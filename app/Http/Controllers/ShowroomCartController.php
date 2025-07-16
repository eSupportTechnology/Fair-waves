<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShowroomCartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Session::get('showroom_cart', []);
        
        // Get the first image from product_images table using relationship
        $productImage = $product->images()->first();
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
            // Get the first product image from product_images table
            $productImage = ProductImage::where('product_id', $productId)
                ->first();
            
            $cartItem['image'] = $productImage ? $productImage->image_path : 'images/default-product.jpg';
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

        return view('frontend.DealerShowroom.checkout', compact('cart', 'subtotal', 'deliveryFee', 'total'));
    }
}