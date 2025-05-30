<style>
    /* Hide elements with the class .mobhide on screens smaller than or equal to 768px */
    @media (max-width: 1000px) {
        .mobhide {
            display: none !important;
            /* Add !important if you want to override other styles */
        }
    }

    @media (min-width: 1000px) {
        .mobshow {
            display: none !important;
            /* Hides .mobshow on screens 768px or wider */
        }
    }
</style>

<body>








    <div id="app">

        <div class="main-container-wrapper">



            <div id="notification_banner"></div>







            <!-- mobile hearder begin -->
            <!-- top banner mobile-->
            <div class="mobi-main-header fixed-header">
                <div id="topupbar_banner_mobile"></div>
                <header class="header mobile-header ">
                    <div class="container mobile-header-container">
                        <div class="mobi-full-row">
                            <div class="col-5-5">
                                <div class="d-flex">
                                    <div class="header-left me-2">
                                        <a href="#" class="mobile-menu-toggle new-mobile-toggle"
                                            onclick="if (!window.__cfRLUnblockHandlers) return false;  openMenuMobi()"
                                            data-cf-modified-a071cb3ff60724c4b8f55cf9-="">
                                            <img class="mobi-menu-icon"
                                                src="{{ asset('frontend/newstyle/assets/images/menuLOGO-mbo.png') }}">



                                        </a>
                                    </div>

                                    <div class="mobi-logo"><a href="/"><img
                                                src="{{ asset('frontend/newstyle/assets/images/logo.png') }}"
                                                alt="logo" />
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="col-2-5">
                        <div class="mobi-header-btn mobi-search-btn">
                            <img class="cart-icon"
                                src="frontend/newstyle/assets/images/icon/mobi-search.png">
                        </div>
                    </div> -->


                            <!-- Header Middle Right start -->
                            <div class="header-right flex-align d-lg-block d-none">
                                <div class="flex-wrap gap-32 header-two-activities flex-align">
                                    <button type="button"
                                        class="gap-4 flex-align search-icon d-lg-none d-flex item-hover-two">
                                        <span class="text-2xl text-white d-flex position-relative item-hover__text">
                                            <i class="ph ph-magnifying-glass"></i>
                                        </span>
                                    </button>





                                    <a href="javascript:void(0)"
                                        class="gap-8 ml-10 flex-align flex-column item-hover-two"
                                        style="margin-right:30px;">
                                        <span
                                            class="mt-6 text-2xl text-white d-flex position-relative me-6 item-hover__text">
                                            <i class="ph ph-shopping-cart-simple"></i>
                                            <!-- Display the cart count dynamically -->
                                            <span id="cart-count-1"
                                                class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">
                                                {{ $cartCount ?? 0 }}

                                            </span>
                                        </span>
                                        <span class="text-white text-md item-hover__text d-none d-lg-flex">Cart</span>
                                    </a>




                                </div>
                            </div>














                            <div class="col-2-5">
                                <div class="header-right-con">
                                    <div class="top-right-nav">


                                        <!-- Profile Dropdown -->

                                        <div class="profile-dropdown">
                                            @auth





                                                <div class="log-user-img dropdown col-2-5">
                                                    <a href="#"><img
                                                            src="https://buyabans.com/themes/buyabans/assets/images/icon/dummy-user.png"></a>
                                                    <div class="dropdown-box">
                                                        <div class="user-name">
                                                            Hi!
                                                            {{ auth()->user()->name }}
                                                        </div>
                                                        <ul class="log-popup-links">
                                                            <li>
                                                                <a href="/profile">
                                                                    <img
                                                                        src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/user.png">My
                                                                    Account
                                                                </a>
                                                            </li>



                                                            <li>
                                                                <a>
                                                                    <img
                                                                        src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/turn-off.png">
                                                                    <form method="POST" action="{{ route('logout') }}">


                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="dropdown-item w-100">Logout</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>








                                                <div class="dropdown-box">

                                                    <ul class="log-popup-links">
                                                        <li>
                                                            <a href="{{ route('dashboard') }}">
                                                                <img
                                                                    src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/user.png">My
                                                                Account
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a>
                                                                <img
                                                                    src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/turn-off.png">
                                                                <form method="POST" action="{{ route('logout') }}">


                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="dropdown-item w-100">Logout</button>
                                                                </form>
                                                            </a>
                                                        </li>



                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Default Profile Icon and Links for Guests -->
                                    <div class="sign-up d-inline-flex">
                                        <div class= "mobhide">
                                            <a href="{{ route('login') }}" class="d-flex">
                                                <div class="dt-icon-div"><img
                                                        src=" {{ asset('frontend/newstyle/assets/images/account-icon.png') }} ">
                                                </div>
                                                <div>Login</div>
                                            </a>
                                        </div>

                                        <div class="boder-right"></div>

                                        <div class= "mobhide">
                                            <a class="sign-up-link" href="{{ route('register') }}"><span>Sign
                                                    Up</span></a>
                                        </div>
                                    </div>

                                    <div class= "mobshow">
                                        <a href="{{ route('login') }}" class="d-flex">
                                            <div class="dt-icon-div">
                                                <img src=" {{ asset('frontend/newstyle/assets/images/account-icon.png') }} "
                                                    style="padding-bottom: 17px;">
                                            </div>



                                        </a>
                                    </div>



                                </div>


                            @endauth





                            <div class="des-cart pos-relative cart-popup ">
                                <a href="javascript:void(0)" class="gap-8 ml-10 flex-align flex-column item-hover-two"
                                    style="margin-right:30px;">
                                    <span
                                        class="mt-6 text-2xl text-white2 d-flex position-relative me-6 item-hover__text">
                                        <i class="ph ph-shopping-cart-simple"></i>
                                        <!-- Display the cart count dynamically -->
                                        <span id="cart-count-2"
                                            class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">
                                            {{ $cartCount ?? 0 }}

                                        </span>
                                    </span>

                                    <span class="text-white2 text-md item-hover__text d-none d-lg-flex">Cart</span>
                                </a>

                            </div>




                        </div>
                    </div>


            </div>
        </div>


        </header>

    </div>


    <!-- destop header begin -->

    <div class="desmain-header">
        <div class="page-loader" hidden>
            <img src="{{ asset('frontend/newstyle/assets/images/loader.gif') }}" style="display:block">

        </div>
        <div class="fixed-header">
            <div class="destop-affix ">
                <div class="destop-header">
                    <div id="topupbar_banner_desktop"></div>

                    <!-- top banner mobile-->
                    <div class="site-common-con header-search">
                        <div class="destop-main-header">
                            <div class="des-logo">
                                <a href="/"><img src="{{ asset('frontend/newstyle/assets/images/logo.png') }}">
                                </a>
                            </div>

                            <div class="search-con search-container">
                                <div class="top-search search-container">
                                    <input type="text" class="form-control main-search top-search-suggestion"
                                        placeholder="Search for products, categories and more">
                                    <button type="button" class="btn btn-primary submit-search"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                    <div id="suggestions-box-display"
                                    class="suggestions-box suggestions-box-display" style="display: none;">
                                        <div class="left-suggestion-no-products" hidden>
                                            <p>No results found.</p>
                                        </div>

                                        <div class="left-suggestion-main-con">
                                            <!-- JS will inject products here -->
                                        </div>

                                        <div class="right-suggestion-main-con">
                                            <div>
                                                <h4 class="headding search-category-title">Categories</h4>
                                                <ul class="category-list">
                                                    <!-- JS will inject categories here -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>












                            </div>




                            <div class="header-right-con">
                                <div class="top-right-nav">
                                    <div class="des-cart pos-relative cart-popup ">

                                        <a href="javascript:void(0)" class="d-flex">

                                            <cart-item-count></cart-item-count>
                                            <div class="dt-icon-div"><span id="cart-count-3"
                                                    class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 ">
                                                    {{ $cartCount ?? 0 }}

                                                </span> <img
                                                    src=" {{ asset('frontend/newstyle/assets/images/cart-new.png') }}"
                                                    class="cart-img"></div><span>Cart</span>
                                        </a>
                                    </div>



                                    <script>
                                        $(".cart-popup").click(function() {
                                            $('.mini-cart').removeClass('d-none');
                                            $('.mini-cart').addClass('d-block');
                                        });
                                        $(".close-minicart, .mini-cart-overlay").click(function() {
                                            $('.mini-cart').addClass('d-none');
                                            $('.mini-cart').removeClass('d-block');
                                        });
                                    </script>


                                    <div class="auth-container">



                                        <!-- Profile Dropdown -->
                                        <div class="profile-dropdown">
                                            @auth

                                                <div class="auth-container">
                                                    <div class="loged-user d-inline-flex">
                                                        <div class="log-user-img"><img
                                                                src="https://buyabans.com/themes/buyabans/assets/images/icon/dummy-user.png">
                                                        </div>
                                                        <div class="log-user-data dropdown">
                                                            <div class="user-name">Hi!
                                                                {{ auth()->user()->name }}
                                                            </div>
                                                            <div class="dropdown-box">

                                                                <ul class="log-popup-links">
                                                                    <li>
                                                                        <a href="{{ route('dashboard') }}">
                                                                            <img
                                                                                src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/user.png">My
                                                                            Account
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a>
                                                                            <img
                                                                                src="https://buyabans.com/themes/buyabans/assets/images/icon/mini-profile/turn-off.png">
                                                                            <form method="POST"
                                                                                action="{{ route('logout') }}">


                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="dropdown-item w-100">Logout</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>



                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- Default Profile Icon and Links for Guests -->
                                                <div class="sign-up d-inline-flex">
                                                    <div>
                                                        <a href="{{ route('login') }}" class="d-flex">
                                                            <div class="dt-icon-div"><img
                                                                    src=" {{ asset('frontend/newstyle/assets/images/account-icon.png') }} ">
                                                            </div>
                                                            <div>Login</div>
                                                        </a>
                                                    </div>

                                                    <div class="boder-right"></div>

                                                    <div>
                                                        <a class="sign-up-link" href="{{ route('register') }}"><span>Sign
                                                                Up</span></a>
                                                    </div>
                                                </div>

                                            </div>


                                        @endauth
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!--    category begin -->
            <div class="header-bottom destop-categories">
                <div class="site-common-con">
                    <div class="d-flex">
                        <div class="cat-main-set ">
                            <div id="mega-menu">
                                <div class="btn-mega">
                                    <div class="all-cat-txt">
                                        <div class="cat-icon">

                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <span class="nav-vcenter">
                                            All Categories
                                            <span class="fa-solid fa-chevron-down cat-arrow"></span>
                                        </span>
                                    </div>
                                </div>
                                <style>




                                </style>
                                <div class="wrap-menu">
                                    <div class="wrap-inner">
                                        @foreach ($categories as $category)
                                            <div class="fly main-link">

                                                <a href="{{ url('/shop?category_id=' . $category->id) }}">

                                                    {{ $category->name }}
                                                </a>


                                                <div class="inner">
                                                    <div class="scroll-height"></div>
                                                    <div class="scroll-cat-set">


                                                        <!-- Check if the category has subcategories -->
                                                        @if ($category->subcategories->isNotEmpty())
                                                            @foreach ($category->subcategories as $subcategory)
                                                                <div class="one-third">
                                                                    <div class="cat-title">
                                                                        <a
                                                                            href="{{ url('/shop?subcategory_id=' . $subcategory->id) }}">
                                                                            {{ $subcategory->name }}
                                                                        </a>
                                                                    </div>
                                                                    <ul>
                                                                        @if ($category->subcategories->isNotEmpty())
                                                                            @foreach ($subcategory->subSubcategories as $subSubcategory)
                                                                                <li class="fly main-link">
                                                                                    <a
                                                                            href="{{ url('/shop?subsubcategory_id=' . $subSubcategory->id) }}">
                                                                            {{ $subSubcategory->name }}
                                                                        </a>


                                                                                </li>
                                                                            @endforeach
                                                                        @endif

                                                                    </ul>

                                                                </div>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>



                        </div><!-- /.col-md-3 col-2 -->


                        <!-- right sub menu end -->


                        <div class="cat-sub-set">
                            <div class="nav-wrap">
                                <div id="mainnav" class="mainnav">
                                    <ul class="menu">



                                        <li class="column-1"> <a href="/" title="">Home</a> </li>
                                        <!-- /.column-1 -->


                                        <!-- /.column-1 -->
                                        <li class="column-1"><a href="/shop" title="">Shop</a></li>
                                        <!-- /.column-1 -->


                                        </li><!-- /.column-1 -->




                                        <li class="has-mega-menu">
                                            <a href="#" title="Brands">

                                                Brands </a>

                                            <ul class="submenu" id="brand-submenu">
                                                <div class="row align-items-start">
                                                    <div class="col-sm-6">
                                                        <p class="brand-topic">Top Brands</p>
                                                        <div id="top-brands" class="brand-logos-set row"></div>
                                                    </div>
                                                    <div class="px-40 col-sm-6">
                                                        <p class="brand-topic">All Brands</p>
                                                        <div id="all-brands" class="row align-items-start"></div>
                                                    </div>
                                                </div>
                                            </ul>


                                        </li>




                                        <li class="column-1">
                                            <a href="/about" title="">

                                                About Us </a>

                                        </li>


                                        <li class="column-1">
                                            <a href="/contact" title="">

                                                Contact Us </a>

                                        </li>

                                        <!-- <li class="column-1">
                                            <a href="{{ route('frontend.vendor') }}" title="">

                                                Vendors </a>

                                        </li> -->




                                        <!-- /.column-1 -->
                                    </ul><!-- /.menu -->



                                    <div class="destop-hotline d-flex">

                                        <div class="top-track">

                                            <a href="{{ route('my-orders') }}"><i class="fa-solid fa-location-dot me-2"></i>Track your
                                                order</a>

                                        </div>
                                        <div><a href="#" title="">
                                                <i class="fa-solid fa-phone me-2"></i>
                                                +94 112 251 202

                                            </a>
                                        </div>
                                    </div>

                                </div><!-- /.mainnav -->
                            </div><!-- /.nav-wrap -->

                            <div class="btn-menu">
                                <span></span>
                            </div><!-- //mobile menu button -->
                        </div><!-- /.col-md-9 -->
                    </div><!-- /.row -->




                </div><!-- /.container -->
            </div>
            <!-- destop category end -->
        </div>
    </div>
    <!-- destop header end -->




















    </div>



    <!-- mobile header end -->
















    <!-- onestop showroom login -->



    </div>


    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper" style="z-index: 10000;">
        <div class="mobile-menu-overlay ss" onclick="if (!window.__cfRLUnblockHandlers) return false; closeMenuMobi()"
            data-cf-modified-a071cb3ff60724c4b8f55cf9-=""></div>
        <!-- End of .mobile-menu-overlay -->
        <!-- End of .mobile-menu-close -->
        <div class="mobile-menu-container scrollable">

            <a href="#" class="mobile-menu-close"
                onclick="if (!window.__cfRLUnblockHandlers) return false; closeMenuMobi()"
                data-cf-modified-a071cb3ff60724c4b8f55cf9-=""><i class="close-icon"></i></a>
            <!-- End of Search Form -->

            <div class="hot-line-mob">
                <div class="d-flex mobi-hot-main">
                    <div class="mobi-hot-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <div>HOT LINE</div>
                        <strong>+94 112 251 202
                        </strong>
                    </div>
                </div>
            </div>

            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#main-menu" class="nav-link mobimain-menu active"
                            onclick="if (!window.__cfRLUnblockHandlers) return false; opensideMainMobi()"
                            data-cf-modified-a071cb3ff60724c4b8f55cf9-="">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#categories" class="nav-link menu-cat "
                            onclick="if (!window.__cfRLUnblockHandlers) return false; opencategoryMobi()"
                            data-cf-modified-a071cb3ff60724c4b8f55cf9-="">Categories</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">

                <!-- Main Menu Tab Pane -->
                <div class="tab-pane menu-pane active" id="main-menu">
                    <ul class="mobi-icon-menu">


                        <li> <a href="/" title="">Home</a> </li>


                        <li class="column-1"><a href="/shop" title="">Shop</a></li>
                        <li class="column-1"><a href="#" title="">Brands</a></li>

                        <li><a href="/about" title=""> About Us </a></li>

                        <li><a href="/contact" title="">Contact Us </a></li>

                        <!-- <li ><a href="{{ route('frontend.vendor') }}" title="">Vendors </a></li> -->


                    </ul>







                    </ul>


                </div>

                <div class="tab-pane cat-pane" id="categories">
                    <ul class=" list-unstyled">

                        @foreach ($categories as $category)
                            <li class="position-relative">

                                <!-- Main Category and Toggle -->
                                <div class="d-flex justify-content-between align-items-center ">
                                    <a href="{{ url('/shop?category_id=' . $category->id) }}"
                                        class="text-dark text-decoration-none fw-semibold" style="line-height: 1.6;">
                                        {{ $category->name }}
                                    </a>

                                    @if ($category->subcategories->isNotEmpty())
                                        <span class="toggle-btn" onclick="toggleDropdown(this)"
                                            style="cursor: pointer;">
                                            <i class="fa fa-chevron-down text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                <!-- Subcategory List -->
                                @if ($category->subcategories->isNotEmpty())
                                    <ul
                                        class="mt-1 border rounded shadow-sm dropdown subcategory-dropdown bg-light d-none">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a href="{{ url('/shop?subcategory_id=' . $subcategory->id) }}"
                                                    class="px-4 py-2 d-block text-dark text-decoration-none"
                                                    style="line-height: 1.6;">
                                                    {{ $subcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach

                    </ul>
                </div>


                <script>
                    function toggleDropdown(toggleBtn) {
                        const dropdown = toggleBtn.closest('li').querySelector('.subcategory-dropdown');
                        if (dropdown) {
                            dropdown.classList.toggle('d-none');
                            toggleBtn.querySelector('i').classList.toggle('fa-chevron-down');
                            toggleBtn.querySelector('i').classList.toggle('fa-chevron-up');
                        }
                    }
                </script>



                <style>
                    .subcategory-dropdown {
                        list-style: none;
                        padding-left: 0;
                    }

                    .category-link:hover {
                        background-color: #f8f9fa;
                    }
                </style>

            </div>































        </div>
    </div>
    <!-- End of Mobile Menu -->
    </div>


    <script>
        document.querySelectorAll('.nav-link').forEach((tab) => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
                this.classList.add('active');

                document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('show', 'active'));
                const target = this.getAttribute('href');
                document.querySelector(target).classList.add('show', 'active');
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#product-search').on('keyup', function() {
                let query = $(this).val();
                $('#search-results').empty();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('search.products') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            if (response.products && response.products.length > 0) {
                                $('#search-results').show();
                                response.products.forEach(function(product) {
                                    $('#search-results').append(
                                        `<div class="p-2 border-bottom">${product.product_name}</div>`
                                    );
                                });
                            } else {
                                $('#search-results').show().html(
                                    '<div class="p-2">No products found</div>');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#search-results').hide();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandsMenuItem = document.querySelector('li > a[title="Brands"]')?.parentElement;
            const submenu = document.getElementById('brand-submenu');

            let brandsLoaded = false;
            let brandsFetching = false;
            let hoverTimeout = null;

            if (!brandsMenuItem || !submenu) return;

            // Show submenu on hover
            brandsMenuItem.addEventListener('mouseenter', () => {
                // Clear any existing timeout to avoid flickering
                if (hoverTimeout) clearTimeout(hoverTimeout);

                submenu.style.display = 'block';

                // Only fetch data if it hasn't been loaded or isn't currently fetching
                if (!brandsLoaded && !brandsFetching) {
                    brandsFetching = true; // Lock to prevent multiple requests

                    console.log('Fetching brands data');

                    fetch('/brands-data')
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.json();
                        })
                        .then(data => {
                            const topContainer = document.getElementById('top-brands');
                            const allContainer = document.getElementById('all-brands');

                            // Clear containers first to prevent duplicate content
                            topContainer.innerHTML = '';
                            allContainer.innerHTML = '';

                            const allList = [
                                [],
                                [],
                                [],
                                []
                            ];
                            let col = 0;

                            data.forEach(brand => {
                                const imageUrl = brand.image ? brand.image :
                                'default-image.png';

                                const brandLink = `<a title="${brand.name}" href="/brand/${brand.slug}">
                            <img src="/storage/${imageUrl}" alt="${brand.name}" style="height: 50px;">
                        </a>`;

                                if (brand.is_top_brand) {
                                    topContainer.insertAdjacentHTML('beforeend',
                                        `<div class="brand-img col-sm-3">${brandLink}</div>`
                                        );
                                }

                                allList[col].push(
                                    `<li><a href="/brand/${brand.slug}">${brand.name}</a></li>`
                                    );
                                col = (col + 1) % 4;
                            });

                            allList.forEach(column => {
                                allContainer.insertAdjacentHTML('beforeend',
                                    `<ul class="col-sm-3">${column.join('')}</ul>`);
                            });

                            brandsLoaded = true;
                            console.log('Brands loaded successfully');
                        })
                        .catch(err => {
                            console.error('Brand fetch failed:', err);
                        })
                        .finally(() => {
                            brandsFetching = false;
                        });
                }
            });

            // Add event listeners to both menu item and submenu to prevent flickering
            submenu.addEventListener('mouseenter', () => {
                if (hoverTimeout) clearTimeout(hoverTimeout);
                submenu.style.display = 'block';
            });

            // Hide submenu on mouse leave with slight delay to prevent flickering
            const handleMouseLeave = () => {
                hoverTimeout = setTimeout(() => {
                    submenu.style.display = 'none';
                }, 200); // Small delay to prevent flickering when moving between menu and submenu
            };

            brandsMenuItem.addEventListener('mouseleave', handleMouseLeave);
            submenu.addEventListener('mouseleave', handleMouseLeave);
        });
    </script>



<script>
    document.querySelector('.main-search').addEventListener('keyup', function() {
        let query = this.value.trim();

        if (query.length < 2) {
            document.getElementById('suggestions-box-display').style.display = 'none';
            return;
        }

        fetch(`/search-suggestions?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                const box = document.getElementById('suggestions-box-display');
                const productCon = box.querySelector('.left-suggestion-main-con');
                const categoryCon = box.querySelector('.category-list');
                const noResults = box.querySelector('.left-suggestion-no-products');

                productCon.innerHTML = '';
                categoryCon.innerHTML = '';

                if (data.products.length === 0 && data.categories.length === 0) {
                    noResults.hidden = false;
                    box.style.display = 'block';
                    return;
                }

                noResults.hidden = true;

                // Add products
                data.products.forEach(product => {
                    const productHTML = `
                <a class="search-product-element" href="${product.url}">
                    <div class="suggestion-box">
                        <div class="suggestion-product-img"><img class="img-fluid" alt="" src="${product.image ?? ''}"></div>
                        <div class="suggestion-box-details">
                            <div class="product-line product-name">${product.name}</div>
                        </div>
                    </div>
                </a>
            `;
                    productCon.innerHTML += productHTML;
                });

                // Add categories
                data.categories.forEach(category => {
                    const categoryHTML =
                        `<li><a class="search-category-name" href="${category.url}">${category.name}</a></li>`;
                    categoryCon.innerHTML += categoryHTML;
                });

                box.style.display = 'block';
            })
            .catch(err => {
                console.error('Search error:', err);
            });
    });
</script>

<script>
    function updateCartCount() {
        fetch("{{ route('cart.count') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count-1').textContent = data.cart_count;
                document.getElementById('cart-count-2').textContent = data.cart_count;
                document.getElementById('cart-count-3').textContent = data.cart_count;
                document.getElementById('cart-count-4').textContent = data.cart_count;
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });
    }

    // Call on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>



    </header>
