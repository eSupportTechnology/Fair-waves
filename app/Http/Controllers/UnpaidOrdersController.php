<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnpaidOrdersController extends Controller
{
    public function index()
    {
        $unpaidOrders = CustomerOrder::with(['items.product.images'])
            ->where('user_id', Auth::id())
            ->where('status', 'Pending')
            ->where('payment_status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user_dashboard.unpaid_orders', compact('unpaidOrders'));
    }
}
