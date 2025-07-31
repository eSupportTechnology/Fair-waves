
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
            <div class="aside-top" style="padding:0">
                <a href="<?php echo e(route('admin.index')); ?>" class="brand-wrap">
                    <?php
                        $companySettings = \App\Models\CompanySettings::first();
                    ?>

                    <?php if($companySettings && $companySettings->logo): ?>
                        <img src="<?php echo e(asset('frontend/newstyle/assets/images/logo.png')); ?>" class="logo" alt="DK-Mart" style="margin-left:80%; width:80%;"/>
                    <?php else: ?>
                        <img src="<?php echo e(asset('frontend/newstyle/assets/images/logo.png')); ?>" class="logo" alt="DK-Mart" style="margin-left:80%; width:80%;"/>
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
                            <a href="<?php echo e(route('brand_list')); ?>" class="<?php echo e(request()->is('admin/brands') ? 'active' : ''); ?>">
                                Brands
                            </a>
                            <a href="<?php echo e(route('fees.index')); ?>" class="<?php echo e(request()->is('fees.index') ? 'active' : ''); ?>">
                                Delivery Fee
                            </a>
                        </div>
                    </li>
                    <li class="menu-item <?php echo e(request()->routeIs('customers') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('customers')); ?>">
                        <i class="icon material-icons md-group"></i>
                            <span class="text">Customers</span>
                        </a>
                    </li>

                    <li class="menu-item <?php echo e(request()->routeIs('dealers') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('dealers')); ?>">
                        <i class="icon material-icons md-person_pin_circle"></i>
                            <span class="text">Dealers</span>
                        </a>
                    </li>

                    <li class="menu-item <?php echo e(request()->routeIs('admin.genealogy') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('admin.genealogy')); ?>">
                        <i class="icon material-icons md-account_tree"></i>
                            <span class="text">Genealogy</span>
                        </a>
                    </li>

                    <!--li class="menu-item has-submenu { request()->is('admin/affiliate*') || request()->is('admin/affiliate_rules*') || request()->is('admin/affiliate_withdrawals*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-share"></i>
                            <span class="text">Affiliate</span>
                        </a>
                        <div class="submenu { request()->is('admin/affiliate*') || request()->is('admin/affiliate_rules*') || request()->is('admin/affiliate_withdrawals*') ? 'show' : '' }}">
                            <a href="{ route('affiliate_customers') }}" class="{ request()->is('admin/affiliate_customers') ? 'active' : '' }}">
                            Affiliate Customers
                            </a>
                            <!--<a href="{ route('affiliate_rules') }}" class="{ request()->is('admin/affiliate_rules') ? 'active' : '' }}">
                            Affiliate Rules
                            </a>
                            <a href="{ route('affiliate_withdrawals') }}" class="{ request()->is('admin/affiliate_withdrawals') ? 'active' : '' }}">
                            Affiliate Withdrawals
                            </a>-->
                        <!--/div>
                    </li-->
                    <li class="menu-item <?php echo e(request()->routeIs('orders') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('orders')); ?>">
                        <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Orders</span>
                        </a>
                    </li>


                    <!--<li class="menu-item has-submenu <?php echo e(request()->is('admin/vendors*') || request()->is('admin/payments*') ? 'active' : ''); ?>">
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
                    </li>-->

                    <li class="menu-item has-submenu <?php echo e(request()->is('admin/withdrawals/pending*') || request()->is('admin/withdrawals/approved*') || request()->is('admin/withdrawals/rejected*') ? 'active' : ''); ?>">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-money"></i>
                            <span class="text">Withdrawal</span>
                        </a>
                        <div class="submenu <?php echo e(request()->is('admin/withdrawals/pending*') || request()->is('admin/withdrawals/approved*') || request()->is('admin/withdrawals/rejected*') ? 'admin.withdrawals.pending' : ''); ?>">
                            <a href="<?php echo e(route('admin.withdrawals.pending')); ?>" class="<?php echo e(request()->is('admin/withdrawals/pending') ? 'active' : ''); ?>">
                                Pending
                            </a>
                            <a href="<?php echo e(route('admin.withdrawals.approved')); ?>" class="<?php echo e(request()->is('admin/withdrawals/approved') ? 'active' : ''); ?>">
                                Approved
                            </a>
                            <a href="<?php echo e(route('admin.withdrawals.rejected')); ?>" class="<?php echo e(request()->is('admin/withdrawals/rejected') ? 'active' : ''); ?>">
                                Rejected
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
                            <a href="<?php echo e(route('dealerReport')); ?>" >
                                Dealers
                            </a>
                            <a href="<?php echo e(route('productReport')); ?>" >
                                Products
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

                            <a href="<?php echo e(route('slider')); ?>">
                                Slider images
                            </a>

                            <a href="<?php echo e(route('banners')); ?>">
                                Banner images
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
        </aside>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/Sidebar.blade.php ENDPATH**/ ?>