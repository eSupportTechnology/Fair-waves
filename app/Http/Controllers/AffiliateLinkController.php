<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Models\RaffleTicket;
use App\Models\AffiliateLink;
use App\Models\Product;
use App\Models\AffiliateReferral;
use App\Models\AffiliateProduct;

use Illuminate\Http\Request;

class AffiliateLinkController extends Controller
{
    public function showAffiliateForm() 
    {
        $affiliateId = session('affiliate_user_id');

        // Fetch tracking IDs associated with the logged-in affiliate user
        $trackingIds = RaffleTicket::where('user_id', $affiliateId)
                        ->where('status', 'Pending') // Optional: filter by active status
                        ->get(['token']); // Only select the 'token' field

        // Pass tracking IDs to the view
        return view('AffiliateDashBoard.tools', compact('trackingIds'));
    }

    public function generateNewLink(Request $request)
    {
        // Validate the input
        $request->validate([
            'product_url' => 'required|url',
            'tracking_id' => 'required|string'
        ]);

        // Extract the product identifier from the product URL
        $productIdentifier = basename($request->product_url);

        // Find the product using the product_id or product_name
        $product = Product::where('product_id', $productIdentifier)
            ->orWhere('product_name', $productIdentifier)
            ->first();

        if (!$product) {
            return redirect()->back()->withErrors('Product not found. Please verify the product URL.');
        }

        // Validate that the product is eligible for affiliate links
        if (!$product->is_affiliate || !$product->affiliate_price) {
            return redirect()->back()->withErrors('This product is not eligible for affiliate links.');
        }

        // Generate the tracking URL
        $trackingUrl = url('/track/' . $request->tracking_id . '/' . $product->product_id) . '?redirect=' . urlencode($request->product_url);

        // Find the raffle ticket using the tracking ID
        $raffleTicket = RaffleTicket::where('token', $request->tracking_id)->first();

        if (!$raffleTicket) {
            return redirect()->back()->withErrors('Invalid tracking ID.');
        }

        // Calculate the commission
        $commissionPrice = $product->total_price - $product->affiliate_price;

        // Save the generated link to the affiliate_links table
        $affiliateLink = AffiliateLink::create([
            'user_id' => $raffleTicket->user_id,
            'raffle_ticket_id' => $raffleTicket->id,
            'link' => $trackingUrl,
        ]);

        // Save product details and other referral data in the AffiliateReferral table
        AffiliateReferral::create([
            'user_id' => $raffleTicket->user_id,
            'raffle_ticket_id' => $raffleTicket->id,
            'product_url' => $request->product_url,
            'views_count' => 0,
            'referral_count' => 0,
            'product_price' => $product->normal_price, // Use normal_price from the model
            'affiliate_commission' => $product->commission_price, // Calculate commission
        ]);

        // Link the product and the affiliate link
        AffiliateProduct::create([
            'product_id' => $product->id,
            'affiliate_link_id' => $affiliateLink->id,
        ]);

        // Redirect back to the form with the generated link
        return redirect()->back()->with('generated_link', $trackingUrl);
    }


    public function calculateCommission($affiliatePrice)
    {
        // Assuming the product has a commission percentage field, and it is stored as a decimal value (e.g., 0.10 for 10%)
        // Fetch the commission percentage from the product
        $product = Product::where('affiliate_price', $affiliatePrice)->first();

        // Ensure the product has a valid commission percentage
        if ($product && $product->commission_percentage > 0) {
            // Calculate the commission as a percentage of the affiliate price
            $commission = ($product->commission_percentage / 100) * $affiliatePrice;

            // Return the calculated commission
            return $commission;
        }

        // If no valid commission percentage is found, return 0
        return 0;
    }

    public function trackClick(Request $request, $tracking_id, $product_id)
    {
        // Find the raffle ticket by the tracking ID
        $raffleTicket = RaffleTicket::where('token', $tracking_id)->first();

        if ($raffleTicket) {
            // Find the specific referral record by raffle_ticket_id and product_id
            $referral = AffiliateReferral::where('raffle_ticket_id', $raffleTicket->id)
                                        ->where('product_url', 'like', '%' . $product_id . '%')
                                        ->first();

                if ($referral) {
                // Increment the views count for the specific product referral
                $referral->increment('views_count');

                // Store tracking_id in the session for later use during the checkout process
                session(['tracking_id' => $tracking_id]);

                // Check if a redirect URL is provided
                if ($request->has('redirect')) {
                    return redirect($request->input('redirect'));
                }

                // Default redirect if no redirect URL is provided
                return redirect('/');
            }
        }

        // If not found, redirect to home or show an error
        return redirect('/')->withErrors('Invalid tracking link.');
    }


    public function codeCenter()
    {
        // Get the customer ID from session
        $affiliateId = session('affiliate_user_id');

        // Find all affiliate links for the customer
        $affiliateLinks = AffiliateLink::with(['raffleTicket', 'product'])
            ->where('user_id', $affiliateId)
            ->get();
        
        return view('AffiliateDashBoard.codeCenter',compact('affiliateLinks'));
    }
}
