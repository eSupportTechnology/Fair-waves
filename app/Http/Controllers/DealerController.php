<?php

namespace App\Http\Controllers;

use App\CommissionType;
use App\Models\Commission;
use App\Models\DealerProfile;
use App\Models\DealerReferral;
use App\Models\Notification;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Mockery\Matcher\Not;

class DealerController extends Controller
{
    public function index(Request $request)
    {
        $refCode = $request->query('ref');

        if (!Auth::check()) {
            return view('frontend.dealer.dealer-register', compact('refCode'));
        }

        $userId = Auth::id();
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        if ($user->role === 'dealer') {
            return redirect()->route('dealer.dashboard')->with('success', 'You are already a dealer.');
        }

        return view('frontend.dealer.become-a-dealer', compact('refCode'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'dealer_code' => 'required|string|max:255|exists:dealer_profiles,dealer_code',
            // 'agreement' => 'accepted',
        ]);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        $referrerProfile = DealerProfile::where('dealer_code', $request->dealer_code)->first();
        $referrerUser = $referrerProfile->user;

        $userId = Auth::id();
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->role = 'dealer';
        $user->referred_by = $referrerUser->id; // Set the referrer
        $user->save();

        $dealer_code_generated = 'D-' . strtoupper(uniqid());

        DealerProfile::create([
            'user_id' => Auth::id(),
            'rank' => 'Beginner',
            'cbv' => 0,
            'bv' => 0,
            'tier' => 'silver',
            'dealer_code' => $dealer_code_generated,
        ]);

        // Step 4: Add to Referral Table
        DealerReferral::create([
            'dealer_id' => $referrerUser->id,
            'referred_id' => $user->id,
            'approved' => false, // allow referrer to approve later via dashboard
        ]);

        // Optional: Notify referrer (event or notification)
        // Notification::send($referrerUser, new NewReferralNotification($user));

        return redirect()->back()->with('success', 'Your dealer application has been submitted successfully.');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your orders.');
        }

        $userId = Auth::id();
        $dealer = User::where('id', $userId)->where('role', 'dealer')->first();
        if (!$dealer) {
            return redirect()->back()->with('error', 'You are not a dealer.');
        }

        $dealerProfile = DealerProfile::where('user_id', $userId)->first();
        if (!$dealerProfile) {
            return redirect()->back()->with('error', 'Dealer profile not found.');
        }

        // Get total team members (recursive)
        $teamCount = $this->countDownline($dealer);

        // Get this week's earnings (optional filters: only rank/team commissions)
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $weeklyEarnings = Commission::where('dealer_id', $dealer->id)
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->sum('amount');

        // Load direct referrals
        $directReferrals = $dealer->directReferrals()
            ->with('dealerProfile')
            ->get();

        // Get downline users
        $downlines = $dealer->directReferrals()->with('dealerProfile')->get();

        // Count MAs in downlines
        $marketingAssistants = $downlines->filter(function ($user) {
            return $user->dealerProfile?->rank === 'Marketing Assistant';
        })->count();

        // Count how many links (groups under him)
        $linkCount = $downlines->count();

        // Determine current CBV
        $currentCBV = $dealerProfile->cbv;

        // Get current rank and define next rank info
        $rankMap = [
            'Beginner' => [
                'name' => 'Marketing Assistant',
                'target_cbv' => 700,
                'methods' => [],
            ],
            'Marketing Assistant' => [
                'name' => 'Marketing Executive',
                'target_cbv' => 10000,
                'methods' => [
                    ['cbv' => 5000, 'links' => 0, 'assistants' => 0],
                    ['cbv' => 10000, 'links' => 2, 'assistants' => 2],
                    ['cbv' => 6000, 'links' => 3, 'assistants' => 3],
                ]
            ],
            'Marketing Executive' => [
                'name' => 'Senior Marketing Executive',
                'target_cbv' => 15000,
                'methods' => [
                    ['cbv' => 15000, 'links' => 0, 'assistants' => 0],
                    ['cbv' => 40000, 'links' => 2, 'assistants' => 2],
                    ['cbv' => 26000, 'links' => 3, 'assistants' => 3],
                ]
            ],
            // Add more ranks here as needed...
        ];

        $currentRank = $dealerProfile->rank;
        $nextRankData = $rankMap[$currentRank] ?? null;
        $progressPercent = $nextRankData
            ? min(100, ($currentCBV / $nextRankData['target_cbv']) * 100)
            : 0;


        // 1 BV = 100 LKR
        $availableWithdrawalLKR = $dealerProfile->bv * 100;

        // Define withdrawal days
        $today = Carbon::now()->format('D');
        $withdrawalDays = ['Thu', 'Fri', 'Sat'];
        $isWithdrawalDay = in_array($today, $withdrawalDays);

        // Next withdrawal day (only if today is not allowed)
        $nextWithdrawalDay = null;
        if (!$isWithdrawalDay) {
            $carbonToday = Carbon::now();
            foreach ($withdrawalDays as $day) {
                $next = Carbon::parse("next $day");
                if (!$nextWithdrawalDay || $next->lt($nextWithdrawalDay)) {
                    $nextWithdrawalDay = $next;
                }
            }
            $nextWithdrawalDayFormatted = $nextWithdrawalDay->format('l');
        } else {
            $nextWithdrawalDayFormatted = null;
        }

        // Calculate weekly commission breakdown
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $commissionTypes = CommissionType::values();
        $commissionBreakdown = [];

        foreach ($commissionTypes as $type) {
            $commissionBreakdown[$type] = Commission::where('dealer_id', $dealer->id)
                ->where('level', $type)
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('amount');
        }

        $totalWeeklyEarnings = array_sum($commissionBreakdown);


        // Recent Team Activity
        $recentCommissions = Commission::with(['source'])
        ->where('dealer_id', $dealer->id)
        ->latest()
        ->limit(5)
        ->get();

        $recentJoins = DealerReferral::with(['referred'])
            ->where('dealer_id', $dealer->id)
            ->latest()
            ->limit(5)
            ->get();

        $activities = collect();

        foreach ($recentCommissions as $c) {
            $activities->push([
                'type' => 'purchase',
                'name' => $c->source->name,
                'initials' => strtoupper(substr($c->source->name, 0, 2)),
                'amount' => $c->order->total ?? null,
                'commission' => $c->amount,
                'date' => $c->created_at,
            ]);
        }

        foreach ($recentJoins as $r) {
            $activities->push([
                'type' => 'join',
                'name' => $r->referred->name,
                'initials' => strtoupper(substr($r->referred->name, 0, 2)),
                'amount' => null,
                'commission' => null,
                'date' => $r->created_at,
            ]);
        }

        $recentActivities = $activities->sortByDesc('date')->take(5);


        // Pending referrals awaiting approval
        $pendingReferralsCount = DealerReferral::where('dealer_id', $dealer->id)
            ->where('approved', false)
            ->count();

        // Unread notifications
        $notificationCount = Notification::where('user_id', $dealer->id)
            ->where('is_read', false)
            ->count();


        return view('frontend.dealer.dashboard', compact(
            'dealerProfile',
            'directReferrals',
            'teamCount',
            'weeklyEarnings',
            'currentCBV',
            'currentRank',
            'nextRankData',
            'progressPercent',
            'linkCount',
            'marketingAssistants',
            'availableWithdrawalLKR',
            'isWithdrawalDay',
            'nextWithdrawalDayFormatted',
            'commissionBreakdown',
            'totalWeeklyEarnings',
            'recentActivities',
            'pendingReferralsCount',
            'notificationCount',




        ));
    }

    public function pendingReferrals()
    {
        $referrals = DealerReferral::with('referred')
            ->where('dealer_id', Auth::id())
            ->where('approved', false)
            ->get();

        return view('frontend.dealer.pending-referrals', compact('referrals'));
    }

    public function analytics()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your orders.');
        }

        $userId = Auth::id();
        $dealer = User::where('id', $userId)->where('role', 'dealer')->first();
        if (!$dealer) {
            return redirect()->back()->with('error', 'You are not a dealer.');
        }

        $dealerProfile = DealerProfile::where('user_id', $userId)->first();
        if (!$dealerProfile) {
            return redirect()->back()->with('error', 'Dealer profile not found.');
        }

        // Get total team members (recursive)
        $teamCount = $this->countDownline($dealer);

        // Placeholder for advanced analytics
        return view('frontend.dealer.analytics', compact( 'dealerProfile', 'teamCount'));
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.dealer.notifications', compact('notifications'));
    }

    public function approveReferral($id)
    {
        $ref = DealerReferral::where('dealer_id', Auth::id())->findOrFail($id);
        $ref->approved = true;
        $ref->save();

        Notification::create([
            'user_id' => $ref->referred_id,
            'type' => 'referral_approved',
            'message' => 'Your referral application has been approved. Welcome to the dealer network!',
            'is_read' => false,
        ]);

        return back()->with('success', 'Referral approved.');
    }

    public function rejectReferral($id)
    {
        $ref = DealerReferral::where('dealer_id', Auth::id())->findOrFail($id);
        $ref->delete();

        DealerProfile::where('user_id', $ref->referred_id)->delete(); // Optionally delete the profile

        $customer = User::find($ref->referred_id);
        $customer->role = 'customer'; // Revert role if needed
        $customer->save();

        // Optionally notify the customer
        // Notification::send($customer, new ReferralRejectedNotification());

        // Optionally log this action
        Notification::create([
            'user_id' => $customer->id,
            'type' => 'referral_rejected',
            'message' => 'Your referral application has been rejected.',
            'is_read' => false,
        ]);



        return back()->with('success', 'Referral rejected.');
    }



    public function requestWithdrawal()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your orders.');
        }

        $userId = Auth::id();
        $user = User::where('id', $userId)->where('role', 'dealer')->first();
        if (!$user) {
            return redirect()->back()->with('error', 'You are not a dealer.');
        }

        $profile = $user->dealerProfile;

        // Only allow on Thu, Fri, Sat
        $today = Carbon::now()->format('D');
        if (!in_array($today, ['Thu', 'Fri', 'Sat'])) {
            return back()->with('error', 'Withdrawals only allowed on Thu, Fri, Sat.');
        }

        if ($profile->bv <= 0) {
            return back()->with('error', 'You have no available BV to withdraw.');
        }

        // Save withdrawal request
        WithdrawalRequest::create([
            'dealer_id' => $user->id,
            'amount' => $profile->bv * 100, // in LKR
            'status' => 'pending',
        ]);

        // Reset BV after request (optional - or wait until approved)
        if ($profile instanceof \Illuminate\Database\Eloquent\Model) {
            $profile->bv = 0;
            $profile->save();
        }

        return back()->with('success', 'Withdrawal request submitted successfully.');
    }


    // Recursive team member counter
    private function countDownline($user)
    {
        $referrals = $user->directReferrals;
        $count = $referrals->count();

        foreach ($referrals as $referral) {
            $count += $this->countDownline($referral);
        }

        return $count;
    }

    public function fullHierarchy()
    {
        $user = Auth::user();

        // Recursively load the full downline tree
        $tree = $this->buildHierarchy($user);

        return view('frontend.dealer.full-hierarchy', compact('tree', 'user'));
    }

    protected function buildHierarchy($user, $depth = 0)
    {
        $referrals = $user->directReferrals()->with('dealerProfile')->get();

        return $referrals->map(function ($referral) use ($depth) {
            return [
                'user' => $referral,
                'depth' => $depth,
                'children' => $this->buildHierarchy($referral, $depth + 1)
            ];
        });
    }

    public function showRegisterForm(Request $request)
    {
        $refCode = $request->query('ref');
        return view('frontend.dealer.dealer-register', compact('refCode'));
    }

    public function register(Request $request){
        $request->validate([
            'dealer_code' => 'required|string|max:255|exists:dealer_profiles,dealer_code',
            // 'name' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:15'],
        ]);

        // Step 1: Get Referrer
        $referrerProfile = DealerProfile::where('dealer_code', $request->dealer_code)->first();
        $referrerUser = $referrerProfile->user;

        // Step 2: Create New User
        $user = User::create([
            'name' => $request->fname . " " . $request->lname,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'role' => 'dealer', // or 'customer' based on your logic
            'referred_by' => $referrerUser->id, // Set the referrer
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Step 3: Create Dealer Profile
        $dealer_code_generated = 'D-' . strtoupper(uniqid());
        DealerProfile::create([
            'user_id' => $user->id,
            'rank' => 'Beginner',
            'cbv' => 0,
            'bv' => 0,
            'tier' => 'silver',
            'dealer_code' => $dealer_code_generated,
        ]);

        // Step 4: Add to Referral Table
        DealerReferral::create([
            'dealer_id' => $referrerUser->id,
            'referred_id' => $user->id,
            'approved' => false, // allow referrer to approve later via dashboard
        ]);

        // Optional: Notify referrer (event or notification)
        // Notification::send($referrerUser, new NewReferralNotification($user));

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
