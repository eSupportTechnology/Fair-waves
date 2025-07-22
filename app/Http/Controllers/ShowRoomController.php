<?php

namespace App\Http\Controllers;

use App\Models\AffiliateReferral;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\DealerProductLink;
use App\Models\DealerProductOrder;
use App\Models\Product;
use App\Models\RaffleTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ShowRoomController extends Controller
{
    public function index($dealer_shop_name)
    {
        // Find the dealer by shop name
        $dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
            $query->where('dealer_shop_name', $dealer_shop_name);
        })->where('role', 'dealer')->with('dealerProfile')->first();

        if (!$dealer) {
            abort(404, 'Showroom not found');
        }

        // Get all products for this dealer
        $dealerProducts = DealerProductLink::with([
            'product.images',
            'product.category',
            'product.brand',
            'product.variations'
        ])
        ->where('dealer_id', $dealer->id)
        ->paginate(12);

        return view('frontend.DealerShowroom.home.index', compact('dealer', 'dealerProducts'));
    }

    public function productView($dealer_shop_name, $unique_code)
    {
        // Find the product link using the unique code with all necessary relationships
        $productLink = DealerProductLink::with([
            'product.images',
            'product.variations',
            'product.reviews',
            'product.category',
            'product.brand',
            'dealer.dealerProfile'
        ])
            ->where('unique_code', $unique_code)
            ->firstOrFail();

        // Verify that the dealer shop name matches
        if ($productLink->dealer->dealerProfile->dealer_shop_name !== $dealer_shop_name) {
            abort(404, 'Product not found in this showroom');
        }

        // Get the dealer for header display
        $dealer = $productLink->dealer;

        return view('frontend.DealerShowroom.product.productView', compact('productLink', 'dealer'));
    }

    public function about($dealer_shop_name)
    {
        // Find the dealer by shop name
        $dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
            $query->where('dealer_shop_name', $dealer_shop_name);
        })->where('role', 'dealer')->with('dealerProfile')->first();

        if (!$dealer) {
            abort(404, 'Showroom not found');
        }

        return view('frontend.DealerShowroom.about.index', compact('dealer'));
    }

    public function dealerAdd($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);
        $cart[] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->normal_price,
            'quantity' => 1,
            'size' => $request->input('size'), // optional
            'color' => $request->input('color'), // optional
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function dealerBuyNow($id,$dpid, Request $request)
    {
        // dd($request->all());

        $product = Product::findOrFail($id);

        // Store only the current product in session for buy-now
        session()->put('buy_now', [
            "id" => $product->id,
            "name" => $product->product_name,
            "price" => $product->normal_price,
            "quantity" => 1,
            "size" => $request->input('size'), // can be null
            "color" => $request->input('color'), // can be null
            "dealerProductLink"=> $dpid,
            "bv" => $product->bv,
        ]);

        return redirect()->route('dealer.checkout.page');
    }

    public function dealer_buynow_placeOrder(Request $request)
    {
        try {
            $orderCode = 'ORD-' . strtoupper(Str::random(8));
            $deliveryFee = 300;
            $subtotal = 0;

            // Validate basic fields
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'house_no' => 'required|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
            ]);

            // Get the buy_now item from session
            $buyNowItem = session('buy_now');
            if (!$buyNowItem) {
                return redirect()->back()->with('error', 'Buy now session expired. Please try again.');
            }

            // Create products array from buy_now session data
            $products = [[
                'product_id' => $buyNowItem['id'],
                'dealerProductLink' => $buyNowItem['dealerProductLink'],
                'quantity' => $buyNowItem['quantity'],
                'cost' => $buyNowItem['price'],
                'bv' => $buyNowItem['bv'] ?? 0,
                'size' => $buyNowItem['size'] ?? null,
                'color' => $buyNowItem['color'] ?? null,
            ]];

            foreach ($products as $product) {
                $subtotal += $product['cost'] * $product['quantity'];
            }

            $total = $subtotal + $deliveryFee;

            // Create customer order
            $order = CustomerOrder::create([
                'order_code' => $orderCode,
                'user_id' => Auth::id() ?? null, // set user id if logged in, else null
                'customer_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'house_no' => $request->input('house_no'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('postal_code'),
                'date' => Carbon::now(),
                'total_cost' => $total,
                'status' => 'Pending',
                'payment_method' => $request->input('payment_method', null),
                'payment_status' => 'Pending',
                'order_type' => 'annonymous',
            ]);

            // Add products to the order
            foreach ($products as $product) {
                $itemSubtotal = $product['cost'] * $product['quantity'];

                $customerOrderItem = CustomerOrderItems::create([
                    'order_code' => $orderCode,
                    'product_id' => $product['product_id'],
                    'dealer_product_link_id' => $product['dealerProductLink'],
                    'quantity' => $product['quantity'],
                    'size' => $product['size'],
                    'color' => $product['color'],
                    'cost' => $itemSubtotal,
                    'date' => Carbon::now(),
                    'bv' => $product['bv'],
                ]);

                $dealerProductLink = DealerProductLink::where('id', $product['dealerProductLink'])->first();
                DealerProductOrder::create([
                    'dealer_product_link_id' => $product['dealerProductLink'],
                    'customer_order_item_id' => $customerOrderItem->id,
                    'user_id' => $dealerProductLink ? $dealerProductLink->dealer_id : null,
                ]);

                // Decrease product quantity
                $productModel = Product::find($product['product_id']);
                if ($productModel) {
                    $productModel->decrement('quantity', $product['quantity']);
                }
            }

            // Affiliate tracking logic
            if (session()->has('tracking_id')) {
                $tracking_id = session('tracking_id');
                $raffleTicket = RaffleTicket::where('token', $tracking_id)->first();

                if ($raffleTicket) {
                    foreach ($products as $product) {
                        $productRecord = Product::find($product['product_id']);
                        if ($productRecord) {
                            $productUrlPart = $productRecord->id;

                            $referral = AffiliateReferral::where('raffle_ticket_id', $raffleTicket->id)
                                ->where('product_url', 'like', '%' . $productUrlPart . '%')
                                ->first();

                            if ($referral) {
                                $referral->increment('referral_count');
                                // Check if affiliate_commission property exists before using it
                                if (isset($referral->affiliate_commission)) {
                                    $referral->increment('total_affiliate_price', $referral->affiliate_commission);
                                }
                            }
                        }
                    }
                }

                session()->forget('tracking_id');
            }

            return redirect()->route('dealerPayment', ['order_code' => $orderCode]);
            
        } catch (\Exception $e) {
            \Log::error('Error in dealer_buynow_placeOrder: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to place order. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function showPaymentPage($order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)
                              ->with(['items.product', 'items.dealerProductLink.dealer.dealerProfile'])
                              ->firstOrFail();
        
        // Get dealer from the first order item's dealer product link
        $dealer = $order->items->first()?->dealerProductLink?->dealer;
        
        return view('frontend.DealerShowroom.payment', compact('order', 'dealer'));
    }

    public function confirmCODOrder($order_code)
    {
        try {
            // For showroom orders, allow both authenticated and anonymous users
            $orderQuery = CustomerOrder::where('order_code', $order_code);
            
            // If user is logged in, check their orders, otherwise allow any order with this code
            if (Auth::check()) {
                $order = $orderQuery->where('user_id', Auth::id())->firstOrFail();
            } else {
                $order = $orderQuery->firstOrFail();
            }

            // Update the payment method and payment status
            $order->update([
                'payment_method' => 'COD',
            ]);

            // Clear the buy_now session after successful order
            session()->forget('buy_now');

            return redirect()->route('dealer.order.thankyou', ['order_code' => $order_code])
                ->with('success', 'Order confirmed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }

    public function confirmcardOrder($order_code)
    {
        try {
            // For showroom orders, allow both authenticated and anonymous users
            $orderQuery = CustomerOrder::where('order_code', $order_code);
            
            // If user is logged in, check their orders, otherwise allow any order with this code
            if (Auth::check()) {
                $order = $orderQuery->where('user_id', Auth::id())->firstOrFail();
            } else {
                $order = $orderQuery->firstOrFail();
            }

            // Update the payment method and payment status
            $order->update([
                'payment_method' => 'Card',
                'payment_status' => 'Paid',
            ]);

            // Clear the buy_now session after successful order
            session()->forget('buy_now');

            return redirect()->route('dealer.order.thankyou', ['order_code' => $order_code])
                ->with('success', 'Order confirmed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }



    public function getOrderDetails($order_code)
    {
        // For showroom orders, allow both authenticated and anonymous users
        $orderQuery = CustomerOrder::where('order_code', $order_code);
        
        // If user is logged in, check their orders, otherwise allow any order with this code
        if (Auth::check()) {
            $order = $orderQuery->where('user_id', Auth::id())->firstOrFail();
        } else {
            $order = $orderQuery->firstOrFail();
        }

        $orderItems = CustomerOrderItems::where('order_code', $order_code)->get();
        return view('frontend.order_received', compact('order', 'orderItems'));
    }
}
