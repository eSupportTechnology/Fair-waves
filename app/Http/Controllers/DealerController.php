<?php

namespace App\Http\Controllers;

use App\Models\DealerProfile;
use App\Models\DealerReferral;
use App\Models\User;
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

        return view('frontend.dealer.dashboard', compact('dealerProfile'));
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
