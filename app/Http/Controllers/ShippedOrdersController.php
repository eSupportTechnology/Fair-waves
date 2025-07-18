<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippedOrdersController extends Controller
{
    public function index()
    {
        try {
            $shippedOrders = CustomerOrder::with(['items.product.images'])
                ->where('user_id', Auth::id())
                ->whereIn('status', ['Shipped', 'In Transit', 'Customer Unavailable', 'Rescheduled', 'Delivered'])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('user_dashboard.shipped_orders', [
                'shippedOrders' => $shippedOrders,
                'user' => Auth::user()
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to load shipped orders. Please try again.');
        }
    }
}
