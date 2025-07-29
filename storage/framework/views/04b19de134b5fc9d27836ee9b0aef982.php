<?php
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
?>

<?php $__env->startSection('content'); ?>

<!-- Breadcrumb -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Checkout</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <?php if(isset($dealer) && $dealer->dealerProfile && $dealer->dealerProfile->dealer_shop_name): ?>
                        <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                            <i class="ph ph-house"></i> Home
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('showroom.index', $dealer_shop_name)); ?>" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                            <i class="ph ph-house"></i> Home
                        </a>
                    <?php endif; ?>
                </li>
                
                <li class="flex-align"><i class="ph ph-caret-right"></i></li>
                <li class="text-sm text-main-600">Checkout</li>
            </ul>
        </div>
    </div>
</div>

<!-- Checkout -->
<section class="checkout py-80">
<?php if(isset($cart) && !empty($cart)): ?>
    
    <form action="<?php echo e(route('dealer.cart.placeOrder', $dealer_shop_name)); ?>" method="POST">
<?php elseif(session('buy_now') && empty(session('showroom_cart', []))): ?>
    
    <form action="<?php echo e(route('dealer_buynow_placeOrder')); ?>" method="POST">
<?php else: ?>
    
    <form action="<?php echo e(route('dealer.cart.placeOrder', $dealer_shop_name)); ?>" method="POST">
<?php endif; ?>
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

                    <?php if(isset($cart) && !empty($cart)): ?>
                        
                        <?php
                            $cartSubtotal = 0;
                        ?>
                        
                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $itemSubtotal = $cartItem['price'] * $cartItem['quantity'];
                                $cartSubtotal += $itemSubtotal;
                            ?>
                            <div class="flex-between gap-24 mb-32">
                                <div class="flex-align gap-12">
                                    <span class="text-gray-900 fw-normal text-sm font-heading-two w-144"><?php echo e($cartItem['name']); ?></span>
                                    <span class="text-gray-900 fw-normal text-sm font-heading-two"><i class="ph-bold ph-x"></i></span>
                                    <span class="text-gray-900 fw-semibold text-sm font-heading-two"><?php echo e($cartItem['quantity']); ?></span>
                                </div>
                                <span class="text-gray-900 fw-bold text-sm font-heading-two">Rs <?php echo e(number_format($itemSubtotal, 2)); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php
                            $deliveryFee = 300;
                            $total = $cartSubtotal + $deliveryFee;
                        ?>

                    <?php elseif(session('buy_now') && empty(session('showroom_cart', []))): ?>
                        
                        <?php
                            $item = session('buy_now');
                            $product = \App\Models\Product::find($item['id']);
                            $subtotal = $item['price'] * $item['quantity'];
                            $deliveryFee = 300;
                            $total = $subtotal + $deliveryFee;
                        ?>

                        <div class="flex-between gap-24 mb-32">
                            <div class="flex-align gap-12">
                                <span class="text-gray-900 fw-normal text-sm font-heading-two w-144"><?php echo e($item['name']); ?></span>
                                <span class="text-gray-900 fw-normal text-sm font-heading-two"><i class="ph-bold ph-x"></i></span>
                                <span class="text-gray-900 fw-semibold text-sm font-heading-two"><?php echo e($item['quantity']); ?></span>
                            </div>
                            <span class="text-gray-900 fw-bold text-sm font-heading-two">Rs <?php echo e(number_format($subtotal, 2)); ?></span>
                        </div>

                        <!-- Hidden Fields for Buy Now -->
                        <input type="hidden" name="products[0][product_id]" value="<?php echo e($item['id']); ?>">
                        <input type="hidden" name="products[0][quantity]" value="<?php echo e($item['quantity']); ?>">
                        <input type="hidden" name="products[0][size]" value="<?php echo e($item['size'] ?? ''); ?>">
                        <input type="hidden" name="products[0][color]" value="<?php echo e($item['color'] ?? ''); ?>">
                        <input type="hidden" name="products[0][cost]" value="<?php echo e($item['price']); ?>">
                        <input type="hidden" name="products[0][dealerProductLink]" value="<?php echo e($item['dealerProductLink']); ?>">
                        <input type="hidden" name="products[0][bv]" value="<?php echo e($item['bv']); ?>">
                    <?php endif; ?>

                    <div class="border-top border-gray-100 pt-30 mt-30">
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Subtotal</span>
                            <span class="text-gray-900 font-heading-two text-md fw-semibold">Rs <?php echo e(number_format(isset($cartSubtotal) ? $cartSubtotal : $subtotal, 2)); ?></span>
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
    // Fallback for when dealer context is not available
    // Try to get dealer info from cart session or other sources
    const desktopNav = document.querySelector('.header-navigation');
    const mobileNav = document.querySelector('.mobile-nav-menu');
    
    <?php
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
    ?>
    
    <?php if(isset($cartDealer) && $cartDealer): ?>
    // Use dealer info from cart items
    if (desktopNav) {
        desktopNav.innerHTML = `
            <a href="<?php echo e(route('showroom.index', $cartDealer['dealer_shop_name'])); ?>" class="nav-link text-dark me-3 hover-orange">Home</a>
            <a href="<?php echo e(route('showroom.index', $cartDealer['dealer_shop_name'])); ?>#products-section" class="nav-link text-dark me-3 hover-orange">Products</a>
            <a href="<?php echo e(route('showroom.about', $cartDealer['dealer_shop_name'])); ?>" class="nav-link text-dark me-3 hover-orange">About</a>
            <a href="<?php echo e(route('showroom.about', $cartDealer['dealer_shop_name'])); ?>#contact-section" class="nav-link text-dark hover-orange contact-about-scroll">Contact</a>
        `;
    }

    if (mobileNav) {
        mobileNav.innerHTML = `
            <a href="<?php echo e(route('showroom.index', $cartDealer['dealer_shop_name'])); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
            <a href="<?php echo e(route('showroom.index', $cartDealer['dealer_shop_name'])); ?>#products-section" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
            <a href="<?php echo e(route('showroom.about', $cartDealer['dealer_shop_name'])); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
            <a href="<?php echo e(route('showroom.about', $cartDealer['dealer_shop_name'])); ?>#contact-section" class="d-block py-2 text-dark text-decoration-none hover-orange contact-about-scroll">Contact</a>
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
    <?php else: ?>
    // If navigation links are empty and no dealer context, redirect to main site
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
    <?php endif; ?>
});
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/checkout.blade.php ENDPATH**/ ?>