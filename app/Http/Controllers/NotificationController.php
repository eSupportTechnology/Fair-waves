<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class NotificationController extends Controller
{
    public function index()
    {
        // Fetch notifications
        $notifications = session()->get('notifications', []);

        return view('admin.notifications', compact('notifications'));
    }

    public function addUserNotification(User $user)
    {
        $notification = "New user registered: " . $user->name;

        // Add to session
        $notifications = session()->get('notifications', []);
        $notifications[] = $notification;
        session()->put('notifications', $notifications);

        return redirect()->back();
    }

    public function addOrderNotification(Order $order)
    {
        $notification = "New order placed: #" . $order->id . " by " . $order->name;

        // Add to session
        $notifications = session()->get('notifications', []);
        $notifications[] = $notification;
        session()->put('notifications', $notifications);

        return redirect()->back();
    }

    public function clearNotifications()
    {
        session()->forget('notifications');
        return redirect()->back();
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
    public function showNotifications()
{
    $notifications = Auth::user()->notifications; // Retrieve all notifications
    return view('notifications.index', compact('notifications'));
}
}
