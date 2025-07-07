<?php

namespace App\Http\Controllers;

use App\CommissionType;
use App\Models\Commission;
use App\Models\DealerProfile;
use App\Models\DealerReferral;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

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
        $customer = User::where('id', $userId)->where('role', 'dealer')->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'You are not a dealer.');
        }

        $dealerProfile = DealerProfile::where('user_id', $userId)->first();
        if (!$dealerProfile) {
            return redirect()->back()->with('error', 'Dealer profile not found.');
        }

        // Get total team members (recursive)
        $teamCount = $this->countDownline($customer);

        // Get this week's earnings (optional filters: only rank/team commissions)
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $weeklyEarnings = Commission::where('dealer_id', $customer->id)
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->sum('amount');

        // Load direct referrals
        $directReferrals = $customer->directReferrals()
            ->with('dealerProfile')
            ->get();

        // Get downline users
        $downlines = $customer->directReferrals()->with('dealerProfile')->get();

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
            $commissionBreakdown[$type] = Commission::where('dealer_id', $customer->id)
                ->where('level', $type)
                ->whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('amount');
        }

        $totalWeeklyEarnings = array_sum($commissionBreakdown);


        // Recent Team Activity
        $recentCommissions = Commission::with(['source'])
        ->where('dealer_id', $customer->id)
        ->latest()
        ->limit(5)
        ->get();

        $recentJoins = DealerReferral::with(['referred'])
            ->where('dealer_id', $customer->id)
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



        ));
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
