<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CustomEmailVerificationController extends Controller
{
    /**
     * Verify the user's email address
     */
    public function verify(Request $request)
    {
        // Log the verification attempt
        \Log::info('Email verification attempt', [
            'url' => $request->fullUrl(),
            'params' => $request->route()->parameters(),
            'query' => $request->query()
        ]);

        // Validate the signed URL
        if (!URL::hasValidSignature($request)) {
            \Log::error('Invalid verification signature', ['url' => $request->fullUrl()]);
            return redirect()->route('login')->with('error', 'Invalid or expired verification link.');
        }

        // Get parameters from route
        $userId = $request->route('id');
        $userEmail = $request->route('email') ?? $request->query('email');
        $hash = $request->route('hash');

        // Find the user
        $user = User::find($userId);
        
        if (!$user) {
            \Log::error('User not found for verification', ['user_id' => $userId]);
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Check if email matches (either from route or user's actual email)
        $expectedHash = sha1($user->email);
        if ($hash !== $expectedHash) {
            \Log::error('Hash mismatch for verification', [
                'user_id' => $userId,
                'provided_hash' => $hash,
                'expected_hash' => $expectedHash,
                'user_email' => $user->email
            ]);
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }

        // Check if email is already verified
        if ($user->hasVerifiedEmail()) {
            \Log::info('Email already verified', ['user_id' => $userId]);
            return redirect()->route('login')->with('success', 'Email already verified. You can now log in.');
        }

        // Mark email as verified
        $user->email_verified_at = Carbon::now();
        $user->save();

        \Log::info('Email verification successful', [
            'user_id' => $userId,
            'email' => $user->email,
            'verified_at' => $user->email_verified_at
        ]);

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now log in to your account.');
    }
}
