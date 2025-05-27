<?php $__env->startSection('content'); ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<style>
    .nav-link.active {
        border-left: 3px solid #ff3c00; 
        padding-left: 10px; 
    }
    .sidebar {
        background-color: #f8f9fa;
        padding: 15px;
    }
 

/* sidebar*/
.dashboard-container {
    padding-top: 30px;
    margin-right: 55px;
    margin-left: 55px;
    margin-bottom:55px ;

}

.sidebar {
    background-color: white;
    color: black;
    position: sticky;
    top: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    border: 1px solid #e0e0e0;
    height: 85vh; 
    
}

.sidebar a {
    color: black;
    border-bottom: 1px solid #e0e0e0; 
    padding: 12px;
    display: block;
}
.sidebar a:hover {
    background-color: #e8ecf0;
    color: black;
}
.sidebar .nav-item {
    padding: 5px; 
}
.sidebar .nav-link.active {
    background-color: #e8ecf0;
}
.card-container {
    padding: 30px;
   
}
.card1 {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    border: 1px solid #e0e0e0; 
    background-color: white;
    height: auto;
    min-height:85vh;
    
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

    <div class="row dashboard-container">
        <!-- Sidebar toggle button -->
        <div class="d-flex justify-content-start">
            <button class="mb-3 btn btn-sm d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars fa-lg"></i>
            </button>
        </div>

        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: white;">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="mt-2 nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    </li>
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
                        <a class="nav-link text-danger" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="px-4 col-md-9 ms-sm-auto col-lg-10">
            <div class="card1">
                <div class="card-body card-container">
                    <?php echo $__env->yieldContent('dashboard-content'); ?>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/layouts/user_sidebar.blade.php ENDPATH**/ ?>