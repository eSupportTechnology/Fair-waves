<?php $__env->startSection('content'); ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    .dashboard-container {
        padding: 30px 55px;
        margin: 0 auto;
        max-width: 1400px;
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
        position: sticky;
        top: 20px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        height: 85vh;
        padding: 20px 10px;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .sidebar .nav {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        flex-grow: 1;
        margin: 0;
    }

    .sidebar a {
        color: #2d3748;
        font-size: 16px;
        font-weight: 500;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        border-radius: 6px;
        margin-bottom: 6px;
        transition: all 0.2s ease-in-out;
        border-bottom: none;
        text-align: left;
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
        transform: translateX(4px);
    }

    .sidebar .nav-link.active {
        background-color: #fef2f2;
        color: #ff3c00;
        border-left: 4px solid #ff3c00;
        font-weight: 600;
        padding-left: 12px;
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
        border-radius: 8px;
        min-height: 85vh;
        padding: 30px;
    }

    .btn.btn-sm.d-md-none {
        margin-bottom: 16px;
        font-size: 16px;
    }

    /* Responsive Enhancements */
    @media (max-width: 991.98px) {
        .dashboard-container {
            padding: 16px 8px;
            max-width: 100%;
        }

        .sidebar {
            position: static;
            height: auto;
            box-shadow: none;
            border-radius: 0;
            padding: 10px 0;
            border: none;
        }

        .card1 {
            min-height: unset;
            padding: 16px 8px;
        }

        .breadcrumb-wrapper {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }

    @media (max-width: 575.98px) {
        .dashboard-container {
            padding: 8px 2px;
        }

        .sidebar a {
            font-size: 15px;
            padding: 10px 8px;
        }

        .sidebar .nav-link.active {
            padding-left: 8px;
        }

        .card1 {
            padding: 8px 2px;
        }
    }

    .sidebar .nav {
        gap: 2px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>


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

<div class="container-fluid dashboard-container" style="padding: 30px 55px;margin-top: 50px">
    <div class="row">
        <!-- Sidebar toggle button for mobile -->
        <div class="col-12 d-md-none mb-2">
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarDrawer" aria-controls="sidebarDrawer" style="background-color:rgba(0, 0, 0, 0.47); border-color:rgb(0, 0, 0);">
                <i class="fas fa-bars fa-lg"></i> Menu
            </button>
        </div>


        <div class="col-md-4 col-lg-3 mb-3 mb-md-0">
            <div id="sidebarMenu" class="sidebar collapse d-md-block">
                <div class="offcanvas-body">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <?php if(Auth::user()->role== 'dealer'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('dealer.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.dashboard')); ?>"><i class="fas fa-tachometer"></i>Dealer Dashboard</a>
                        </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('edit-profile') ? 'active' : ''); ?>" href="<?php echo e(route('edit-profile')); ?>"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('my-orders') ? 'active' : ''); ?>" href="<?php echo e(route('my-orders')); ?>"><i class="fas fa-box"></i> My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('My-Reviews') ? 'active' : ''); ?>" href="<?php echo e(route('My-Reviews')); ?>"><i class="fas fa-star"></i> My Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('edit-password') ? 'active' : ''); ?>" href="<?php echo e(route('edit-password')); ?>"><i class="fas fa-key"></i> Password</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Log Out
                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>




        <!-- Main content -->
        <div class="col-md-8 col-lg-9">
            <div class="card1">
                <div class="card-body card-container">
                    <?php echo $__env->yieldContent('dashboard-content'); ?>
                </div>
            </div>
            </main>
        </div>
    </div>
    <div class="offcanvas offcanvas-start d-md-none"
        tabindex="-1"
        id="sidebarDrawer"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        aria-labelledby="sidebarDrawerLabel" style="padding-top: 5rem ;margin-top:5rem;">
        <div class="offcanvas-header" style="padding-right: 1rem;">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                </li>
                <?php if(Auth::check() && Auth::user()->role === 'dealer'): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e(request()->routeIs('dealer.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dealer.dashboard')); ?>">Dealer Dashboard</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('edit-profile') ? 'active' : ''); ?>" href="<?php echo e(route('edit-profile')); ?>">Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('my-orders') ? 'active' : ''); ?>" href="<?php echo e(route('my-orders')); ?>">My Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('My-Reviews') ? 'active' : ''); ?>" href="<?php echo e(route('My-Reviews')); ?>">My Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('edit-password') ? 'active' : ''); ?>" href="<?php echo e(route('edit-password')); ?>">Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>


            </ul>
        </div>
    </div>
</div>
<script>
    document.addEventListener('hidden.bs.offcanvas', function() {
        const backdrop = document.querySelector('.offcanvas-backdrop');
        if (backdrop) backdrop.remove();
        document.body.classList.remove('offcanvas-backdrop');
        document.body.style.overflow = '';
    });
</script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/layouts/user_sidebar.blade.php ENDPATH**/ ?>