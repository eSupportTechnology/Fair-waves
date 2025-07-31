<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ReturnRequestMail;
use App\Models\CustomerOrder;
use App\Models\ReturnRequest;
use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ReturnRequestController extends Controller
{
    public function show()
    {
        return view('frontend.ReturnProduct');
    }

    public function submit(Request $request)
    {
        Log::info('Return request submission started', $request->all());

        // Validate the request
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'order_date' => 'required|date',
            'request_type' => 'required|in:cancel,return',
            'reason' => 'required|string|max:1000',
            't_and_c_agree' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            Log::warning('Return request validation failed', $validator->errors()->toArray());
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Check if a return request already exists for this order
        $existingRequest = ReturnRequest::where('order_code', $validatedData['order_id'])->first();
        if ($existingRequest) {
            Log::warning('Duplicate return request attempted', ['order_code' => $validatedData['order_id']]);
            return back()->withErrors([
                'validation' => 'A return/cancel request has already been submitted for this order.'
            ])->withInput();
        }

        try {
            // Create return request
            $returnRequest = ReturnRequest::create([
                'order_code' => $validatedData['order_id'],
                'customer_name' => $validatedData['customer_name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'order_date' => $validatedData['order_date'],
                'request_type' => $validatedData['request_type'],
                'cancel_reason' => $validatedData['reason'], // Map 'reason' to 'cancel_reason'
                'status' => 'pending'
            ]);

            Log::info('Return request created successfully', ['return_request_id' => $returnRequest->id]);

            // Get all admin and super admin users
            $adminUsers = SystemUser::whereIn('role', ['Admin', 'Super Admin'])
                ->where('status', 'Active')
                ->get();

            Log::info('Admin users search completed', [
                'total_system_users' => SystemUser::count(),
                'admin_users_found' => $adminUsers->count(),
                'admin_emails' => $adminUsers->pluck('email')->toArray()
            ]);

            if ($adminUsers->isEmpty()) {
                Log::error('No active admin users found for email notification');
                return back()->with('success', ucfirst($validatedData['request_type']) . ' request submitted successfully. However, no administrators were found to notify.');
            }

            $emailsSent = 0;
            $emailErrors = [];

            // Send email to each admin
            foreach ($adminUsers as $admin) {
                try {
                    Mail::to($admin->email)->send(new ReturnRequestMail($returnRequest));
                    $emailsSent++;
                    Log::info('Email sent successfully', ['admin_email' => $admin->email]);
                } catch (\Exception $e) {
                    $emailErrors[] = $admin->email;
                    Log::error('Failed to send email to admin', [
                        'admin_email' => $admin->email,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            Log::info('Email sending completed', [
                'emails_sent' => $emailsSent,
                'total_admins' => $adminUsers->count(),
                'failed_emails' => $emailErrors
            ]);

            $requestType = $validatedData['request_type'] === 'cancel' ? 'Cancellation' : 'Return';
            $message = "$requestType request submitted successfully.";
            
            // Log email results but don't show in user message
            if ($emailsSent == 0) {
                Log::error('All email notifications failed', [
                    'failed_emails' => $emailErrors,
                    'return_request_id' => $returnRequest->id
                ]);
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error processing return request', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $validatedData
            ]);

            return back()->withErrors([
                'validation' => 'There was an error processing your request. Please try again later.'
            ])->withInput();
        }
    }

    public function approve(Request $request, $id)
    {
        try {
            $returnRequest = ReturnRequest::findOrFail($id);
            
            $returnRequest->update([
                'status' => 'approved',
                'admin_response' => $request->input('admin_response', 'Request approved by administrator.'),
                'processed_by' => session('email', 'admin@system.com'),
                'processed_at' => now(),
            ]);

            Log::info('Return request approved', [
                'return_request_id' => $id,
                'processed_by' => session('email')
            ]);

            return back()->with('success', 'Return request approved successfully.');
        } catch (\Exception $e) {
            Log::error('Error approving return request', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Failed to approve return request.']);
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $returnRequest = ReturnRequest::findOrFail($id);
            
            $returnRequest->update([
                'status' => 'rejected',
                'admin_response' => $request->input('admin_response', 'Request rejected by administrator.'),
                'processed_by' => session('email', 'admin@system.com'),
                'processed_at' => now(),
            ]);

            Log::info('Return request rejected', [
                'return_request_id' => $id,
                'processed_by' => session('email')
            ]);

            return back()->with('success', 'Return request rejected successfully.');
        } catch (\Exception $e) {
            Log::error('Error rejecting return request', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Failed to reject return request.']);
        }
    }
}
