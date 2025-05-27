<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AffiliateUser;
use Illuminate\Support\Facades\Hash;


class AffiliateUserController extends Controller
{
    

    // Show all affiliate users
    public function showAffiliates()
    {
        $affiliates = AffiliateUser::all();
        return view('AdminDashboard.affiliate_customers', compact('affiliates'));
    }

    
  

    public function showDetails($id)
    {
        $affiliate = AffiliateUser::findOrFail($id);
    
        // Decode the promotion_method if it's a JSON string
        if ($affiliate && is_string($affiliate->promotion_method)) {
            $affiliate->promotion_method = json_decode($affiliate->promotion_method, true);
        }
    
        return view('AdminDashboard.Affiliatecustomer-details', compact('affiliate'));

    }

    // Update affiliate user status
    public function updateStatus($id, $status)
    {
        $affiliate = AffiliateUser::findOrFail($id);
        $affiliate->status = $status;
        $affiliate->save();

        return redirect()->route('affiliate_customers')->with('success', 'Affiliate status updated successfully!');
    }

    // Handle the login logic
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt to retrieve the user with the provided email
        $user = AffiliateUser::where('email', $request->email)->first();

        // Check if the user exists, is approved, and the password matches
        if ($user && $user->status === 'approved' && Hash::check($request->password, $user->password)) {
            // Login the user by saving their ID in the session
            session(['affiliate_user_id' => $user->id]);
            
            return redirect()->route('affiliate')->with('status', 'Logging Success...!,Welcome to your dashboard!');
        }

        // If authentication fails, return with an error
        return back()->withErrors(['error' => 'Invalid login credentials or account not approved.']);
    }

    // Optional: Method for logging out
    public function logout()
    {
        session()->forget('affiliate_user_id');
        return redirect()->route('affiliate_login')->with('status', 'Logged out successfully.');
    }
    
    

    public function store(Request $request)
    {
        $request->merge([
            'dob_day' => (int) $request->dob_day,
            'dob_month' => (int) $request->dob_month,
            'dob_year' => (int) $request->dob_year,
        ]);
        
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'dob_day' => 'required|integer|min:1|max:31',
            'dob_month' => 'required|integer|min:1|max:12',
            'dob_year' => 'required|integer',
            'gender' => 'nullable|string|max:255',
            'NIC' => 'required|string|max:255',
            'phone_num' => 'required|string|max:20',
            'email' => 'required|email|unique:affiliate_users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'promotion_method' => 'nullable|array',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'content_website_url' => 'nullable|url',
            'content_whatsapp_url' => 'nullable|url',
            'bank_name' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        //dd($request);

        // Combine the Date of Birth fields into a single date
        $dob = $validatedData['dob_year'] . '-' . str_pad($validatedData['dob_month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($validatedData['dob_day'], 2, '0', STR_PAD_LEFT);

        $customer = new AffiliateUser;
        $customer->name = $validatedData['name'];
        $customer->address = $validatedData['address'];
        $customer->district = $validatedData['district'];
        $customer->DOB = $dob;
        $customer->gender = $validatedData['gender'];
        $customer->NIC = $validatedData['NIC'];
        $customer->contactno = $validatedData['phone_num'];
        $customer->email = $validatedData['email'];
        $customer->password = $validatedData['password'];
        $customer->promotion_method = json_encode($validatedData['promotion_method'] ?? []); 
        $customer->instagram_url = $validatedData['instagram_url'];
        $customer->facebook_url = $validatedData['facebook_url'];
        $customer->tiktok_url = $validatedData['tiktok_url'];
        $customer->youtube_url = $validatedData['youtube_url'];
        $customer->content_website_url = $validatedData['content_website_url'];
        $customer->content_whatsapp_url = $validatedData['content_whatsapp_url'];
        $customer->bank_name = $validatedData['bank_name'];
        $customer->branch = $validatedData['branch'];
        $customer->account_name = $validatedData['account_name'];
        $customer->account_number = $validatedData['account_number'];
        $customer->status = 'pending';

        // Save the customer to the database
        $customer->save();

        // Redirect to a success page with a session message
        return redirect()->route('affiliate_login')->with('status', 'Affiliate account created successfully!');
    }



}
