<?php

namespace App\Http\Controllers;
use App\Models\Inquiry; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReplyMail;

class InquiryController extends Controller
{

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'full_name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string', 
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $inquiry = Inquiry::create([
            'full_name' => $request->full_name, 
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'not replied', 
        ]);

        return redirect()->back()->with('success', 'Your Inquiry has been submitted successfully.');
    }


    public function index(Request $request)
    {
        $query = Inquiry::query();
    
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        $inquiries = $query->get();
    
        return view('AdminDashboard.inquiries', compact('inquiries'));
    }
    

    public function storeReply(Request $request, $inquiryId)
    {
        // Validate the reply input
        $request->validate([
            'replyMessage' => 'required|string',
        ]);

        // Find the inquiry by ID
        $inquiry = Inquiry::findOrFail($inquiryId);

        $inquiry->reply = $request->input('replyMessage');
        $inquiry->status = 'replied'; 
        $inquiry->save();

        // Send the reply via email
        Mail::to($inquiry->email)->send(new InquiryReplyMail($inquiry));

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

}
