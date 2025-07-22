<?php

namespace App\Http\Controllers;

use App\Models\KYCDetail;
use Illuminate\Http\Request;

class KYCDetailController extends Controller
{
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
