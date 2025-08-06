<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ReturnRequestMail;
use App\Mail\ReturnRequestStatusMail;
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

    /**
     * Get order data for auto-filling form fields
     */
    public function getOrderData($orderCode)
    {
        Log::info('Fetching order data for auto-fill', ['order_code' => $orderCode]);

        try {
            // Find the order by order_code
            $order = CustomerOrder::where('order_code', $orderCode)->first();

            if (!$order) {
                Log::warning('Order not found for auto-fill', ['order_code' => $orderCode]);
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found. Please check the Order ID and try again.'
                ], 404);
            }

            // Return the order data for auto-filling
            return response()->json([
                'success' => true,
                'data' => [
                    'customer_name' => $order->customer_name,
                    'phone' => $order->phone,
                    'email' => $order->email,
                    'order_date' => $order->date // This will be in the format stored in database
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching order data for auto-fill', [
                'order_code' => $orderCode,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching order data. Please try again.'
            ], 500);
        }
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
            
            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // Additional validation: Check if the order exists and customer details match
        $order = CustomerOrder::where('order_code', $validatedData['order_id'])->first();
        if ($order) {
            // Verify customer details match (case-insensitive comparison)
            $nameMatch = strtolower(trim($order->customer_name)) === strtolower(trim($validatedData['customer_name']));
            $emailMatch = strtolower(trim($order->email)) === strtolower(trim($validatedData['email']));
            $phoneMatch = preg_replace('/\D/', '', $order->phone) === preg_replace('/\D/', '', $validatedData['phone']);
            
            if (!$nameMatch || !$emailMatch || !$phoneMatch) {
                Log::warning('Customer details mismatch', [
                    'order_code' => $validatedData['order_id'],
                    'submitted_name' => $validatedData['customer_name'],
                    'order_name' => $order->customer_name,
                    'name_match' => $nameMatch,
                    'email_match' => $emailMatch,
                    'phone_match' => $phoneMatch
                ]);
                
                // Return JSON response for AJAX requests
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The customer details you entered do not match our records for this order. Please verify your information and try again.',
                        'errors' => ['validation' => 'The customer details you entered do not match our records for this order. Please verify your information and try again.']
                    ], 422);
                }
                
                return back()->withErrors([
                    'validation' => 'The customer details you entered do not match our records for this order. Please verify your information and try again.'
                ])->withInput();
            }
            
            Log::info('Customer details verified successfully', ['order_code' => $validatedData['order_id']]);
        } else {
            Log::warning('Order not found for return request', ['order_code' => $validatedData['order_id']]);
            
            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found. Please check your Order ID and try again.',
                    'errors' => ['validation' => 'Order not found. Please check your Order ID and try again.']
                ], 422);
            }
            
            return back()->withErrors([
                'validation' => 'Order not found. Please check your Order ID and try again.'
            ])->withInput();
        }

        // Check if a return request already exists for this order
        $existingRequest = ReturnRequest::where('order_code', $validatedData['order_id'])->first();
        if ($existingRequest) {
            Log::warning('Duplicate return request attempted', ['order_code' => $validatedData['order_id']]);
            
            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'A return/cancel request has already been submitted for this order.',
                    'errors' => ['validation' => 'A return/cancel request has already been submitted for this order.']
                ], 422);
            }
            
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
                
                $message = ucfirst($validatedData['request_type']) . ' request submitted successfully. However, no administrators were found to notify.';
                
                // Return JSON response for AJAX requests
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => $message,
                        'return_request_id' => $returnRequest->id
                    ]);
                }
                
                return back()->with('success', $message);
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

            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
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

            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'There was an error processing your request. Please try again later.',
                    'errors' => ['validation' => 'There was an error processing your request. Please try again later.']
                ], 500);
            }

            return back()->withErrors([
                'validation' => 'There was an error processing your request. Please try again later.'
            ])->withInput();
        }
    }

    public function approve(Request $request, $id)
    {
        Log::info('Approve method called', [
            'request_id' => $id,
            'request_data' => $request->all(),
            'session_email' => session('email'),
            'session_data' => session()->all()
        ]);

        try {
            $returnRequest = ReturnRequest::findOrFail($id);
            
            Log::info('Return request found', [
                'current_status' => $returnRequest->status,
                'request_type' => $returnRequest->request_type
            ]);
            
            // Update status to 'confirmed' instead of 'approved'
            $returnRequest->update([
                'status' => 'confirmed',
                'admin_response' => $request->input('admin_response', 'Request approved by administrator.'),
                'processed_by' => session('email', 'admin@system.com'),
                'processed_at' => now(),
            ]);

            Log::info('Return request updated', [
                'new_status' => $returnRequest->fresh()->status,
                'admin_response' => $returnRequest->admin_response
            ]);

            // Send email notification to customer
            try {
                Mail::to($returnRequest->email)->send(new ReturnRequestStatusMail($returnRequest, 'approved'));
                Log::info('Customer approval email sent successfully', [
                    'return_request_id' => $id,
                    'customer_email' => $returnRequest->email
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send customer approval email', [
                    'return_request_id' => $id,
                    'customer_email' => $returnRequest->email,
                    'error' => $e->getMessage()
                ]);
            }

            Log::info('Return request approved', [
                'return_request_id' => $id,
                'processed_by' => session('email')
            ]);

            return redirect()->back()->with('success', 'Return request approved successfully. Customer has been notified via email.');
        } catch (\Exception $e) {
            Log::error('Error approving return request', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to approve return request: ' . $e->getMessage()]);
        }
    }

    public function reject(Request $request, $id)
    {
        Log::info('Reject method called', [
            'request_id' => $id,
            'request_data' => $request->all(),
            'session_email' => session('email')
        ]);

        try {
            $returnRequest = ReturnRequest::findOrFail($id);
            
            // Validate that admin response is provided for rejection
            $adminResponse = $request->input('admin_response');
            if (empty(trim($adminResponse))) {
                Log::warning('Admin response required for rejection', ['request_id' => $id]);
                return redirect()->back()->withErrors(['error' => 'Admin response is required when rejecting a return request.']);
            }
            
            Log::info('Return request found for rejection', [
                'current_status' => $returnRequest->status,
                'admin_response' => $adminResponse
            ]);
            
            $returnRequest->update([
                'status' => 'rejected',
                'admin_response' => trim($adminResponse),
                'processed_by' => session('email', 'admin@system.com'),
                'processed_at' => now(),
            ]);

            Log::info('Return request updated to rejected', [
                'new_status' => $returnRequest->fresh()->status,
                'admin_response' => $returnRequest->admin_response
            ]);

            // Send email notification to customer
            try {
                Mail::to($returnRequest->email)->send(new ReturnRequestStatusMail($returnRequest, 'rejected'));
                Log::info('Customer rejection email sent successfully', [
                    'return_request_id' => $id,
                    'customer_email' => $returnRequest->email
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send customer rejection email', [
                    'return_request_id' => $id,
                    'customer_email' => $returnRequest->email,
                    'error' => $e->getMessage()
                ]);
            }

            Log::info('Return request rejected', [
                'return_request_id' => $id,
                'processed_by' => session('email')
            ]);

            return redirect()->back()->with('success', 'Return request rejected successfully. Customer has been notified via email.');
        } catch (\Exception $e) {
            Log::error('Error rejecting return request', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => 'Failed to reject return request: ' . $e->getMessage()]);
        }
    }
}
