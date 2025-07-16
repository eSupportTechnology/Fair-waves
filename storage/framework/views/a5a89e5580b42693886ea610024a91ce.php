<!-- Header Section -->
<header class="header-section bg-white shadow-sm border-bottom">
    <div class="container">
        <div class="row align-items-center py-3">
            <!-- Dealer Profile and Shop Name -->
            <div class="col-md-6 col-8">
                <div class="d-flex align-items-center">
                    <?php if(isset($dealer)): ?>
                        <!-- Dealer Information with Profile Image -->
                        <div class="dealer-info d-flex align-items-center">
                            <!-- Dealer Profile Image -->
                            <div class="dealer-profile-wrapper me-3">
                                <?php if($dealer->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $dealer->profile_image)); ?>"
                                         alt="<?php echo e($dealer->name); ?>"
                                         class="dealer-profile-img">
                                <?php else: ?>
                                    <div class="dealer-profile-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Dealer Name and Details -->
                            <div class="dealer-content">
                                <h3 class="dealer-name mb-1 text-dark fw-bold">
                                    <?php if($dealer->dealerProfile->dealer_shop_name): ?>
                                        <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="text-dark text-decoration-none">
                                            <?php echo e($dealer->dealerProfile->dealer_shop_name); ?>

                                        </a>
                                    <?php else: ?>
                                        <?php echo e($dealer->name); ?>

                                    <?php endif; ?>
                                </h3>
                                <div class="dealer-details">
                                    <small class="text-muted me-3 dealer-owner">
                                        <?php echo e($dealer->name); ?>

                                    </small>
                                    <span class="dealer-badge">
                                        <i class="fas fa-certificate me-1"></i>
                                        Verified Seller
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Fallback to Fair Waves if no dealer context -->
                        <img src="<?php echo e(asset('frontend/newstyle/assets/images/Fire Waves LOGO.png')); ?>"
                             alt="Fair Waves Logo"
                             class="shop-logo me-3"
                             style="height: 50px; width: auto;">
                        <div>
                            <h4 class="shop-name mb-0 text-dark fw-bold">FAIR WAVES</h4>
                            <small class="text-muted">Premium Electronics Store</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Navigation and Cart -->
            <div class="col-md-6 col-4">
                <div class="d-flex align-items-center justify-content-end h-100">
                    <!-- Navigation Menu (Desktop) -->
                    <nav class="header-navigation d-none d-md-flex me-4">
                        <?php if(isset($dealer)): ?>
                            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="nav-link text-dark me-3 hover-orange">Home</a>
                            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>#products-section" class="nav-link text-dark me-3 hover-orange">Products</a>
                            <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>" class="nav-link text-dark me-3 hover-orange">About</a>
                            <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>#contact-section" class="nav-link text-dark hover-orange contact-about-scroll">Contact</a>
                        <?php else: ?>
                            <a href="" class="nav-link text-dark me-3 hover-orange">Home</a>
                            <a href="" class="nav-link text-dark me-3 hover-orange">Products</a>
                            <a href="" class="nav-link text-dark me-3 hover-orange">About</a>
                            <a href="" class="nav-link text-dark hover-orange">Contact</a>
                        <?php endif; ?>
                    </nav>

                    <!-- Cart Icon with Count - Always Visible -->
                    <div class="cart-section position-relative d-flex align-items-center">
                        <a href="<?php echo e(route('showroom.cart')); ?>" class="btn btn-cart-custom position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge"
                                  id="cart-count">
                                <?php echo e(session('cart_count', 0)); ?>

                            </span>
                        </a>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button class="btn btn-outline-dark d-md-none ms-2"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#mobileMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="collapse d-md-none" id="mobileMenu">
            <div class="mobile-nav-menu py-3 border-top">
                <?php if(isset($dealer)): ?>
                    <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
                    <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>#products-section" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
                    <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
                    <a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>#contact-section" class="d-block py-2 text-dark text-decoration-none hover-orange contact-about-scroll">Contact</a>
                <?php else: ?>
                    <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
                    <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
                    <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
                    <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">Contact</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<style>
.hover-orange:hover {
    color: #ff5800 !important;
}

.cart-section .badge {
    font-size: 0.7rem;
}

/* Enhanced Dealer Profile Styling */
.dealer-profile-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dealer-profile-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ff5800;
    box-shadow: 0 4px 12px rgba(255, 88, 0, 0.2);
    transition: all 0.3s ease;
}

.dealer-profile-img:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(255, 88, 0, 0.3);
}

.dealer-profile-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff5800, #ff7a3d);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    transition: transform 0.3s ease;
}

.dealer-profile-placeholder:hover {
    transform: scale(1.05);
}

/* Enhanced Dealer Content Styling */
.dealer-info {
    display: flex;
    align-items: center;
}

.dealer-content {
    display: flex;
    flex-direction: column;
}

.dealer-name {
    font-size: 1.25rem;
    transition: color 0.3s ease;
    margin-bottom: 5px;
}

.dealer-name a:hover {
    color: #ff5800 !important;
    text-decoration: none;
}

.dealer-owner {
    font-size: 0.85rem;
    margin-bottom: 3px;
}

.dealer-details {
    display: flex;
    align-items: center;
    gap: 10px;
}

.dealer-details .dealer-badge {
    background: #ff5800;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 2px 8px rgba(255, 88, 0, 0.2);
}

.shop-logo {
    transition: transform 0.3s ease;
}

.shop-logo:hover {
    transform: scale(1.05);
}

.header-section {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-bottom: 2px solid #e9ecef;
}

/* Dealer Profile Styling */
.dealer-profile-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dealer-profile-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ff5800;
    box-shadow: 0 4px 12px rgba(255, 88, 0, 0.2);
    transition: all 0.3s ease;
}

.dealer-profile-img:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(255, 88, 0, 0.3);
}

.dealer-profile-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff5800, #ff7a3d);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(255, 88, 0, 0.2);
}

.dealer-info {
    flex: 1;
    display: flex;
    align-items: center;
    min-height: 60px;
}

.dealer-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-left: 0;
}

.dealer-name {
    font-size: 1.9rem;
    color: #2d3748;
    margin-bottom: 2px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.5px;
}

.dealer-name a:hover {
    color: #ff5800 !important;
    transition: color 0.3s ease;
}

.dealer-owner {
    font-size: 0.85rem;
    font-weight: 500;
    color: #6b7280 !important;
    margin-bottom: 0;
}

.dealer-details {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 2px;
}

.dealer-badge {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Navigation Styling */
.header-navigation {
    display: flex;
    align-items: center;
    gap: 0;
}

.header-navigation .nav-link {
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
    padding: 8px 0;
    white-space: nowrap;
    display: inline-block;
}

.header-navigation .nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #ff5800;
    transition: width 0.3s ease;
}

.header-navigation .nav-link:hover::after {
    width: 100%;
}

/* Cart Button Styling - Simple Orange Button */
.cart-section {
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-cart-custom {
    background-color: #ff5800;
    color: #000000;
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 50px;
    height: 50px;
    transition: all 0.3s ease;
    position: relative;
}

.btn-cart-custom:hover {
    background-color: #e04e00;
    color: #000000;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 88, 0, 0.3);
}

.btn-cart-custom:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 88, 0, 0.2);
}

.btn-cart-custom .fas {
    color: #000000;
}

.cart-badge {
    background: #dc3545 !important;
    color: white;
    font-weight: 600;
    font-size: 0.7rem;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

@media (max-width: 1200px) {
    .cart-section {
        display: flex;
    }
    
    .btn-cart-custom {
        display: flex;
    }
}

@media (max-width: 992px) {
    .cart-section {
        display: flex;
    }
    
    .btn-cart-custom {
        display: flex;
    }
}

@media (max-width: 768px) {
    .dealer-name {
        font-size: 1.4rem;
        margin-bottom: 2px;
    }

    .dealer-profile-img,
    .dealer-profile-placeholder {
        width: 50px;
        height: 50px;
    }

    .dealer-profile-placeholder {
        font-size: 20px;
    }

    .dealer-owner {
        font-size: 0.8rem;
    }

    .dealer-details {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
        margin-top: 2px;
    }

    .dealer-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }

    .btn-cart-custom {
        padding: 10px 14px;
        min-width: 45px;
        height: 45px;
        font-size: 16px;
    }

    .cart-section {
        display: flex;
    }

    .cart-badge {
        font-size: 0.6rem;
        min-width: 16px;
        height: 16px;
    }

    .header-navigation {
        display: none !important;
    }

    .col-4 {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for contact links (for current page dealer info)
    document.querySelectorAll('.contact-scroll').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Handle contact navigation to about page
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
</script><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/layouts/header.blade.php ENDPATH**/ ?>