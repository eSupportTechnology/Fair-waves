<?php $__env->startSection('content'); ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    .dashboard-container {
        margin-left: 280px;
        padding: 20px 30px;
        min-height: 100vh;
        background-color: #f8f9fa;
        transition: margin-left 0.3s ease;
    }

    .breadcrumb {
        padding: 26px 0;
        background-color: #f8f9fa;
        margin-bottom: 0;
    }

    .breadcrumb-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .breadcrumb h6 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .breadcrumb ul {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .breadcrumb ul li {
        font-size: 14px;
    }

    .breadcrumb a {
        color: #2d3748;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: #ff3c00;
    }

    .sidebar {
        background-color: #ffffff;
        color: #1a1a1a;
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
        border-right: 1px solid #e5e7eb;
        padding: 20px 0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        z-index: 1000;
    }

    .sidebar .nav {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        flex-grow: 1;
        margin: 0;
        padding: 0 0 20px 0;
    }

    .sidebar-brand {
        padding: 20px 20px 30px 20px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
        text-align: center;
    }

    .sidebar-brand h5 {
        color: #ff3c00;
        font-weight: 700;
        margin: 0;
        font-size: 18px;
    }

    .sidebar-brand small {
        color: #6b7280;
        font-size: 12px;
    }

    .sidebar a {
        color: #2d3748;
        font-size: 15px;
        font-weight: 500;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        border-radius: 8px;
        margin: 2px 10px;
        transition: all 0.2s ease-in-out;
        border-bottom: none;
        text-align: left;
        text-decoration: none;
    }

    .sidebar a i {
        margin-right: 12px;
        font-size: 18px;
        width: 24px;
        text-align: center;
    }

    .sidebar a:hover {
        background-color: #f1f5f9;
        color: #ff3c00;
        transform: translateX(3px);
    }

    .sidebar .nav-link.active {
        background-color: #ff3c00;
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(255, 60, 0, 0.3);
    }

    .sidebar .nav-item {
        margin-bottom: 0;
        width: 100%;
    }

    .sidebar .nav-item .text-danger {
        color: #dc2626 !important;
        font-weight: 600;
    }

    .sidebar .nav-item .text-danger i {
        color: #dc2626 !important;
    }

    .sidebar .nav-item .text-danger:hover {
        background-color: #fef2f2;
        color: #b91c1c !important;
    }

    .sidebar .nav-item .text-danger:hover i {
        color: #b91c1c !important;
    }

    main {
        width: 100%;
    }

    .card1 {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        background-color: #ffffff;
        border-radius: 12px;
        min-height: calc(100vh - 120px);
        padding: 25px;
        margin-bottom: 20px;
    }

    .btn.btn-sm.d-md-none {
        margin-bottom: 16px;
        font-size: 16px;
    }

    /* Responsive Enhancements */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            z-index: 1050;
        }
        
        .sidebar.show {
            transform: translateX(0);
        }
        
        .dashboard-container {
            margin-left: 0;
            padding: 16px 12px;
        }

        .card1 {
            min-height: unset;
            padding: 20px 16px;
        }

        .breadcrumb-wrapper {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }

    @media (max-width: 575.98px) {
        .dashboard-container {
            padding: 8px 6px;
        }

        .sidebar a {
            font-size: 14px;
            padding: 12px 16px;
        }

        .card1 {
            padding: 16px 12px;
        }
    }

    /* Add mobile overlay */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* Mobile menu toggle */
    .mobile-menu-toggle {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1060;
        background: #ff3c00;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        display: none;
    }

    @media (max-width: 991.98px) {
        .mobile-menu-toggle {
            display: block;
        }
    }
</style>

<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>
<!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">My Account</h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="index.html" class="gap-8 text-gray-900 flex-align hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> My Account </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- Mobile Menu Toggle -->
<button class="mobile-menu-toggle" id="mobileMenuToggle">
    <i class="fas fa-bars fa-lg"></i>
</button>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <h5>Fair Waves</h5>
        <small>Dashboard</small>
    </div>
    
    <!-- Navigation -->
    <div class="nav flex-column">
        <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        
        <?php if(Auth::user()->role == 'dealer'): ?>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.dashboard')); ?>">
            <i class="fas fa-crown"></i> Dealer Dashboard
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.analytics') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.analytics')); ?>">
            <i class="fas fa-chart-bar"></i> Analytics
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.team.full') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.team.full')); ?>">
            <i class="fas fa-sitemap"></i> Team Hierarchy
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.referrals.pending') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.referrals.pending')); ?>">
            <i class="fas fa-user-plus"></i> Pending Referrals
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.products.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.products.dashboard')); ?>">
            <i class="fas fa-box"></i> Products
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.notifications') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.notifications')); ?>">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <?php endif; ?>

        <a class="nav-link <?php echo e(request()->routeIs('edit-profile') ? 'active' : ''); ?>" href="<?php echo e(route('edit-profile')); ?>">
            <i class="fas fa-user-edit"></i> Edit Profile
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('my-orders') ? 'active' : ''); ?>" href="<?php echo e(route('my-orders')); ?>">
            <i class="fas fa-box"></i> My Orders
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('My-Reviews') ? 'active' : ''); ?>" href="<?php echo e(route('My-Reviews')); ?>">
            <i class="fas fa-star"></i> My Reviews
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('edit-password') ? 'active' : ''); ?>" href="<?php echo e(route('edit-password')); ?>">
            <i class="fas fa-key"></i> Password
        </a>

        <!-- Logout -->
        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-top: auto;">
            <i class="fas fa-sign-out-alt"></i> Log Out
        </a>

        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </div>
</div>

<div class="dashboard-container">
    <?php echo $__env->yieldContent('dashboard-content'); ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    // Toggle mobile menu
    mobileMenuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('show');
    });
    
    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 991.98 && 
            !sidebar.contains(event.target) && 
            !mobileMenuToggle.contains(event.target)) {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991.98) {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        }
    });
});
</script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/layouts/user_sidebar.blade.php ENDPATH**/ ?>