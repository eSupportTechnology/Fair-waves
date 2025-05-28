@extends ('frontend.master')

@section('content')
<div class="banner-two">
    <div class="container container-lg">
        <div class="banner-two-wrapper d-flex align-items-start">
                <div class="mb-0 overflow-hidden banner-item-two-wrapper rounded-24 position-relative arrow-center flex-grow-1">
                    <img src="{{ asset('frontend/assets/images/bg/banner-two-bg.png') }}" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">
                    <div class="banner-item-two__slider">
                        <div class="banner-item-two">
                            <div class="banner-item-two__content">
                                <span class="mb-8 text-white h6 wow bounceInDown">Starting at only Rs 500</span>
                                <h2 class="text-white banner-item-two__title bounce wow bounceInLeft">Get The Sound You Love For Less</h2>
                                <a href="/shop" class="gap-8 mt-48 btn btn-outline-white d-inline-flex align-items-center rounded-pill wow bounceInUp">
                                    Shop Now<span class="text-xl icon d-flex"><i class="ph ph-shopping-cart-simple"></i> </span>
                                </a>
                            </div>
                            <div class="bottom-0 banner-item-two__thumb position-absolute wow bounceInUp" data-wow-duration="1s" data-tilt data-tilt-max="12" data-tilt-speed="500" data-tilt-perspective="5000" data-tilt-scale="1.06">
                                <img src="frontend/assets/images/imgs/music-cover1.png" alt="">
                            </div>
                        </div>
                        <div class="banner-item-two">
                            <div class="banner-item-two__content">
                                <span class="mb-8 text-white h6 wow bounceInDown">Starting at only Rs 500</span>
                                <h2 class="text-white banner-item-two__title bounce wow bounceInLeft">Get The Sound You Love For Less</h2>
                                <a href="{{ route('shop.index') }}" class="gap-8 mt-48 btn btn-outline-white d-inline-flex align-items-center rounded-pill wow bounceInUp">
                                    Shop Now<span class="text-xl icon d-flex"><i class="ph ph-shopping-cart-simple"></i> </span>
                                </a>
                            </div>
                            <div class="bottom-0 banner-item-two__thumb position-absolute wow bounceInUp" data-wow-duration="1s" data-tilt data-tilt-max="12" data-tilt-speed="500" data-tilt-perspective="5000" data-tilt-scale="1.06">
                                <img src="frontend/assets/images/imgs/music-cover1.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Banner Section End =============================== -->

    <!-- ============================ promotional banner Start ========================== -->
    <section class="mt-32 promotional-banner">
        <div class="container container-lg">
            <div class="row gy-4">
                <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="600">
                    <div class="p-32 overflow-hidden position-relative rounded-16 z-1">
                        <img src="frontend/assets/images/bg/promo-bg-img1.png" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        <div class="flex-wrap gap-16 flex-between">
                            <div class="">
                                <span class="mb-8 text-sm text-heading">Latest Deal</span>
                                <h6 class="mb-0">iPhone 15 Pro Max</h6>
                                <a href="/shop" class="gap-8 mt-16 border border-gray-900 d-inline-flex align-items-center text-heading text-md fw-medium border-top-0 border-end-0 border-start-0 hover-text-main-two-600 hover-border-main-two-600">
                                    Shop Now
                                    <span class="icon text-md d-flex"><i class="ph ph-plus"></i></span>
                                </a>
                            </div>
                            <div class="pe-xxl-4">
                                <img src="frontend/assets/images/imgs/phone.png" alt="" style="width: 130px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="p-32 overflow-hidden position-relative rounded-16 z-1">
                        <img src="frontend/assets/images/bg/promo-bg-img2.png" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        <div class="flex-wrap gap-16 flex-between">
                            <div class="">
                                <span class="mb-8 text-sm text-heading">Get 60% Off</span>
                                <h6 class="mb-0">Instax Mini 11 Camera</h6>
                                <a href="/shop" class="gap-8 mt-16 border border-gray-900 d-inline-flex align-items-center text-heading text-md fw-medium border-top-0 border-end-0 border-start-0 hover-text-main-two-600 hover-border-main-two-600">
                                    Shop Now
                                    <span class="icon text-md d-flex"><i class="ph ph-plus"></i></span>
                                </a>
                            </div>
                            <div class="pe-xxl-4">
                                <img src="frontend/assets/images/imgs/category-3.png" alt="" style="width: 100px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="p-32 overflow-hidden position-relative rounded-16 z-1">
                        <img src="frontend/assets/images/bg/promo-bg-img3.png" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        <div class="flex-wrap gap-16 flex-between">
                            <div class="">
                                <span class="mb-8 text-sm text-heading">Start From Rs 250</span>
                                <h6 class="mb-0">Airpod Headphone</h6>
                                <a href="/shop" class="gap-8 mt-16 border border-gray-900 d-inline-flex align-items-center text-heading text-md fw-medium border-top-0 border-end-0 border-start-0 hover-text-main-two-600 hover-border-main-two-600">
                                    Shop Now
                                    <span class="icon text-md d-flex"><i class="ph ph-plus"></i></span>
                                </a>
                            </div>
                            <div class="pe-xxl-4">
                                <img src="frontend/assets/images/imgs/headphones.png" alt="" style="width: 90px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ promotional banner End ========================== -->

<!-- ============================ new section add leatest product========================== -->
  <!-- ========================= Deals Week Start ================================ -->
  <section class="overflow-hidden deals-weeek pt-80">
    <div class="container container-lg">
        <div class="p-24 border border-gray-100 rounded-16">
            <div class="mb-24 section-heading">
                <div class="flex-wrap gap-8 flex-between">
                    <h5 class="mb-0 wow bounceInLeft">Latest products</h5>
                    <div class="gap-16 flex-align wow bounceInRight">
                        <a href="/shop" class="text-sm text-gray-700 fw-medium hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                        <div class="gap-10 flex-align">
                            <button type="button" id="deal-week-prev" class="text-xl border border-gray-100 slick-prev slick-arrow flex-center rounded-circle hover-border-neutral-600 hover-bg-neutral-600 hover-text-white transition-1">
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <button type="button" id="deal-week-next" class="text-xl border border-gray-100 slick-next slick-arrow flex-center rounded-circle hover-border-neutral-600 hover-bg-neutral-600 hover-text-white transition-1">
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="deals-week-slider arrow-style-two">
                @foreach ($products->slice(0, 10) as $product)
                    <div data-aos="fade-up" data-aos-duration="200">
                        <div class="p-16 border border-gray-100 product-card h-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <a href="{{ route('showProductDetails', $product->product_id) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative">
                                @if($product->quantity == 0)
                                    <span class="px-8 py-4 text-sm text-white product-card__badge bg-main-600 position-absolute inset-inline-start-0 inset-block-start-0">Sold</span>
                                @endif
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->product_name }}" class="w-auto max-w-unset" style="width: 200px; height: 200px; object-fit: cover;">
                            </a>
                            <div class="mt-16 product-card__content">
                                <div class="gap-6 mt-16 mb-20 flex-align">
                                 @if ($product->total_reviews!=0)
                                    <div class="rating-info d-flex gap-2">
                                        @php
                                        $fullStars = floor($product->average_rating); // Number of full stars
                                        $hasHalfStar = ($product->average_rating - $fullStars) >= 0.5; // Half-star condition
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                        @endif
                                        <span class="text-xs fw-medium text-gray-500">{{ number_format($product->average_rating, 1) }}</span>
                                        &nbsp;<span class="text-xs fw-medium text-gray-500">({{ $product->total_reviews }})</span>
                                    </div>
                                    @endif
                                    <!-- Heart Icon -->
                                    <button type="button" class="heart-icon ms-auto" 
                                            id="wishlist-icon-{{ $product->product_id }}" 
                                            onclick="toggleWishlist(this, '{{ $product->product_id }}')">
                                        <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                                    </button>
                                </div>
                                <h6 class="mt-12 mb-8 text-lg title fw-semibold">
                                    <a href="{{ route('showProductDetails', $product->product_id) }}" class="link text-line-2" tabindex="0">{{ $product->product_name }}</a>
                                </h6>
                                <div class="gap-4 flex-align">
                                    <span class="text-tertiary-600 text-md d-flex">
                                        <i class="ph-fill ph-storefront"></i>
                                    </span>
                                    @if($product->shop_id && $product->shop) 
                                        <span class="text-xs text-gray-500">By {{ $product->shop->shop_name }}</span>
                                    @endif
                                </div>

                                <div class="mt-8">
                                    @php
                                        // Calculate the percentage sold
                                        $percentageSold = $product->total_quantity > 0 
                                            ? ($product->sold_quantity / $product->total_quantity) * 100 
                                            : 0;
                                    @endphp

                                    <div class="h-4 progress w-100 bg-color-three rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $percentageSold }}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-main-two-600 rounded-pill" style="width: {{ $percentageSold }}%;"></div>
                                    </div>
                                    <span class="mt-8 text-xs text-gray-900 fw-medium">
                                        Sold: {{ $product->sold_quantity }}/{{ $product->total_quantity }}
                                    </span>
                                </div>
                                <div class="my-20 product-card__price">
                                    <span class="text-heading text-md fw-semibold ">Rs {{ $product->normal_price }} <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                </div>

                                <a href="{{ route('showProductDetails', $product->product_id) }}" style="width:230px" class="gap-8 px-24 product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 rounded-8 flex-center fw-medium" tabindex="0">
                                    Add To Cart <i class="ph ph-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
<!-- ========================= Deals Week End ================================ -->

   

<!-- ========================= new section end================================ -->


 <!-- ========================= categories section Start ================================ -->
    <section class="overflow-hidden popular-products pt-80"> 
        <div class="container container-lg">
            <div class="p-24 border border-gray-100 rounded-16">
                <div class="mb-24 section-heading">
                    <div class="flex-wrap gap-8 flex-between">
                        <h5 class="mb-0 wow bounceInLeft">Categories</h5>
                        <div class="gap-16 flex-align wow bounceInRight">
                            <a href="/shop" class="text-sm text-gray-700 fw-medium hover-text-main-600 hover-text-decoration-underline">View All Products</a>
                        </div>
                    </div>
                </div>

                <div class="row gy-4">
                    @foreach ($categories->slice(0, 8) as $category)
                        <div class="col-xxl-3 col-xl-4 col-sm-6 col-xs-6 wow bounceIn">
                            <div class="gap-16 p-16 border border-gray-100 product-card h-100 d-flex hover-border-main-600 rounded-16 position-relative transition-2">
                                <a href="{{ route('shop.index') }}" class="flex-shrink-0 p-0 product-card__thumb flex-center h-unset rounded-8 position-relative w-unset" tabindex="0">
                                    <img src="
                                        @if (Str::contains(strtolower($category->name), 'women'))
                                            {{ asset('frontend/assets/images/imgs/category-1.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'men'))
                                            {{ asset('frontend/assets/images/imgs/category-2.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'health'))
                                            {{ asset('frontend/assets/images/imgs/category-4.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'electronic'))
                                            {{ asset('frontend/assets/images/imgs/category-3.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'sports'))
                                            {{ asset('frontend/assets/images/imgs/category-5.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'watch'))
                                            {{ asset('frontend/assets/images/imgs/category-6.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'appliances'))
                                            {{ asset('frontend/assets/images/imgs/category-7.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'home'))
                                            {{ asset('frontend/assets/images/imgs/category-8.jpg') }}
                                        @elseif (Str::contains(strtolower($category->name), 'groceries'))
                                            {{ asset('frontend/assets/images/imgs/category-9.jpg') }}
                                        @else
                                            {{ asset('frontend/assets/images/imgs/default-1.png') }}
                                        @endif
                                    " alt="{{ $category->name }}" class="w-100 max-w-unset">
                                </a>
                                <div class="product-card__content flex-grow-1">
                                    <h6 class="mb-12 text-lg title fw-semibold">
                                        <a href="{{ route('shop.index') }}" class="link text-line-2" tabindex="0">{{ $category->name }}</a>
                                    </h6>
                                    @foreach ($category->subcategories->take(4) as $subcategory)
                                        <span class="mb-4 text-sm text-gray-600">{{ $subcategory->name }}</span><br>
                                    @endforeach

                                    <a href="{{ route('shop.index') }}" class="gap-8 mt-24 text-tertiary-600 flex-align">
                                        All Categories
                                        <i class="ph ph-arrow-right d-flex"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- ========================= categories section End ================================ -->

    <!-- ========================= Deals Week Start ================================ -->
    <section class="overflow-hidden deals-weeek pt-80">
        <div class="container container-lg">
            <div class="p-24 border border-gray-100 rounded-16">
                <div class="mb-24 section-heading">
                    <div class="flex-wrap gap-8 flex-between">
                        <h5 class="mb-0 wow bounceInLeft">Deal of The Week</h5>
                        <div class="gap-16 flex-align wow bounceInRight">
                            <a href="/shop" class="text-sm text-gray-700 fw-medium hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                            <div class="gap-8 flex-align">
                                <button type="button" id="deal-week-prev" class="text-xl border border-gray-100 slick-prev slick-arrow flex-center rounded-circle hover-border-neutral-600 hover-bg-neutral-600 hover-text-white transition-1">
                                    <i class="ph ph-caret-left"></i>
                                </button>
                                <button type="button" id="deal-week-next" class="text-xl border border-gray-100 slick-next slick-arrow flex-center rounded-circle hover-border-neutral-600 hover-bg-neutral-600 hover-text-white transition-1">
                                    <i class="ph ph-caret-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="deals-week-slider arrow-style-two">
                    @foreach ($products->slice(0, 10) as $product)
                        <div data-aos="fade-up" data-aos-duration="200">
                            <div class="p-16 border border-gray-100 product-card h-100 hover-border-main-600 rounded-16 position-relative transition-2">
                                <a href="{{ route('showProductDetails', $product->product_id) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative">
                                    @if($product->quantity == 0)
                                        <span class="px-8 py-4 text-sm text-white product-card__badge bg-main-600 position-absolute inset-inline-start-0 inset-block-start-0">Sold</span>
                                    @endif
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->product_name }}" class="w-auto max-w-unset" style="width: 200px; height: 200px; object-fit: cover;">
                                </a>
                                <div class="mt-16 product-card__content">
                                    <div class="gap-6 mt-16 mb-20 flex-align">
                                        @if ($product->total_reviews!=0)
                                        <div class="rating-info d-flex gap-2">
                                            @php
                                            $fullStars = floor($product->average_rating); // Number of full stars
                                            $hasHalfStar = ($product->average_rating - $fullStars) >= 0.5; // Half-star condition
                                            @endphp
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            @endfor
                                            @if ($hasHalfStar)
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                            @endif
                                            <span class="text-xs fw-medium text-gray-500">{{ number_format($product->average_rating, 1) }}</span>
                                            &nbsp;<span class="text-xs fw-medium text-gray-500">({{ $product->total_reviews }})</span>
                                        </div>
                                        @endif
                                        <!-- Heart Icon -->
                                        <button type="button" class="heart-icon ms-auto" 
                                                id="wishlist-icon-{{ $product->product_id }}" 
                                                onclick="toggleWishlist(this, '{{ $product->product_id }}')">
                                            <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                                        </button>
                                    </div>
                                    <h6 class="mt-12 mb-8 text-lg title fw-semibold">
                                        <a href="{{ route('showProductDetails', $product->product_id) }}" class="link text-line-2" tabindex="0">{{ $product->product_name }}</a>
                                    </h6>
                                    <div class="gap-4 flex-align">
                                    <span class="text-tertiary-600 text-md d-flex">
                                        <i class="ph-fill ph-storefront"></i>
                                    </span>
                                    @if($product->shop_id && $product->shop) 
                                        <span class="text-xs text-gray-500">By {{ $product->shop->shop_name }}</span>
                                    @endif
                                </div>

                                <div class="mt-8">
                                    @php
                                        // Calculate the percentage sold
                                        $percentageSold = $product->total_quantity > 0 
                                            ? ($product->sold_quantity / $product->total_quantity) * 100 
                                            : 0;
                                    @endphp

                                    <div class="h-4 progress w-100 bg-color-three rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $percentageSold }}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-main-two-600 rounded-pill" style="width: {{ $percentageSold }}%;"></div>
                                    </div>
                                    <span class="mt-8 text-xs text-gray-900 fw-medium">
                                        Sold: {{ $product->sold_quantity }}/{{ $product->total_quantity }}
                                    </span>
                                </div>

                                    <div class="my-20 product-card__price">
                                        <span class="text-heading text-md fw-semibold ">Rs {{ $product->normal_price }} <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                    </div>

                                    <a href="{{ route('showProductDetails', $product->product_id) }}" style="width:230px" class="gap-8 px-24 product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 rounded-8 flex-center fw-medium" tabindex="0">
                                        Add To Cart <i class="ph ph-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- ========================= Deals Week End ================================ -->



<script>
document.addEventListener('DOMContentLoaded', function () {
    const productIds = [...document.querySelectorAll('.heart-icon')].map(button => button.id.replace('wishlist-icon-', ''));

    // Fetch wishlist status for all products on the page
    fetch('/wishlist/check-multiple', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ product_ids: productIds })
    })
    .then(response => response.json())
    .then(data => {
        // Loop through each product and update the icon if it's in the wishlist
        data.wishlist.forEach(productId => {
            const heartIcon = document.querySelector(`#wishlist-icon-${productId}`);
            if (heartIcon) {
                heartIcon.classList.add('active');
                const icon = heartIcon.querySelector('i');
                icon.classList.replace('fa-regular', 'fa-solid');
                icon.style.color = 'red';
            }
        });
    })
    .catch(error => console.error('Error:', error));
});

function toggleWishlist(button, productId) {
    // Toggle active state
    button.classList.toggle('active');
    const icon = button.querySelector('i');

    if (button.classList.contains('active')) {
        icon.classList.replace('fa-regular', 'fa-solid');
        icon.style.color = 'red';
    } else {
        icon.classList.replace('fa-solid', 'fa-regular');
        icon.style.color = '#ccc';
    }

    // Send AJAX request to toggle wishlist status
    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error); // If not logged in or another error
        } else {
            alert(data.message); // Display success message
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection