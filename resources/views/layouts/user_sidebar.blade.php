@extends('frontend.master')

@section('content')
<div class="main-wrapper">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    .dashboard-container {
        margin-left: 280px;
        padding: 20px 30px;
        min-height: calc(100vh - 200px);
        background-color: #f8f9fa;
        transition: margin-left 0.3s ease;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }
    
    /* Dashboard header adjustments */
    .dashboard-header {
        margin-top: 40px !important; /* Increased from 5px to 20px to add more space */
        margin-bottom: 15px !important;
        padding-top: 5px !important;
        padding-bottom: 10px !important;
        border-bottom: 1px solid #e0e0e0 !important;
    }

    /* Footer adjustments for sidebar layout */
    .footer-with-sidebar {
        margin-left: 280px;
        transition: margin-left 0.3s ease;
        position: relative;
        z-index: 998;
        width: calc(100% - 280px);
        box-sizing: border-box;
        clear: both;
        margin-top: auto;
        margin-bottom: 0;
        padding-bottom: 0;
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
        width: calc(100% - 280px);
        margin-left: 280px;
        clear: both;
        float: right;
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
        position: relative;
        z-index: 1;
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
        transition: all 0.3s ease, bottom 0.1s ease, height 0.1s ease;
        display: flex;
        flex-direction: column;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        z-index: 1050;
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
        
        /* Ensure sidebar responsiveness with footer interaction */
        .sidebar {
            height: 100vh !important; /* Always full height on mobile */
            bottom: 0 !important; /* Don't adjust position on mobile */
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

@if (!Auth::check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @php exit; @endphp
@endif
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
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        
        @if(Auth::user()->role == 'dealer')
        <a class="nav-link {{ request()->routeIs('dealer.dashboard') ? 'active' : '' }}" href="{{ route('dealer.dashboard') }}">
            <i class="fas fa-crown"></i> Dealer Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('dealer.analytics') ? 'active' : '' }}" href="{{ route('dealer.analytics') }}">
            <i class="fas fa-chart-bar"></i> Analytics
        </a>
        <a class="nav-link {{ request()->routeIs('dealer.team.full') ? 'active' : '' }}" href="{{ route('dealer.team.full') }}">
            <i class="fas fa-sitemap"></i> Team Hierarchy
        </a>
        <a class="nav-link {{ request()->routeIs('dealer.referrals.pending') ? 'active' : '' }}" href="{{ route('dealer.referrals.pending') }}">
            <i class="fas fa-user-plus"></i> Pending Referrals
        </a>
        <a class="nav-link {{ request()->routeIs('dealer.products.dashboard') ? 'active' : '' }}" href="{{ route('dealer.products.dashboard') }}">
            <i class="fas fa-box"></i> Products
        </a>
        <a class="nav-link {{ request()->routeIs('dealer.notifications') ? 'active' : '' }}" href="{{ route('dealer.notifications') }}">
            <i class="fas fa-bell"></i> Notifications
        </a>
        @endif

        <a class="nav-link {{ request()->routeIs('edit-profile') ? 'active' : '' }}" href="{{ route('edit-profile') }}">
            <i class="fas fa-user-edit"></i> Edit Profile
        </a>
        <a class="nav-link {{ request()->routeIs('my-orders') ? 'active' : '' }}" href="{{ route('my-orders') }}">
            <i class="fas fa-box"></i> My Orders
        </a>
        <a class="nav-link {{ request()->routeIs('My-Reviews') ? 'active' : '' }}" href="{{ route('My-Reviews') }}">
            <i class="fas fa-star"></i> My Reviews
        </a>
        <a class="nav-link {{ request()->routeIs('edit-password') ? 'active' : '' }}" href="{{ route('edit-password') }}">
            <i class="fas fa-key"></i> Password
        </a>

        <!-- Logout -->
        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-top: auto;">
            <i class="fas fa-sign-out-alt"></i> Log Out
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

<div class="dashboard-container">
    @yield('dashboard-content')
</div>
<!-- Ensure footer appears after content -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    // Apply footer styling to accommodate sidebar
    const footerElements = document.querySelectorAll('footer');
    footerElements.forEach(footer => {
        footer.classList.add('footer-with-sidebar');
    });
    
    // Also check for any footer that might be loaded later
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Element node
                    if (node.tagName === 'FOOTER') {
                        node.classList.add('footer-with-sidebar');
                    }
                    // Also check children
                    const footers = node.querySelectorAll && node.querySelectorAll('footer');
                    if (footers) {
                        footers.forEach(footer => footer.classList.add('footer-with-sidebar'));
                    }
                }
            });
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
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
    
    // Fix sidebar and footer overlap issue by creating a more robust solution
    function adjustSidebarPosition() {
        const footer = document.querySelector('footer');
        if (!footer) return;
        
        // Set sidebar to have overflow-y auto to enable scrolling within the sidebar
        sidebar.style.overflowY = 'auto';
        
        // Set the sidebar to take up the full height of the viewport
        sidebar.style.height = '100vh';
        
        // Make sure the footer is always positioned after the main content
        footer.style.position = 'relative';
        footer.style.zIndex = '999';
        
        // Check if we're on a dealer dashboard page
        const isDealerDashboard = window.location.href.includes('dealer');
        if (isDealerDashboard) {
            // Add dealer dashboard class to body
            document.body.classList.add('dealer-dashboard-page');
        } else {
            document.body.classList.remove('dealer-dashboard-page');
        }
        
        // Ensure the content container has enough space for content
        const dashboardContainer = document.querySelector('.dashboard-container');
        if (dashboardContainer) {
            dashboardContainer.style.minHeight = 'calc(100vh - 250px)';
        }
    }
    
    // Initial adjustment and listen for events
    adjustSidebarPosition();
    window.addEventListener('resize', adjustSidebarPosition);
    window.addEventListener('load', adjustSidebarPosition);
    
    // Check for path changes (for SPA-like behavior if any)
    let lastPath = window.location.pathname;
    setInterval(() => {
        if (window.location.pathname !== lastPath) {
            lastPath = window.location.pathname;
            adjustSidebarPosition();
        }
    }, 500);
});
</script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</div><!-- End of main-wrapper -->
@endsection
