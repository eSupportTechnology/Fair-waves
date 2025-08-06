<?php $__env->startSection('dashboard-content'); ?>
<div class="dealer-orders-container">
    <div class="page-header">
        <h4 class="page-title">My Customer Orders</h4>
    </div>
    
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
            <div class="search-filters">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-list"></i>
                    All Orders
                </button>
                <button class="filter-btn" data-filter="pending">
                    <i class="fas fa-clock"></i>
                    Pending
                </button>
                <button class="filter-btn" data-filter="packed">
                    <i class="fas fa-box"></i>
                    Packed
                </button>
                <button class="filter-btn" data-filter="shipped">
                    <i class="fas fa-truck"></i>
                    Shipped
                </button>
            </div>
        </div>
        <div class="search-results-info">
            <span id="searchResultsCount" style="display: none;"></span>
        </div>
    </div>
    
    <div class="orders-content">

    <?php $__empty_1 = true; $__currentLoopData = $groupedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderCode => $orderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="order-card" data-status="<?php echo e(strtolower(str_replace(' ', '-', $orderData['order']->status))); ?>">
        <div class="order-card-header">
            <span class="status <?php echo e(strtolower(str_replace(' ', '-', $orderData['order']->status))); ?>">
                <?php echo e($orderData['order']->status); ?>

            </span>
        </div>

        <div class="order-info">
            <div class="info-grid">
                <div class="info-item">
                    <i class="fas fa-hashtag"></i>
                    <div class="info-content">
                        <label>Order ID</label>
                        <span><?php echo e($orderData['order']->order_code); ?></span>
                    </div>
                </div>
                <div class="info-item">
                    <i class="far fa-calendar-alt"></i>
                    <div class="info-content">
                        <label>Order Date</label>
                        <span><?php echo e($orderData['order']->created_at->format('Y-m-d')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-container">
            <?php $__currentLoopData = $orderData['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-item">
                <div class="product-image">
                    <?php if($item->link->product->images->first()): ?>
                    <img src="<?php echo e(asset('storage/' . $item->link->product->images->first()->image_path)); ?>" 
                         alt="Product Image">
                    <?php endif; ?>
                </div>
                <div class="product-details">
                    <h6><?php echo e($item->link->product->name); ?></h6>
                    <div class="product-meta">
                        <span class="quantity">
                            <i class="fas fa-cubes"></i> <?php echo e($item->order->quantity); ?> units
                        </span>
                        <span class="price">
                            <i class="fas fa-tag"></i> Rs <?php echo e(number_format($item->order->cost, 2)); ?>

                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="order-footer">
            <div class="total-section">
                <span class="total-label">Total Amount</span>
                <span class="total-amount">Rs <?php echo e(number_format($orderData['order']->total_cost, 2)); ?></span>
            </div>
            <div class="action-buttons">
                <a href="<?php echo e(route('dealer.track-order', $orderData['order']->order_code)); ?>" class="track-btn">
                    <i class="fas fa-truck"></i> Track Order
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="no-orders">
        <i class="fas fa-box-open empty-icon"></i>
        <h5>No orders found</h5>
        <p>You have no customer orders yet.</p>
    </div>
    <?php endif; ?>
</div>

<style>
    .page-header {
        margin-bottom: 20px;
        background: linear-gradient(135deg, #ff6f1a 0%, #ff9248 100%);
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(255, 111, 26, 0.15);
        display: flex;
        align-items: center;
        height: 60px;
        margin-top: 25px;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .order-card {
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #eaeaea;
    }

    .order-card-header {
        padding-bottom: 12px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f0f0f0;
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status.pending { background: #fff3cd; color: #856404; }
    .status.accepted { background: #d4edda; color: #155724; }
    .status.packed { background: #cce5ff; color: #004085; }
    .status.shipped { background: #d1ecf1; color: #0c5460; }
    .status.delivered { background: #d4edda; color: #155724; }
    .status.cancelled { background: #f8d7da; color: #721c24; }

    .order-info {
        margin-bottom: 16px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-item i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
        color: #ff6f1a;
    }

    .info-content {
        display: flex;
        flex-direction: column;
    }

    .info-content label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 2px;
    }

    .info-content span {
        font-weight: 500;
        color: #333;
    }

    .products-container {
        display: grid;
        gap: 12px;
        margin-bottom: 16px;
        max-height: 200px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .products-container::-webkit-scrollbar {
        width: 6px;
    }

    .products-container::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 3px;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 8px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .product-image {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-details h6 {
        margin: 0 0 4px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .product-meta {
        display: flex;
        gap: 16px;
    }

    .product-meta span {
        font-size: 0.85rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .product-meta i {
        font-size: 0.8rem;
        color: #ff6f1a;
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
    }

    .total-section {
        display: flex;
        flex-direction: column;
    }

    .total-label {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 4px;
    }

    .total-amount {
        font-size: 1.1rem;
        font-weight: 600;
        color: #ff6f1a;
    }

    .track-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ff6f1a;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .track-btn:hover {
        background: #e65800;
        color: white;
        transform: translateY(-1px);
    }

    .no-orders {
        text-align: center;
        padding: 48px 24px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .empty-icon {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 16px;
    }

    .no-orders h5 {
        color: #495057;
        margin-bottom: 8px;
    }

    .no-orders p {
        color: #6c757d;
        margin: 0;
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

    .search-filters {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border: 2px solid #e5e7eb;
        border-radius: 25px;
        background: #ffffff;
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        outline: none;
    }

    .filter-btn:hover {
        border-color: #ff6f1a;
        color: #ff6f1a;
        background: rgba(255, 111, 26, 0.05);
        transform: translateY(-1px);
    }

    .filter-btn.active {
        border-color: #ff6f1a;
        background: linear-gradient(135deg, #ff6f1a, #ff9248);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(255, 111, 26, 0.3);
    }

    .filter-btn i {
        font-size: 0.8rem;
    }

    .search-results-info {
        text-align: center;
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 12px;
        font-weight: 500;
    }

    .order-card.filtered {
        display: none;
    }

    .no-search-results {
        text-align: center;
        padding: 48px 24px;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 16px;
        display: none;
        border: 2px dashed #e5e7eb;
        margin-top: 20px;
    }

    .no-search-results .empty-icon {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 16px;
    }

    .no-search-results h5 {
        color: #4b5563;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .no-search-results p {
        color: #6b7280;
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .search-section {
            padding: 20px 16px;
            margin-bottom: 20px;
        }

        .search-input-wrapper {
            max-width: 100%;
        }
        
        .search-input {
            padding: 16px 50px 16px 48px;
            font-size: 0.95rem;
        }

        .search-filters {
            gap: 8px;
        }

        .filter-btn {
            padding: 8px 14px;
            font-size: 0.8rem;
        }

        .search-container {
            gap: 16px;
        }
    }

    @media (max-width: 480px) {
        .search-filters {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .search-filters::-webkit-scrollbar {
            height: 4px;
        }

        .search-filters::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 2px;
        }

        .filter-btn {
            flex-shrink: 0;
        }
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('orderSearchInput');
    const clearBtn = document.getElementById('clearSearch');
    const searchResultsCount = document.getElementById('searchResultsCount');
    const orderCards = document.querySelectorAll('.order-card');
    const ordersContent = document.querySelector('.orders-content');
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    let currentFilter = 'all';
    
    // Create no search results element
    const noSearchResults = document.createElement('div');
    noSearchResults.className = 'no-search-results';
    noSearchResults.innerHTML = `
        <i class="fas fa-search empty-icon"></i>
        <h5>No orders found</h5>
        <p>No orders match your search criteria. Try a different Order ID or filter.</p>
    `;
    ordersContent.appendChild(noSearchResults);

    let searchTimeout;

    function performSearch() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;
        
        orderCards.forEach(card => {
            let matchesSearch = true;
            let matchesFilter = true;
            
            // Check search term
            if (searchTerm !== '') {
                const orderIdElement = card.querySelector('.info-content span');
                if (orderIdElement) {
                    const orderId = orderIdElement.textContent.toLowerCase();
                    matchesSearch = orderId.includes(searchTerm);
                }
            }
            
            // Check filter
            if (currentFilter !== 'all') {
                const cardStatus = card.getAttribute('data-status');
                matchesFilter = cardStatus === currentFilter;
            }
            
            // Show/hide card based on both criteria
            if (matchesSearch && matchesFilter) {
                card.style.display = 'block';
                card.classList.remove('filtered');
                visibleCount++;
            } else {
                card.style.display = 'none';
                card.classList.add('filtered');
            }
        });
        
        // Update UI elements
        if (searchTerm === '' && currentFilter === 'all') {
            searchResultsCount.style.display = 'none';
            clearBtn.style.display = 'none';
            noSearchResults.style.display = 'none';
        } else {
            if (searchTerm !== '') {
                clearBtn.style.display = 'block';
            } else {
                clearBtn.style.display = 'none';
            }
            
            // Show search results count
            if (visibleCount > 0) {
                let resultText = `Found ${visibleCount} order${visibleCount !== 1 ? 's' : ''}`;
                if (searchTerm !== '') {
                    resultText += ` matching "${searchInput.value}"`;
                }
                if (currentFilter !== 'all') {
                    resultText += ` with status "${currentFilter}"`;
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
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 300);
    });

    // Clear search functionality
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        performSearch();
        searchInput.focus();
    });

    // Enter key search
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimeout);
            performSearch();
        }
    });

    // Filter button functionality
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Update current filter
            currentFilter = this.getAttribute('data-filter');
            
            // Perform search with new filter
            performSearch();
        });
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
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/dealer/orders/index.blade.php ENDPATH**/ ?>