<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaffleTicket;
use App\Models\AffiliateUser;
use Illuminate\Support\Str;

class RaffleTicketController extends Controller
{
    // Display all raffle tickets
    public function index()
    {
        $raffleTickets = RaffleTicket::with('user')->get();
        return view('AffiliateDashBoard.trackingId', compact('raffleTickets'));
    }

    // Store a new raffle ticket
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:affiliate_users,id',
        ]);

        $raffleTicket = RaffleTicket::create([
            'user_id' => $request->user_id,
            'token' => Str::uuid(), // Generate a unique token
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Raffle ticket created successfully!');
    }

    

    // Show a specific raffle ticket
    public function show(RaffleTicket $raffleTicket)
    {
        return view('raffle_tickets.show', compact('raffleTicket'));
    }

    // Update the status of a raffle ticket
    public function update(Request $request, RaffleTicket $raffleTicket)
    {
        $request->validate([
            'status' => 'required|in:Pending,Active,Used,Expired',
        ]);

        $raffleTicket->status = $request->status;
        $raffleTicket->save();

        return redirect()->back()->with('success', 'Raffle ticket updated successfully!');
    }

    // Delete a raffle ticket
    public function destroy(RaffleTicket $raffleTicket)
    {
        $raffleTicket->delete();

        return redirect()->back()->with('success', 'Raffle ticket deleted successfully!');
    }
}
