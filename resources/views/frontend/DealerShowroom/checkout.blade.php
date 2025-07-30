@extends ('frontend.DealerShowroom.master')

@php
    // Get dealer information from session data
    $dealer = null;
    
    // Check if we have cart items first (prioritize cart over buy_now)
    $cart = session('showroom_cart', []);
    $isCartCheckout = !empty($cart);
    
    if ($isCartCheckout) {
        // For cart checkout, try to get dealer from cart items or passed variable
        if (isset($dealer_shop_name)) {
            $dealerProfile = \App\Models\DealerProfile::where('dealer_shop_name', $dealer_shop_name)
                ->with('user')
                ->first();
            if ($dealerProfile && $dealerProfile->user) {
                $dealer = $dealerProfile->user;
                $dealer->setRelation('dealerProfile', $dealerProfile);
            }
        }
    } elseif (session('buy_now')) {
        // Handle Buy Now checkout only if no cart items
        $buyNowItem = session('buy_now');
        if (isset($buyNowItem['dealerProductLink'])) {
            $dealerProductLink = \App\Models\DealerProductLink::find($buyNowItem['dealerProductLink']);
            if ($dealerProductLink && $dealerProductLink->dealer && $dealerProductLink->dealer->dealerProfile) {
                $dealer = $dealerProductLink->dealer;
            }
        }
    }
@endphp

@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Checkout</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    @if(isset($dealer) && $dealer->dealerProfile && $dealer->dealerProfile->dealer_shop_name)
                        <a href="{{ route('showroom.index', $dealer->dealerProfile->dealer_shop_name) }}" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                            <i class="ph ph-house"></i> Home
                        </a>
                    @else
                        <a href="{{ route('showroom.index', $dealer_shop_name) }}" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                            <i class="ph ph-house"></i> Home
                        </a>
                    @endif
                </li>
                
                <li class="flex-align"><i class="ph ph-caret-right"></i></li>
                <li class="text-sm text-main-600">Checkout</li>
            </ul>
        </div>
    </div>
</div>

<!-- Checkout -->
<section class="checkout py-80">
@if(isset($cart) && !empty($cart))
    {{-- Cart checkout - prioritize cart over buy_now --}}
    <form action="{{ route('dealer.cart.placeOrder', $dealer_shop_name) }}" method="POST">
@elseif(session('buy_now') && empty(session('showroom_cart', [])))
    {{-- Buy now checkout - only when no cart items --}}
    <form action="{{ route('dealer_buynow_placeOrder') }}" method="POST">
@else
    {{-- Default to cart checkout with dealer shop name --}}
    <form action="{{ route('dealer.cart.placeOrder', $dealer_shop_name) }}" method="POST">
@endif
@csrf

<div class="container container-lg">
    <div class="row">
        <!-- Billing -->
        <div class="col-xl-8 col-lg-7">
            <div class="border border-gray-100 rounded-8 px-40 py-48" style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                <h3 class="text-lg fw-semibold mb-24">Billing Details</h3>
                <div class="row gy-3">
                    <div class="col-sm-6 col-xs-6">
                        <input type="text" name="first_name" class="common-input border-gray-100" placeholder="First Name" required>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <input type="text" name="last_name" class="common-input border-gray-100" placeholder="Last Name" required>
                    </div>
                    <div class="col-12">
                        <input type="text" name="house_no" class="common-input border-gray-100" placeholder="House number and street name" required>
                    </div>
                    <div class="col-12">
                        <input type="text" name="apartment" class="common-input border-gray-100" placeholder="Apartment, suite, unit, etc. (Optional)">
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <input type="text" name="city" class="common-input border-gray-100" placeholder="City" required>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <input type="text" name="postal_code" class="common-input border-gray-100" placeholder="Postal Code" required>
                    </div>
                    <div class="col-12">
                        <input type="number" name="phone" class="common-input border-gray-100" placeholder="Phone" required>
                    </div>
                    <div class="col-12">
                        <input type="email" name="email" class="common-input border-gray-100" placeholder="Email Address" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Summary -->
        <div class="col-xl-4 col-lg-5">
            <div class="checkout-sidebar">
                <div class="bg-color-three rounded-8 p-14 text-center">
                    <span class="text-gray-900 text-xl fw-semibold">Your Order</span>
                </div>
                <div class="border border-gray-100 rounded-8 px-24 py-40 mt-24">
                    <div class="mb-12 pb-12 border-bottom border-gray-100 flex-between gap-8">
                        <span class="text-gray-900 fw-medium text-xl font-heading-two">Product</span>
                        <span class="text-gray-900 fw-medium text-xl font-heading-two">Subtotal</span>
                    </div>

                    @if(isset($cart) && !empty($cart))
                        {{-- Cart Checkout Display --}}
                        @php
                            $cartSubtotal = 0;
                        @endphp
                        
                        @foreach($cart as $productId => $cartItem)
                            @php
                                $itemSubtotal = $cartItem['price'] * $cartItem['quantity'];
                                $cartSubtotal += $itemSubtotal;
                            @endphp
                            <div class="flex-between gap-24 mb-32">
                                <div class="flex-align gap-12">
                                    <span class="text-gray-900 fw-normal text-sm font-heading-two w-144">{{ $cartItem['name'] }}</span>
                                    <span class="text-gray-900 fw-normal text-sm font-heading-two"><i class="ph-bold ph-x"></i></span>
                                    <span class="text-gray-900 fw-semibold text-sm font-heading-two">{{ $cartItem['quantity'] }}</span>
                                </div>
                                <span class="text-gray-900 fw-bold text-sm font-heading-two">Rs {{ number_format($itemSubtotal, 2) }}</span>
                            </div>
                        @endforeach

                        @php
                            // Calculate delivery fee for cart - use highest delivery fee among cart items
                            $cartDeliveryFees = array_column($cart, 'delivery_fee');
                            $deliveryFee = !empty($cartDeliveryFees) ? max($cartDeliveryFees) : 300;
                            $total = $cartSubtotal + $deliveryFee;
                        @endphp

                    @elseif(session('buy_now') && empty(session('showroom_cart', [])))
                        {{-- Buy Now Checkout Display --}}
                        @php
                            $item = session('buy_now');
                            $product = \App\Models\Product::find($item['id']);
                            $subtotal = $item['price'] * $item['quantity'];
                            // Get delivery fee from session (stored during buy now process), fallback to default
                            $deliveryFee = $item['delivery_fee'] ?? 300;
                            $total = $subtotal + $deliveryFee;
                        @endphp

                        <div class="flex-between gap-24 mb-32">
                            <div class="flex-align gap-12">
                                <span class="text-gray-900 fw-normal text-sm font-heading-two w-144">{{ $item['name'] }}</span>
                                <span class="text-gray-900 fw-normal text-sm font-heading-two"><i class="ph-bold ph-x"></i></span>
                                <span class="text-gray-900 fw-semibold text-sm font-heading-two">{{ $item['quantity'] }}</span>
                            </div>
                            <span class="text-gray-900 fw-bold text-sm font-heading-two">Rs {{ number_format($subtotal, 2) }}</span>
                        </div>

                        <!-- Hidden Fields for Buy Now -->
                        <input type="hidden" name="products[0][product_id]" value="{{ $item['id'] }}">
                        <input type="hidden" name="products[0][quantity]" value="{{ $item['quantity'] }}">
                        <input type="hidden" name="products[0][size]" value="{{ $item['size'] ?? '' }}">
                        <input type="hidden" name="products[0][color]" value="{{ $item['color'] ?? '' }}">
                        <input type="hidden" name="products[0][cost]" value="{{ $item['price'] }}">
                        <input type="hidden" name="products[0][dealerProductLink]" value="{{ $item['dealerProductLink'] }}">
                        <input type="hidden" name="products[0][bv]" value="{{ $item['bv'] }}">
                    @endif

                    <div class="border-top border-gray-100 pt-30 mt-30">
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Subtotal</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs {{ number_format(isset($cartSubtotal) ? $cartSubtotal : $subtotal, 2) }}</span>
                        </div>
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Delivery Fee</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs {{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-xl fw-bold">Total</span>
                            <span class="text-gray-900 font-heading-two text-xl fw-bold">Rs {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-32 pt-32 border-top border-gray-100">
                    <p class="text-gray-500">Your personal data will be used to process your order and support your experience on this site. See our <a href="#" class="text-main-600 text-decoration-underline">privacy policy</a>.</p>
                </div>
                <style>
                    .btn-order {
                        background: #ff5800;
                        color: white;
                        transition: all 0.3s ease;
                    }
                    .btn-order:hover {
                        background: #ff7a3d;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 12px rgba(255, 88, 0, 0.2);
                    }
                </style>
                <button type="submit" class="btn btn-order mt-40 py-18 w-100 rounded-8">Place Order</button>
            </div>
        </div>
    </div>
</div>
</form>
</section>

@if($dealer && $dealer->dealerProfile)
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update desktop navigation links
    const desktopNav = document.querySelector('.header-navigation');
    if (desktopNav) {
        desktopNav.innerHTML = `
            <a href="{{ route('showroom.index', $dealer->dealerProfile->dealer_shop_name) }}" class="nav-link text-dark me-3 hover-orange">Home</a>
            <a href="{{ route('showroom.index', $dealer->dealerProfile->dealer_shop_name) }}#products-section" class="nav-link text-dark me-3 hover-orange">Products</a>
            <a href="{{ route('showroom.about', $dealer->dealerProfile->dealer_shop_name) }}" class="nav-link text-dark me-3 hover-orange">About</a>
            <a href="{{ route('showroom.about', $dealer->dealerProfile->dealer_shop_name) }}#contact-section" class="nav-link text-dark hover-orange contact-about-scroll">Contact</a>
        `;
    }

    // Update mobile navigation links
    const mobileNav = document.querySelector('.mobile-nav-menu');
    if (mobileNav) {
        mobileNav.innerHTML = `
            <a href="{{ route('showroom.index', $dealer->dealerProfile->dealer_shop_name) }}" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
            <a href="{{ route('showroom.index', $dealer->dealerProfile->dealer_shop_name) }}#products-section" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
            <a href="{{ route('showroom.about', $dealer->dealerProfile->dealer_shop_name) }}" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
            <a href="{{ route('showroom.about', $dealer->dealerProfile->dealer_shop_name) }}#contact-section" class="d-block py-2 text-dark text-decoration-none hover-orange contact-about-scroll">Contact</a>
        `;
    }

    // Handle contact navigation to about page with scrolling
    document.querySelectorAll('.contact-about-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#contact-section')) {
                // Let the browser handle navigation to the about page
                // The hash will be handled by the about page's JavaScript
                window.location.href = href;
            }
        });
    });
});
</script>
@else
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fallback for when dealer context is not available
    // Try to get dealer info from cart session or other sources
    const desktopNav = document.querySelector('.header-navigation');
    const mobileNav = document.querySelector('.mobile-nav-menu');
    
    @php
        // Try to get dealer info from cart items for regular cart checkout
        $cartDealer = null;
        if (session('cart') && is_array(session('cart'))) {
            foreach (session('cart') as $cartItem) {
                if (isset($cartItem['dealer_shop_name'])) {
                    $cartDealer = $cartItem;
                    break;
                }
            }
        }
    @endphp
    
    @if(isset($cartDealer) && $cartDealer)
    // Use dealer info from cart items
    if (desktopNav) {
        desktopNav.innerHTML = `
            <a href="{{ route('showroom.index', $cartDealer['dealer_shop_name']) }}" class="nav-link text-dark me-3 hover-orange">Home</a>
            <a href="{{ route('showroom.index', $cartDealer['dealer_shop_name']) }}#products-section" class="nav-link text-dark me-3 hover-orange">Products</a>
            <a href="{{ route('showroom.about', $cartDealer['dealer_shop_name']) }}" class="nav-link text-dark me-3 hover-orange">About</a>
            <a href="{{ route('showroom.about', $cartDealer['dealer_shop_name']) }}#contact-section" class="nav-link text-dark hover-orange contact-about-scroll">Contact</a>
        `;
    }

    if (mobileNav) {
        mobileNav.innerHTML = `
            <a href="{{ route('showroom.index', $cartDealer['dealer_shop_name']) }}" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
            <a href="{{ route('showroom.index', $cartDealer['dealer_shop_name']) }}#products-section" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
            <a href="{{ route('showroom.about', $cartDealer['dealer_shop_name']) }}" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
            <a href="{{ route('showroom.about', $cartDealer['dealer_shop_name']) }}#contact-section" class="d-block py-2 text-dark text-decoration-none hover-orange contact-about-scroll">Contact</a>
        `;
    }

    // Handle contact navigation to about page with scrolling
    document.querySelectorAll('.contact-about-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#contact-section')) {
                // Let the browser handle navigation to the about page
                // The hash will be handled by the about page's JavaScript
                window.location.href = href;
            }
        });
    });
    @else
    // If navigation links are empty and no dealer context, redirect to main site
    if (desktopNav) {
        const emptyLinks = desktopNav.querySelectorAll('a[href=""]');
        if (emptyLinks.length > 0) {
            // Replace empty navigation links with main site navigation
            desktopNav.innerHTML = `
                <a href="{{ url('/') }}" class="nav-link text-dark me-3 hover-orange">Home</a>
                <a href="{{ url('/') }}" class="nav-link text-dark me-3 hover-orange">Products</a>
                <a href="{{ url('/') }}" class="nav-link text-dark me-3 hover-orange">About</a>
                <a href="{{ url('/') }}" class="nav-link text-dark hover-orange">Contact</a>
            `;
        }
    }
    
    if (mobileNav) {
        const emptyLinks = mobileNav.querySelectorAll('a[href=""]');
        if (emptyLinks.length > 0) {
            mobileNav.innerHTML = `
                <a href="{{ url('/') }}" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
                <a href="{{ url('/') }}" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
                <a href="{{ url('/') }}" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
                <a href="{{ url('/') }}" class="d-block py-2 text-dark text-decoration-none hover-orange">Contact</a>
            `;
        }
    }
    @endif
});
</script>
@endif

@endsection