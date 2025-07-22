

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
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.summary-card .card-title {
    color: #333;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 25px;
}

.summary-details {
    font-size: 16px;
}

.total-section span:last-child {
    color: rgb(35, 98, 225);
    font-size: 20px;
    font-weight: 600;
}
</style>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Payment</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="<?php echo e(url('/')); ?>" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
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
    <div class="container">
        <div class="row checkout-summary-container">
            <!-- Payment -->
            <div class="col-md-8 mb-4">
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
                                    <form action="<?php echo e(route('cart.payment.card', $order_code)); ?>" method="POST" id="card-payment-form">
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
                                <form action="<?php echo e(route('cart.payment.cod', $order_code)); ?>" method="POST">
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
            <div class="col-md-4">
                <div class="card border-0 summary-card">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        
                        <div class="summary-details">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span style="color: #666; font-size: 16px;">Subtotal</span>
                                <span style="color: #333; font-size: 16px; font-weight: 500;">Rs. <?php echo e(number_format($order->total_cost - 300, 2)); ?></span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span style="color: #666; font-size: 16px;">Delivery Fee</span>
                                <span style="color: #333; font-size: 16px; font-weight: 500;">Rs. 300.00</span>
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

<?php if(isset($dealer) && $dealer && $dealer->dealerProfile && $dealer->dealerProfile->dealer_shop_name): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update desktop navigation links
    const desktopNav = document.querySelector('.header-navigation');
    if (desktopNav) {
        desktopNav.innerHTML = `
            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="nav-link text-dark me-3 hover-orange">Home</a>
            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>#products-section" class="nav-link text-dark me-3 hover-orange">Products</a>
            <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>" class="nav-link text-dark me-3 hover-orange">About</a>
            <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>#contact-section" class="nav-link text-dark hover-orange contact-about-scroll">Contact</a>
        `;
    }

    // Update mobile navigation links
    const mobileNav = document.querySelector('.mobile-nav-menu');
    if (mobileNav) {
        mobileNav.innerHTML = `
            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>#products-section" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
            <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
            <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>#contact-section" class="d-block py-2 text-dark text-decoration-none hover-orange contact-about-scroll">Contact</a>
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
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/cart/payment.blade.php ENDPATH**/ ?>