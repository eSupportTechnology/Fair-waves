<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToBeShippedController extends Controller
{
    public function index()
    {
        try {
            $toBeShippedOrders = CustomerOrder::with(['items.product.images'])
                ->where('user_id', Auth::id())
                ->whereIn('status', ['Pending', 'Accepted', 'Packed', 'Pickup Done', 'Ready to Ship'])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('user_dashboard.to_be_shipped', [
                'toBeShippedOrders' => $toBeShippedOrders,
                'user' => Auth::user() // Add this to fix the $user variable error
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to load orders. Please try again.');
        }
    }
}
