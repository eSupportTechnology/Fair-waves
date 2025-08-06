<?php $__env->startSection('content'); ?>
<div class="main-wrapper">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    .dashboard-container {
        margin-left: 80px; /* Collapsed sidebar width */
        padding: 20px 30px;
        min-height: calc(100vh - 250px);
        background-color: #f8f9fa;
        transition: margin-left 0.3s ease;
        margin-bottom: 20px;
        position: relative;
        z-index: 15;
        width: calc(100% - 80px); /* Adjust for collapsed sidebar */
    }

    .dashboard-container.expanded {
        margin-left: 280px; /* Expanded sidebar width */
        width: calc(100% - 280px);
    }

    /* Dashboard header adjustments */
    .dashboard-header {
        margin-top: 40px !important;
        margin-bottom: 15px !important;
        padding-top: 5px !important;
        padding-bottom: 10px !important;
        border-bottom: 1px solid #e0e0e0 !important;
    }

    /* Footer adjustments for sidebar layout */
    .footer-with-sidebar {
        margin-left: 80px; /* Collapsed sidebar width */
        transition: margin-left 0.3s ease;
        position: relative;
        z-index: 20;
        width: calc(100% - 80px);
        background-color: #fff;
        margin-top: auto;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    }

    .footer-with-sidebar.expanded {
        margin-left: 280px; /* Expanded sidebar width */
        width: calc(100% - 280px);
    }

    /* Ensure footer content is properly spaced */
    .footer-with-sidebar .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Special handling for dealer dashboard pages to prevent overlap */
    body.dealer-dashboard-page .footer-with-sidebar {
        position: relative;
        width: calc(100% - 80px);
        margin-left: 80px;
        clear: both;
        float: right;
    }

    body.dealer-dashboard-page .footer-with-sidebar.expanded {
        width: calc(100% - 280px);
        margin-left: 280px;
    }

    /* Make sure footer content is readable */
    .footer-with-sidebar .footer-title,
    .footer-with-sidebar .contact-item,
    .footer-with-sidebar .footer-link {
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Specific styling for footer sections */
    .footer-with-sidebar .footer-widget {
        padding: 0 10px;
    }

    .footer-with-sidebar .footer-title {
        color: #ffffff !important;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: block;
    }

    .footer-with-sidebar .contact-item {
        display: flex !important;
        align-items: center;
        margin-bottom: 12px;
        color: #e2e8f0;
    }

    .footer-with-sidebar .contact-item i {
        margin-right: 10px;
        width: 20px;
        color: #ff5800;
    }

    /* Ensure proper body layout */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    /* Special handling for dealer dashboard body */
    body.dealer-dashboard-page {
        overflow-x: hidden; /* Prevent horizontal scrolling */
    }

    /* Wrapper for main content and footer */
    .main-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        position: relative;
        z-index: 1;
    }

    /* Sidebar styling - Collapsed by default */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 80px; /* Collapsed width */
        background: #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        z-index: 100;
        padding: 20px 0;
        overflow: hidden;
        transition: all 0.3s ease;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
    }

    /* Expanded sidebar */
    .sidebar.expanded {
        width: 280px; /* Expanded width */
        overflow-y: auto;
        padding: 20px 0;
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
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .sidebar-brand h5 {
        color: #ff3c00;
        font-weight: 700;
        margin: 0;
        font-size: 18px;
        white-space: nowrap;
        opacity: 0;
        transition: opacity 0.3s ease 0.1s;
    }

    .sidebar.expanded .sidebar-brand h5 {
        opacity: 1;
    }

    .sidebar-brand small {
        color: #6b7280;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        transition: opacity 0.3s ease 0.15s;
    }

    .sidebar.expanded .sidebar-brand small {
        opacity: 1;
    }

    /* Brand icon for collapsed state */
    .sidebar-brand::before {
        content: "FW";
        position: absolute;
        color: #ff3c00;
        font-weight: 700;
        font-size: 20px;
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .sidebar.expanded .sidebar-brand::before {
        opacity: 0;
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
        white-space: nowrap;
        position: relative;
        overflow: hidden;
    }

    .sidebar a i {
        margin-right: 12px;
        font-size: 18px;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
    }

    /* Hide text in collapsed state */
    .sidebar a .nav-text {
        opacity: 0;
        transition: opacity 0.3s ease 0.1s;
    }

    .sidebar.expanded a .nav-text {
        opacity: 1;
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

    /* Main wrapper adjustments */
    .main-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
        z-index: 200;
    }

    /* Hover zone for auto-expand */
    .sidebar-hover-zone {
        position: fixed;
        top: 0;
        left: 0;
        width: 100px; /* Slightly wider than collapsed sidebar */
        height: 100vh;
        z-index: 99;
        pointer-events: none;
    }

    /* Responsive Enhancements */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            bottom: 0;
            width: 280px; /* Full width on mobile */
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .dashboard-container {
            margin-left: 0;
            padding: 16px 12px;
            width: 100%;
        }

        /* Footer adjustments for mobile */
        .footer-with-sidebar {
            margin-left: 0;
            width: 100%;
        }

        .footer-with-sidebar .container {
            padding-left: 12px;
            padding-right: 12px;
        }

        /* Dealer dashboard footer adjustments for mobile */
        body.dealer-dashboard-page .footer-with-sidebar {
            margin-left: 0;
            width: 100%;
            float: none;
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

        /* Disable hover zone on mobile */
        .sidebar-hover-zone {
            display: none;
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
    .mobile-menu-toggle-2 {
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
        .mobile-menu-toggle-2 {
            display: block;
        }
    }

    /* Tooltip for collapsed state */
    .nav-tooltip {
        position: absolute;
        left: 90px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
        z-index: 1000;
    }

    .nav-tooltip::before {
        content: '';
        position: absolute;
        left: -5px;
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-right-color: rgba(0, 0, 0, 0.8);
    }

    .sidebar:not(.expanded) a:hover .nav-tooltip {
        opacity: 1;
    }

    @media (max-width: 991.98px) {
        .nav-tooltip {
            display: none;
        }
    }
</style>

<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">My Account</h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="/" class="gap-8 text-gray-900 flex-align hover-text-main-600">
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
<button class="mobile-menu-toggle-2" id="mobileMenuToggle" style="right: 15px; left: auto; top: 70px; padding: 6px 8px; font-size: 18px;">
    <i class="fas fa-bars fa-sm"></i>
</button>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Hover Zone for Auto-Expand -->
<div class="sidebar-hover-zone" id="sidebarHoverZone"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <h5><?php echo e($companySettings->title ?? 'Fair Waves'); ?></h5>
        <small>Dashboard</small>
    </div>

    <!-- Navigation -->
    <div class="nav flex-column">
        <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span class="nav-text">Dashboard</span>
            <div class="nav-tooltip">Dashboard</div>
        </a>

        <?php if(Auth::user()->role == 'dealer'): ?>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.dashboard')); ?>">
            <i class="fas fa-crown"></i>
            <span class="nav-text">Dealer Dashboard</span>
            <div class="nav-tooltip">Dealer Dashboard</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.analytics') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.analytics')); ?>">
            <i class="fas fa-chart-bar"></i>
            <span class="nav-text">Analytics</span>
            <div class="nav-tooltip">Analytics</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.team.full') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.team.full')); ?>">
            <i class="fas fa-sitemap"></i>
            <span class="nav-text">Team Hierarchy</span>
            <div class="nav-tooltip">Team Hierarchy</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.referrals.pending') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.referrals.pending')); ?>">
            <i class="fas fa-user-plus"></i>
            <span class="nav-text">Pending Referrals</span>
            <div class="nav-tooltip">Pending Referrals</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.products.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.products.dashboard')); ?>">
            <i class="fas fa-box"></i>
            <span class="nav-text">Products</span>
            <div class="nav-tooltip">Products</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.customer.orders') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.customer.orders')); ?>">
            <i class="fas fa-shopping-bag"></i>
            <span class="nav-text">Dealer's Orders</span>
            <div class="nav-tooltip">Dealer's Orders</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('dealer.notifications') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.notifications')); ?>">
            <i class="fas fa-bell"></i>
            <span class="nav-text">Notifications</span>
            <div class="nav-tooltip">Notifications</div>
        </a>
        <?php endif; ?>

        <a class="nav-link <?php echo e(request()->routeIs('edit-profile') ? 'active' : ''); ?>" href="<?php echo e(route('edit-profile')); ?>">
            <i class="fas fa-user-edit"></i>
            <span class="nav-text">Edit Profile & Bank Details</span>
            <div class="nav-tooltip">Edit Profile & Bank Details</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('cart') ? 'active' : ''); ?>" href="<?php echo e(route('cart')); ?>">
            <i class="fas fa-shopping-cart"></i>
            <span class="nav-text">My Cart</span>
            <div class="nav-tooltip">My Cart</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('my-orders') ? 'active' : ''); ?>" href="<?php echo e(route('my-orders')); ?>">
            <i class="fas fa-box"></i>
            <span class="nav-text">My Orders</span>
            <div class="nav-tooltip">My Orders</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('My-Reviews') ? 'active' : ''); ?>" href="<?php echo e(route('My-Reviews')); ?>">
            <i class="fas fa-star"></i>
            <span class="nav-text">My Reviews</span>
            <div class="nav-tooltip">My Reviews</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('addresses') ? 'active' : ''); ?>" href="<?php echo e(route('addresses')); ?>">
            <i class="fas fa-map-marker-alt"></i>
            <span class="nav-text">My Addresses</span>
            <div class="nav-tooltip">My Addresses</div>
        </a>
        <a class="nav-link <?php echo e(request()->routeIs('edit-password') ? 'active' : ''); ?>" href="<?php echo e(route('edit-password')); ?>">
            <i class="fas fa-key"></i>
            <span class="nav-text">Password</span>
            <div class="nav-tooltip">Password</div>
        </a>

        <!-- Logout -->
        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-top: auto;">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-text">Log Out</span>
            <div class="nav-tooltip">Log Out</div>
        </a>

        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </div>
</div>

<div class="dashboard-container" id="dashboardContainer">
    <?php echo $__env->yieldContent('dashboard-content'); ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarHoverZone = document.getElementById('sidebarHoverZone');
    const dashboardContainer = document.getElementById('dashboardContainer');

    let expandTimeout;
    let collapseTimeout;

    // Apply footer styling to accommodate sidebar
    function updateFooterPosition(expanded = false) {
        const footerElements = document.querySelectorAll('footer');
        footerElements.forEach(footer => {
            footer.classList.add('footer-with-sidebar');
            if (expanded) {
                footer.classList.add('expanded');
            } else {
                footer.classList.remove('expanded');
            }
        });
    }

    // Function to expand sidebar
    function expandSidebar() {
        clearTimeout(collapseTimeout);
        expandTimeout = setTimeout(() => {
            if (window.innerWidth > 991.98) { // Only on desktop
                sidebar.classList.add('expanded');
                dashboardContainer.classList.add('expanded');
                updateFooterPosition(true);
            }
        }, 100); // Small delay to prevent flickering if moving cursor quickly
    }

    // Function to collapse sidebar
    function collapseSidebar() {
        clearTimeout(expandTimeout);
        collapseTimeout = setTimeout(() => {
            if (window.innerWidth > 991.98) { // Only on desktop
                sidebar.classList.remove('expanded');
                dashboardContainer.classList.remove('expanded');
                updateFooterPosition(false);
            }
        }, 300); // Delay before collapsing
    }

    // Auto-expand/collapse functionality for desktop
    sidebar.addEventListener('mouseenter', expandSidebar);
    sidebar.addEventListener('mouseleave', collapseSidebar);

    // Also listen to the hover zone
    sidebarHoverZone.addEventListener('mouseenter', expandSidebar);
    sidebarHoverZone.addEventListener('mouseleave', collapseSidebar);

    // Initial footer setup
    updateFooterPosition(false);

    // Also check for any footer that might be loaded later
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Element node
                    if (node.tagName === 'FOOTER') {
                        node.classList.add('footer-with-sidebar');
                        if (sidebar.classList.contains('expanded')) {
                            node.classList.add('expanded');
                        }
                    }
                    // Also check children
                    const footers = node.querySelectorAll && node.querySelectorAll('footer');
                    if (footers) {
                        footers.forEach(footer => {
                            footer.classList.add('footer-with-sidebar');
                            if (sidebar.classList.contains('expanded')) {
                                footer.classList.add('expanded');
                            }
                        });
                    }
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Mobile menu functionality
    if (!window.sidebarToggleInitialized) {
    window.sidebarToggleInitialized = true;


    mobileMenuToggle.addEventListener('click', function () {
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('show');
    });
}


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
            // Reset to collapsed state on desktop
            sidebar.classList.remove('expanded');
            dashboardContainer.classList.remove('expanded');
            updateFooterPosition(false);
        } else {
            // On mobile, ensure sidebar is properly positioned
            sidebar.classList.remove('expanded');
            dashboardContainer.classList.remove('expanded');
        }
    });

    // Check if we're on a dealer dashboard page
    function checkDealerDashboard() {
        const isDealerDashboard = window.location.href.includes('dealer');
        if (isDealerDashboard) {
            document.body.classList.add('dealer-dashboard-page');
        } else {
            document.body.classList.remove('dealer-dashboard-page');
        }
    }

    // Initial check and path monitoring
    checkDealerDashboard();
    let lastPath = window.location.pathname;
    setInterval(() => {
        if (window.location.pathname !== lastPath) {
            lastPath = window.location.pathname;
            checkDealerDashboard();
        }
    }, 500);
});
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</div><!-- End of main-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/layouts/user_sidebar.blade.php ENDPATH**/ ?>