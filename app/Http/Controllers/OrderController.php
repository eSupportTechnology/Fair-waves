<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\User;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'Pending' => ['Accepted'], // ✅ Allow first transition
            'Accepted' => ['Packed'],
            'Packed' => ['Pickup Done'],
            'Pickup Done' => ['Ready to Ship'],
            'Ready to Ship' => ['Shipped'],
            'Shipped' => ['In Transit'],
            'In Transit' => ['Delivered', 'Customer Unavailable', 'Rescheduled'],
            'Customer Unavailable' => ['Rescheduled', 'In Transit'],
            'Rescheduled' => ['In Transit'],
            'Delivered' => [],
            'Cancelled' => [],
            'Returned' => [],
        ];


        // Define activity log messages
        $statusMessages = [
            'Accepted' => 'Order has been accepted.',
            'Packed' => 'Order has been packed.',
            'Pickup Done' => 'Order picked up by the delivery partner.',
            'Ready to Ship' => 'Order is ready to ship.',
            'Shipped' => 'Order shipped to the customer.',
            'In Transit' => 'Order is in transit.',
            'Customer Unavailable' => 'Customer was unavailable at delivery.',
            'Rescheduled' => 'Delivery has been rescheduled.',
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
            'tracking_number'=> 'nullable|string|max:255',
            'tracking_link' => 'nullable|url|max:255',
        ]);

        // Add an activity log for the status change
        if (isset($statusMessages[$request->status])) {
            $order->addActivityLog($statusMessages[$request->status]);
        }

        // Update the order status
        $updateData = [
            'status' => $request->status,
        ];

        if ($request->status == 'Shipped') {
            $updateData['tracking_number'] = $request->tracking_number;
            $updateData['tracking_link'] = $request->tracking_link;
        }

        $order->update($updateData);

        if($request->status == 'Delivered' && $order->order_type == 'annonymous'){
            $this->dealerPointAdd($order);
        }

        // Return success message
        return redirect()->back()->with('success', "Order status updated to '{$request->status}' successfully.");
    }

    protected function dealerPointAdd($customerOrder){
        // 1. Get dealer and product IV
        // Assuming items() returns a relationship and dealerProductLink() returns a related model with dealer_id
        $firstItem = $customerOrder->items()->first();
        $dealerProductLink = $firstItem ? $firstItem->dealerProductLink : null;
        $dealerId = $dealerProductLink ? $dealerProductLink->dealer_id : null;
        $dealer = $dealerId ? User::find($dealerId) : null;
        $dealerProfile = $dealer->dealerProfile;

        // IV = Distributor Profit / 100
        $iv = $customerOrder->items()->sum('bv');
        $rankPercent = $this->getRankPercentage($dealerProfile->rank);

        // 2. Direct Commission (self)
        $directCommission = $iv * $rankPercent;

        Commission::create([
            'dealer_id' => $dealer->id,
            'from_user_id' => $dealer->id,
            'bv' => $iv,
            'amount' => $directCommission,
            'level' => 'direct',
            'customer_order_id' => $customerOrder->id,
        ]);

        // 3. Traverse uplines
        $currentDealer = $dealer;
        $currentPercent = $rankPercent;

        while ($uplineRef = $currentDealer->referredByDealer) {
            $upline = $uplineRef->dealer;

            if (!$upline || !$upline->dealerProfile) break;

            $uplinePercent = $this->getRankPercentage($upline->dealerProfile->rank);
            $gap = $uplinePercent - $currentPercent;

            if ($gap > 0) {
                $gapCommission = $iv * $gap;

                Commission::create([
                    'dealer_id' => $upline->id,
                    'from_user_id' => $dealer->id,
                    'bv' => $iv,
                    'amount' => $gapCommission,
                    'level' => 'rank',
                    'customer_order_id' => $customerOrder->id,
                ]);
            }

            $currentDealer = $upline;
            $currentPercent = $uplinePercent;

            // optional: break if upline is top (Diamond)
            if ($uplinePercent == 100) break;
        }
    }

    protected function getRankPercentage($rank)
    {
        return match ($rank) {
            'Loyalty Member' => 50,
            'Bronze Member' => 60,
            'Silver Member' => 70,
            'Gold Member' => 80,
            'Platinum Member' => 90,
            'Diamond Member' => 100,
            default => 0,
        };
    }
}
