<!-- Header Section -->
<header class="header-section bg-white shadow-sm">
    <div class="container">
        <div class="row align-items-center py-3">
            <!-- Logo and Shop Name -->
            <div class="col-md-6 col-8">
                <div class="d-flex align-items-center">
                    <img src="<?php echo e(asset('frontend/newstyle/assets/images/Fire Waves LOGO.png')); ?>"
                         alt="Fair Waves Logo"
                         class="shop-logo me-3"
                         style="height: 50px; width: auto;">
                    <div>
                        <h4 class="shop-name mb-0 text-dark fw-bold">FAIR WAVES</h4>
                        <small class="text-muted">Premium Electronics Store</small>
                    </div>
                </div>
            </div>

            <!-- Navigation and Cart -->
            <div class="col-md-6 col-4">
                <div class="d-flex align-items-center justify-content-end">
                    <!-- Navigation Menu (Desktop) -->
                    <nav class="navbar-nav d-none d-md-flex me-4">
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
}

@media (max-width: 768px) {
    .shop-name {
        font-size: 1.1rem;
    }

    .shop-logo {
        height: 40px;
    }
}
</style>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/layouts/header.blade.php ENDPATH**/ ?>