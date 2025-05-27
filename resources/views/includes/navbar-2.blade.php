<style>
    /* Dropdown styles */
    .profile-dropdown {
        position: relative;
    }

    .profile-toggle {
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        padding: 10px;
        z-index: 10;
        min-width: 60px;
    }

    .dropdown-item {
        color: hsl(0, 2%, 66%);
        padding: 8px 12px;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #f2f2f2;
        color: #ce1616;
    }

    .profile-dropdown:hover .dropdown-menu {
        display: block;
    }

    .header-middle {
        background-color: #001f3f!important; /* Force Apply Dark Blue */
     }
  


</style>

<!--==================== Overlay Start ====================-->
<div class="overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ==================== Scroll to Top End Here ==================== -->
<div class="progress-wrap">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>
<!-- ==================== Scroll to Top End Here ==================== -->


<!-- ==================== Mobile Menu Start Here ==================== -->
<div class="mobile-menu scroll-sm d-lg-none d-block">
    <button type="button" class="close-button"> <i class="ph ph-x"></i> </button>
    <div class="mobile-menu__inner">
        <a href="/" class="mobile-menu__logo">
            <img src="frontend/assets/images/logo/logo-mobile-menu-new1.png" alt="Logo">
        </a>
        
        <div class="mobile-menu__menu">
            <!-- Nav Menu Start -->
            <ul class="nav-menu flex-align nav-menu--mobile">
                <li class="nav-menu__item">
                    <a href="javascript:void(0)" class="nav-menu__link">Home</a>
                
                </li>
                <li class="nav-menu__item">
                    <a href="javascript:void(0)" class="nav-menu__link">Shop</a>
                    
                </li>
                <li class="nav-menu__item">
                
                    <a href="{{ route('about') }}" class="nav-menu__link">About Us</a>
                
                </li>
                <li class="nav-menu__item">
                
                    <a href="{{ route('contact') }}" class="nav-menu__link">Contact Us</a>
                
                </li>
            
                <li class="nav-menu__item">
                    <a href="{{ route('frontend.vendor') }}" class="nav-menu__link">Vendors</a>
                </li>
            </ul>
            <!-- Nav Menu End -->
        </div>
    </div>
</div>
<!-- ==================== Mobile Menu End Here ==================== -->

<!-- ======================= Middle Header Two Start ========================= -->
<header class="header-middle style-two bg-color-neutral">
    <div class="container container-lg">
        <nav class="header-inner flex-between">
            <!-- Logo Start -->
            <div class="logo"style="margin-left: 80px;  margin-top: 0; margin-bottom: 0;">
                <a href="/" class="link">

                
                    <img src="{{ asset('frontend/assets/images/logo/navbar-logo-new.png') }}" alt="Logo" >

                </a>
            </div>
            <!-- Logo End  -->

            <!-- form Category Start -->
            <div class="gap-16 flex-align">
                <div class="select-dropdown-for-home-two d-lg-none d-block">
                    <!-- Dropdown Select Start -->

                    <!-- Dropdown Select End -->
                </div>

                <form action="{{ route('search.products') }}" method="GET" class="flex-wrap flex-align form-location-wrapper">
                    <div class="h-48 search-category style-two d-flex search-form d-sm-flex d-none">
                        <select class="border border-0 border-gray-200 js-example-basic-single border-end-0 rounded-0" name="category">
                            <option value="" selected disabled>All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="search-form__wrapper position-relative">
                            <input type="text" class="border-0 search-form__input common-input py-13 ps-16 pe-18 rounded-0" name="search" placeholder="Search for a product or brand.." value="{{ request('search') }}">
                            <div id="search-results" class="dropdown-menu"></div>
                        </div>
                        <button type="submit" class="flex-shrink-0 w-48 text-xl text-white bg-main-two-600 flex-center hover-bg-main-two-600 d-lg-flex d-none">
                            <i class="ph ph-magnifying-glass"></i>
                        </button>
                    </div>
                </form>

            </div>
            <!-- form Category start -->
             
            <!-- Header Middle Right start -->
            <div class="header-right flex-align d-lg-block d-none">
                <div class="flex-wrap gap-32 header-two-activities flex-align">
    <button type="button" class="gap-4 flex-align search-icon d-lg-none d-flex item-hover-two">
        <span class="text-2xl text-white d-flex position-relative item-hover__text">
            <i class="ph ph-magnifying-glass"></i>
        </span>
    </button>


    <!-- Profile Dropdown -->
    <div class="profile-dropdown">
        @auth
            <a href="#" class="gap-8 flex-align flex-column item-hover-two profile-toggle">
                <span class="profile-initial d-flex justify-content-center align-items-center">
                    {{ auth()->user()->name[0] }}
                </span>
            </a>

            <!-- Dropdown Menu for Logged-In User -->
            <div class="dropdown-menu" style="width: 170px">
                <a href="{{ route('dashboard') }}" class="dropdown-item">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="p-0 dropdown-item">
                    @csrf
                    <button type="submit" class="dropdown-item w-100">Logout</button>
                </form>
            </div>
        @else
            <!-- Default Profile Icon and Links for Guests -->
            <a href="#" class="gap-8 flex-align flex-column item-hover-two profile-toggle">
                <span class="text-2xl text-white d-flex position-relative item-hover__text">
                    <i class="ph ph-user"></i>
                </span>
                <span class="text-white text-md item-hover__text d-none d-lg-flex">Profile</span>
            </a>

            <!-- Dropdown Menu for Guests -->
            <div class="dropdown-menu" style="width: 170px">
                <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                <a href="{{ route('register') }}" class="dropdown-item">Sign Up</a>
            </div>
        @endauth
    </div>


    <a href="{{ route('wishlist') }}" class="gap-8 flex-align flex-column item-hover-two">
        <span class="mt-6 text-2xl text-white d-flex position-relative me-6 item-hover__text">
            <i class="ph ph-heart"></i>
            <span id="wishlist-count" class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">0</span>
        </span>
        <span class="text-white text-md item-hover__text d-none d-lg-flex">Wishlist</span>
    </a>


    
    <a href="{{ route ('cart') }}" class="gap-8 ml-10 flex-align flex-column item-hover-two" style="margin-right:30px;">
        <span class="mt-6 text-2xl text-white d-flex position-relative me-6 item-hover__text">
            <i class="ph ph-shopping-cart-simple"></i>
            <!-- Display the cart count dynamically -->
            <span id="cart-count" class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">
            0

            </span>
        </span>
        <span class="text-white text-md item-hover__text d-none d-lg-flex">Cart</span>
    </a>


                </div>
            </div>
            <!-- Header Middle Right End  -->
        </nav>
    </div>
</header>
<!-- ======================= Middle Header Two End ========================= -->

    <!-- ==================== Header Two Start Here ==================== -->
<header class="border-gray-100 header border-bottom">
    <div class="container container-lg">
        <nav class="gap-8 header-inner d-flex justify-content-between">
        <div class="flex-align menu-category-wrapper">

<!-- Category Dropdown Start -->
<div class="text-white category d-block on-hover-item bg-main-600">
    <button type="button" class="gap-8 p-16 text-white border-gray-100 category__button flex-align fw-medium border-end border-start">
        <span class="text-2xl icon d-xs-flex d-none"><i class="ph ph-dots-nine"></i></span>
        <span class="d-sm-flex d-none">All</span> Categories
        <span class="text-xl arrow-icon d-flex"><i class="ph ph-caret-down"></i></span>
    </button>

    <div class="p-0 responsive-dropdown on-hover-dropdown common-dropdown nav-submenu submenus-submenu-wrapper">
        <button type="button" class="mt-4 text-xl close-responsive-dropdown rounded-circle position-absolute inset-inline-end-0 inset-block-start-0 me-8 d-lg-none d-flex"> 
            <i class="ph ph-x"></i> 
        </button>

        <ul class="p-0 py-8 overflow-y-auto responsive-dropdown__list scroll-sm max-h-400">
            @foreach ($categories as $category)
                <li class="has-submenus-submenu" style="width: 240px;">
                    <a href="{{ url('/shop?category_id=' . $category->id) }}" class="gap-8 px-16 py-12 text-gray-500 text-15 flex-align rounded-0">
                        <span>{{ $category->name }}</span>
                        <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                    </a>

                    <!-- Subcategories Column -->
                    @if ($category->subcategories->isNotEmpty())
                        <div class="py-16 submenus-submenu">
                            <h6 class="px-16 text-lg submenus-submenu__title">{{ $category->name }}</h6>
                            <ul class="overflow-y-auto submenus-submenu__list max-h-300 scroll-sm">
                                @foreach ($category->subcategories as $subcategory)
                                    <li class="has-sub-submenu">
                                        <a href="{{ url('/shop?subcategory_id=' . $subcategory->id) }}">{{ $subcategory->name }}</a>

                                        <!-- Sub-Subcategories Column -->
                                        @if ($subcategory->subSubcategories->isNotEmpty())
                                            <div class="sub-submenu-column">
                                                <ul class="overflow-y-auto sub-submenu max-h-300 scroll-sm">
                                                    @foreach ($subcategory->subSubcategories as $subSubcategory)
                                                        <li class="has-sub-submenu">
                                                            <a href="{{ url('/shop?subsubcategory_id=' . $subSubcategory->id) }}">{{ $subSubcategory->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- Category Dropdown End -->

<!-- Other Menu Items -->
<div class="header-menu d-lg-block d-none">
    <ul class="nav-menu flex-align ">
        <li class="nav-menu__item">
            <a href="/" class="nav-menu__link">Home</a>
        </li>
        <li class="nav-menu__item">
            <a href="/shop" class="nav-menu__link">Shop</a>
        </li>
        <li class="nav-menu__item">
            <a href="/about" class="nav-menu__link">About Us</a>
        </li>
        <li class="nav-menu__item">
            <a href="/contact" class="nav-menu__link">Contact Us</a>
        </li>
        <li class="nav-menu__item">
            <a href="{{ route('frontend.vendor') }}" class="nav-menu__link">Vendors</a>
        </li>
    </ul>
</div>

</div>
 <!-- Header Right start -->
            <div class="header-right flex-align">

                <div class="select-dropdown-for-home-two d-lg-block d-none">
                    <!-- Dropdown Select Start -->
<ul class="flex-wrap header-top__right style-two flex-align">
    
    
</ul>
<!-- Dropdown Select End -->
                 </div>
                
                <div class="me-8 d-lg-none d-block">
                    <div class="flex-wrap gap-32 header-two-activities flex-align">
    <button type="button" class="gap-4 flex-align search-icon d-lg-none d-flex item-hover-two">
        <span class="text-2xl text-white d-flex position-relative item-hover__text">
            <i class="ph ph-magnifying-glass"></i>
        </span>
    </button>


   <!-- Profile Dropdown -->
   <div class="profile-dropdown">
    @auth
        <a href="#" class="gap-8 flex-align flex-column item-hover-two profile-toggle">
            <span class="profile-initial d-flex justify-content-center align-items-center">
                {{ auth()->user()->name[0] }}
            </span>
        </a>

        <!-- Dropdown Menu for Logged-In User -->
        <div class="dropdown-menu" style="width: 170px">
            <a href="" class="dropdown-item">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="p-0 dropdown-item">
                @csrf
                <button type="submit" class="dropdown-item w-100">Logout</button>
            </form>
        </div>
    @else
        <!-- Default Profile Icon and Links for Guests -->
        <a href="#" class="gap-8 flex-align flex-column item-hover-two profile-toggle">
            <span class="text-2xl text-white d-flex position-relative item-hover__text">
                <i class="ph ph-user"></i>
            </span>
            <span class="text-white text-md item-hover__text d-none d-lg-flex">Profile</span>
        </a>

        <!-- Dropdown Menu for Guests -->
        <div class="dropdown-menu" style="width: 170px">
            <a href="{{ route('login') }}" class="dropdown-item">Login</a>
            <a href="{{ route('register') }}" class="dropdown-item">Sign Up</a>
        </div>
    @endauth
</div>



    <a href="{{ route('wishlist') }}" class="gap-8 flex-align flex-column item-hover-two">
        <span class="mt-6 text-2xl text-white d-flex position-relative me-6 item-hover__text">
            <i class="ph ph-heart"></i>
            <span class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">2</span>
        </span>
        <span class="text-white text-md item-hover__text d-none d-lg-flex">Wishlist</span>
    </a>

    <a href="{{ route ('cart') }}" class="gap-8 ml-10 flex-align flex-column item-hover-two" style="margin-right:30px;">
    <span class="mt-6 text-2xl text-white d-flex position-relative me-6 item-hover__text">
        <i class="ph ph-shopping-cart-simple"></i>
        <!-- Display the cart count dynamically -->
        <span id="cart-count" class="w-16 h-16 text-xs text-white flex-center rounded-circle bg-main-two-600 position-absolute top-n6 end-n4">
           0
        </span>
    </span>
    <span class="text-white text-md item-hover__text d-none d-lg-flex">Cart</span>
</a>

    
</div>
                </div>
                <button type="button" class="text-4xl text-gray-800 toggle-mobileMenu d-lg-none ms-3n d-flex"> <i class="ph ph-list"></i> </button>
            </div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>

<!-- ==================== Header End Here ==================== -->


<script>
    $(document).ready(function () {
        $('#product-search').on('keyup', function () {
            let query = $(this).val();
            $('#search-results').empty();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('search.products') }}",
                    method: 'GET',
                    data: { query: query },
                    success: function (response) {
                        if (response.products && response.products.length > 0) {
                            $('#search-results').show();
                            response.products.forEach(function (product) {
                                $('#search-results').append(
                                    `<div class="p-2 border-bottom">${product.product_name}</div>`
                                );
                            });
                        } else {
                            $('#search-results').show().html('<div class="p-2">No products found</div>');
                        }
                    },
                    error: function (xhr) {
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
    

</script>

