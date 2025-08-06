<?php $__env->startSection('title', 'About ' . $dealer->dealerProfile->dealer_shop_name); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* About Page Styles */
    .about-section-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .about-section-card .card-header {
        background: linear-gradient(to right, #ff5800, #ff7a3d);
        color: white;
        padding: 20px;
        border-bottom: none;
    }

    .about-section-card .card-title {
        margin-bottom: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .about-section-card .card-body {
        padding: 25px;
    }

    /* Header Navigation Styles */
    .hover-orange:hover {
        color: #ff5800 !important;
    }

    .header-navigation .nav-link {
        position: relative;
        font-weight: 500;
    }

    .header-navigation .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #ff5800;
        transition: width 0.3s;
    }

    .header-navigation .nav-link:hover::after {
        width: 100%;
    }

    .about-content .about-item {
        display: flex;
        margin-bottom: 30px;
    }

    .about-content .about-item:last-child {
        margin-bottom: 0;
    }

    .about-content .about-icon {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        background-color: rgba(255, 88, 0, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 24px;
        color: #ff5800;
    }

    .about-content .about-details h5 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #333;
    }

    .about-content .about-details p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Contact Section Styles */
    .contact-item {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .contact-icon {
        width: 45px;
        height: 45px;
        background-color: rgba(255, 88, 0, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
        color: #ff5800;
        font-size: 18px;
    }

    .contact-details h5 {
        font-size: 1rem;
        margin-bottom: 5px;
        color: #333;
    }

    .contact-details p {
        color: #666;
        margin-bottom: 0;
    }

    /* About Banner Styling */
    .about-banner {
        background: white;
        border-bottom: 1px solid #eaeaea;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* Page Title Styling */
    .page-title-section {
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        color: white;
        border-bottom: 1px solid #eaeaea;
        position: relative;
        overflow: hidden;
    }

    .page-title-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 80%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0 50% 50% 0;
        transform: skewY(-15deg);
        z-index: 1;
    }

    .page-title-section .container {
        position: relative;
        z-index: 2;
    }

    .page-title {
        color: white;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Responsive Styles */
    @media (max-width: 767px) {
        .about-content .about-item {
            flex-direction: column;
        }

        .about-content .about-icon {
            margin-bottom: 15px;
            margin-right: 0;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .page-title-section::before {
            left: -30%;
            width: 100%;
        }
    }
</style>

<!-- Page Title -->
<div class="page-title-section py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title">About <?php echo e($dealer->dealerProfile->dealer_shop_name); ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- About Page Content Start -->
<div class="container-fluid py-3">
    <div class="showroom-container">

        <!-- Main Content -->
        <div class="row">
            <!-- Dealer Information -->
            <div class="col-lg-8 mb-4">
                <div class="about-section-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle me-2"></i>
                            About Our Store
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="about-content">
                            <div class="about-item">
                                <div class="about-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="about-details">
                                    <h5>Store Information</h5>
                                    <p>Welcome to <strong><?php echo e($dealer->dealerProfile->dealer_shop_name); ?></strong>, your trusted partner for quality products and excellent service. We are committed to providing you with the best shopping experience and premium products at competitive prices.</p>
                                </div>
                            </div>



                            <div class="about-item">
                                <div class="about-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="about-details">
                                    <h5>Why Choose Us</h5>
                                    <ul class="benefits-list">
                                        <li><i class="fas fa-check text-success me-2"></i>Verified and trusted dealer</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Quality products guaranteed</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Competitive pricing</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Excellent customer service</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Fast and reliable delivery</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4 mb-4">
                <div class="contact-section-card" id="contact-section">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-phone me-2"></i>
                            Contact Information
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="contact-details">
                                    <label>Dealer Name</label>
                                    <p><?php echo e($dealer->name); ?></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="contact-details">
                                    <label>Shop Name</label>
                                    <p><?php echo e($dealer->dealerProfile->dealer_shop_name); ?></p>
                                </div>
                            </div>

                            <?php if($dealer->dealerProfile->phone): ?>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <label>Phone</label>
                                    <p>
                                        <a href="tel:<?php echo e($dealer->dealerProfile->phone); ?>" class="contact-link">
                                            <?php echo e($dealer->dealerProfile->phone); ?>

                                        </a>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($dealer->email): ?>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <label>Email</label>
                                    <p>
                                        <a href="mailto:<?php echo e($dealer->email); ?>" class="contact-link">
                                            <?php echo e($dealer->email); ?>

                                        </a>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($dealer->dealerProfile->address): ?>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <label>Address</label>
                                    <p><?php echo e($dealer->dealerProfile->address); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if($dealer->dealerProfile->dealer_code): ?>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="contact-details">
                                    <label>Dealer Code</label>
                                    <p class="dealer-code"><?php echo e($dealer->dealerProfile->dealer_code); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="contact-actions mt-4">
                            <?php if($dealer->dealerProfile->phone): ?>
                            <a href="tel:<?php echo e($dealer->dealerProfile->phone); ?>" class="btn btn-primary-custom w-100 mb-2">
                                <i class="fas fa-phone me-2"></i>Call Now
                            </a>
                            <?php endif; ?>

                            <?php if($dealer->email): ?>
                            <a href="mailto:<?php echo e($dealer->email); ?>" class="btn btn-outline-custom w-100 mb-2">
                                <i class="fas fa-envelope me-2"></i>Send Email
                            </a>
                            <?php endif; ?>

                            <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="btn btn-success w-100">
                                <i class="fas fa-arrow-left me-2"></i>Back to Showroom
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #ff5800;
        --secondary-color: #28a745;
        --success-color: #28a745;
        --border-radius: 12px;
        --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .showroom-container {
        padding: 40px 20px;
        min-height: 100vh;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    /* About Section styles will start from here */

    .profile-placeholder:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.3);
    }

    /* .dealer-info {
        text-align: center;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    } */

    .shop-name {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        letter-spacing: 0.5px;
        position: relative;
        display: inline-block;
        padding-bottom: 8px;
    }

    .shop-name:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 80px;
        height: 3px;
        background: rgba(255, 255, 255, 0.6);
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .dealer-name {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 20px;
        font-weight: 500;
        letter-spacing: 0.3px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .dealer-badges {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 5px;
    }

    .dealer-badge {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .dealer-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .status-badge {
        background: var(--success-color);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .status-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Card Styling */
    .about-section-card,
    .contact-section-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        overflow: hidden;
        height: 100%;
    }

    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 25px;
        border-bottom: 2px solid var(--primary-color);
    }

    .card-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
    }

    .card-body {
        padding: 30px 25px;
    }

    /* About Content */
    .about-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: var(--transition);
    }

    .about-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .about-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .about-details h5 {
        margin-bottom: 10px;
        color: #2d3748;
        font-weight: 600;
    }

    .about-details p {
        color: #4a5568;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .benefits-list li {
        padding: 8px 0;
        color: #4a5568;
        display: flex;
        align-items: center;
    }

    /* Contact Information */
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        transition: var(--transition);
    }

    .contact-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .contact-details label {
        font-weight: 600;
        color: #4a5568;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        display: block;
    }

    .contact-details p {
        margin: 0;
        color: #2d3748;
        font-weight: 500;
    }

    .contact-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .contact-link:hover {
        color: #ff7043;
        text-decoration: underline;
    }

    .dealer-code {
        font-family: 'Courier New', monospace;
        background: #e9ecef;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
        color: var(--primary-color);
    }

    /* Buttons */
    .btn-primary-custom {
        background: var(--primary-color);
        border: 2px solid var(--primary-color);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-primary-custom:hover {
        background: #ff7043;
        border-color: #ff7043;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 88, 0, 0.3);
    }

    .btn-outline-custom {
        background: #f8f9fa;
        border: 2px solid var(--primary-color);
        color: var(--primary-color) !important;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 700;
        transition: var(--transition);
        text-decoration: none !important;
        display: inline-block;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .btn-outline-custom:hover {
        background: var(--primary-color) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 88, 0, 0.3);
        text-decoration: none !important;
        border-color: var(--primary-color);
    }

    .btn-outline-custom:focus {
        background: var(--primary-color) !important;
        color: white !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 88, 0, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .showroom-container {
            padding: 20px 10px;
        }

        .about-hero-section {
            padding: 40px 0;
        }

        .shop-name {
            font-size: 1.8rem;
        }

        .dealer-profile-section {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .dealer-profile-image {
            margin-bottom: 10px;
        }

        .profile-img,
        .profile-placeholder {
            width: 100px;
            height: 100px;
            font-size: 32px;
        }

        .dealer-badges {
            justify-content: center;
        }

        .about-item {
            flex-direction: column;
            text-align: center;
        }

        .contact-item {
            flex-direction: column;
            text-align: center;
        }

        .contact-actions .btn {
            margin-bottom: 10px;
            padding: 10px 15px;
            font-size: 14px;
        }
    }

    /* Animation */
    .showroom-welcome {
        animation: fadeIn 0.8s ease-out;
    }

    .dealer-info-card {
        animation: fadeInDown 0.8s ease-out 0.2s both;
    }

    .about-section-card,
    .contact-section-card {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle hash navigation for contact section
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

    // Handle contact navigation clicks
    document.querySelectorAll('.contact-about-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#contact-section')) {
                // If we're on the same page, prevent default and scroll
                if (window.location.pathname === this.pathname) {
                    e.preventDefault();
                    scrollToSection('contact-section');
                }
                // Otherwise, let the browser handle navigation
            }
        });
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/about/index.blade.php ENDPATH**/ ?>