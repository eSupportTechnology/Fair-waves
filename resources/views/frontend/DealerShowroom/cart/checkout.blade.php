@extends ('frontend.DealerShowroom.master')

@section('content')
@php
$cart = session('showroom_cart', []);
// Get dealer shop name from URL segment or session cart
$dealer_shop_name = request()->segment(2) ?? optional(reset($cart))['dealer_shop_name'] ?? 'default';
@endphp

<!-- Breadcrumb -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Checkout</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="{{ url('/') }}" class="text-gray-900 flex-align gap-8 home-link">
                        <i class="ph ph-house"></i> Home
                    </a>
                </li>
                <style>
                    .home-link {
                        transition: color 0.3s ease;
                    }
                    .home-link:hover {
                        color: #ffffff !important;
                    }
                </style>
                <li class="flex-align"><i class="ph ph-caret-right"></i></li>
                <li class="text-sm text-main-600">Checkout</li>
            </ul>
        </div>
    </div>
</div>

<!-- Checkout -->
<section class="checkout py-80">
<form action="{{ route('dealer.cart.placeOrder', $dealer_shop_name ?? 'default') }}" method="POST">
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

                    @php
                        // Use cart data passed from controller, fallback to session if not available
                        $sessionCart = $cart ?? session('showroom_cart', []);
                        // Use subtotal and deliveryFee passed from controller, with fallbacks
                        $checkoutSubtotal = $subtotal ?? 0;
                        $checkoutDeliveryFee = $deliveryFee ?? 300;
                        $checkoutTotal = $total ?? ($checkoutSubtotal + $checkoutDeliveryFee);
                        
                        // Debug output (remove this after testing)
                        // dd($sessionCart, $checkoutSubtotal, $checkoutDeliveryFee, $checkoutTotal);
                    @endphp

                    @if(empty($sessionCart))
                        <div class="text-center py-4">
                            <p class="text-gray-500">Your cart is empty</p>
                            <a href="{{ route('showroom.cart', $dealer_shop_name ?? 'default') }}" class="btn btn-primary mt-3">Back to Cart</a>
                        </div>
                    @else
                        <!-- Cart items display -->
                        @forelse($sessionCart as $index => $item)
                        <div class="flex-between gap-24 mb-32">
                            <div class="flex-align gap-12">
                                <!-- Product Image -->
                        
                                
                                <!-- Product Details -->
                                <div class="product-details">
                                    <span class="text-gray-900 fw-normal text-sm font-heading-two w-144">{{ $item['name'] ?? 'Unknown Product' }}</span>
                                    @if(isset($item['size']) && $item['size'])
                                        <small class="d-block text-gray-600">Size: {{ $item['size'] }}</small>
                                    @endif
                                    @if(isset($item['color']) && $item['color'])
                                        <small class="d-block text-gray-600">Color: {{ $item['color'] }}</small>
                                    @endif
                                </div>
                                
                                <span class="text-gray-900 fw-normal text-sm font-heading-two"><i class="ph-bold ph-x"></i></span>
                                <span class="text-gray-900 fw-semibold text-sm font-heading-two">{{ $item['quantity'] ?? 0 }}</span>
                            </div>
                            @php
                                $itemSubtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                            @endphp
                            <span class="text-gray-900 fw-bold text-sm font-heading-two">Rs {{ number_format($itemSubtotal, 2) }}</span>

                            <!-- Hidden Fields -->
                            <input type="hidden" name="products[{{$index}}][product_id]" value="{{ $item['id'] ?? $item['product_id'] ?? '' }}">
                            <input type="hidden" name="products[{{$index}}][quantity]" value="{{ $item['quantity'] ?? 0 }}">
                            <input type="hidden" name="products[{{$index}}][size]" value="{{ $item['size'] ?? '' }}">
                            <input type="hidden" name="products[{{$index}}][color]" value="{{ $item['color'] ?? '' }}">
                            <input type="hidden" name="products[{{$index}}][cost]" value="{{ $item['price'] ?? 0 }}">
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <p class="text-gray-500">No items found in cart</p>
                        </div>
                        @endforelse

                    <div class="border-top border-gray-100 pt-30 mt-30">
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Subtotal</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs {{ number_format($checkoutSubtotal, 2) }}</span>
                        </div>
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Delivery Fee</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs {{ number_format($checkoutDeliveryFee, 2) }}</span>
                        </div>
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-xl fw-bold">Total</span>
                            <span class="text-gray-900 font-heading-two text-xl fw-bold">Rs {{ number_format($checkoutTotal, 2) }}</span>
                        </div>
                    </div>
                    @endif
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

@if(isset($dealer_shop_name))
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update desktop navigation links
    const desktopNav = document.querySelector('.header-navigation');
    const shopName = '{{ $dealer_shop_name }}';
    
    if (desktopNav && shopName) {
        desktopNav.innerHTML = `
            <a href="/showroom/${shopName}" class="nav-link text-dark me-3 hover-orange">Home</a>
            <a href="/showroom/${shopName}#products-section" class="nav-link text-dark me-3 hover-orange">Products</a>
            <a href="/showroom/${shopName}/about" class="nav-link text-dark me-3 hover-orange">About</a>
            <a href="/showroom/${shopName}/about#contact-section" class="nav-link text-dark hover-orange contact-about-scroll">Contact</a>
        `;
    }

    // Update mobile navigation links
    const mobileNav = document.querySelector('.mobile-nav-menu');
    if (mobileNav && shopName) {
        mobileNav.innerHTML = `
            <a href="/showroom/${shopName}" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
            <a href="/showroom/${shopName}#products-section" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
            <a href="/showroom/${shopName}/about" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
            <a href="/showroom/${shopName}/about#contact-section" class="d-block py-2 text-dark text-decoration-none hover-orange contact-about-scroll">Contact</a>
        `;
    }

    // Update dealer shop name in header - replace dealer name with shop name
    const dealerNameElement = document.querySelector('.dealer-name');
    if (dealerNameElement && shopName && shopName !== 'default') {
        dealerNameElement.innerHTML = `<a href="/showroom/${shopName}" class="text-dark text-decoration-none">${shopName}</a>`;
    }

    // Handle contact navigation to about page with scrolling
    document.querySelectorAll('.contact-about-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#contact-section')) {
                window.location.href = href;
            }
        });
    });
});
</script>
@endif

@endsection