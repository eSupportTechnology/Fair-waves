<?php

namespace App\Http\Controllers;

use App\Models\VendorWallet; 
use Illuminate\Http\Request;
use App\Models\VendorPaymentRequest;
use App\Models\Vendor; 

class VendorPaymentRequestController extends Controller
{


    public function index()
    {
      
        $pendingRequests = VendorPaymentRequest::where('status', 'Pending')->with('vendor')->get();
        $pendingCount = $pendingRequests->count();
        $completedRequests = VendorPaymentRequest::where('status', 'Completed')->with('vendor')->get();

        return view('AdminDashboard.vendor_payments', compact('pendingRequests', 'completedRequests'));
    }


    
    public function updatePaymentStatus(Request $request, $id)
    {
  
        $request->validate([
            'processing_fee' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $paymentRequest = VendorPaymentRequest::findOrFail($id);

        $paymentRequest->processing_fee = $request->processing_fee;
        $paymentRequest->paid_amount = $request->paid_amount;
        $paymentRequest->status = 'Completed';
        $paymentRequest->save();

        return redirect()->route('admin.vendor.payments')->with('success', 'Payment status updated successfully.');
    }


    public function showPayments()
    {
        $vendor_id = session('vendor_id');
    
        $vendorWallet = VendorWallet::where('vendor_id', $vendor_id)->first();
        $totalBalance = $vendorWallet ? $vendorWallet->balance : 0;
    
        $paymentRequests = VendorPaymentRequest::where('vendor_id', $vendor_id)
            ->orderBy('requested_at', 'desc')
            ->paginate(10);
    
        return view('VendorDashboard.payment_requests', compact('vendorWallet', 'totalBalance', 'paymentRequests'));
    }
    


    
    public function paymentRequest(Request $request)
    {
        $request->validate([
            'request_amount' => 'required|numeric',
        ]);

        $vendorId = session('vendor_id');

        // Fetch the vendor's wallet balance
        $vendorWallet = VendorWallet::where('vendor_id', $vendorId)->first();
        $totalBalance = $vendorWallet ? $vendorWallet->balance : 0;

        // Ensure the total balance is more than 1000
        if ($totalBalance < 1000) {
            return redirect()->back()->with('error', 'Your total value must be more than 1000.');
        }

        // Ensure the withdraw amount is less than the total balance
        if ($totalBalance < $request->request_amount) {
            return redirect()->back()->with('error', 'Your request amount must be less than your total balance.');
        }

        // Get the vendor's bank details
        $vendor = Vendor::findOrFail($vendorId);

        if (!$vendor || !$vendor->account_number) {
            return redirect()->back()->with('error', 'No valid bank details found for the vendor.');
        }

        // Create a new payment request record
        $paymentRequest = VendorPaymentRequest::create([
            'vendor_id' => $vendorId,
            'request_amount' => $request->input('request_amount'),
            'bank_name' => $vendor->bank_name,
            'branch' => $vendor->branch,
            'account_name' => $vendor->account_name,
            'account_number' => $vendor->account_number,
            'status' => 'Pending',
            'requested_at' => now(),
        ]);

        return redirect()->route('vendor.payments')->with('success', 'Your payment request has been submitted and will be processed within 48 hours.');
    }
}
