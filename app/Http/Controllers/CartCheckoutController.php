<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DealerProductLink;
use App\Models\DealerProductOrder;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartCheckoutController extends Controller
{
    public function cartCheckout(Request $request)
    {
        // Get cart items from session
        $cartItems = session()->get('showroom_cart');
        $total = 0;
        
        if($cartItems) {
            foreach($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return view('frontend.DealerShowroom.cart.checkout', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function processCartCheckout(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'house_no' => 'required|string',
                'apartment' => 'nullable|string',
                'city' => 'required|string',
                'postal_code' => 'required|string'
            ]);

            // Get cart items
            $cartItems = session()->get('showroom_cart');
            if (!$cartItems) {
                return redirect()->back()->with('error', 'Your cart is empty!');
            }

            // Calculate totals
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $deliveryFee = 300; // Fixed delivery fee
            $total = $subtotal + $deliveryFee;

            // Generate order code
            $orderCode = 'ORD-' . strtoupper(Str::random(8));

            // Store checkout information in session
            session()->put('checkout_info', [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'house_no' => $validated['house_no'],
                'apartment' => $validated['apartment'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code']
            ]);

            // Store cart summary in session
            session()->put('cart_summary', [
                'order_code' => $orderCode,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'items' => $cartItems
            ]);

            // Redirect to payment page with order code
            return redirect()->route('cart.payment', ['order_code' => $orderCode]);

        } catch (\Exception $e) {
            \Log::error('Cart checkout error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to process your order. Please try again.');
        }
    }

    public function showPayment($order_code)
    {
        // Verify the order code matches the one in session
        $cartSummary = session()->get('cart_summary');
        $checkoutInfo = session()->get('checkout_info');
        
        if (!$cartSummary || $cartSummary['order_code'] !== $order_code) {
            return redirect()->route('showroom.cart')->with('error', 'Invalid order. Please try again.');
        }

        // Create an order object with the necessary data
        $order = (object)[
            'order_code' => $order_code,
            'total_cost' => $cartSummary['total'],
            'subtotal' => $cartSummary['subtotal'],
            'items' => $cartSummary['items'],
            'first_name' => $checkoutInfo['first_name'],
            'last_name' => $checkoutInfo['last_name'],
            'email' => $checkoutInfo['email'],
            'phone' => $checkoutInfo['phone'],
            'house_no' => $checkoutInfo['house_no'],
            'apartment' => $checkoutInfo['apartment'],
            'city' => $checkoutInfo['city'],
            'postal_code' => $checkoutInfo['postal_code']
        ];

        return view('frontend.DealerShowroom.cart.payment', [
            'order' => $order,
            'order_code' => $order_code,
            'subtotal' => $cartSummary['subtotal'],
            'delivery_fee' => $cartSummary['delivery_fee'],
            'total' => $cartSummary['total']
        ]);
    }

    public function confirmCODPayment($order_code)
    {
        try {
            $cartSummary = session()->get('cart_summary');
            $checkoutInfo = session()->get('checkout_info');
            
            if (!$cartSummary || !$checkoutInfo || $cartSummary['order_code'] !== $order_code) {
                throw new \Exception('Invalid order information');
            }

            // Create order record in customer_orders table
            $order = \App\Models\CustomerOrder::create([
                'order_code' => $order_code,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'customer_name' => $checkoutInfo['first_name'] . ' ' . $checkoutInfo['last_name'],
                'phone' => $checkoutInfo['phone'],
                'email' => $checkoutInfo['email'],
                'house_no' => $checkoutInfo['house_no'],
                'apartment' => $checkoutInfo['apartment'],
                'city' => $checkoutInfo['city'],
                'postal_code' => $checkoutInfo['postal_code'],
                'date' => \Carbon\Carbon::now(),
                'total_cost' => $cartSummary['total'],
                'status' => 'Pending',
                'payment_method' => 'COD',
                'payment_status' => 'Pending',
                'order_type' => \Illuminate\Support\Facades\Auth::check() ? 'customer' : 'annonymous'
            ]);

            // Create order items in customer_order_items table
            foreach ($cartSummary['items'] as $item) {
                \App\Models\CustomerOrderItems::create([
                    'order_code' => $order_code,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'cost' => $item['price'] * $item['quantity'],
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null,
                    'date' => \Carbon\Carbon::now(),
                    'dealer_product_link_id' => $item['dealer_product_link_id'] ?? null
                ]);
            }

            // Clear cart and checkout data
            session()->forget(['showroom_cart', 'cart_summary', 'checkout_info']);

            return redirect()->route('order.thankyou', ['order_code' => $order_code])
                        ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            \Log::error('COD payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function confirmCardPayment($order_code)
    {
        try {
            $cartSummary = session()->get('cart_summary');
            $checkoutInfo = session()->get('checkout_info');
            
            if (!$cartSummary || !$checkoutInfo || $cartSummary['order_code'] !== $order_code) {
                throw new \Exception('Invalid order information');
            }

            // Create order record in customer_orders table
            $order = \App\Models\CustomerOrder::create([
                'order_code' => $order_code,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'customer_name' => $checkoutInfo['first_name'] . ' ' . $checkoutInfo['last_name'],
                'phone' => $checkoutInfo['phone'],
                'email' => $checkoutInfo['email'],
                'house_no' => $checkoutInfo['house_no'],
                'apartment' => $checkoutInfo['apartment'],
                'city' => $checkoutInfo['city'],
                'postal_code' => $checkoutInfo['postal_code'],
                'date' => \Carbon\Carbon::now(),
                'total_cost' => $cartSummary['total'],
                'status' => 'Pending',
                'payment_method' => 'Card',
                'payment_status' => 'Paid',
                'order_type' => \Illuminate\Support\Facades\Auth::check() ? 'customer' : 'annonymous'
            ]);

            // Create order items in customer_order_items table
            foreach ($cartSummary['items'] as $item) {
                \App\Models\CustomerOrderItems::create([
                    'order_code' => $order_code,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'cost' => $item['price'] * $item['quantity'],
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null,
                    'date' => \Carbon\Carbon::now(),
                    'dealer_product_link_id' => $item['dealer_product_link_id'] ?? null
                ]);
            }

            // Clear cart and checkout data
            session()->forget(['showroom_cart', 'cart_summary', 'checkout_info']);

            return redirect()->route('order.thankyou', ['order_code' => $order_code])
                        ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            \Log::error('Card payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }
}
