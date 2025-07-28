<?php $__env->startSection('dashboard-content'); ?>
<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>
<style>
    /* Existing styles remain unchanged */

    /* Add tracking button styles */
    .track-button {
        color: #fff;
        background-color: #ff7b00;
        /* Orange */
        border: none;
        padding: 5px 15px;
        border-radius: 5px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .track-button:hover {
        background-color: #e56b00;
        /* Darker orange */
    }

    /* Move content down by 50px */
    .my-orders-container {
        margin-top: 50px;
    }

    /* Enhanced Search Section Styles */
    .search-section {
        background: linear-gradient(135deg, 
            rgba(255, 111, 26, 0.02) 0%, 
            rgba(255, 146, 72, 0.05) 25%, 
            rgba(255, 179, 102, 0.03) 50%, 
            rgba(255, 255, 255, 0.95) 75%, 
            rgba(248, 249, 250, 1) 100%);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 28px;
        box-shadow: 
            0 8px 32px rgba(255, 111, 26, 0.08),
            0 4px 16px rgba(0, 0, 0, 0.04),
            inset 0 1px 0 rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(255, 111, 26, 0.12);
        position: relative;
        overflow: hidden;
    }

    .search-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            #ff6f1a 0%, 
            #ff9248 25%, 
            #ffb366 50%, 
            #ffc999 75%, 
            #ff6f1a 100%);
        animation: gradientShift 3s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% {
            background: linear-gradient(90deg, 
                #ff6f1a 0%, 
                #ff9248 25%, 
                #ffb366 50%, 
                #ffc999 75%, 
                #ff6f1a 100%);
        }
        50% {
            background: linear-gradient(90deg, 
                #ffc999 0%, 
                #ffb366 25%, 
                #ff9248 50%, 
                #ff6f1a 75%, 
                #ffc999 100%);
        }
    }

    .search-section::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(
            ellipse at top left, 
            rgba(255, 111, 26, 0.03) 0%, 
            transparent 50%
        ),
        radial-gradient(
            ellipse at bottom right, 
            rgba(255, 179, 102, 0.02) 0%, 
            transparent 50%
        );
        pointer-events: none;
        z-index: 1;
    }

    .search-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        position: relative;
        z-index: 2;
    }

    .search-input-wrapper {
        position: relative;
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-icon-container {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-icon {
        color: #ff6f1a;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .search-input {
        width: 100%;
        padding: 18px 60px 18px 56px;
        border: 2px solid #e8ecef;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 400;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        outline: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        position: relative;
        z-index: 2;
    }

    .search-input:focus {
        border-color: #ff6f1a;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(255, 111, 26, 0.15);
        transform: translateY(-1px);
    }

    .search-input:focus + .search-input-focus-ring {
        opacity: 1;
        transform: scale(1);
    }

    .search-input::placeholder {
        color: #9ca3af;
        font-style: normal;
        font-weight: 400;
    }

    .search-input-focus-ring {
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border-radius: 32px;
        background: linear-gradient(45deg, #ff6f1a, #ff9248);
        opacity: 0;
        transform: scale(0.98);
        transition: all 0.3s ease;
        z-index: 1;
        pointer-events: none;
    }

    .clear-btn {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: #f3f4f6;
        border: none;
        color: #6b7280;
        font-size: 0.9rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: all 0.2s ease;
        z-index: 3;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .clear-btn:hover {
        color: #ffffff;
        background: #ff6f1a;
        transform: translateY(-50%) scale(1.1);
    }

    .search-results-info {
        text-align: center;
        margin-top: 15px;
    }

    .search-results-info span {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .no-search-results {
        text-align: center;
        padding: 48px 24px;
        background: #f8f9fa;
        border-radius: 12px;
        margin-top: 20px;
    }

    .no-search-results .empty-icon {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 16px;
    }

    .no-search-results h5 {
        color: #495057;
        margin-bottom: 8px;
    }

    .no-search-results p {
        color: #6c757d;
        margin: 0;
    }

    /* Animation for search results */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .order-card:not(.filtered) {
        animation: fadeInUp 0.3s ease-out;
    }
</style>

<div class="my-orders-container">
    <h4 class="px-2 py-2">My Orders</h4>

    <!-- Enhanced Search Bar Section -->
    <div class="search-section">
        <div class="search-container">
            <div class="search-input-wrapper">
                <div class="search-icon-container">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <input type="text" id="orderSearchInput" class="search-input" placeholder="Search by Order ID..." autocomplete="off">
                <button type="button" id="clearSearch" class="clear-btn" style="display: none;">
                    <i class="fas fa-times"></i>
                </button>
                <div class="search-input-focus-ring"></div>
            </div>
        </div>
        <div class="search-results-info">
            <span id="searchResultsCount" style="display: none;"></span>
        </div>
    </div>
</div>


<!-- All Orders Tab -->
<div id="all-orders" class="tab-content active">
    <?php if(auth()->guard()->check()): ?>
    <div class="orders-content">
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="order-card" data-order-id="<?php echo e(strtolower($order->order_code)); ?>" style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
            <div class="order-card-header d-flex justify-content-between align-items-center" style="margin-bottom: 20px; border-bottom: 1px solid #eaeaea;">
                <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>"><?php echo e($order->status); ?></span>
            </div>

            <div class="order-card-body d-flex align-items-center">
                <div class="order-image" style="margin-right: 15px;">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($orderItem->product && $orderItem->product->images->first()): ?>
                    <img src="<?php echo e(asset('storage/' . $orderItem->product->images->first()->image_path)); ?>" alt="Product Image" style="width: 70px; height: 80px;">
                    <?php break; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="order-info" style="font-size: 13px; color: black;">
                    <p><a href="#" class="order-link">Order ID:</a> <a href="#" class="order-link order-id-text"><?php echo e($order->order_code); ?></a></p>
                    <p class="order-date">Order date: <?php echo e($order->created_at->format('Y-m-d')); ?></p>
                    <p class="order-price">Total: Rs <?php echo e(number_format($order->total_cost, 2)); ?></p>
                </div>
                <div style="text-align: right; margin-left: auto;">
                    <a href="<?php echo e(route('user.track-order', $order->order_code)); ?>" class="track-button">Track Order</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-5">
            <h5 style="color: #999;">You have no orders yet.</h5>
            <a href="<?php echo e(route('shop.index')); ?>" class="btn btn-danger mt-3">Start Shopping</a>
        </div>
        <?php endif; ?>
    </div>

    <?php endif; ?>
    <?php if(auth()->guard()->guest()): ?>
    <div class="alert alert-warning" role="alert">
        Please <a href="<?php echo e(route('login')); ?>" class="alert-link">log in</a> to view your orders.
    </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('orderSearchInput');
    const clearBtn = document.getElementById('clearSearch');
    const searchResultsCount = document.getElementById('searchResultsCount');
    const orderCards = document.querySelectorAll('.order-card');
    const ordersContent = document.querySelector('.orders-content');
    
    // Create no search results element
    const noSearchResults = document.createElement('div');
    noSearchResults.className = 'no-search-results';
    noSearchResults.innerHTML = `
        <i class="fas fa-search empty-icon"></i>
        <h5>No orders found</h5>
        <p>No orders match your search criteria. Try a different Order ID.</p>
    `;
    noSearchResults.style.display = 'none';
    if (ordersContent) {
        ordersContent.appendChild(noSearchResults);
    }

    let searchTimeout;

    function performSearch() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;
        
        orderCards.forEach(card => {
            let matchesSearch = true;
            
            // Check search term
            if (searchTerm !== '') {
                const orderIdElement = card.querySelector('.order-id-text');
                if (orderIdElement) {
                    const orderId = orderIdElement.textContent.toLowerCase();
                    matchesSearch = orderId.includes(searchTerm);
                }
            }
            
            // Show/hide card based on search criteria
            if (matchesSearch) {
                card.style.display = 'block';
                card.classList.remove('filtered');
                visibleCount++;
            } else {
                card.style.display = 'none';
                card.classList.add('filtered');
            }
        });
        
        // Update UI elements
        if (searchTerm === '') {
            searchResultsCount.style.display = 'none';
            clearBtn.style.display = 'none';
            noSearchResults.style.display = 'none';
        } else {
            clearBtn.style.display = 'block';
            
            // Show search results count
            if (visibleCount > 0) {
                let resultText = `Found ${visibleCount} order${visibleCount !== 1 ? 's' : ''}`;
                if (searchTerm !== '') {
                    resultText += ` matching "${searchInput.value}"`;
                }
                searchResultsCount.textContent = resultText;
                searchResultsCount.style.display = 'block';
                noSearchResults.style.display = 'none';
            } else {
                searchResultsCount.style.display = 'none';
                noSearchResults.style.display = 'block';
            }
        }
    }

    // Search input event listener with debouncing
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 300);
        });

        // Enter key search
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                performSearch();
            }
        });

        // Focus search input on page load
        searchInput.focus();

        // Add smooth scrolling to search results
        searchInput.addEventListener('focus', function() {
            this.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        });
    }

    // Clear search functionality
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            performSearch();
            searchInput.focus();
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/user_dashboard/my-orders.blade.php ENDPATH**/ ?>