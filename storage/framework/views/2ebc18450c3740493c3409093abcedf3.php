
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
            <div class="aside-top" style="padding:0">
                <a href="<?php echo e(route('admin.index')); ?>" class="brand-wrap">
                    <?php
                        $companySettings = \App\Models\CompanySettings::first(); 
                    ?>

                    <?php if($companySettings && $companySettings->logo): ?>
                        <img src="<?php echo e(asset($companySettings->logo)); ?>" class="logo" alt="DK-Mart" style="margin-left:80%;"/>
                    <?php else: ?>
                        <img src="<?php echo e(asset('frontend/assets/images/logo/preloader-new1.png')); ?>" class="logo" alt="DK-Mart" style="margin-left:80%;"/>
                    <?php endif; ?>
                </a>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <li class="menu-item <?php echo e(request()->routeIs('admin.index') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('admin.index')); ?>">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item has-submenu <?php echo e(request()->is('admin/products*') || request()->is('admin/add_products*') || request()->is('admin/categories*') ? 'active' : ''); ?>">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-shopping_bag"></i>
                            <span class="text">Products</span>
                        </a>
                        <div class="submenu <?php echo e(request()->is('admin/products*') || request()->is('admin/add_products*') || request()->is('admin/categories*') ? 'show' : ''); ?>">
                            <a href="<?php echo e(route('products_list')); ?>" class="<?php echo e(request()->is('admin/products') ? 'active' : ''); ?>">
                                Product List
                            </a>
                            <a href="<?php echo e(route('categories')); ?>" class="<?php echo e(request()->is('admin/categories') ? 'active' : ''); ?>">
                                Categories
                            </a>
                        </div>
                    </li>
                    <li class="menu-item <?php echo e(request()->routeIs('customers') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('customers')); ?>">
                        <i class="icon material-icons md-group"></i>
                            <span class="text">Customers</span>
                        </a>
                    </li>

                    <li class="menu-item has-submenu <?php echo e(request()->is('admin/affiliate*') || request()->is('admin/affiliate_rules*') || request()->is('admin/affiliate_withdrawals*') ? 'active' : ''); ?>">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-share"></i>
                            <span class="text">Affiliate</span>
                        </a>
                        <div class="submenu <?php echo e(request()->is('admin/affiliate*') || request()->is('admin/affiliate_rules*') || request()->is('admin/affiliate_withdrawals*') ? 'show' : ''); ?>">
                            <a href="<?php echo e(route('affiliate_customers')); ?>" class="<?php echo e(request()->is('admin/affiliate_customers') ? 'active' : ''); ?>">
                            Affiliate Customers
                            </a>
                            <a href="<?php echo e(route('affiliate_rules')); ?>" class="<?php echo e(request()->is('admin/affiliate_rules') ? 'active' : ''); ?>">
                            Affiliate Rules
                            </a>
                            <a href="<?php echo e(route('affiliate_withdrawals')); ?>" class="<?php echo e(request()->is('admin/affiliate_withdrawals') ? 'active' : ''); ?>">
                            Affiliate Withdrawals
                            </a>
                        </div>
                    </li>
                    <li class="menu-item <?php echo e(request()->routeIs('orders') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('orders')); ?>">
                        <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Orders</span>
                        </a>
                    </li>
                 

                    <li class="menu-item has-submenu <?php echo e(request()->is('admin/vendors*') || request()->is('admin/payments*') ? 'active' : ''); ?>">
                        <a class="menu-link" href="#">
                        <i class="icon material-icons md-store"></i>
                            <span class="text">Vendors</span>
                        </a>
                        <div class="submenu <?php echo e(request()->is('admin/vendors*') || request()->is('admin/payments*') ? 'show' : ''); ?>">
                            <a href="<?php echo e(route('vendors')); ?>" class="<?php echo e(request()->is('admin/vendors') ? 'active' : ''); ?>">
                            Vendors
                            </a>
                            <a href="<?php echo e(route('admin.vendor.payments')); ?>" class="<?php echo e(request()->is('admin/payments') ? 'active' : ''); ?>">
                            Payment Requests
                            </a>
                        </div>
                    </li>

                    <li class="menu-item <?php echo e(request()->routeIs('adminReviews') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('adminReviews')); ?>">

                        <i class="icon material-icons md-comment"></i>
                            <span class="text">Reviews</span>
                        </a>
                    </li>

                    <li class="menu-item has-submenu ">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-description"></i>
                            <span class="text">Reports</span>
                        </a>
                        <div class="submenu ">
                            <a href="<?php echo e(route('customerReport')); ?>" >
                                Customers
                            </a>
                            <a href="<?php echo e(route('productReport')); ?>" >
                                Products 
                            </a>
                            <a href="<?php echo e(route('affiliateCustomerReport')); ?>" >
                                Affiliate Customer 
                            </a>
                            <a href="<?php echo e(route('affiliateCusBankData')); ?>" >
                                Affiliate Bank Details 
                            </a>
                            <a href="<?php echo e(route('vendorReport')); ?>" >
                                Vendors 
                            </a>
                            <a href="<?php echo e(route('orderReport')); ?>" >
                                Orders 
                            </a>
                        </div>
                    </li>

                    <li class="menu-item has-submenu ">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-settings"></i>
                            <span class="text">Settings</span>
                        </a>
                        <div class="submenu ">
                            <a href="<?php echo e(route('admin.customer.inquiries')); ?>" >
                                Inquiries
                            </a>
                            <a href="<?php echo e(route('manage_company_profile')); ?>" >
                                Manage Company
                            </a>
                            <a href="<?php echo e(route('users')); ?>" >
                                Users
                            </a>
                           <!-- <a href="<?php echo e(route('role_list')); ?>" >
                                Role List
                            </a>-->
                            
                        </div>
                    </li>
                    

                </ul>
                <hr />

                <br />
                <br />
            </nav>
        </aside><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/AdminDashboard/Sidebar.blade.php ENDPATH**/ ?>