<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Send the password reset link to the provided email address
        $status = Password::sendResetLink(
            $validated // Pass the validated email to the sendResetLink method
        );

        // Check if the reset link was sent successfully
        if ($status == Password::RESET_LINK_SENT) {
            // If sent successfully, return with a success message
            return back()->with('status', __('We have sent a password reset link to your email.'));
        }

        // If there was an error, redirect back with the email input and the error message
        return back()
            ->withInput($request->only('email')) // Keep the email input in case of error
            ->withErrors(['email' => __('We could not find a user with that email address.')]); // Customize error message
    

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
