<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


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
        // Get the authenticated user with bank details
        $user = Auth::user();
        $user->load('bankDetail');

        // Pass the user data to the view
        return view('user_dashboard.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Debug: Check if user is authenticated
        \Log::info('Profile update request received');
        \Log::info('User authenticated:', [Auth::check()]);
        \Log::info('User ID:', [Auth::id()]);
        \Log::info('Has file:', [$request->hasFile('profile_image')]);
        
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
            try {
                \Log::info('Processing profile image upload');
                
                // Delete old profile image if it exists
                if ($user->profile_image) {
                    Storage::delete('public/' . $user->profile_image);
                    \Log::info('Old profile image deleted: ' . $user->profile_image);
                }
                
                $file = $request->file('profile_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $imagePath = $file->storeAs('profile_images', $filename, 'public');
                $user->profile_image = $imagePath;
                
                // Log successful upload
                \Log::info('Profile image uploaded successfully: ' . $imagePath);
            } catch (\Exception $e) {
                \Log::error('Profile image upload failed: ' . $e->getMessage());
                return redirect()->route('edit-profile')->with('error', 'Failed to upload profile image. Please try again.');
            }
        } else {
            \Log::info('No profile image file in request');
        }

        $user->save();
        \Log::info('User profile updated successfully');

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

    public function storeBankDetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'account_type' => 'required|string|in:savings,current,business',
            'bank_front_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Check if user is a dealer
        if ($user->role !== 'dealer') {
            return redirect()->back()->with('error', 'Only dealers can add bank details.');
        }

        // Check if bank details already exist
        if ($user->bankDetail) {
            return redirect()->back()->with('error', 'Bank details already exist. You cannot add new details.');
        }

        // Handle file upload
        $bankFrontImagePath = null;
        if ($request->hasFile('bank_front_image')) {
            $file = $request->file('bank_front_image');
            $filename = time() . '_front_' . $file->getClientOriginalName();
            $bankFrontImagePath = $file->storeAs('bank_documents', $filename, 'public');
        }

        // Create bank details
        $user->bankDetail()->create([
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'account_type' => $request->account_type,
            'bank_front_image' => $bankFrontImagePath,
            'bank_status' => 'pending', // Default status
        ]);

        return redirect()->route('edit-profile')->with('success', 'Bank details submitted successfully! Status: Pending approval.');
    }

    public function updateBankDetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'account_type' => 'required|string|in:savings,current,business',
            'bank_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $bankDetail = $user->bankDetail;

        // Check if user is a dealer and has bank details
        if ($user->role !== 'dealer' || !$bankDetail) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        // Only allow updates if status is rejected
        if ($bankDetail->bank_status !== 'rejected') {
            return redirect()->back()->with('error', 'You can only update bank details when status is rejected.');
        }

        // Handle file upload if provided
        $bankFrontImagePath = $bankDetail->bank_front_image;
        if ($request->hasFile('bank_front_image')) {
            // Delete old image
            if ($bankDetail->bank_front_image) {
                Storage::delete('public/' . $bankDetail->bank_front_image);
            }
            
            $file = $request->file('bank_front_image');
            $filename = time() . '_front_' . $file->getClientOriginalName();
            $bankFrontImagePath = $file->storeAs('bank_documents', $filename, 'public');
        }

        // Update bank details
        $bankDetail->update([
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'account_type' => $request->account_type,
            'bank_front_image' => $bankFrontImagePath,
            'bank_status' => 'pending', // Reset to pending
        ]);

        return redirect()->route('edit-profile')->with('success', 'Bank details updated successfully! Status: Pending approval.');
    }
}
