<?php

namespace App\Http\Controllers;

use App\Models\RaffleTicket;
use App\Models\AffiliateReferral;
use App\Models\Product;
use App\Models\AffiliateUser;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AffiliateReportController extends Controller
{
    public function trafficreport(Request $request) 
    {
        // Get the customer ID from session
        $affiliateId = session('affiliate_user_id');

        // If customer_id is not found in session, handle the error or redirect
        if (!$affiliateId) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // Fetch all raffle tickets for the current user to show in the dropdown
        $raffleTickets = RaffleTicket::where('user_id', $affiliateId)->get();

        // Initialize the query for AffiliateReferral
        $query = AffiliateReferral::where('user_id', $affiliateId)->with(['raffleTicket']);

        // Apply filter if a specific raffle ticket is selected
        if ($request->has('raffle_ticket_id') && $request->raffle_ticket_id) {
            $query->where('raffle_ticket_id', $request->raffle_ticket_id);
        }

        // Fetch the filtered or unfiltered results
        $affiliateReferrals = $query->get();

        // Loop through each referral and extract the product_id from the product_url
        foreach ($affiliateReferrals as $referral) {
            // Extract the product ID from the URL
            $productIdentifier = basename($referral->product_url); // This gets the last part of the URL (e.g., PRODUCT-XXXXX)

            // Query the Products model to find the product by product_id or product_name
            $product = Product::where('product_id', $productIdentifier)
                ->orWhere('product_name', $productIdentifier)
                ->first();

            // Attach the product name to the referral object for use in the view
            if ($product) {
                $referral->product_name = $product->product_name;
            } else {
                $referral->product_name = 'N/A'; // Fallback if the product isn't found
            }
        }

        return view('AffiliateDashBoard.reports', compact('affiliateReferrals', 'raffleTickets'));
    }

    public function  withdrawals() 
    {

        // Get the customer ID from session
        $affiliateId = session('affiliate_user_id');
        $affiliateName = $affiliateId ? AffiliateUser::find($affiliateId)->name : 'Guest';

        // Get all referral records for the current affiliate
        $referrals = AffiliateReferral::where('user_id', $affiliateId)->get();

        // Calculate total paid earnings
        $totalBalance = $referrals->sum('total_affiliate_price');

        // Calculate total paid amount for completed payment requests
        $completedPayments = PaymentRequest::where('user_id', $affiliateId)
        ->where('status', 'completed')
        ->sum('withdraw_amount');

        // Update totalPaidEarnings by subtracting completedPayments
        $totalBalance = max(0, $totalBalance - $completedPayments);


        $affiliateId = session('affiliate_user_id');
        $paymentRequests = PaymentRequest::where('user_id', $affiliateId)->get();

        return view('AffiliateDashBoard.withdrawals', compact('totalBalance','paymentRequests'));
    }



    public function  showPaymentInfo()
    {
        // Get the customer ID from session
        $affiliateId = session('affiliate_user_id');

        // Fetch the payment details from the Affiliate_Customer model
        $customer = AffiliateUser::where('id', $affiliateId)->first();

        return view('AffiliateDashBoard.paymentInformation', compact('customer'));
    }

   
}
