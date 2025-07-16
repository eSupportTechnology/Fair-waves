<?php $__env->startSection('content'); ?>

<style>
    .showroom-welcome {
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        color: white;
        padding: 60px 0;
        text-align: center;
    }

    .showroom-welcome h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: white;
    }

    .showroom-welcome p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .dealer-info-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: -30px;
        position: relative;
        z-index: 2;
    }

    .products-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        text-align: center;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        text-align: center;
        margin-bottom: 50px;
    }

    .product-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 40px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        position: relative;
        overflow: hidden;
        height: 280px;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        background: #f8f9fa;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center top;
        transition: transform 0.3s ease;
        padding: 15px;
    }

    .product-card:hover .product-image img {
        transform: scale(1.1);
    }

    /* Additional spacing for card rows */
    .row > [class*="col-"] {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .mb-5 {
        margin-bottom: 3rem !important;
    }

    .product-content {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
        gap: 15px;
    }

    .product-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0;
        line-height: 1.4;
        flex: 1;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-availability {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .product-availability.available {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .product-availability.out-of-stock {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 15px;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 14px;
        color: #6c757d;
    }

    .product-category {
        background: #e9ecef;
        color: #495057;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .stock-status {
        font-weight: 600;
    }

    .stock
        color: #28a745;
    }

    .stock-out {
        color: #dc3545;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .btn-view-product {
        flex: 1;
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-view-product:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 88, 0, 0.3);
        color: white;
        text-decoration: none;
    }

    .no-products {
        text-align: center;
        padding: 80px 0;
    }

    .no-products h3 {
        color: #6c757d;
        margin-bottom: 20px;
    }

    .no-products p {
        color: #adb5bd;
        font-size: 1.1rem;
    }

    .pagination-wrapper {
        margin-top: 50px;
        text-align: center;
    }

    .pagination .page-link {
        color: #ff5800;
        border-color: #ff5800;
    }

    .pagination .page-item.active .page-link {
        background-color: #ff5800;
        border-color: #ff5800;
    }

    .pagination .page-link:hover {
        color: #ff7a3d;
        background-color: #fff3ec;
        border-color: #ff5800;
    }

    .features-grid {
        padding: 60px 0;
    }

    .feature-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 30px;
        color: white;
    }

    .contact-info {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        margin-top: 40px;
    }

    .contact-info h5 {
        color: #333;
        margin-bottom: 20px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .contact-item i {
        color: #ff5800;
        width: 20px;
        margin-right: 15px;
    }

    @media (max-width: 768px) {
        .showroom-welcome h1 {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .product-card {
            margin-bottom: 20px;
        }
        
        .product-actions {
            flex-direction: column;
        }
    }
</style>

<!-- Welcome Section -->
<div class="showroom-welcome">
    <div class="container">
        <h1>Welcome to <?php echo e($dealer->dealerProfile->dealer_shop_name ?? 'Our Showroom'); ?></h1>
        <p>Discover amazing products from our authorized dealer</p>
    </div>
</div>

<!-- Dealer Information -->
<div class="container">
    <div class="dealer-info-card">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="text-primary mb-3">
                    <i class="fas fa-store me-2"></i>
                    <?php echo e($dealer->dealerProfile->dealer_shop_name ?? 'Authorized Dealer Showroom'); ?>

                </h3>
                <p class="text-muted mb-2">
                    <strong>Dealer:</strong> <?php echo e($dealer->name); ?>

                </p>
                <?php if($dealer->dealerProfile->address): ?>
                <p class="text-muted mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <?php echo e($dealer->dealerProfile->address); ?>

                </p>
                <?php endif; ?>
                
            </div>
            <div class="col-md-4 text-md-end">
                <div class="showroom-badge">
                    <span class="badge bg-success fs-6 p-3">
                        <i class="fas fa-certificate me-2"></i>
                        Verified Seller
                    </span>
                </div>
            </div>
        </div>
    </div>

<!-- Products Section -->
<div class="products-section" id="products-section">
    <div class="container">
        <?php if($dealerProducts->count() > 0): ?>
            <h2 class="section-title">Product Collection</h2>
            <p class="section-subtitle">Explore our wide range of quality products available at competitive prices</p>
            
            <div class="row">
                <?php $__currentLoopData = $dealerProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="product-card">
                        <div class="product-image">
                            <?php if($productLink->product->images->count() > 0): ?>
                                <img src="<?php echo e(asset('storage/' . $productLink->product->images->first()->image_path)); ?>" 
                                     alt="<?php echo e($productLink->product->product_name); ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x250/f8f9fa/6c757d?text=No+Image" 
                                     alt="<?php echo e($productLink->product->product_name); ?>">
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-content">
                            <div class="product-header">
                                <h4 class="product-title"><?php echo e($productLink->product->product_name); ?></h4>
                                <?php if($productLink->product->quantity > 0): ?>
                                    <div class="product-availability available">Available</div>
                                <?php else: ?>
                                    <div class="product-availability out-of-stock">Out of Stock</div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="product-price">
                                Rs. <?php echo e(number_format($productLink->product->normal_price, 2)); ?>

                            </div>
                            
                            <div class="product-meta">
                                <span class="product-category">
                                    <?php echo e($productLink->product->category->name ?? 'General'); ?>

                                </span>
                                <span class="stock-status <?php echo e($productLink->product->quantity > 0 ? 'stock-available' : 'stock-out'); ?>">
                                    <?php if($productLink->product->quantity > 0): ?>
                                        <?php echo e($productLink->product->quantity); ?> in stock
                                    <?php else: ?>
                                        Out of stock
                                    <?php endif; ?>
                                </span>
                            </div>
                            
                            <div class="product-actions">
                                <a href="<?php echo e(route('showroom.productView', [$dealer->dealerProfile->dealer_shop_name, $productLink->unique_code])); ?>" 
                                   class="btn-view-product">
                                    <i class="fas fa-eye"></i>
                                    View Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- Pagination -->
            <?php if($dealerProducts->hasPages()): ?>
            <div class="pagination-wrapper">
                <?php echo e($dealerProducts->links()); ?>

            </div>
            <?php endif; ?>
            
        <?php else: ?>
            <!-- No Products Section -->
            <div class="no-products">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h3>
                            <i class="fas fa-box-open me-3"></i>
                            No Products Available
                        </h3>
                        <p>
                            This dealer hasn't added any products to their showroom yet. 
                            Please check back later or contact the dealer directly for product inquiries.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

    

    <!-- Contact Information -->
   
</div>

<div style="margin-bottom: 60px;"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle hash navigation for products section
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // Check if there's a hash in the URL on page load
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        setTimeout(() => {
            scrollToSection(hash);
        }, 500); // Small delay to ensure page is fully loaded
    }

    // Handle navigation clicks for smooth scrolling
    document.querySelectorAll('a[href*="#products-section"]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#products-section')) {
                // If we're on the same page, prevent default and scroll
                if (window.location.pathname === this.pathname) {
                    e.preventDefault();
                    scrollToSection('products-section');
                }
                // Otherwise, let the browser handle navigation
            }
        });
    });

    // Handle contact scroll
    document.querySelectorAll('.contact-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            scrollToSection(targetId);
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/home/index.blade.php ENDPATH**/ ?>