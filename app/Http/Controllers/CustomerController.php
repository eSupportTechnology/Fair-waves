<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\User;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{

    public function show(Request $request)
    {
        $search = $request->get('search');

        $customers = User::withCount('customerOrders')
            ->where('role', 'customer')
            ->where('customer_status', 1) // Only show active customers
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search . '%');
                });
            })
            // TODO: Uncomment for future development - Total Orders functionality
            // ->withCount('customerOrders')
            ->paginate(10)
            ->appends(request()->query());

        return view('AdminDashboard.customer', compact('customers', 'search'));
    }


    public function showCustomerDetails($user_id)
    {
        $customer = User::findOrFail($user_id);

        $orders = CustomerOrder::where('user_id', $user_id)
            ->with('items.product')
            ->get();

        $totalCost = $orders->sum('total_cost');
        $totalOrders = $orders->count();
        $totalProducts = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        return view('AdminDashboard.customer-details', compact('customer', 'orders', 'totalCost', 'totalOrders', 'totalProducts'));
    }

    public function edit($user_id)
    {
        // TODO: Uncomment for future development - Total Orders functionality
        // $customer = User::withCount('customerOrders')->findOrFail($user_id);
        $customer = User::findOrFail($user_id);
        return view('AdminDashboard.edit-customer', compact('customer'));
    }

    public function update(Request $request, $user_id)
    {
        $customer = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user_id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $customer->update($validatedData);

        return redirect()->route('customers')->with('success', 'Customer updated successfully!');
    }

    public function delete($user_id)
    {
        $customer = User::findOrFail($user_id);

        // Check if this is a customer
        if ($customer->role !== 'customer') {
            return redirect()->back()->with('error', 'Only customers can be deleted.');
        }

        // Soft delete by setting customer_status = 0
        $customer->update(['customer_status' => 0]);

        return redirect()->route('customers')->with('success', 'Customer has been successfully deleted.');
    }

    public function export(Request $request)
    {
        $search = $request->get('search');
        $filename = 'customers_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new CustomersExport($search), $filename);
    }
}
