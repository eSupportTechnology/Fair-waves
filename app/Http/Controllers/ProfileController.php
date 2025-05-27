<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;


use App\Models\CustomerOrder;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function myOrders()
    {
        $orders = CustomerOrder::where('user_id', auth()->id())->get();
        return view('user_dashboard.my-orders', compact('orders'));
    }

    public function trackOrder($orderCode)
    {
        $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();

        // Convert activity_logs to a Laravel Collection
        $order->activity_logs = collect($order->activity_logs ?? []);

        return view('user_dashboard.tracking-page', compact('order'));
    }

    public function dashboard()
    {
        // Retrieve the authenticated user's details
        $user = Auth::user();
        //dd($user);

        // Pass the user to the view
        return view('user_dashboard.dashboard', compact('user'));
    }

    public function editProfile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('user_dashboard.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the request
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone_num' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image validation
        ]);

        $user = Auth::user();

        // Update user details
        $user->name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone_num');
        $user->dob = $request->input('date_of_birth');

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_images'), $filename);
            $user->profile_image = $filename; // Save filename in the database
        }

        $user->save();

        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully.');
    }

    public function editPassword()
    {
        // Pass the user data to the view
        return view('user_dashboard.edit-password');
    }

    public function changePassword(Request $request)
    {
        //dd($request);
        // Validate the input fields
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' ensures new_password and new_password_confirmation match
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the provided current password matches the stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The current password is incorrect.',
            ], 400);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('dashboard-main')->with('success', 'Password updated successfully.');
    }







}
