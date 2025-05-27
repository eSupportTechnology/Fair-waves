
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
    <div class="aside-top" style="padding:0">
        <a href="{{ route('vendorhome') }}" class="brand-wrap">
            <img src="{{ asset('frontend/assets/images/logo/preloader-new1.png') }}" class="logo" alt="DK-Mart" style="margin-left:80%;"/>
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ request()->routeIs('vendorhome') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('vendorhome') }}">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('vendor.shop') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('vendor.shop') }}">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Shop</span>
                </a>
            </li>


            <!-- Products Menu -->
            <li class="menu-item has-submenu {{ request()->routeIs('vendor.products*') ? 'active' : '' }}">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Products</span>
                </a>
                <!-- Add "show" class dynamically for submenu -->
                <div class="submenu {{ request()->routeIs('vendor.products*') ? 'show' : '' }}">
                    <a href="{{ route('vendor.products') }}"
                        class="{{ request()->routeIs('vendor.products') ? 'active' : '' }}">
                        Product List
                    </a>
                    <a href="{{ route('vendor.products.add') }}"
                        class="{{ request()->routeIs('vendor.products.add') ? 'active' : '' }}">
                        Add Product
                    </a>
                </div>
            </li>

            <li class="menu-item {{ request()->routeIs('vendor.orders') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('vendor.orders') }}">
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

                    <a href="{{ route('vendorProductReport') }}">
                        Products
                    </a>
                    <a href="{{ route('vendorOrderReport') }}">
                        Orders
                    </a>
                </div>
            </li>

            <li class="menu-item {{ request()->routeIs('vendor.wallet') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('vendor.wallet') }}">
                <i class="icon fas fa-wallet ms-1" style="font-size:18px;"></i>
                    <span class="text ms-1">Wallet</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('vendor.payments') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('vendor.payments') }}">
                <i class="icon material-icons md-payment"></i>
                    <span class="text">Payments</span>
                </a>
            </li>

        </ul>

        <hr />

        <br />
        <br />
    </nav>
</aside>