<?php
// Extract dealer information from cart session for navigation
$dealer = null;
$cart = session('showroom_cart', []);
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

// Get dealer shop name from URL segment - THIS IS THE KEY FIX
$dealer_shop_name = request()->segment(2) ?? 'default';
?>

<?php $__env->startSection('content'); ?>

<style>
.payment-section {
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 60px 0;
}

.payment-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(149, 157, 165, 0.1);
    transition: all 0.4s ease;
}

.payment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(149, 157, 165, 0.15);
}

.payment-title {
    color: #2d3436;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 35px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
    position: relative;
}

.payment-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 60px;
    height: 2px;
    background: #ee520a;
}

.payment-tabs .nav-link {
    border: none;
    padding: 20px 30px;
    border-radius: 15px;
    color: #4a4a4a;
    transition: all 0.4s ease;
    margin: 0 15px;
    position: relative;
    text-align: center;
    min-width: 180px;
}

.payment-tabs .nav-link.active {
    background: #fff;
    color: #ee520a;
    box-shadow: 0 4px 20px rgba(238,82,10,0.15);
    transform: translateY(-3px);
}

.payment-form .form-label {
    font-weight: 500;
    color: #555;
    margin-bottom: 8px;
}

.payment-form .form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.payment-form .form-control:focus {
    border-color: #ee520a;
    box-shadow: 0 0 0 0.2rem rgba(238,82,10,0.1);
}

.btn-pay {
    background: linear-gradient(135deg, #ee520a, #ff6b2b);
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-pay:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(238,82,10,0.2);
}

.cod-info {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    border-left: 4px solid #ee520a;
}

.summary-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 1px solid #f0f0f0;
    position: sticky;
    top: 20px;
}

.summary-card .card-title {
    color: #333;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
    position: relative;
}

.summary-card .card-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 50px;
    height: 2px;
    background: #ee520a;
}

.summary-details {
    font-size: 16px;
}

.total-section span:last-child {
    color: rgb(35, 98, 225);
    font-size: 20px;
    font-weight: 600;
}

/* Enhanced Order Summary Card Layout */
.checkout-summary-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Responsive improvements for payment page */
@media (max-width: 768px) {
    .checkout-summary-container {
        margin: 0 10px;
    }
    
    .payment-card, .summary-card {
        margin-bottom: 20px;
    }
    
    .summary-card {
        position: static;
    }
    
    .payment-tabs .nav-link {
        min-width: 150px;
        padding: 15px 20px;
        margin: 0 8px;
    }
    
    .col-lg-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

@media (min-width: 992px) {
    .container-fluid {
        padding: 0 40px;
    }
}
</style>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Payment</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <?php if(isset($dealer) && $dealer->dealerProfile && $dealer->dealerProfile->dealer_shop_name): ?>
                        <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="text-gray-900 flex-align gap-8 home-link">
                            <i class="ph ph-house"></i>
                            Home
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('showroom.index', $dealer_shop_name)); ?>" class="text-gray-900 flex-align gap-8 home-link">
                            <i class="ph ph-house"></i>
                            Home
                        </a>
                    <?php endif; ?>
                </li>
                <style>
                    .home-link {
                        transition: color 0.3s ease;
                        text-decoration: none;
                    }
                    .home-link:hover {
                        color: #ffffff !important;
                        text-decoration: none;
                    }
                    .home-link:hover i {
                        color: #ffffff !important;
                    }
                </style>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600">Payment</li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<section class="payment-section">
    <div class="container-fluid">
        <div class="row checkout-summary-container justify-content-center">
            <!-- Payment -->
            <div class="col-lg-6 col-md-7 mb-4">
                <div class="payment-card">
                    <div class="p-4">
                        <h5 class="payment-title">Select Payment Method</h5>

                        <!-- Payment Tabs -->
                        <ul class="nav nav-tabs payment-tabs" id="paymentTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active d-flex flex-column align-items-center" id="credit-card-tab" data-bs-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="true">
                                    <div class="mb-2">
                                        <img src="<?php echo e(asset('frontend/assets/images/imgs/card.png')); ?>" style="width: 40px; height: auto;">
                                    </div>
                                    <span>Credit/Debit Card</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex flex-column align-items-center" id="cash-on-delivery-tab" data-bs-toggle="tab" href="#cash-on-delivery" role="tab" aria-controls="cash-on-delivery" aria-selected="false">
                                    <div class="mb-2">
                                        <img src="<?php echo e(asset('frontend/assets/images/imgs/cod.png')); ?>" style="width: 50px; height: auto;">
                                    </div>
                                    <span>Cash on Delivery</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="paymentTabsContent">
                            <!-- Credit Card Section -->
                            <div class="tab-pane fade show active" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab">
                                <div class="payment-form p-4">
                                    <form action="<?php echo e(route('dealer.cart.payment.card', ['dealer_shop_name' => $dealer_shop_name, 'order_code' => $order_code])); ?>" method="POST" id="card-payment-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <label class="form-label" for="cardName">
                                                    <span class="text-danger me-1">*</span>Card Holder Name
                                                </label>
                                                <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter card holder name" required>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <label class="form-label" for="cardNumber">
                                                    <span class="text-danger me-1">*</span>Card Number
                                                </label>
                                                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label" for="expiryDate">
                                                    <span class="text-danger me-1">*</span>Expiry Date
                                                </label>
                                                <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label" for="cvv">
                                                    <span class="text-danger me-1">*</span>CVV
                                                </label>
                                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-pay w-100 text-white mt-3">
                                            <i class="fas fa-lock me-2"></i>Pay Rs. <?php echo e(number_format($order->total_cost, 2)); ?>

                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Cash on Delivery Section -->
                            <div class="tab-pane fade" id="cash-on-delivery" role="tabpanel" aria-labelledby="cash-on-delivery-tab">
                                <div class="cod-info mb-4">
                                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Important Information</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pay in cash to our courier upon delivery</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Verify delivery status is 'Out for Delivery' before accepting</li>
                                        <li><i class="fas fa-shield-alt text-primary me-2"></i>100% Safe and Secure Delivery</li>
                                    </ul>
                                </div>
                                <form action="<?php echo e(route('dealer.cart.payment.cod', ['dealer_shop_name' => $dealer_shop_name, 'order_code' => $order_code])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-pay text-white w-100">
                                        <i class="fas fa-handshake me-2"></i>Confirm Cash on Delivery
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="col-lg-6 col-md-5">
                <div class="card border-0 summary-card">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        
                        <!-- Cart Items -->
                        <?php if(isset($order->items) && !empty($order->items)): ?>
                        <div class="mb-4">
                            <h6 class="mb-3 text-muted">Items in your order:</h6>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="me-3">
                                    <?php if(isset($item['image']) && $item['image']): ?>
                                    <img src="<?php echo e(asset($item['image'])); ?>" alt="<?php echo e($item['name']); ?>" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    <?php else: ?>
                                    <div style="width: 50px; height: 50px; background: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" style="font-size: 14px;"><?php echo e($item['name']); ?></h6>
                                    <div class="text-muted" style="font-size: 12px;">
                                        <?php if(isset($item['size']) && $item['size']): ?>
                                        <span>Size: <?php echo e($item['size']); ?></span>
                                        <?php endif; ?>
                                        <?php if(isset($item['color']) && $item['color']): ?>
                                        <span class="ms-2">Color: <?php echo e($item['color']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-muted" style="font-size: 12px;">
                                        Qty: <?php echo e($item['quantity']); ?> × Rs. <?php echo e(number_format($item['price'], 2)); ?>

                                    </div>
                                    <div class="fw-semibold" style="font-size: 14px;">
                                        Rs. <?php echo e(number_format($item['subtotal'], 2)); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Price Summary -->
                        <div class="summary-details">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span style="color: #666; font-size: 16px;">Subtotal</span>
                                <span style="color: #333; font-size: 16px; font-weight: 500;">Rs. <?php echo e(number_format($order->subtotal, 2)); ?></span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span style="color: #666; font-size: 16px;">Delivery Fee</span>
                                <span style="color: #333; font-size: 16px; font-weight: 500;">Rs. <?php echo e(number_format($order->delivery_fee, 2)); ?></span>
                            </div>
                            
                            <hr style="margin: 20px 0; opacity: 0.1;">
                            
                            <div class="d-flex justify-content-between align-items-center total-section">
                                <span style="color: #333; font-size: 18px; font-weight: 600;">Total Amount</span>
                                <span style="color: rgb(35, 98, 225); font-size: 20px; font-weight: 600;">Rs. <?php echo e(number_format($order->total_cost, 2)); ?></span>
                            </div>
                        </div>

                        <div class="mt-4 d-flex align-items-center" style="color: #666;">
                            <i class="fas fa-shield-alt me-2" style="color: #28a745;"></i>
                            <span style="font-size: 14px;">Secure Payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(isset($dealer_shop_name) && $dealer_shop_name && $dealer_shop_name !== 'default'): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update desktop navigation links
    const desktopNav = document.querySelector('.header-navigation');
    const shopName = '<?php echo e($dealer_shop_name); ?>';
    
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
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/cart/payment.blade.php ENDPATH**/ ?>