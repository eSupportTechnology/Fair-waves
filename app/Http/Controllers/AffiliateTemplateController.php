<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AffiliateUser;
use App\Models\AffiliateReferral;
use App\Models\PaymentRequest;

class AffiliateTemplateController extends Controller
{
    public function index(){

        $affiliateId = session('affiliate_user_id');
        $affiliateName = $affiliateId ? AffiliateUser::find($affiliateId)->name : 'Guest';

        // Get all referral records for the current affiliate
        $referrals = AffiliateReferral::where('user_id', $affiliateId)->get();

        // Calculate total referrals and total views
        $totalReferrals = $referrals->sum('referral_count');
        $totalViews = $referrals->sum('views_count');

        // Total Unpaid Earnings (set to 0 as per the original code)
        $totalUnpaidEarnings = 0;

        // Calculate total paid earnings
        $totalPaidEarnings = $referrals->sum('total_affiliate_price');

        // Calculate total paid amount for completed payment requests
        $completedPayments = PaymentRequest::where('user_id', $affiliateId)
        ->where('status', 'completed')
        ->sum('withdraw_amount');

        // Update totalPaidEarnings by subtracting completedPayments
        $totalPaidEarnings = max(0, $totalPaidEarnings - $completedPayments);

        // Calculate referrals over the last 12 months
        $referralsOverMonths = [];
        $months = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('M');
            
            // Filter referrals by the specific month and user ID
            $monthlyReferrals = AffiliateReferral::where('user_id', $affiliateId)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('referral_count');
            
            $months[] = $monthName;
            $referralsOverMonths[] = $monthlyReferrals;
        }

        return view('AffiliateDashBoard.affindex',compact(
            'affiliateName',
            'affiliateId',
            'totalReferrals',
            'totalViews',
            'totalUnpaidEarnings',
            'totalPaidEarnings',
            'referralsOverMonths', // Added for monthly chart data
            'months', // Added for x-axis labels in the chart
            'completedPayments'
        ));
    }

    

    
}
