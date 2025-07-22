<?php $__env->startSection('content'); ?>
<?php
// Extract dealer information from cart session
$dealer = null;
$cart = session('showroom_cart', []);
if (!empty($cart)) {
    // Get the first product from cart to find dealer information
    $firstItem = reset($cart);
    if (isset($firstItem['product_id']) && $firstItem['product_id']) {
        // Find dealer through DealerProductLink
        $dealerProductLink = App\Models\DealerProductLink::where('product_id', $firstItem['product_id'])
            ->with(['dealer.dealerProfile'])
            ->first();
        
        if ($dealerProductLink && $dealerProductLink->dealer) {
            $dealer = $dealerProductLink->dealer;
        }
    }
}
?>
<style>
    .cart-table {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .cart-item {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quantity-btn {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background: #e9ecef;
    }

    .quantity-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 5px;
    }

    .remove-item {
        background-color: #ff4d4d;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        line-height: 1;
    }

    .remove-item:hover {
        background-color: #ff3333;
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(255, 77, 77, 0.2);
    }

    .cart-summary {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .checkout-btn {
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        color: white;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        font-weight: 600;
        margin-top: 20px;
    }

    .checkout-btn:hover {
        background: linear-gradient(135deg, #ff7a3d, #ff5800);
        transform: translateY(-1px);
    }

    .loading {
        opacity: 0.6;
        pointer-events: none;
    }
</style>

<div class="container py-5">
    <h2 class="mb-4">Shopping Cart</h2>

    <?php if(empty($cart)): ?>
        <div class="alert alert-info">
            Your cart is empty. <a href="<?php echo e(url()->previous()); ?>">Continue shopping</a>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cart-item" data-product-id="<?php echo e($productId); ?>">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <?php if(isset($item['product']) && $item['product'] && $item['product']->images->isNotEmpty()): ?>
                                        <img src="<?php echo e(asset('storage/' . $item['product']->images->first()->image_path)); ?>" alt="<?php echo e($item['name']); ?>" class="product-image">
                                    <?php elseif(isset($item['image']) && $item['image']): ?>
                                        <img src="<?php echo e(asset('storage/' . $item['image'])); ?>" alt="<?php echo e($item['name']); ?>" class="product-image">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/default-product.jpg')); ?>" alt="<?php echo e($item['name']); ?>" class="product-image">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <h5><?php echo e($item['name']); ?></h5>
                                    <?php if($item['size']): ?>
                                        <small class="d-block">Size: <?php echo e($item['size']); ?></small>
                                    <?php endif; ?>
                                    <?php if($item['color']): ?>
                                        <small class="d-block">Color: <?php echo e($item['color']); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2">
                                    <div class="price">Rs. <?php echo e(number_format($item['price'], 2)); ?></div>
                                    <div class="mt-2">
                                        <div class="item-subtotal">Rs. <?php echo e(number_format($item['price'] * $item['quantity'], 2)); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn btn-minus" data-product-id="<?php echo e($productId); ?>" data-action="decrease">
                                            -
                                        </button>
                                        <input type="number" class="quantity-input" value="<?php echo e($item['quantity']); ?>" min="1" readonly>
                                        <button type="button" class="quantity-btn btn-plus" data-product-id="<?php echo e($productId); ?>" data-action="increase">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <form action="<?php echo e(route('showroom.cart.remove', $productId)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="remove-item" onclick="return confirm('Are you sure you want to remove this item?')" title="Remove item">
                                            ×
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="mb-4">Order Summary</h4>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="cart-subtotal">Rs. <?php echo e(number_format($subtotal, 2)); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Delivery Fee</span>
                        <span>Rs. <?php echo e(number_format($deliveryFee, 2)); ?></span>
                    </div>
                    <hr>
                    <div class="summary-row">
                        <strong>Total</strong>
                        <strong id="cart-total">Rs. <?php echo e(number_format($total, 2)); ?></strong>
                    </div>
                
                        <a href="<?php echo e(route('cart.checkout')); ?>" class="btn btn-primary checkout-btn">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function showMessage(message, type = 'success') {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        const container = document.querySelector('.container');
        container.insertBefore(alertDiv, container.firstChild);
        
        // Auto-dismiss after 3 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity updates
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const action = this.dataset.action;
            const inputElement = this.parentElement.querySelector('.quantity-input');
            let currentQty = parseInt(inputElement.value);
            
            let newQty = action === 'increase' ? currentQty + 1 : currentQty - 1;
            if (newQty < 1) newQty = 1;
            
            // Show loading state
            button.disabled = true;
            
            // Send AJAX request to update cart
            fetch(`/showroom/cart/update/${productId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: newQty
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update quantity input
                    inputElement.value = newQty;
                    
                    // Update item subtotal
                    const cartItem = button.closest('.cart-item');
                    const subtotalElement = cartItem.querySelector('.item-subtotal');
                    const priceElement = cartItem.querySelector('.price');
                    const price = parseFloat(priceElement.textContent.replace('Rs. ', '').replace(',', ''));
                    const newSubtotal = price * newQty;
                    subtotalElement.textContent = 'Rs. ' + newSubtotal.toFixed(2);
                    
                    // Update cart total
                    document.getElementById('cart-subtotal').textContent = 'Rs. ' + data.subtotal.toFixed(2);
                    document.getElementById('cart-total').textContent = 'Rs. ' + data.total.toFixed(2);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred while updating the cart.', 'error');
            })
            .finally(() => {
                button.disabled = false;
                cartItem.classList.remove('loading');
            });
        });
    });
    // Add event listeners to all quantity buttons
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', handleQuantityChange);
    });

    function handleQuantityChange(event) {
        const button = event.target;
        const productId = button.dataset.productId;
        const action = button.dataset.action;
        const cartItem = button.closest('.cart-item');
        const quantityInput = cartItem.querySelector('.quantity-input');
        const currentQuantity = parseInt(quantityInput.value);
        
        let newQuantity = currentQuantity;
        
        if (action === 'increase') {
            newQuantity = currentQuantity + 1;
        } else if (action === 'decrease' && currentQuantity > 1) {
            newQuantity = currentQuantity - 1;
        } else if (action === 'decrease' && currentQuantity === 1) {
            // Don't allow quantity to go below 1
            return;
        }

        // Show loading state
        cartItem.classList.add('loading');
        button.disabled = true;

        // Update quantity via AJAX
        updateQuantity(productId, newQuantity, cartItem);
    }

    function updateQuantity(productId, newQuantity, cartItem) {
        fetch(`/showroom/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                quantity: newQuantity
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showMessage('Cart updated successfully!', 'success');
                // Update quantity input
                const quantityInput = cartItem.querySelector('.quantity-input');
                quantityInput.value = newQuantity;
                
                // Update item subtotal
                const itemPrice = parseFloat(cartItem.querySelector('.price').textContent.replace('Rs. ', '').replace(',', ''));
                const newSubtotal = (itemPrice * newQuantity).toFixed(2);
                const subtotalElement = cartItem.querySelector('.item-subtotal');
                subtotalElement.textContent = `Rs. ${parseFloat(newSubtotal).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

                // Update cart summary
                const formattedSubtotal = parseFloat(data.subtotal).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                const formattedTotal = parseFloat(data.total).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                document.getElementById('cart-subtotal').textContent = `Rs. ${formattedSubtotal}`;
                document.getElementById('cart-total').textContent = `Rs. ${formattedTotal}`;

                // Show success message (optional)
                showMessage('Cart updated successfully!', 'success');
            } else {
                showMessage('Failed to update cart: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('An error occurred while updating the cart.', 'error');
        })
        .finally(() => {
            // Remove loading state
            cartItem.classList.remove('loading');
            cartItem.querySelectorAll('.quantity-btn').forEach(btn => {
                btn.disabled = false;
            });
        });
    }

    function showMessage(message, type) {
        // Create a simple toast notification
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // Handle contact navigation to about page with scroll
    document.querySelectorAll('a[href*="#contact-section"]').forEach(function(element) {
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
<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/cart/index.blade.php ENDPATH**/ ?>