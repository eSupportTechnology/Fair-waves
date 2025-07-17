<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DealerProductLink;

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
        // Add your cart checkout processing logic here
        // This will handle the form submission from the checkout page
        
        // Clear the cart after successful checkout
        session()->forget('showroom_cart');
        
        return redirect()->route('showroom.cart')->with('success', 'Order placed successfully!');
    }
}
