<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use Illuminate\Http\Request;

class BankDetailController extends Controller
{
    public function approve($id)
    {
        $bank = BankDetail::findOrFail($id);
        $bank->update(['bank_status' => 'approved']);
        return back()->with('success', 'Bank details approved.');
    }

    public function reject($id)
    {
        $bank = BankDetail::findOrFail($id);
        $bank->update(['bank_status' => 'rejected']);
        return back()->with('success', 'Bank details rejected.');
    }
}
