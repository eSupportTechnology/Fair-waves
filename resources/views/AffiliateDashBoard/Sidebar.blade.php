
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
            <div class="aside-top" style="padding:0">
                <a href="{{ route('affiliate') }}" class="brand-wrap">
                    <img src="{{ asset('frontend/assets/images/222.png') }}" class="logo" alt="DK-Mart" style="margin-left:80%;"/>
                </a>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <li class="menu-item {{ request()->routeIs('affiliate') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('affiliate') }}">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('ad_center') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('ad_center') }}">
                        <i class="icon material-icons md-campaign"></i>
                            <span class="text">Ad Center</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('tracking_id') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('tracking_id') }}">
                        <i class="icon material-icons md-track_changes"></i>
                            <span class="text">Tracking IDS</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('affiliatetools') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('affiliatetools') }}">
                        <i class="icon material-icons md-build"></i>
                            <span class="text">Tools</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('code_center') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('code_center') }}">
                        <i class="icon material-icons md-code"></i>
                            <span class="text">Code Centers</span>
                        </a>
                    </li>

                    <li class="menu-item has-submenu {{ request()->is('admin/products*') || request()->is('admin/add_products*') || request()->is('admin/categories*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                        <i class="icon material-icons md-assessment"></i>
                            <span class="text">Reports</span>
                        </a>
                        <div class="submenu {{ request()->is('traffic_report*') || request()->is('traffic_report*') || request()->is('admin/categories*') ? 'show' : '' }}">
                            <a href="{{ route('traffic_report') }}" class="{{ request()->is('admin/products') ? 'active' : '' }}">
                                Traffic Report
                            </a>
                            
                        </div>
                    </li>

                    <li class="menu-item has-submenu {{ request()->is('admin/manage_company*') || request()->is('admin/users*') || request()->is('admin/role_list*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                        <i class="icon material-icons md-payment"></i>
                            <span class="text">Payment</span>
                        </a>
                        <div class="submenu {{ request()->is('admin/manage_company*') || request()->is('admin/users*') || request()->is('admin/role_list*') ? 'show' : '' }}">
                            <a href="{{ route('withdrawals') }}" class="{{ request()->is('withdrawals') ? 'active' : '' }}">
                                Withdrawals
                            </a>
                            <a href="{{ route('payment_info') }}" class="{{ request()->is('payment_info') ? 'active' : '' }}">
                                Payment Information
                            </a>
                            <a href="{{ route('show_affiliate_rules') }}" class="{{ request()->is('show_affiliate_rules') ? 'active' : '' }}">
                                Commission Rules
                            </a>
                        </div>
                    </li>

                    <li class="menu-item has-submenu {{ request()->is('admin/manage_company*') || request()->is('admin/users*') || request()->is('admin/role_list*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                        <i class="icon material-icons md-account_circle"></i>
                            <span class="text">Account</span>
                        </a>
                        <div class="submenu {{ request()->is('mywebsites_page*') || request()->is('admin/users*') || request()->is('admin/role_list*') ? 'show' : '' }}">
                            <a href="{{ route('mywebsites_page') }}" class="{{ request()->is('mywebsites_page') ? 'active' : '' }}">
                                My Websites
                            </a>
                        </div>
                    </li>

                </ul>
                <hr />

                <br />
                <br />
            </nav>
        </aside>