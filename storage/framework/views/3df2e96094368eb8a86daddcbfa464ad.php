<?php $__env->startSection('content'); ?>
<?php
$cart = session('showroom_cart', []);
// Get dealer shop name from URL segment or session cart
$dealer_shop_name = request()->segment(2) ?? optional(reset($cart))['dealer_shop_name'] ?? 'default';

// Clear buy_now session if we have cart items to prevent conflicts
if (!empty($cart) && session()->has('buy_now')) {
    session()->forget('buy_now');
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
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            
            <h2 class="mb-0">Shopping Cart</h2>
        </div>
    </div>

    <?php if(empty($cart)): ?>
        <div class="alert alert-info">
            Your cart is empty. <a href="<?php echo e(route('showroom.index', $dealer_shop_name)); ?>">Continue shopping</a>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productId => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cart-item" data-product-id="<?php echo e($productId); ?>">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <?php
                                        // Get product with images if not already loaded
                                        if (!isset($item['product']) || !$item['product']) {
                                            $item['product'] = App\Models\Product::with('images')->find($item['id']);
                                        }
                                    ?>
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
                                    <form action="<?php echo e(route('showroom.cart.remove', [$dealer_shop_name ?? 'default', $productId])); ?>" method="POST" class="remove-item-form" onsubmit="return handleRemoveItem(event, this, '<?php echo e($productId); ?>')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="remove-item" title="Remove item">
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
                
                        <?php if(isset($dealer_shop_name)): ?>
                            <a href="<?php echo e(route('dealer.cart.checkout', $dealer_shop_name)); ?>" class="btn btn-primary checkout-btn">Proceed to Checkout</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('cart.checkout')); ?>" class="btn btn-primary checkout-btn">Proceed to Checkout</a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity updates - Single implementation only
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const action = this.dataset.action;
            const cartItem = this.closest('.cart-item');
            const inputElement = cartItem.querySelector('.quantity-input');
            let currentQty = parseInt(inputElement.value);
            
            let newQty = action === 'increase' ? currentQty + 1 : currentQty - 1;
            if (newQty < 1) newQty = 1;
            
            // Show loading state
            cartItem.classList.add('loading');
            this.disabled = true;
            
            // Send AJAX request to update cart
            const dealerShopName = '<?php echo e($dealer_shop_name ?? ($dealer->dealerProfile->dealer_shop_name ?? 'default')); ?>';
            const updateUrl = `/showroom/${dealerShopName}/cart/update/${productId}`;
            
            fetch(updateUrl, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: newQty
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update quantity input
                    inputElement.value = newQty;
                    
                    // Update item subtotal
                    const subtotalElement = cartItem.querySelector('.item-subtotal');
                    const priceElement = cartItem.querySelector('.price');
                    const price = parseFloat(priceElement.textContent.replace('Rs. ', '').replace(',', ''));
                    const newSubtotal = price * newQty;
                    subtotalElement.textContent = `Rs. ${newSubtotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    
                    // Update cart totals
                    if (data.subtotal !== undefined) {
                        document.getElementById('cart-subtotal').textContent = `Rs. ${data.subtotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    }
                    if (data.total !== undefined) {
                        document.getElementById('cart-total').textContent = `Rs. ${data.total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                    }
                    
                    // Update cart count in header - this is the key fix!
                    if (typeof window.updateCartCount === 'function') {
                        window.updateCartCount();
                    }
                    
                    // Show success message
                    showMessage('Cart updated successfully!', 'success');
                } else {
                    showMessage(data.message || 'Failed to update cart', 'error');
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
        });
    });

    // Handle remove item functionality with AJAX
    function handleRemoveItem(event, form, productId) {
        event.preventDefault();
        
        // Show confirmation dialog
        if (!confirm('Are you sure you want to remove this item?')) {
            return false;
        }
        
        const cartItem = form.closest('.cart-item');
        const removeButton = form.querySelector('.remove-item');
        
        // Show loading state
        cartItem.classList.add('loading');
        removeButton.disabled = true;
        removeButton.textContent = '⏳';
        
        // Send AJAX request to remove item
        fetch(form.action, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text(); // Laravel may return redirect HTML
        })
        .then(data => {
            // Remove the cart item with animation
            cartItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            cartItem.style.opacity = '0';
            cartItem.style.transform = 'translateX(-100%)';
            
            setTimeout(() => {
                cartItem.remove();
                
                // Check if cart is now empty
                const remainingItems = document.querySelectorAll('.cart-item');
                if (remainingItems.length === 0) {
                    // Reload page to show empty cart message
                    window.location.reload();
                }
            }, 300);
            
            // Update cart count in header - this is the key fix!
            if (typeof window.updateCartCount === 'function') {
                window.updateCartCount();
            }
            
            // Show success message
            showMessage('Item removed from cart successfully!', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Failed to remove item. Please try again.', 'error');
            
            // Reset button state
            cartItem.classList.remove('loading');
            removeButton.disabled = false;
            removeButton.textContent = '×';
        });
        
        return false;
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

<?php if(isset($dealer_shop_name)): ?>
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
<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/cart/index.blade.php ENDPATH**/ ?>