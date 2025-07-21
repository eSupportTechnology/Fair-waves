<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function pendingWithdrawals(Request $request)
    {
        $search = $request->input('search');

        $withdrawals = WithdrawalRequest::where('status', 'pending')
            ->with('dealer')
            ->when($search, function ($query, $search) {
                $query->whereHas('dealer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('AdminDashboard.withdraw.pending', compact('withdrawals'));
    }

    // Approve a withdrawal
    public function approve($id)
    {
        $withdrawal = WithdrawalRequest::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be approved.');
        }

        $withdrawal->status = 'approved';
        $withdrawal->updated_at = now(); // optional timestamp
        $withdrawal->save();





        return redirect()->back()->with('success', 'Withdrawal approved successfully.');
    }

    // Reject a withdrawal
    public function reject($id)
    {
        $withdrawal = WithdrawalRequest::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        $withdrawal->status = 'rejected';
        $withdrawal->updated_at = now(); // optional timestamp
        $withdrawal->save();

        return redirect()->back()->with('success', 'Withdrawal rejected successfully.');
    }

    public function approvedWithdrawals(Request $request)
    {
        $search = $request->input('search');

        $withdrawals = WithdrawalRequest::where('status', 'approved')
            ->with('dealer')
            ->when($search, function ($query, $search) {
                $query->whereHas('dealer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('AdminDashboard.withdraw.approved', compact('withdrawals'));
    }

    public function rejectedWithdrawals(Request $request)
    {
        $search = $request->input('search');
        $withdrawals = WithdrawalRequest::where('status', 'rejected')
            ->with('dealer')
            ->when($search, function ($query, $search) {
                $query->whereHas('dealer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);
        return view('AdminDashboard.withdraw.rejected', compact('withdrawals'));
    }
}
