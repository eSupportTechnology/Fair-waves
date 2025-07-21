<?php $__env->startSection('content'); ?>

<!-- Breadcrumb -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Checkout</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="<?php echo e(url('/')); ?>" class="text-gray-900 flex-align gap-8 home-link">
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
<form action="<?php echo e(route('cart.checkout.process')); ?>" method="POST">
<?php echo csrf_field(); ?>

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

                    <?php
                        $cart = session('showroom_cart', []);
                        $subtotal = 0;
                        $deliveryFee = 300;
                    ?>

                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex-between gap-24 mb-32">
                            <div class="flex-align gap-12">
                                <span class="text-gray-900 fw-normal text-sm font-heading-two w-144"><?php echo e($item['name']); ?></span>
                                <span class="text-gray-900 fw-normal text-sm font-heading-two"><i class="ph-bold ph-x"></i></span>
                                <span class="text-gray-900 fw-semibold text-sm font-heading-two"><?php echo e($item['quantity']); ?></span>
                            </div>
                            <?php
                                $itemSubtotal = $item['price'] * $item['quantity'];
                                $subtotal += $itemSubtotal;
                            ?>
                            <span class="text-gray-900 fw-bold text-sm font-heading-two">Rs <?php echo e(number_format($itemSubtotal, 2)); ?></span>

                            <!-- Hidden Fields -->
                            <input type="hidden" name="products[<?php echo e($index); ?>][product_id]" value="<?php echo e($item['id']); ?>">
                            <input type="hidden" name="products[<?php echo e($index); ?>][quantity]" value="<?php echo e($item['quantity']); ?>">
                            <input type="hidden" name="products[<?php echo e($index); ?>][size]" value="<?php echo e($item['size'] ?? ''); ?>">
                            <input type="hidden" name="products[<?php echo e($index); ?>][color]" value="<?php echo e($item['color'] ?? ''); ?>">
                            <input type="hidden" name="products[<?php echo e($index); ?>][cost]" value="<?php echo e($item['price']); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $total = $subtotal + $deliveryFee;
                    ?>

                    <div class="border-top border-gray-100 pt-30 mt-30">
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Subtotal</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs <?php echo e(number_format($subtotal, 2)); ?></span>
                        </div>
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Delivery Fee</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs <?php echo e(number_format($deliveryFee, 2)); ?></span>
                        </div>
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-xl fw-bold">Total</span>
                            <span class="text-gray-900 font-heading-two text-xl fw-bold">Rs <?php echo e(number_format($total, 2)); ?></span>
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

<?php $__env->stopSection(); ?>

<?php
    // Get dealer information from cart items
    $dealer = null;
    if (session('showroom_cart') && is_array(session('showroom_cart'))) {
        foreach (session('showroom_cart') as $cartItem) {
            if (isset($cartItem['dealer_shop_name'])) {
                // If cart item has dealer info, get the dealer
                $dealer = \App\Models\User::whereHas('dealerProfile', function($query) use ($cartItem) {
                    $query->where('dealer_shop_name', $cartItem['dealer_shop_name']);
                })->where('role', 'dealer')->with('dealerProfile')->first();
                break;
            }
        }
    }
?>

<?php if($dealer && $dealer->dealerProfile): ?>
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
<?php else: ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fallback for when dealer context is not available from cart
    const desktopNav = document.querySelector('.header-navigation');
    const mobileNav = document.querySelector('.mobile-nav-menu');
    
    // Check if navigation has empty links and replace them
    if (desktopNav) {
        const emptyLinks = desktopNav.querySelectorAll('a[href=""]');
        if (emptyLinks.length > 0) {
            // Replace empty navigation links with main site navigation
            desktopNav.innerHTML = `
                <a href="<?php echo e(url('/')); ?>" class="nav-link text-dark me-3 hover-orange">Home</a>
                <a href="<?php echo e(url('/')); ?>" class="nav-link text-dark me-3 hover-orange">Products</a>
                <a href="<?php echo e(url('/')); ?>" class="nav-link text-dark me-3 hover-orange">About</a>
                <a href="<?php echo e(url('/')); ?>" class="nav-link text-dark hover-orange">Contact</a>
            `;
        }
    }
    
    if (mobileNav) {
        const emptyLinks = mobileNav.querySelectorAll('a[href=""]');
        if (emptyLinks.length > 0) {
            mobileNav.innerHTML = `
                <a href="<?php echo e(url('/')); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
                <a href="<?php echo e(url('/')); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
                <a href="<?php echo e(url('/')); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
                <a href="<?php echo e(url('/')); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">Contact</a>
            `;
        }
    }
});
</script>
<?php endif; ?>

<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/cart/checkout.blade.php ENDPATH**/ ?>