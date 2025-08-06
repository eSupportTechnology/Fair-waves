<?php $__env->startSection('dashboard-content'); ?>
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #ff6b00, #ff3c00);
        --secondary-gradient: linear-gradient(135deg, #667eea, #764ba2);
        --success-gradient: linear-gradient(135deg, #11998e, #38ef7d);
        --warning-gradient: linear-gradient(135deg, #f093fb, #f5576c);
        --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        --card-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.12);
        --border-radius: 16px;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --bg-light: #f7fafc;
        --white: #ffffff;
    }

    /* Dashboard Header Styling */
    .welcome-banner {
        background: var(--primary-gradient);
        border-radius: var(--border-radius);
        padding: 2rem;
        margin: 1.5rem 0 2rem 0;
        color: white;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 1;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 1;
    }

    .banner-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .profile-avatar {
        position: relative;
        flex-shrink: 0;
    }

    .profile-avatar img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.3);
        transition: transform 0.3s ease;
    }

    .profile-avatar:hover img {
        transform: scale(1.05);
    }

    /* Default Profile Placeholder */
    .profile-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff5800, #ff7a3d);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 600;
        border: 4px solid rgba(255, 255, 255, 0.3);
        transition: transform 0.3s ease;
        text-transform: uppercase;
    }

    .profile-avatar:hover .profile-placeholder {
        transform: scale(1.05);
    }

    .welcome-text h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .welcome-text p {
        font-size: 1rem;
        margin: 0;
        opacity: 0.9;
        font-weight: 400;
    }

    /* Quick Stats Section */
    .stats-section {
        margin: 2rem 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .stat-card:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translateY(-2px);
    }

    .stat-card.pending {
        border-left-color: #f59e0b;
        background: linear-gradient(135deg, #fef3c7, #ffffff);
    }

    .stat-card.processing {
        border-left-color: #3b82f6;
        background: linear-gradient(135deg, #dbeafe, #ffffff);
    }

    .stat-card.shipped {
        border-left-color: #10b981;
        background: linear-gradient(135deg, #d1fae5, #ffffff);
    }

    .stat-card.completed {
        border-left-color: #8b5cf6;
        background: linear-gradient(135deg, #e9d5ff, #ffffff);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
    }

    .stat-icon.pending {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .stat-icon.processing {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .stat-icon.shipped {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .stat-icon.completed {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Orders Section */
    .orders-section {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--card-shadow);
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .orders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
    }

    .order-card {
        background: var(--white);
        border: 2px solid #f1f5f9;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        position: relative;
        overflow: hidden;
    }

    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .order-card:hover {
        border-color: #ff3c00;
        box-shadow: var(--card-shadow-hover);
        transform: translateY(-4px);
        color: inherit;
        text-decoration: none;
    }

    .order-card:hover::before {
        transform: scaleX(1);
    }

    .order-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem auto;
        background: var(--bg-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .order-icon img {
        width: 32px;
        height: 32px;
        filter: sepia(1) saturate(2) hue-rotate(15deg);
        transition: all 0.3s ease;
    }

    .order-card:hover .order-icon {
        background: #ff3c00;
        transform: scale(1.1);
    }

    .order-card:hover .order-icon img {
        filter: brightness(0) invert(1);
    }

    .order-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .order-description {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin: 0;
        line-height: 1.4;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-banner {
            padding: 1.5rem;
            margin: 1rem 0;
        }

        .banner-content {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .profile-avatar img,
        .profile-placeholder {
            width: 70px;
            height: 70px;
        }

        .profile-placeholder {
            font-size: 28px;
        }

        .welcome-text h1 {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .orders-section {
            padding: 1.5rem;
        }

        .orders-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .order-card {
            padding: 1rem;
        }

        .order-icon {
            width: 56px;
            height: 56px;
        }

        .order-icon img {
            width: 28px;
            height: 28px;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .orders-grid {
            grid-template-columns: 1fr 1fr;
        }

        .order-card {
            padding: 0.875rem;
        }

        .section-title {
            font-size: 1.25rem;
        }
    }

    /* Loading Animation */
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

    .welcome-banner,
    .stat-card,
    .orders-section {
        animation: fadeInUp 0.6s ease forwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
</style>

<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>

<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="banner-content">
        <div class="profile-avatar">
            <?php if($user->profile_image): ?>
                <img src="<?php echo e($user->profile_image_url); ?>" alt="Profile Image">
            <?php else: ?>
                <div class="profile-placeholder">
                    <?php echo e(substr($user->name, 0, 1)); ?>

                </div>
            <?php endif; ?>
        </div>
        <div class="welcome-text">
            <h1>Welcome back, <?php echo e($user->name); ?>!</h1>
            <p>Manage your orders and track your purchases with ease</p>
        </div>
    </div>
</div>

<!-- Quick Stats Section -->


<!-- My Orders Section -->
<div class="orders-section">
    <div class="section-title">My Orders</div>
    <div class="orders-grid">
        <a href="<?php echo e(route('user.unpaid.orders')); ?>" class="order-card">
            <div class="order-icon">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/bigmk_app_icon/unpaid-2.png" alt="Unpaid">
            </div>
            <div class="order-title">Unpaid</div>
            <div class="order-description">Orders awaiting payment</div>
        </a>
        
        <a href="<?php echo e(route('user.to.be.shipped')); ?>" class="order-card">
            <div class="order-icon">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/cb/to-be-shipped-25.png" alt="To be shipped">
            </div>
            <div class="order-title">To be shipped</div>
            <div class="order-description">Orders being prepared</div>
        </a>
        
        <a href="<?php echo e(route('user.shipped.orders')); ?>" class="order-card">
            <div class="order-icon">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/bigmk_app_icon/in-transit.png" alt="Shipped">
            </div>
            <div class="order-title">Shipped</div>
            <div class="order-description">Orders on the way</div>
        </a>
        
        <a href="<?php echo e(route('My-Reviews')); ?>" class="order-card">
            <div class="order-icon">
                <img src="https://icons.veryicon.com/png/128/miscellaneous/document-format/reviewed-5.png" alt="To be reviewed">
            </div>
            <div class="order-title">To be reviewed</div>
            <div class="order-description">Completed orders</div>
        </a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/user_dashboard/dashboard.blade.php ENDPATH**/ ?>