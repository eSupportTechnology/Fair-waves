<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    // List all fees
    public function index()
    {
        $fees = Fee::latest()->paginate(10);
        return view('AdminDashboard.fee.index', compact('fees'));
    }

    // Show create form
    public function create()
    {
        $fees = Fee::latest()->paginate(10);
        return view('AdminDashboard.fee.index', compact('fees'));
    }

    // Store new fee
    public function store(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric|min:0',
        ]);

        Fee::create([
            'fee' => $request->fee,
        ]);

        return response()->json(['success' => true]);
    }

    // Show edit form
    public function edit(Fee $fee)
    {
        return view('AdminDashboard.fee.edit', compact('fee'));
    }

    // Update fee
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'fee' => 'required|numeric|min:0',
        ]);

        $fee->update([
            'fee' => $request->fee,
        ]);

        return redirect()->route('fees.index')->with('success', 'Fee updated successfully.');
    }

    // Delete fee
    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Fee deleted successfully.');
    }
}
