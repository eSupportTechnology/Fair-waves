<?php

namespace App\Http\Controllers;

use App\Models\RaffleTicket;
use App\Models\AffiliateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AffiliateTrackingController extends Controller
{
    public function index()
    {
        // Retrieve the affiliate user ID from the session
        $AffiliateId = session('affiliate_user_id');

        // Fetch raffle tickets related to this affiliate user, if needed
        $raffleTickets = RaffleTicket::with('user')
                        ->where('user_id', $AffiliateId) // assuming RaffleTicket has an affiliate_id column
                        ->get();

        // Pass data to the view
        return view('AffiliateDashBoard.trackingid', compact('raffleTickets'));
    }


    // Store a new raffle ticket
    public function store(Request $request)
    {
        $AffiliateId = Session::get('affiliate_user_id');
        
        // Define custom messages
        $messages = [
            'tracking_id.required' => 'The tracking ID is required.',
            'tracking_id.string' => 'The tracking ID must be a string.',
            'tracking_id.max' => 'The tracking ID cannot be longer than 255 characters.',
            'tracking_id.unique' => 'This tracking ID is already in use.',
            'tracking_id.regex' => 'The tracking ID format is invalid. Only letters, numbers, underscores, hyphens, and ampersands are allowed.',
        ];

        // Validate the request with custom messages
        $request->validate([
            'tracking_id' => ['required', 'string', 'max:255', 'unique:raffle_tickets,token', 'regex:/^[A-Za-z0-9_\-&]+$/'],
        ], $messages);

        // Create and save the raffle ticket
        $raffleTicket = RaffleTicket::create([
            'user_id' => $AffiliateId,
            'token' => $request->tracking_id,
            'status' => 'Pending', // Set a default status
        ]);

        return redirect()->route('tracking_id')->with('success', 'Tracking ID created successfully.');

    }

    public function destroy($id)
    {
        $ticket = RaffleTicket::findOrFail($id);
        $ticket->delete();

        return redirect()->back()->with('success', 'Tracking ID deleted successfully.');
    }
}
