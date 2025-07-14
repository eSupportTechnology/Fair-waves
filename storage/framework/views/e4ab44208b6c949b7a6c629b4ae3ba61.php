<!-- Header Section -->
<header class="header-section bg-white shadow-sm border-bottom">
    <div class="container">
        <div class="row align-items-center py-3">
            <!-- Dealer Profile and Shop Name -->
            <div class="col-md-6 col-8">
                <div class="d-flex align-items-center">
                    <?php if(isset($dealer)): ?>
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
                        
                        <!-- Dealer Information -->
                        <div class="dealer-info">
                            <h4 class="dealer-name mb-0 text-dark fw-bold">
                                <?php echo e($dealer->dealerProfile->dealer_shop_name ?? $dealer->name); ?>

                            </h4>
                            <div class="dealer-details">
                                <small class="text-muted me-2">
                                    <i class="fas fa-user me-1"></i>
                                    <?php echo e($dealer->name); ?>

                                </small>
                                <span class="dealer-badge">
                                    <i class="fas fa-certificate me-1"></i>
                                    Verified Dealer
                                </span>
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
                <div class="d-flex align-items-center justify-content-end">
                    <!-- Navigation Menu (Desktop) -->
                    <nav class="header-navigation d-none d-md-flex me-4">
                        <a href="" class="nav-link text-dark me-3 hover-orange">Home</a>
                        <a href="" class="nav-link text-dark me-3 hover-orange">Products</a>
                        <a href="" class="nav-link text-dark me-3 hover-orange">About</a>
                        <a href="" class="nav-link text-dark hover-orange">Contact</a>
                    </nav>

                    <!-- Cart Icon with Count -->
                    <div class="cart-section position-relative">
                        
                        <a href="" class="btn btn-outline-dark position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
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
                
                <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">Home</a>
                <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">Products</a>
                <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">About</a>
                <a href="" class="d-block py-2 text-dark text-decoration-none hover-orange">Contact</a>
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
}

.dealer-name {
    font-size: 1.4rem;
    color: #2d3748;
    margin-bottom: 5px;
    font-weight: 700;
}

.dealer-details {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.dealer-badge {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 11px;
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

/* Cart Button Styling */
.cart-section .btn {
    border-radius: 25px;
    padding: 8px 16px;
    transition: all 0.3s ease;
    border: 2px solid #ff5800;
    color: #ff5800;
}

.cart-section .btn:hover {
    background: #ff5800;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 88, 0, 0.3);
}

.cart-section .badge {
    background: #dc3545 !important;
    font-weight: 600;
}

@media (max-width: 768px) {
    .dealer-name {
        font-size: 1.1rem;
    }

    .dealer-profile-img,
    .dealer-profile-placeholder {
        width: 50px;
        height: 50px;
    }

    .dealer-profile-placeholder {
        font-size: 20px;
    }

    .dealer-details {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .dealer-badge {
        font-size: 10px;
        padding: 3px 8px;
    }
}
</style>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/layouts/header.blade.php ENDPATH**/ ?>