<?php

namespace App\Http\Controllers;
use App\Models\AffiliateUser;
use App\Models\AffiliateReferral;
use App\Models\PaymentRequest;

use Illuminate\Http\Request;

class AffiliateDashboardController extends Controller
{
    public function index() 
    {
        // Get the customer ID from session
        $affiliateId = session('affiliate_user_id');

        // Retrieve the customer
        $customer = AffiliateUser::find($affiliateId);

        // Decode promotion_method if it's a JSON string and handle null cases
        if ($customer && is_string($customer->promotion_method)) {
            $customer->promotion_method = json_decode($customer->promotion_method, true) ?? [];
        }

        return view('AffiliateDashBoard.myWebsite', compact('customer'));
    }

    

    public function updateBasicInfo(Request $request)
    {
        $affiliateId = session('affiliate_user_id');
        $customer = AffiliateUser::where('id', $affiliateId)->first();

        if ($customer) {
            $customer->name = $request->input('payeename');
            $customer->email = $request->input('loginemail');
            $customer->contactno = $request->input('loginphone');
            $customer->save();
        }

        return redirect()->back()->with('success', 'Basic information updated successfully.');
    }




    public function updateSiteInfo(Request $request)
    {
        $request->validate([
            'promotion_methods' => 'nullable|array',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'content_website_url' => 'nullable|url',
            'content_whatsapp_url' => 'nullable|url',
        ]);

        
        $affiliateId = session('affiliate_user_id');
        $customer = AffiliateUser::where('id', $affiliateId)->first();

        if ($customer) {
            $selectedMethods = $request->promotion_methods ?? [];
            $customer->promotion_method = json_encode($selectedMethods);

            $customer->instagram_url = in_array('Instagram', $selectedMethods) ? $request->instagram_url : null;
            $customer->facebook_url = in_array('Facebook', $selectedMethods) ? $request->facebook_url : null;
            $customer->tiktok_url = in_array('TikTok', $selectedMethods) ? $request->tiktok_url : null;
            $customer->youtube_url = in_array('YouTube', $selectedMethods) ? $request->youtube_url : null;
            $customer->content_website_url = in_array('Content website/blog', $selectedMethods) ? $request->content_website_url : null;
            $customer->content_whatsapp_url = in_array('WhatsApp', $selectedMethods) ? $request->whatsapp_url : null;


            $customer->save();

            return redirect()->back()->with('success', 'Site information updated successfully.');
        }

        return redirect()->back()->with('error', 'Unable to update site information.');
    }


    public function affiliatelogin() 
    {

        return view('AffiliateDashBoard.affLogin');
    }
}
