@extends ('frontend.DealerShowroom.master')

@section('content')

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
        padding: 40px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f8f9fa 100%);
        position: relative;
    }

    .products-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        text-align: center;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        border-radius: 2px;
    }

    .section-subtitle {
        font-size: 1rem;
        color: #64748b;
        text-align: center;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 25px;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #e2e8f0;
        max-width: 320px;
        margin-left: auto;
        margin-right: auto;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        border-color: #ff5800;
    }

    .product-image {
        position: relative;
        overflow: hidden;
        height: 220px;
        width: 100%;
        display: block;
        background: #ffffff;
        padding: 0;
        border-bottom: 1px solid #f1f5f9;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
        border-radius: 0;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: block;
    }

    .product-card:hover .product-image img {
        transform: scale(1.03);
    }

    /* Additional spacing for card rows */
    .row > [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    /* Card hover effects */
    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 88, 0, 0.05), rgba(255, 122, 61, 0.05));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
        pointer-events: none;
    }

    .product-card:hover::before {
        opacity: 1;
    }

    .product-card > * {
        position: relative;
        z-index: 2;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-card {
            max-width: 280px;
        }
        
        .product-image {
            height: 180px;
            padding: 0;
        }
        
        .product-content {
            padding: 15px;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .product-card {
            max-width: 100%;
            margin-left: 0;
            margin-right: 0;
        }
        
        .product-image {
            height: 160px;
        }
        
        .row > [class*="col-"] {
            padding-left: 5px;
            padding-right: 5px;
        }
    }

    .product-content {
        padding: 18px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        gap: 10px;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0;
        line-height: 1.3;
        flex: 1;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-availability {
        padding: 3px 8px;
        border-radius: 8px;
        font-size: 10px;
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
        font-size: 1.2rem;
        font-weight: 700;
        color: #ff5800;
        margin-bottom: 12px;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 12px;
        color: #6c757d;
        gap: 8px;
    }

    .product-category {
        background: #f1f5f9;
        color: #475569;
        padding: 3px 8px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 50%;
    }

    .stock-status {
        font-weight: 600;
        font-size: 11px;
        white-space: nowrap;
    }

    .stock-available {
        color: #059669;
    }

    .stock-out {
        color: #dc2626;
    }

    .product-actions {
        display: flex;
        gap: 8px;
    }

    .btn-view-product {
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        flex: 1;
        text-align: center;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(255, 88, 0, 0.2);
    }

    .btn-view-product:hover {
        background: linear-gradient(135deg, #e64a00, #ff5800);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(255, 88, 0, 0.3);
        text-decoration: none;
    }

    .btn-view-product i {
        margin-right: 6px;
        font-size: 12px;
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
        <h1>Welcome to {{ $dealer->dealerProfile->dealer_shop_name ?? 'Our Showroom' }}</h1>
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
                    {{ $dealer->dealerProfile->dealer_shop_name ?? 'Authorized Dealer Showroom' }}
                </h3>
                <p class="text-muted mb-2">
                    <strong>Seller:</strong> {{ $dealer->name }}
                </p>
                @if($dealer->dealerProfile->address)
                <p class="text-muted mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {{ $dealer->dealerProfile->address }}
                </p>
                @endif
                
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
        @if($dealerProducts->count() > 0)
            <h2 class="section-title">Product Collection</h2>
            <p class="section-subtitle">Explore our wide range of quality products available at competitive prices</p>
            
            <div class="row justify-content-center">
                @foreach($dealerProducts as $productLink)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            @if($productLink->product->images->count() > 0)
                                <img src="{{ asset('storage/' . $productLink->product->images->first()->image_path) }}" 
                                     alt="{{ $productLink->product->product_name }}">
                            @else
                                <img src="https://via.placeholder.com/300x250/f8f9fa/6c757d?text=No+Image" 
                                     alt="{{ $productLink->product->product_name }}">
                            @endif
                        </div>
                        
                        <div class="product-content">
                            <div class="product-header">
                                <h4 class="product-title">{{ $productLink->product->product_name }}</h4>
                                @if($productLink->product->quantity > 0)
                                    <div class="product-availability available">Available</div>
                                @else
                                    <div class="product-availability out-of-stock">Out of Stock</div>
                                @endif
                            </div>
                            
                            <div class="product-price">
                                Rs. {{ number_format($productLink->product->normal_price, 2) }}
                            </div>
                            
                            <div class="product-meta">
                                <span class="product-category">
                                    {{ $productLink->product->category->name ?? 'General' }}
                                </span>
                                <span class="stock-status {{ $productLink->product->quantity > 0 ? 'stock-available' : 'stock-out' }}">
                                    @if($productLink->product->quantity > 0)
                                        {{ $productLink->product->quantity }} in stock
                                    @else
                                        Out of stock
                                    @endif
                                </span>
                            </div>
                            
                            <div class="product-actions">
                                <a href="{{ route('showroom.productView', [$dealer->dealerProfile->dealer_shop_name, $productLink->unique_code]) }}" 
                                   class="btn-view-product">
                                    <i class="fas fa-eye"></i>
                                    View Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($dealerProducts->hasPages())
            <div class="pagination-wrapper">
                {{ $dealerProducts->links() }}
            </div>
            @endif
            
        @else
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
        @endif
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

@endsection