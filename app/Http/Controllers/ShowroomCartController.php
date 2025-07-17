<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\DealerProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ShowroomCartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Session::get('showroom_cart', []);
        
        // Get the first image from product_images table using relationship
        $productImage = ProductImage::where('product_id', $product->id)->first();
        $imagePath = $productImage ? $productImage->image_path : 'images/default-product.jpg';
        
        $cartItem = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->normal_price,
            'quantity' => 1,
            'image' => $imagePath,
            'size' => $request->input('size'),
            'color' => $request->input('color')
        ];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = $cartItem;
        }

        Session::put('showroom_cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $cart = Session::get('showroom_cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $subtotal = $total;
        $deliveryFee = 300; // Fixed delivery fee
        $total = $subtotal + $deliveryFee;

        return view('frontend.DealerShowroom.cart.index', compact('cart', 'subtotal', 'deliveryFee', 'total'));
    }

    public function removeFromCart($productId)
    {
        $cart = Session::get('showroom_cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('showroom_cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function updateCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('showroom_cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            Session::put('showroom_cart', $cart);
            
            // Calculate new total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'total' => $total,
                'item_subtotal' => $cart[$productId]['price'] * $cart[$productId]['quantity'],
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'formatted_total' => number_format($total, 2)
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart'
        ], 404);
    }

    public function clearCart()
    {
        Session::forget('showroom_cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function getCartCount()
    {
        $cart = Session::get('showroom_cart', []);
        $totalItems = 0;
        
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
        }
        
        return response()->json([
            'cart_count' => count($cart),
            'total_items' => $totalItems
        ]);
    }

    public function proceedToCheckout()
    {
        // If this is a direct buy-now checkout
        if (session()->has('buy_now')) {
            $item = session()->get('buy_now');
            $subtotal = $item['price'] * $item['quantity'];
            $deliveryFee = 300; // Fixed delivery fee
            $total = $subtotal + $deliveryFee;
            
            return view('frontend.DealerShowroom.checkout', compact('item', 'subtotal', 'deliveryFee', 'total'));
        }

        // If this is a cart checkout
        $cart = Session::get('showroom_cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $deliveryFee = 300; // Fixed delivery fee
        $total = $subtotal + $deliveryFee;

        return view('frontend.DealerShowroom.cart.checkout', compact('cart', 'subtotal', 'deliveryFee', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'house_no' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email'
        ]);

        $orderCode = 'ORD-' . strtoupper(Str::random(8));
        $cart = Session::get('showroom_cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        try {
            // Create order record
            $order = DealerProductOrder::create([
                'order_code' => $orderCode,
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'house_no' => $validatedData['house_no'],
                'city' => $validatedData['city'],
                'postal_code' => $validatedData['postal_code'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'total_amount' => $this->calculateTotal($cart),
                'status' => 'pending'
            ]);

            // Create order items
            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null
                ]);
            }

            // Clear the cart after successful order
            Session::forget('showroom_cart');

            return redirect()->route('dealer.order.success', ['order_code' => $orderCode])
                        ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                        ->with('error', 'Failed to place order. Please try again.')
                        ->withInput();
        }
    }

    private function calculateTotal($cart)
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal + 300; // Adding fixed delivery fee
    }
}