@extends('frontend.DealerShowroom.master')

@php
// Get dealer shop name from URL query parameter - THIS IS THE KEY FIX FOR BUY NOW SUCCESS PAGE
$dealer_shop_name = request()->get('dealer_shop_name') ?? 'default';

// Clear any conflicting sessions to prevent future conflicts
if (session()->has('buy_now') && session()->has('showroom_cart')) {
    // If both exist, prioritize cart and clear buy_now
    if (!empty(session('showroom_cart'))) {
        session()->forget('buy_now');
    }
}
@endphp

@section('content')

<style>
.success-section {
    background-color: #f8f9fa;
    min-height: 80vh;
    padding: 80px 0;
}

.success-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(149, 157, 165, 0.1);
    text-align: center;
    padding: 60px 40px;
}

.success-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #28a745, #20c997);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.success-title {
    color: #28a745;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
}

.success-subtitle {
    color: #6c757d;
    font-size: 18px;
    margin-bottom: 40px;
}

.order-info {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 30px;
    margin: 30px 0;
    text-align: left;
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e9ecef;
}

.info-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.btn-continue {
    background: linear-gradient(135deg, #ee520a, #ff6b2b);
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    color: white;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
    transition: all 0.3s ease;
}

.btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(238, 82, 10, 0.2);
    color: white;
    text-decoration: none;
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Order Confirmation</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="{{ route('showroom.index', $dealer_shop_name) }}" class="text-gray-900 flex-align gap-8 home-link">
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
                <li class="text-sm text-main-600">Order Confirmation</li>
            </ul>
        </div>
    </div>
</div>

<section class="success-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-card">
                    <div class="success-icon">
                        <i class="fas fa-check" style="font-size: 40px; color: white;"></i>
                    </div>
                    
                    <h1 class="success-title">Order Placed Successfully!</h1>
                    <p class="success-subtitle">
                        Thank you for your order. We've received your order and will process it shortly.
                    </p>

                    <div class="order-info">
                        <h5 class="mb-4" style="color: #333; font-weight: 600;">Order Details</h5>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Order Number:</span>
                            <span style="color: #333; font-weight: 600;">{{ $order->order_code }}</span>
                        </div>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Customer Name:</span>
                            <span style="color: #333; font-weight: 600;">{{ $order->customer_name }}</span>
                        </div>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Email:</span>
                            <span style="color: #333; font-weight: 600;">{{ $order->email }}</span>
                        </div>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Total Amount:</span>
                            <span style="color: #333; font-weight: 600;">Rs. {{ number_format($order->total_cost, 2) }}</span>
                        </div>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Payment Method:</span>
                            <span style="color: #333; font-weight: 600;">{{ $order->payment_method }}</span>
                        </div>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Payment Status:</span>
                            <span class="badge" style="background: {{ $order->payment_status == 'Paid' ? '#28a745' : '#ffc107' }}; color: white;">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                        
                        <div class="info-row">
                            <span style="color: #666; font-weight: 500;">Order Status:</span>
                            <span class="badge" style="background: #17a2b8; color: white;">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p style="color: #666; margin-bottom: 20px;">
                            <i class="fas fa-info-circle me-2"></i>
                            You will receive an order confirmation email shortly.
                        </p>
                        
                        <a href="{{ route('showroom.index', $dealer_shop_name) }}" class="btn-continue">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($dealer_shop_name) && $dealer_shop_name && $dealer_shop_name !== 'default')
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

    // Update cart link to use correct dealer shop name
    const cartLink = document.querySelector('.btn-cart-custom');
    if (cartLink && shopName) {
        cartLink.setAttribute('href', `/showroom/${shopName}/cart`);
    }

    // Clear cart count after successful order
    const cartCount = document.querySelector('#cart-count');
    if (cartCount) {
        cartCount.textContent = '0';
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
