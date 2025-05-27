
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
    <div class="aside-top" style="padding:0">
        <a href="<?php echo e(route('vendorhome')); ?>" class="brand-wrap">
            <img src="<?php echo e(asset('frontend/assets/images/logo/preloader-new1.png')); ?>" class="logo" alt="DK-Mart" style="margin-left:80%;"/>
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item <?php echo e(request()->routeIs('vendorhome') ? 'active' : ''); ?>">
                <a class="menu-link" href="<?php echo e(route('vendorhome')); ?>">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item <?php echo e(request()->routeIs('vendor.shop') ? 'active' : ''); ?>">
                <a class="menu-link" href="<?php echo e(route('vendor.shop')); ?>">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Shop</span>
                </a>
            </li>


            <!-- Products Menu -->
            <li class="menu-item has-submenu <?php echo e(request()->routeIs('vendor.products*') ? 'active' : ''); ?>">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Products</span>
                </a>
                <!-- Add "show" class dynamically for submenu -->
                <div class="submenu <?php echo e(request()->routeIs('vendor.products*') ? 'show' : ''); ?>">
                    <a href="<?php echo e(route('vendor.products')); ?>"
                        class="<?php echo e(request()->routeIs('vendor.products') ? 'active' : ''); ?>">
                        Product List
                    </a>
                    <a href="<?php echo e(route('vendor.products.add')); ?>"
                        class="<?php echo e(request()->routeIs('vendor.products.add') ? 'active' : ''); ?>">
                        Add Product
                    </a>
                </div>
            </li>

            <li class="menu-item <?php echo e(request()->routeIs('vendor.orders') ? 'active' : ''); ?>">
                <a class="menu-link" href="<?php echo e(route('vendor.orders')); ?>">
                    <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Orders</span>
                </a>
            </li>
            <li class="menu-item has-submenu ">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-description"></i>
                    <span class="text">Reports</span>
                </a>
                <div class="submenu ">

                    <a href="<?php echo e(route('vendorProductReport')); ?>">
                        Products
                    </a>
                    <a href="<?php echo e(route('vendorOrderReport')); ?>">
                        Orders
                    </a>
                </div>
            </li>

            <li class="menu-item <?php echo e(request()->routeIs('vendor.wallet') ? 'active' : ''); ?>">
                <a class="menu-link" href="<?php echo e(route('vendor.wallet')); ?>">
                <i class="icon fas fa-wallet ms-1" style="font-size:18px;"></i>
                    <span class="text ms-1">Wallet</span>
                </a>
            </li>

            <li class="menu-item <?php echo e(request()->routeIs('vendor.payments') ? 'active' : ''); ?>">
                <a class="menu-link" href="<?php echo e(route('vendor.payments')); ?>">
                <i class="icon material-icons md-payment"></i>
                    <span class="text">Payments</span>
                </a>
            </li>

        </ul>

        <hr />

        <br />
        <br />
    </nav>
</aside><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/VendorDashboard/VendorSidebar.blade.php ENDPATH**/ ?>