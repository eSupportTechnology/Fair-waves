<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\EmailVerificationMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('frontend.register');

    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:15'],
        ]);

        // Create user without email verification initially
        $user = User::create([
            'name' => $request->fname . " ". $request->lname,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'role' => 'customer', 
            'customer_status' => 1, // Default to active
            'email_verified_at' => null, // Email not verified yet
        ]);

        // Prepare user data for email
        $userData = [
            'id' => $user->id,
            'fname' => $user->fname,
            'lname' => $user->lname,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
        ];

        // Send email verification
        try {
            Mail::to($user->email)->send(new EmailVerificationMail($userData));
            Log::info('Email verification sent successfully', ['user_email' => $user->email]);
            
            return redirect()->route('login')->with('success', 'Registration successful! Please check your email and click the verification link to activate your account.');
            
        } catch (\Exception $e) {
            Log::error('Failed to send verification email', [
                'user_email' => $user->email,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('login')->with('warning', 'Registration successful! However, we encountered an issue sending the verification email. Please contact support.');
        }
    }

}
