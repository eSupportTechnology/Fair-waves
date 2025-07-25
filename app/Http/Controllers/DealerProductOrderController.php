<?php

namespace App\Http\Controllers;

use App\Models\DealerProductOrder;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealerProductOrderController extends Controller
{
    public function track($orderCode)
    {
        $userId = Auth::id();
        
        // Get all orders for this order code where the dealer is the logged-in user
        $orders = DealerProductOrder::where('user_id', $userId)
            ->whereHas('order.order', function($query) use ($orderCode) {
                $query->where('order_code', $orderCode);
            })
            ->with(['link.product.images', 'order.order'])
            ->get();

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $orderData = [
            'order' => $orders->first()->order->order,
            'items' => $orders
        ];

        return view('dealer.orders.track', compact('orderData'));
    }
    public function index()
    {
        $userId = Auth::id();
        
        // Get all order items for the logged-in dealer with necessary relationships
        $dealerOrders = DealerProductOrder::where('user_id', $userId)
            ->with(['order.customerOrder', 'link.product.images', 'order.order'])
            ->get();

        // Group orders by order code for better organization
        $groupedOrders = collect();
        foreach ($dealerOrders as $dealerOrder) {
            if ($dealerOrder->order && $dealerOrder->order->order) {
                $orderCode = $dealerOrder->order->order_code;
                if (!$groupedOrders->has($orderCode)) {
                    $groupedOrders[$orderCode] = [
                        'order' => $dealerOrder->order->customerOrder,
                        'items' => collect()
                    ];
                }
                $groupedOrders[$orderCode]['items']->push($dealerOrder);
            }
        }

        return view('dealer.orders.index', [
            'groupedOrders' => $groupedOrders
        ]);
    }

    public function show($orderCode)
    {
        $userId = Auth::id();
        
        $dealerOrders = DealerProductOrder::where('user_id', $userId)
            ->whereHas('order', function($query) use ($orderCode) {
                $query->where('order_code', $orderCode);
            })
            ->with(['order.order', 'link.product.images'])
            ->get();

        if ($dealerOrders->isEmpty()) {
            abort(404);
        }

        $order = $dealerOrders->first()->order->order;

        return view('dealer.orders.show', compact('dealerOrders', 'order'));
    }
}
