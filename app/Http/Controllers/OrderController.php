<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Http\Request;



class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerOrder::query();
        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }
        if ($request->filled('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }
        $orders = $query->latest()->paginate(10);

        return view('AdminDashboard.orders', compact('orders'));
    }

    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders')->with('success', 'Order deleted successfully.');
    }

    public function showOrderDetails($orderCode)
    {
        $order = CustomerOrder::with('items.product')->where('order_code', $orderCode)->first();
        $order = CustomerOrder::with('items.product.images')->where('order_code', $orderCode)->first();
        return view('AdminDashboard.order-details', compact('order'));
    }


    public function updateStatus(Request $request, $orderCode)
    {
        // Fetch the order
        $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();

        // Define valid transitions for the admin
        $validTransitions = [
            'Packed' => ['Pickup Done'],
            'Pickup Done' => ['Ready to Ship'],
            'Ready to Ship' => ['Shipped'],
            'Shipped' => ['In Transit'],
            'In Transit' => ['Delivered'],
            'Delivered' => [],
            'Cancelled' => [],
            'Returned' => [],
        ];

        // Define activity log messages
        $statusMessages = [
            'Pickup Done' => 'Order picked up by the delivery partner.',
            'Ready to Ship' => 'Order is ready to ship.',
            'Shipped' => 'Order shipped to the customer.',
            'In Transit' => 'Order is in transit.',
            'Delivered' => 'Order delivered to the customer.',
            'Cancelled' => 'Order has been cancelled.',
            'Returned' => 'Order has been returned.',
        ];

        // Validate the input status
        $request->validate([
            'status' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($order, $validTransitions) {
                    // Check if the current status allows a transition
                    if (!isset($validTransitions[$order->status])) {
                        $fail("The current status '{$order->status}' cannot be updated.");
                    }

                    // Check if the new status is a valid transition
                    if (!in_array($value, $validTransitions[$order->status]) && !in_array($value, ['Cancelled', 'Returned'])) {
                        $fail("The status transition from '{$order->status}' to '{$value}' is not allowed.");
                    }
                },
            ],
        ]);

        // Add an activity log for the status change
        if (isset($statusMessages[$request->status])) {
            $order->addActivityLog($statusMessages[$request->status]);
        }

        // Update the order status
        $order->update([
            'status' => $request->status,
        ]);

        // Return success message
        return redirect()->back()->with('success', "Order status updated to '{$request->status}' successfully.");
    }



}
