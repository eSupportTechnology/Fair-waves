<?php

namespace App\Http\Controllers;

use App\Models\AffiliateReferral;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\DealerProductLink;
use App\Models\DealerProductOrder;
use App\Models\Product;
use App\Models\RaffleTicket;
use App\Models\Review;
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

        // Get reviews for this product
        $reviews = Review::where('product_id', $productLink->product->id)
            ->where('status', 'Published')
            ->with('reviewer')
            ->latest()
            ->get();

        // Calculate average rating
        $averageRating = $reviews->avg('rating') ?? 0;

        // Calculate rating counts
        $ratingCounts = $reviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });

        // Total reviews
        $totalReviews = $reviews->count();

        // Ensure all rating levels (1-5) exist
        $ratingCounts = collect([1, 2, 3, 4, 5])->mapWithKeys(function ($rating) use ($ratingCounts) {
            return [$rating => $ratingCounts->get($rating, 0)];
        });

        return view('frontend.DealerShowroom.product.productView', compact('productLink', 'dealer', 'reviews', 'averageRating', 'ratingCounts', 'totalReviews'));
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

        // Get the dealer_product_link_id from the URL parameters
        $dealerProductLinkId = $request->route('dpid') ?? $request->input('dealer_product_link_id');

        if (!$dealerProductLinkId) {
            return redirect()->back()->with('error', 'Invalid dealer product link.');
        }

        $cart = session()->get('cart', []);
        $cart[] = [
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->normal_price,
            'quantity' => 1,
            'size' => $request->input('size'), // optional
            'color' => $request->input('color'), // optional
            'dealer_product_link_id' => $dealerProductLinkId,
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function dealerBuyNow($id,$dpid, Request $request)
    {
        try {
            $product = Product::findOrFail($id);

            // Get dealer shop name from dealer product link
            $dealerProductLink = DealerProductLink::with(['dealer.dealerProfile'])->findOrFail($dpid);

            // Ensure dealer and dealerProfile exist
            if (!$dealerProductLink->dealer || !$dealerProductLink->dealer->dealerProfile) {
                return redirect()->back()->with('error', 'Dealer information not found.');
            }

            $dealerShopName = $dealerProductLink->dealer->dealerProfile->dealer_shop_name;

            if (!$dealerShopName) {
                return redirect()->back()->with('error', 'Dealer shop name not found.');
            }

            // Clear showroom_cart session when user clicks buy now
            // This prevents conflicts between buy now and cart checkout flows
            if (session()->has('showroom_cart')) {
                session()->forget('showroom_cart');
            }

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

            return redirect()->route('dealer.checkout.page', $dealerShopName);
        } catch (\Exception $e) {
            Log::error('Error in dealerBuyNow: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
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
            Log::error('Error in dealer_buynow_placeOrder: ' . $e->getMessage());
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
                'payment_status' => 'Not Paid', // Set payment status for COD orders
            ]);

            // Clear the buy_now session after successful order
            session()->forget('buy_now');

            // Get dealer shop name for redirect
            $dealer_shop_name = '';
            $firstItem = null;
            if ($order->items && $order->items->count() > 0) {
                $firstItem = $order->items->first();
            }
            $dealerProductLink = $firstItem ? $firstItem->dealerProductLink : null;
            $dealer = $dealerProductLink ? $dealerProductLink->dealer : null;
            if ($dealer && $dealer->dealerProfile) {
                $dealer_shop_name = $dealer->dealerProfile->dealer_shop_name ?? '';
            }
            return redirect()->route('dealer.order.thankyou', ['order_code' => $order_code, 'dealer_shop_name' => $dealer_shop_name])
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

            // Get dealer shop name for redirect
            $dealer_shop_name = '';
            $firstItem = null;
            if ($order->items && $order->items->count() > 0) {
                $firstItem = $order->items->first();
            }
            $dealerProductLink = $firstItem ? $firstItem->dealerProductLink : null;
            $dealer = $dealerProductLink ? $dealerProductLink->dealer : null;
            if ($dealer && $dealer->dealerProfile) {
                $dealer_shop_name = $dealer->dealerProfile->dealer_shop_name ?? '';
            }
            return redirect()->route('dealer.order.thankyou', ['order_code' => $order_code, 'dealer_shop_name' => $dealer_shop_name])
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

        // Get dealer shop name from URL query parameter first (if redirected with shop name)
        $dealer_shop_name = request()->get('dealer_shop_name') ?? '';
        $dealer = null;

        // If no dealer shop name in query, try to get it from order items
        if (empty($dealer_shop_name)) {
            $firstItem = null;
            if ($order->items && $order->items->count() > 0) {
                $firstItem = $order->items->first();
            }
            $dealerProductLink = $firstItem ? $firstItem->dealerProductLink : null;
            $dealer = $dealerProductLink ? $dealerProductLink->dealer : null;
            if ($dealer && $dealer->dealerProfile) {
                $dealer_shop_name = $dealer->dealerProfile->dealer_shop_name ?? '';
            }
        } else {
            // If we have dealer shop name from query, find the dealer object
            $dealer = User::whereHas('dealerProfile', function($query) use ($dealer_shop_name) {
                $query->where('dealer_shop_name', $dealer_shop_name);
            })->where('role', 'dealer')->with('dealerProfile')->first();
        }

        return view('frontend.DealerShowroom.success_buy_now', compact('order', 'dealer_shop_name', 'dealer'));
    }

    public function productTrackingView($dealer_shop_name ,$order_code){

        $order = CustomerOrder::where('order_code', $order_code)
            ->firstOrFail();

        // Get the dealer shop name from the first order item's dealer product link
        $dealerShopName = null;
        if ($order->items && $order->items->count() > 0) {
            $firstItem = $order->items->first();
            if ($firstItem->dealerProductLink && $firstItem->dealerProductLink->dealer && $firstItem->dealerProductLink->dealer->dealerProfile) {
            $dealerShopName = $firstItem->dealerProductLink->dealer->dealerProfile->dealer_shop_name ?? null;
            }
        }
        Log::info('Dealer Shop Name: ' . $dealerShopName);
        Log::info('Order: ' . json_encode($order));

        return view('frontend.DealerShowroom.track.product-track', compact('dealer_shop_name', 'order_code'));
    }

    // Add this method to your ShowRoomController
    public function getOrderTrackingData($dealer_shop_name, $order_code)
    {
        try {
            // Find the order with its items and related product data
            $order = CustomerOrder::with(['items.product'])
                ->where('order_code', $order_code)
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found with the provided order code.'
                ], 404);
            }

            // Format the response data
            $orderData = [
                'order_code' => $order->order_code,
                'customer_name' => $order->customer_name,
                'phone' => $order->phone,
                'email' => $order->email,
                'date' => $order->date,
                'total_cost' => $order->total_cost,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_method,
                'tracking_number' => $order->tracking_number,
                'tracking_link' => $order->tracking_link,
                'activity_logs' => $order->activity_logs ?? [],
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'quantity' => $item->quantity,
                        'size' => $item->size,
                        'color' => $item->color,
                        'cost' => $item->cost,
                        'product' => $item->product ? [
                            'id' => $item->product->id,
                            'name' => $item->product->product_name,
                            // 'sku' => $item->product->sku ?? 'N/A',
                            'image' => $item->product->images && count($item->product->images) > 0
                                ? asset('storage/' . $item->product->images[0]['image_path'])
                                : null,
                        ] : null
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'order' => $orderData
            ]);
        } catch (\Exception $e) {
            Log::error('Order tracking error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching order data. Please try again later.'
            ], 500);
        }
    }
}

