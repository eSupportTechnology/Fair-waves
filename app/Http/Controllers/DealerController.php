<?php

namespace App\Http\Controllers;

use App\CommissionType;
use App\Models\Commission;
use App\Models\DealerProductLink;
use App\Models\DealerProductOrder;
use App\Models\DealerProfile;
use App\Models\DealerReferral;
use App\Exports\DealersExport;
use App\Models\Notification;
use App\Models\User;
use App\Models\WithdrawalRequest;
use App\Models\BankDetail;
use App\Models\CustomerOrder;
use App\Mail\EmailVerificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
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
            'dealer_shop_name' => 'required|string|max:255',
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
            'dealer_shop_name' => $request->dealer_shop_name,
        ]);

        // Step 4: Add to Referral Table
        DealerReferral::create([
            'dealer_id' => $referrerUser->id,
            'referred_id' => $user->id,
            'approved' => false, // allow referrer to approve later via dashboard
        ]);

        // Optional: Notify referrer (event or notification)
        // Notification::send($referrerUser, new NewReferralNotification($user));

        Notification::create([
            'user_id' => $referrerUser->id,
            'type' => 'new_referral',
            'message' => 'You Have a New Referral: ' . $user->name,
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $user->id,
            'type' => 'registration_success',
            'message' => 'You become a dealer successfully! Please wait for your referral to approve your application.',
            'is_read' => false,
        ]);

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
            return $user->dealerProfile?->rank === 'Bronze Member';
        })->count();

        // Count how many links (groups under him)
        $linkCount = $downlines->count();

        // Determine current CBV
        $currentCBV = $dealerProfile->cbv;

        // Get current rank and define next rank info
        $rankMap = [
            'Loyalty Member' => [
                'name' => 'Bronze Member',
                'target_cbv' => 700,
                'methods' => [
                    ['cbv' => 700, 'links' => 0, 'assistants' => 0],
                ],
            ],
            'Bronze Member' => [
                'name' => 'Silver Member',
                'target_cbv' => 10000,
                'methods' => [
                    ['cbv' => 5000, 'links' => 0, 'assistants' => 0],
                    ['cbv' => 10000, 'links' => 2, 'assistants' => 2],
                    ['cbv' => 6000, 'links' => 3, 'assistants' => 3],
                ]
            ],
            'Silver Member' => [
                'name' => 'Gold Member',
                'target_cbv' => 15000,
                'methods' => [
                    ['cbv' => 15000, 'links' => 0, 'assistants' => 0],
                    ['cbv' => 40000, 'links' => 2, 'assistants' => 2],
                    ['cbv' => 26000, 'links' => 3, 'assistants' => 3],
                ]
            ],
            'Gold Member' => [
                'name' => 'Platinum Member',
                'target_cbv' => 45000,
                'methods' => [
                    ['cbv' => 45000, 'links' => 0, 'assistants' => 0],
                    ['cbv' => 120000, 'links' => 2, 'assistants' => 2],
                    ['cbv' => 85000, 'links' => 3, 'assistants' => 3],
                ],
            ],
            'Platinum Member' => [
                'name' => 'Diamond Member',
                'target_cbv' => 135000,
                'methods' => [
                    ['cbv' => 135000, 'links' => 0, 'assistants' => 0],
                    ['cbv' => 300000, 'links' => 2, 'assistants' => 2],
                    ['cbv' => 270000, 'links' => 3, 'assistants' => 3],
                ],
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
            ->paginate(10); // ✅ This returns a LengthAwarePaginator


        return view('frontend.dealer.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->is_read = true;
        $notification->save();

        return back()->with('success', 'Notification marked as read.');
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
        Log::info('=== WITHDRAWAL REQUEST INITIATED ===', [
            'user_id' => Auth::id(),
            'timestamp' => now(),
            'user_authenticated' => Auth::check(),
            'user_role' => Auth::check() ? Auth::user()->role : 'not_authenticated'
        ]);

        // Check if user is logged in
        if (!Auth::check()) {
            Log::warning('Withdrawal request failed: User not authenticated');
            return redirect()->route('login')->with('error', 'You must be logged in to request withdrawal.');
        }

        $userId = Auth::id();
        $dealer = User::where('id', $userId)->where('role', 'dealer')->first();

        if (!$dealer) {
            Log::warning('Withdrawal request failed: User is not a dealer', ['user_id' => $userId]);
            return redirect()->back()->with('error', 'You are not authorized to make withdrawal requests.');
        }

        // Check if dealer has bank details and if they are approved
        $bankDetail = BankDetail::where('user_id', $userId)->first();

        if (!$bankDetail || $bankDetail->bank_status !== 'approved') {
            Log::warning('Withdrawal request failed: Bank details not approved', [
                'user_id' => $userId,
                'has_bank_detail' => !is_null($bankDetail),
                'bank_status' => $bankDetail->bank_status ?? 'no_bank_detail'
            ]);
            return redirect()->back()->with('error', 'Please add bank details and get approval before requesting withdrawal.');
        }

        // Get dealer profile to retrieve BV
        $dealerProfile = DealerProfile::where('user_id', $userId)->first();

        if (!$dealerProfile) {
            Log::warning('Withdrawal request failed: Dealer profile not found', ['user_id' => $userId]);
            return redirect()->back()->with('error', 'Dealer profile not found.');
        }

        // Check if dealer has available BV for withdrawal
        if ($dealerProfile->bv <= 0) {
            Log::warning('Withdrawal request failed: No available BV', [
                'user_id' => $userId,
                'bv' => $dealerProfile->bv
            ]);
            return redirect()->back()->with('error', 'You have no available BV to withdraw.');
        }

        // Calculate amount (BV * 100)
        $amount = $dealerProfile->bv * 100;

        Log::info('Creating withdrawal request', [
            'user_id' => $userId,
            'amount' => $amount,
            'bv' => $dealerProfile->bv,
            'bank_name' => $bankDetail->bank_name
        ]);

        // Create withdrawal request
        WithdrawalRequest::create([
            'dealer_id' => $userId,
            'amount' => $amount,
            'bv' => $dealerProfile->bv,
            'bank_name' => $bankDetail->bank_name,
            'bank_branch' => $bankDetail->bank_branch,
            'account_name' => $bankDetail->account_name,
            'account_number' => $bankDetail->account_number,
            'status' => 'pending',
        ]);

        Log::info('Withdrawal request created successfully', ['user_id' => $userId]);
        return redirect()->back()->with('success', 'Withdrawal request submitted successfully. Your request is now pending approval.');
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
        $user = Auth::user()->load(['dealerProfile', 'directReferrals']);

        // Recursively load the full downline tree
        $tree = $this->buildHierarchy($user);

        // Create the complete tree structure with current user at the top
        $completeTree = [
            'user' => $user,
            'depth' => 0,
            'children' => $tree
        ];

        return view('frontend.dealer.full-hierarchy', compact('completeTree', 'user'));
    }

    protected function buildHierarchy($user, $depth = 0)
    {
        $referrals = $user->directReferrals()->with(['dealerProfile', 'directReferrals'])->get();

        return $referrals->map(function ($referral) use ($depth) {
            return [
                'user' => $referral,
                'depth' => $depth + 1,
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
            'gender' => ['required', 'string', 'in:Male,Female,Other'],
            'phone' => ['required', 'string', 'max:15'],
            'shop_name' => ['required', 'string', 'min:3', 'max:255', 'unique:dealer_profiles,dealer_shop_name'],
        ], [
            'shop_name.unique' => 'This shop name is already in use. Please enter a different shop name.',
            'shop_name.min' => 'Shop name must be at least 3 characters long.',
            'shop_name.required' => 'Shop name is required.',
        ]);

        // Step 1: Get Referrer
        $referrerProfile = DealerProfile::where('dealer_code', $request->dealer_code)->first();
        $referrerUser = $referrerProfile->user;

        // Step 2: Create New User without email verification initially
        $user = User::create([
            'name' => $request->fname . " " . $request->lname,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'role' => 'dealer', // Set as dealer
            'referred_by' => $referrerUser->id, // Set the referrer
            'customer_status' => 1, // Default to active
            'email_verified_at' => null, // Email not verified yet
        ]);

        // Step 3: Create Dealer Profile
        $dealer_code_generated = 'D-' . strtoupper(uniqid());
        DealerProfile::create([
            'user_id' => $user->id,
            'rank' => 'Beginner',
            'cbv' => 0,
            'bv' => 0,
            'tier' => 'silver',
            'dealer_code' => $dealer_code_generated,
            'dealer_shop_name' => $request->shop_name,
        ]);

        // Step 4: Add to Referral Table
        DealerReferral::create([
            'dealer_id' => $referrerUser->id,
            'referred_id' => $user->id,
            'approved' => false, // allow referrer to approve later via dashboard
        ]);

        // Step 5: Prepare user data for email verification
        $userData = [
            'id' => $user->id,
            'fname' => $user->fname,
            'lname' => $user->lname,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
        ];

        Notification::create([
            'user_id' => $referrerUser->id,
            'type' => 'new_referral',
            'message' => 'You Have a New Referral: ' . $user->name,
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $user->id,
            'type' => 'registration_success',
            'message' => 'Your dealer registration is successful! Please wait for your referral to approve your application.',
            'is_read' => false,
        ]);

        // Step 6: Send email verification
        try {
            Mail::to($user->email)->send(new EmailVerificationMail($userData));
            Log::info('Dealer email verification sent successfully', ['user_email' => $user->email, 'user_role' => 'dealer']);

            return redirect()->route('login')->with('success', 'Dealer registration successful! Please check your email and click the verification link to activate your account before logging in.');

        } catch (\Exception $e) {
            Log::error('Failed to send dealer verification email', [
                'user_email' => $user->email,
                'user_role' => 'dealer',
                'error' => $e->getMessage()
            ]);

            return redirect()->route('login')->with('warning', 'Dealer registration successful! However, we encountered an issue sending the verification email. Please contact support.');
        }

        // Note: We don't auto-login users anymore - they must verify email first
        // event(new Registered($user)); // Optional: Can still trigger this event
        // Auth::login($user); // Removed: No auto-login until email verified
    }

    public function checkShopName(Request $request)
    {
        $shopName = $request->input('shop_name');

        if (empty($shopName)) {
            return response()->json([
                'available' => false,
                'message' => 'Shop name is required.'
            ]);
        }

        if (strlen(trim($shopName)) < 3) {
            return response()->json([
                'available' => false,
                'message' => 'Shop name must be at least 3 characters long.'
            ]);
        }

        $exists = DealerProfile::where('dealer_shop_name', trim($shopName))->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'This shop name is already in use. Please enter a different shop name.' : 'Shop name is available!'
        ]);
    }

    public function dealerProductsDashBoard()
    {
        $dealer = $this->getDealer();

        $dealerProfile = $dealer->dealerProfile;

        // Fetch all product links generated by the dealer
        $productLinks = DealerProductLink::with(['product', 'orders'])
            ->where('dealer_id', $dealer->id)
            ->get();

        // Load dealer products (assuming a relationship exists)
        $products = $dealer->products; // Adjust based on your actual relationship

        return view('frontend.dealer.dealer-products-dashboard', compact('dealerProfile', 'productLinks'));
    }

    public function dealerProductOrders($linkId)
    {
        $dealer = $this->getDealer();

        $dealerProductLink = DealerProductLink::with('product')
            ->where('dealer_id', $dealer->id)
            ->findOrFail($linkId);

        // Get all related orders for the product link with proper relationships
        $orders = DealerProductOrder::with([
            'order.order', // CustomerOrderItems -> CustomerOrder
            'order.product' // CustomerOrderItems -> Product
        ])
        ->where('dealer_product_link_id', $linkId)
        ->get();

        return view('frontend.dealer.dealer-product-orders', compact('dealerProductLink', 'orders'));
    }

    public function deleteDealerProductLink($linkId)
    {
        $dealer = $this->getDealer();

        $link = DealerProductLink::where('dealer_id', $dealer->id)->findOrFail($linkId);
        $link->delete();

        return redirect()->route('dealer.products.dashboard')->with('success', 'Product link deleted successfully.');
    }

    public function deleteDealerProductOrder($orderId)
    {
        $dealer = $this->getDealer();

        $order = DealerProductOrder::findOrFail($orderId);
        $link = $order->link;

        if ($link->dealer_id !== $dealer->id) {
            abort(403);
        }

        $order->delete();

        return back()->with('success', 'Order deleted successfully.');
    }


    public function getDealer(): User
    {
        if (!Auth::check()) {
            abort(403, 'You must be logged in.');
        }

        $user = Auth::user();
        if ($user->role !== 'dealer') {
            abort(403, 'You are not a dealer.');
        }

        return $user;
    }





    public function generateDealerLink(Request $request)
    {
        $productId = $request->get('product_id');
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your orders.');
        }

        $userId = Auth::id();
        $dealer = User::where('id', $userId)->where('role', 'dealer')->first();
        if (!$dealer) {
            return redirect()->back()->with('error', 'You are not a dealer.');
        }

        $existing = DealerProductLink::where('dealer_id', $dealer->id)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            return back()->with('info', 'You already generated a link for this product.');
        }

        DealerProductLink::create([
            'dealer_id' => $dealer->id,
            'product_id' => $productId,
            'unique_code' => 'DLR-' . strtoupper(Str::random(8)),
        ]);

        return back()->with('success', 'Product link generated successfully.');
    }

    // Admin Dashboard Methods
    public function listDealers(Request $request)
    {
        $search = $request->get('search');

        $dealers = User::with('bankDetail')->with(relations: 'kycDetail')
            ->where('role', 'dealer')
            ->where('dealer_status', 1) // Only show active dealers
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search . '%');
                });
            })
            ->withCount('dealerProductOrders')
            ->paginate(10)
            ->appends(request()->query());

        return view('AdminDashboard.dealers', compact('dealers', 'search'));
    }

    public function showDealerDetails($user_id)
    {
        $dealer = User::with('dealerProfile')->with('bankDetail')->with('kycDetail')->findOrFail($user_id);

        $orders = CustomerOrder::where('user_id', $user_id)
            ->with('items.product')
            ->get();

        $totalCost = $orders->sum('total_cost');
        $totalOrders = $orders->count();
        $totalProducts = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        // Get referrals if any
        $referrals = DealerReferral::where('dealer_id', $user_id)
            ->with('referred')
            ->get();

        return view('AdminDashboard.dealer-details', compact('dealer', 'orders', 'totalCost', 'totalOrders', 'totalProducts', 'referrals'));
    }

    public function edit($user_id)
    {
        $dealer = User::where('role', 'dealer')->findOrFail($user_id);
        return view('AdminDashboard.edit-dealer', compact('dealer'));
    }

    public function update(Request $request, $user_id)
    {
        $dealer = User::where('role', 'dealer')->findOrFail($user_id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'fname' => 'nullable|string|max:255',
            'lname' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:Male,Female,Other',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $dealer->update($validated);

        return redirect()->route('dealers')->with('success', 'Dealer updated successfully.');
    }

    public function delete($user_id)
    {
        $dealer = User::where('role', 'dealer')->findOrFail($user_id);

        // Soft delete - update dealer_status to 0
        $dealer->update([
            'dealer_status' => 0
        ]);

        return redirect()->route('dealers')->with('success', 'Dealer has been deactivated successfully.');
    }

    public function exportDealers(Request $request)
    {
        $search = $request->get('search');
        $filename = 'dealers_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new DealersExport($search), $filename);
    }

    public function adminGenealogy()
    {
        // Get the oldest dealer (first one created) as the root of the tree
        $rootDealer = User::where('role', 'dealer')
            ->with(['dealerProfile', 'directReferrals'])
            ->orderBy('created_at', 'asc')
            ->first();

        if (!$rootDealer) {
            return view('AdminDashboard.genealogy', [
                'completeTree' => null,
                'rootDealer' => null,
                'totalDealers' => 0,
                'totalLevels' => 0,
                'activeDealers' => 0,
                'inactiveDealers' => 0
            ]);
        }

        // Build the complete genealogy tree starting from the root dealer
        $tree = $this->buildAdminHierarchy($rootDealer);

        // Create the complete tree structure with root dealer at the top
        $completeTree = [
            'user' => $rootDealer,
            'depth' => 0,
            'children' => $tree
        ];

        // Calculate statistics
        $totalDealers = User::where('role', 'dealer')->count();
        $activeDealers = User::where('role', 'dealer')->where('dealer_status', 1)->count();
        $inactiveDealers = User::where('role', 'dealer')->where('dealer_status', 0)->count();
        $totalLevels = $this->calculateMaxDepth($completeTree);

        return view('AdminDashboard.genealogy', compact(
            'completeTree',
            'rootDealer',
            'totalDealers',
            'totalLevels',
            'activeDealers',
            'inactiveDealers'
        ));
    }

    protected function buildAdminHierarchy($user, $depth = 0)
    {
        $referrals = $user->directReferrals()
            ->with(['dealerProfile', 'directReferrals'])
            ->get();

        return $referrals->map(function ($referral) use ($depth) {
            return [
                'user' => $referral,
                'depth' => $depth + 1,
                'children' => $this->buildAdminHierarchy($referral, $depth + 1)
            ];
        });
    }

    protected function calculateMaxDepth($tree, $currentDepth = 0)
    {
        if (empty($tree['children']) || $tree['children']->isEmpty()) {
            return $currentDepth;
        }

        $maxDepth = $currentDepth;
        foreach ($tree['children'] as $child) {
            $childDepth = $this->calculateMaxDepth($child, $currentDepth + 1);
            $maxDepth = max($maxDepth, $childDepth);
        }

        return $maxDepth;
    }
}
