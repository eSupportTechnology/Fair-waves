<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Models\CustomerOrderItems;


class VendorOrderController extends Controller
{


    public function index(Request $request)
    {
        $vendor_id = session('vendor_id');

        $query = CustomerOrder::query();

        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }

        if ($request->filled('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }

        $orders = $query->whereHas('items.product', function ($query) use ($vendor_id) {
            $query->whereHas('shop', function ($shopQuery) use ($vendor_id) {
                $shopQuery->where('vendor_id', $vendor_id);
            });
        })
        ->latest()
        ->paginate(10);

        return view('VendorDashboard.orders', compact('orders'));
    }



    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('vendor.orders')->with('success', 'Order deleted successfully.');
    }



    public function showOrderDetails($orderCode)
    {
        $order = CustomerOrder::with('items.product.images')->where('order_code', $orderCode)->first();
        return view('VendorDashboard.order-details', compact('order'));
    }


    public function updateStatus(Request $request, $orderCode)
{
    // Fetch the order based on the provided order code
    $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();

    // Define valid status transitions for the vendor
    $validTransitions = [
        'Pending' => ['Accepted'], // From Pending, the vendor can mark it as Accepted
        'Accepted' => ['Packed'],  // From Accepted, the vendor can mark it as Packed
    ];

    // Define status messages for the activity log
    $statusMessages = [
        'Accepted' => 'Order accepted by the vendor.',
        'Packed' => 'Order packed by the vendor.',
    ];

    // Validate the new status
    $request->validate([
        'status' => [
            'required',
            'string',
            function ($attribute, $value, $fail) use ($order, $validTransitions) {
                // Check if the current status allows valid transitions
                if (!isset($validTransitions[$order->status])) {
                    $fail("The current status '{$order->status}' cannot be updated.");
                }

                // Check if the new status is allowed
                if (!in_array($value, $validTransitions[$order->status])) {
                    $fail("The status transition from '{$order->status}' to '{$value}' is not allowed.");
                }
            },
        ],
    ]);

    $newStatus = $request->status;

    // Add an activity log for the status change
    if (isset($statusMessages[$newStatus])) {
        $order->addActivityLog($statusMessages[$newStatus]);
    }

    // Update the order status
    $order->update(['status' => $newStatus]);

    // Return success message
    return redirect()->back()->with('success', "Order status updated to '{$newStatus}' successfully.");
}





}
