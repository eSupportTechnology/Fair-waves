<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AffiliateUser;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Session;

class AffiliatePaymentController extends Controller
{
    public function bank_acc(){

        return view('AffiliateDashBoard.bankInfo');

    }

    public function updatebank(Request $request)
    {
        
        // Validate the form data
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        // Get the customer ID from session
        $affiliateId = session('affiliate_user_id');
        $customer = AffiliateUser::findOrFail($affiliateId);

        //dd($customer);

        // Update the customer's bank account details
        $customer->update([
            'bank_name' => $request->input('bank_name'),
            'branch' => $request->input('branch'),
            'account_name' => $request->input('account_name'),
            'account_number' => $request->input('account_number'),
        ]);

        // Redirect back with a success message
        return redirect()->route('payment_info')->with('success', 'Bank account details added successfully.');
    }

    public function paymentRequest(Request $request)
    {
        
        // Validate the form input
        $request->validate([
            'withdraw_amount' => 'required|numeric',
            'total' => 'required|numeric|min:1000',
        ]);

        

        // Get the customer ID from the session (assuming customer_id is stored in the session)
        $affiliateId = session('affiliate_user_id');
    
        // Ensure the total balance is more than 1000
        if ($request->total < 1000) {
            return redirect()->back()->with('error', 'Your total value must be more than 1000.');
        }

        if($request->total<$request->withdraw_amount){
            return redirect()->back()->with('error', 'Your Request value must be lover than Your Total Value.');
        }
        
    
        // Get the user's bank details from Affiliate_User
        $customer = AffiliateUser::findOrFail($affiliateId);
        
        if (!$customer || !$customer->account_number) {
            return redirect()->back()->with('error', 'No valid bank details found for the user.');
        }
        
        //dd($customer);
        // Store the payment request in the payment_requests table
        $paymentRequest = PaymentRequest::create([
            'user_id' => $affiliateId,
            'withdraw_amount' => $request->input('withdraw_amount'),
            'bank_name' => $customer->bank_name,
            'branch' => $customer->branch,
            'account_name' => $customer->account_name,
            'account_number' => $customer->account_number,
            'status' => 'Pending', // Default status is pending
            'requested_at' => now(),
        ]);

        return redirect()->route('withdrawals')->with('success', 'Your payment request has been submitted and will be processed within 48 hours.');
    }
}
