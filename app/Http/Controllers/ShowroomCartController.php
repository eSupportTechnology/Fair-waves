<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\DealerProductOrder;
use App\Models\DealerProductLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ShowroomCartController extends Controller
{
    public function addToCart(Request $request, $dealer_shop_name, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Session::get('showroom_cart', []);
        
        // Find the dealer and dealer product link
        $dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
            $query->where('dealer_shop_name', $dealer_shop_name);
        })->where('role', 'dealer')->first();
        
        if (!$dealer) {
            return redirect()->back()->with('error', 'Dealer not found.');
        }
        
        // Find the dealer product link
        $dealerProductLink = DealerProductLink::where('dealer_id', $dealer->id)
            ->where('product_id', $product->product_id)
            ->first();
        
        // Get the first image from product_images table using relationship
        $productImage = ProductImage::where('product_id', $product->product_id)->first();
        $imagePath = $productImage ? 'storage/' . $productImage->image_path : 'images/default-product.jpg';
        
        $cartItem = [
            'id' => $product->id,
            'product_id' => $product->product_id,
            'name' => $product->product_name,
            'price' => $product->normal_price,
            'quantity' => 1,
            'image' => $imagePath,
            'size' => $request->input('size'),
            'color' => $request->input('color'),
            'dealer_shop_name' => $dealer_shop_name,
            'dealer_product_link_id' => $dealerProductLink ? $dealerProductLink->id : null
        ];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = $cartItem;
        }

        Session::put('showroom_cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart($dealer_shop_name)
    {
        $cart = Session::get('showroom_cart', []);
        $total = 0;

        // Extract dealer information from cart session or find by shop name
        $dealer = null;
        if (!empty($cart)) {
            // Get the first product from cart to find dealer information
            $firstItem = reset($cart);
            if (isset($firstItem['product_id']) && $firstItem['product_id']) {
                // Find dealer through DealerProductLink
                $dealerProductLink = \App\Models\DealerProductLink::where('product_id', $firstItem['product_id'])
                    ->with(['dealer.dealerProfile'])
                    ->first();
                
                if ($dealerProductLink && $dealerProductLink->dealer) {
                    $dealer = $dealerProductLink->dealer;
                }
            }
        }
        
        // If no dealer found from cart, find by shop name
        if (!$dealer) {
            $dealerProfile = \App\Models\DealerProfile::where('dealer_shop_name', $dealer_shop_name)
                ->with('user')
                ->first();
            if ($dealerProfile && $dealerProfile->user) {
                $dealer = $dealerProfile->user; // Get the User model
                $dealer->setRelation('dealerProfile', $dealerProfile); // Set the relationship manually
            }
        } else {
            // Ensure dealerProfile is loaded
            if (!$dealer->relationLoaded('dealerProfile')) {
                $dealer->load('dealerProfile');
            }
        }

        // Load product images for each cart item
        foreach ($cart as $productId => $item) {
            $total += $item['price'] * $item['quantity'];
            
            // Load the product with its images
            $product = Product::with('images')->find($item['id']);
            $cart[$productId]['product'] = $product;
        }

        $subtotal = $total;
        $deliveryFee = 300; // Fixed delivery fee
        $total = $subtotal + $deliveryFee;

        return view('frontend.DealerShowroom.cart.index', compact('cart', 'subtotal', 'deliveryFee', 'total', 'dealer', 'dealer_shop_name'));
    }

    public function removeFromCart($dealer_shop_name, $productId)
    {
        $cart = Session::get('showroom_cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('showroom_cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function updateCart(Request $request, $dealer_shop_name, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('showroom_cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->input('quantity');
            Session::put('showroom_cart', $cart);
            
            // Calculate updated totals
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $deliveryFee = 300; // Fixed delivery fee
            $total = $subtotal + $deliveryFee;
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'subtotal' => $subtotal,
                'total' => $total
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart'
        ], 404);
    }

    public function clearCart($dealer_shop_name)
    {
        Session::forget('showroom_cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function getCartCount($dealer_shop_name)
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

    public function proceedToCheckout($dealer_shop_name)
    {
        // If this is a direct buy-now checkout
        if (session()->has('buy_now')) {
            $item = session()->get('buy_now');
            $subtotal = $item['price'] * $item['quantity'];
            $deliveryFee = 300; // Fixed delivery fee
            $total = $subtotal + $deliveryFee;
            
            return view('frontend.DealerShowroom.checkout', compact('item', 'subtotal', 'deliveryFee', 'total', 'dealer_shop_name'));
        }

        // If this is a cart checkout
        $cart = Session::get('showroom_cart', []);
        if (empty($cart)) {
            return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Your cart is empty');
        }

        $subtotal = 0;
        // Load product images and details for each cart item
        foreach ($cart as $productId => $item) {
            $subtotal += $item['price'] * $item['quantity'];
            
            // Load the product with its images
            $product = Product::with('images')->find($item['id']);
            if ($product) {
                $cart[$productId]['product'] = $product;
                // Update image path if needed
                if (!isset($cart[$productId]['image']) || empty($cart[$productId]['image'])) {
                    $productImage = $product->images->first();
                    $cart[$productId]['image'] = $productImage ? $productImage->image_path : 'images/default-product.jpg';
                }
            }
        }
        
        $deliveryFee = 300; // Fixed delivery fee
        $total = $subtotal + $deliveryFee;

        return view('frontend.DealerShowroom.cart.checkout', compact('cart', 'subtotal', 'deliveryFee', 'total', 'dealer_shop_name'));
    }

    public function placeOrder(Request $request, $dealer_shop_name)
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
            return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $deliveryFee = 300;
        $total = $subtotal + $deliveryFee;

        // Store checkout data in session for payment processing
        Session::put('checkout_data', [
            'order_code' => $orderCode,
            'dealer_shop_name' => $dealer_shop_name,
            'customer_info' => $validatedData,
            'cart' => $cart,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $total
        ]);

        // Redirect to payment page
        return redirect()->route('dealer.cart.payment', ['dealer_shop_name' => $dealer_shop_name, 'order_code' => $orderCode]);
    }

    public function showPayment($dealer_shop_name, $order_code)
    {
        $checkoutData = Session::get('checkout_data');
        
        if (!$checkoutData || $checkoutData['order_code'] !== $order_code) {
            return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Invalid order. Please try again.');
        }

        // Prepare cart items with proper structure for the payment page
        $orderItems = [];
        foreach ($checkoutData['cart'] as $productId => $item) {
            // Load product details with images
            $product = Product::with('images')->find($item['id']);
            
            // Get image path safely
            $imagePath = 'images/default-product.jpg';
            if (isset($item['image']) && !empty($item['image'])) {
                $imagePath = $item['image'];
            } elseif ($product && $product->images->count() > 0) {
                $firstImage = $product->images->first();
                $imagePath = 'storage/' . $firstImage['image_path'];
            }
            
            $orderItems[] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'size' => $item['size'] ?? null,
                'color' => $item['color'] ?? null,
                'image' => $imagePath,
                'subtotal' => $item['price'] * $item['quantity']
            ];
        }

        // Create order object for the payment page
        $order = (object) [
            'order_code' => $order_code,
            'total_cost' => $checkoutData['total'],
            'subtotal' => $checkoutData['subtotal'],
            'delivery_fee' => $checkoutData['delivery_fee'],
            'items' => $orderItems,
            'customer_info' => $checkoutData['customer_info']
        ];

        return view('frontend.DealerShowroom.cart.payment', compact('order', 'order_code', 'dealer_shop_name'));
    }

    public function confirmCODPayment($dealer_shop_name, $order_code)
    {
        $checkoutData = Session::get('checkout_data');
        
        if (!$checkoutData || $checkoutData['order_code'] !== $order_code) {
            return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Invalid order. Please try again.');
        }

        try {
            // Create order record in customer_orders table
            $order = \App\Models\CustomerOrder::create([
                'order_code' => $order_code,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'customer_name' => $checkoutData['customer_info']['first_name'] . ' ' . $checkoutData['customer_info']['last_name'],
                'phone' => $checkoutData['customer_info']['phone'],
                'email' => $checkoutData['customer_info']['email'],
                'house_no' => $checkoutData['customer_info']['house_no'],
                'city' => $checkoutData['customer_info']['city'],
                'postal_code' => $checkoutData['customer_info']['postal_code'],
                'date' => \Carbon\Carbon::now(),
                'total_cost' => $checkoutData['total'],
                'status' => 'Pending',
                'payment_method' => 'COD',
                'payment_status' => 'Not Paid',
                'order_type' => \Illuminate\Support\Facades\Auth::check() ? 'customer' : 'annonymous'
            ]);

            // Create order items in customer_order_items table
            foreach ($checkoutData['cart'] as $item) {
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

            // Clear sessions after successful order
            Session::forget('showroom_cart');
            Session::forget('checkout_data');

            return redirect()->route('dealer.order.success', ['dealer_shop_name' => $dealer_shop_name, 'order_code' => $order_code])
                        ->with('success', 'Order placed successfully! You will pay cash on delivery.');

        } catch (\Exception $e) {
            \Log::error('COD Payment Error: ' . $e->getMessage());
            return redirect()->route('showroom.cart', $dealer_shop_name)
                        ->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function confirmCardPayment($dealer_shop_name, $order_code)
    {
        $checkoutData = Session::get('checkout_data');
        
        if (!$checkoutData || $checkoutData['order_code'] !== $order_code) {
            return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Invalid order. Please try again.');
        }

        try {
            // Create order record in customer_orders table
            $order = \App\Models\CustomerOrder::create([
                'order_code' => $order_code,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'customer_name' => $checkoutData['customer_info']['first_name'] . ' ' . $checkoutData['customer_info']['last_name'],
                'phone' => $checkoutData['customer_info']['phone'],
                'email' => $checkoutData['customer_info']['email'],
                'house_no' => $checkoutData['customer_info']['house_no'],
                'city' => $checkoutData['customer_info']['city'],
                'postal_code' => $checkoutData['customer_info']['postal_code'],
                'date' => \Carbon\Carbon::now(),
                'total_cost' => $checkoutData['total'],
                'status' => 'Pending',
                'payment_method' => 'Card',
                'payment_status' => 'Paid',
                'order_type' => \Illuminate\Support\Facades\Auth::check() ? 'customer' : 'annonymous'
            ]);

            // Create order items in customer_order_items table
            foreach ($checkoutData['cart'] as $item) {
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

            // Clear sessions after successful order
            Session::forget('showroom_cart');
            Session::forget('checkout_data');

            return redirect()->route('dealer.order.success', ['dealer_shop_name' => $dealer_shop_name, 'order_code' => $order_code])
                        ->with('success', 'Order placed successfully! Payment confirmed.');

        } catch (\Exception $e) {
            \Log::error('Card Payment Error: ' . $e->getMessage());
            return redirect()->route('showroom.cart', $dealer_shop_name)
                        ->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function orderSuccess($dealer_shop_name, $order_code)
    {
        try {
            $order = \App\Models\CustomerOrder::where('order_code', $order_code)
                ->with(['items.product'])
                ->first();
            
            if (!$order) {
                return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Order not found.');
            }

            return view('frontend.DealerShowroom.cart.success', compact('order', 'dealer_shop_name'));

        } catch (\Exception $e) {
            return redirect()->route('showroom.cart', $dealer_shop_name)->with('error', 'Error loading order details.');
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