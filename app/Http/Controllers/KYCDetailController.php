<?php

namespace App\Http\Controllers;

use App\Models\KYCDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KYCDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kyc_doc_type' => 'required|in:NIC,DL,Passport',
            'kyc_doc_number' => 'required|string|max:50',
            'kyc_doc_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kyc_doc_back' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        
        // Check if user already has KYC details
        $existingKyc = $user->kycDetail;
        
        // Handle file uploads
        $frontPath = $request->file('kyc_doc_front')->store('kyc/documents', 'public');
        $backPath = $request->file('kyc_doc_back')->store('kyc/documents', 'public');
        $selfiePath = $request->file('selfie')->store('kyc/selfies', 'public');

        $data = [
            'user_id' => $user->id,
            'kyc_doc_type' => $request->kyc_doc_type,
            'kyc_doc_number' => $request->kyc_doc_number,
            'kyc_doc_front' => $frontPath,
            'kyc_doc_back' => $backPath,
            'selfie' => $selfiePath,
            'kyc_status' => 'pending',
            'kyc_reject_reason' => null,
        ];

        if ($existingKyc) {
            // Delete old files if they exist
            if ($existingKyc->kyc_doc_front) {
                Storage::disk('public')->delete($existingKyc->kyc_doc_front);
            }
            if ($existingKyc->kyc_doc_back) {
                Storage::disk('public')->delete($existingKyc->kyc_doc_back);
            }
            if ($existingKyc->selfie) {
                Storage::disk('public')->delete($existingKyc->selfie);
            }
            
            $existingKyc->update($data);
        } else {
            KYCDetail::create($data);
        }

        return back()->with('success', 'KYC details submitted successfully. Your submission is under review.');
    }

    public function approve($id)
    {
        $kyc = KYCDetail::findOrFail($id);
        $kyc->update(['kyc_status' => 'approved', 'kyc_reject_reason' => null]);
        return back()->with('success', 'KYC approved.');
    }

    public function reject(Request $request, $id)
    {
        $kyc = KYCDetail::findOrFail($id);
        $kyc->update([
            'kyc_status' => 'rejected',
            'kyc_reject_reason' => $request->input('reason', 'Manually rejected'),
        ]);
        return back()->with('success', 'KYC rejected.');
    }
}
