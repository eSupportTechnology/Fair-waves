@extends ('frontend.master')

@section('content')


<style>
    a.disabled {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
    }

    
   
     @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

*{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    font-family: 'Open Sans', sans-serif;
}
body{
    line-height: 1.5;
}
.card-wrapper{
    max-width: 1100px;
    margin: 0 auto;
}
img{
    /* width: 100%; */
    display: block;
}
.img-display{
    overflow: hidden;
}
.img-showcase{
    display: flex;
    width: 100%;
    transition: all 0.5s ease;
}
.img-showcase img{
    min-width: 100%;
}
.img-select{
    display: flex;
}
.img-item {
    margin: 0.3rem;
    width: 100px;
    height: 100px;
}


.img-item:nth-child(1),
.img-item:nth-child(2),
.img-item:nth-child(3){
    margin-right: 0;
}
.img-item:hover{
    opacity: 0.8;
}
.product-content{
    padding: 2rem 1rem;
}
.product-title{
    font-size: 3rem;
    text-transform: capitalize;
    font-weight: 700;
    position: relative;
    color: #12263a;
    margin: 1rem 0;
}
.product-title::after{
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 4px;
    width: 80px;
    background: #12263a;
}
.product-link{
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    background: #256eff;
    color: #fff;
    padding: 0 0.3rem;
    transition: all 0.5s ease;
}
.product-link:hover{
    opacity: 0.9;
}
.product-rating{
    color: #ffc107;
}
.product-rating span{
    font-weight: 600;
    color: #252525;
}
.product-price{
    margin: 1rem 0;
    font-size: 1rem;
    font-weight: 700;
}
.product-price span{
    font-weight: 400;
}
.last-price span{
    color: #f64749;
    text-decoration: line-through;
}
.new-price span{
    color: #256eff;
}
.product-detail h2{
    text-transform: capitalize;
    color: #12263a;
    padding-bottom: 0.6rem;
}
.product-detail p{
    font-size: 0.9rem;
    padding: 0.3rem;
    opacity: 0.8;
}
.product-detail ul{
    margin: 1rem 0;
    font-size: 0.9rem;
}
.product-detail ul li{
    margin: 0;
    list-style: none;
    background: url(https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
}
.product-detail ul li span{
    font-weight: 400;
}
.purchase-info{
    margin: 1.5rem 0;
}
.purchase-info input,
.purchase-info .btn{
    border: 1.5px solid #ddd;
    border-radius: 25px;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
}
.purchase-info input{
    width: 60px;
}
.purchase-info .btn{
    cursor: pointer;
    color: #fff;
}
.purchase-info .btn:first-of-type{
    background: #256eff;
}
.purchase-info .btn:last-of-type{
    background: #f64749;
}
.purchase-info .btn:hover{
    opacity: 0.9;
}
.social-links{
    display: flex;
    align-items: center;
}
.social-links a{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #000;
    border: 1px solid #000;
    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
}
.social-links a:hover{
    background: #000;
    border-color: transparent;
    color: #fff;
}

@media screen and (min-width: 992px){
    .card{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1.5rem;
    }
    .card-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-imgs{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-content{
        padding-top: 0;
    }
}
</style>






<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0"> Product Details</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="/home" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> {{ $product->product_name }} </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->



<!-- ========================== Product Details Two Start =========================== -->
<section class="product-details py-80">
    <div class="container container-lg" style="width:90%">
        <div class="row gy-4">
            <div class="col-xl-9">
                <div class="row gy-4">
                    <div class="col-xl-5">
                        <div class="product-details__left">
                           <!-- card left -->
<div class="product-imgs">
  <div class="img-display">
    <div class="img-showcase">
      @foreach ($product->images as $image)
        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->product_name }}">
      @endforeach
    </div>
  </div>

  <div class="img-select">
    @foreach ($product->images as $index => $image)
      <div class="img-item">
        <a href="#" data-id="{{ $index + 1 }}">
          <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->product_name }}">
        </a>
      </div>
    @endforeach
  </div>
</div>


                           
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="product-details__content">

                            <!-- <div class="flex-center mb-24 flex-wrap gap-16 bg-color-one rounded-8 py-16 px-24 position-relative z-1">
                                <img src="{{ asset('/frontend/assets/images/bg/details-offer-bg.png') }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1">
                                <div class="flex-align gap-16">
                                    <span class="text-white text-sm">Special Offer:</span>
                                </div>
                                <div class="countdown" id="countdown11">
                                    <ul class="countdown-list flex-align flex-wrap">
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="days"></span></li>
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="hours"></span></li>
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="minutes"></span></li>
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="seconds"></span></li>
                                    </ul>
                                </div>
                                <span class="text-white text-xs">Remains untill the end of the offer</span>
                            </div> -->

                            <h5 class="mb-12">{{ $product->product_name }}</h5>
                            <div class="flex-align flex-wrap gap-12">
                                @if ($totalReviews!=0)
                                <div class="flex-align gap-12 flex-wrap">
                                    <div class="flex-align gap-8">
                                        @php
                                        $fullStars = floor($averageRating); // Number of full stars
                                        $hasHalfStar = ($averageRating - $fullStars) >= 0.5; // Half-star condition
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            @endfor
                                            @if ($hasHalfStar)
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                            @endif
                                    </div>
                                    <span class="text-sm fw-medium text-neutral-600">{{ number_format($averageRating, 1) }} Star Rating</span>
                                    <span class="text-sm fw-medium text-gray-500">({{$totalReviews}})</span>
                                </div>
                                @endif
                            </div>
                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                            <div class="my-0 flex-align gap-16 flex-wrap">
                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-8 text-main-two-600">
                                        <i class="ph-fill ph-seal-percent text-xl"></i>
                                        -10%
                                    </div>
                                    <h6 class="mb-0">Rs {{ $product->normal_price }}</h6>
                                </div>
                                <div class="flex-align gap-8">
                                    <span class="text-gray-700">Regular Price</span>
                                    <h6 class="text-xl text-gray-400 mb-0 fw-medium">Rs 5500.00</h6>
                                </div>
                            </div>

                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                            <div class="">
                                <p class="mb-10 text-black">
                                    Availability:
                                    @if ($product->quantity > 0)
                                    <span class="text-success-600">In Stock</span>
                                    @else
                                    <span class="text-danger-600">Out of Stock</span>
                                    @endif
                                </p>
                                <!-- Sizes Section -->
                                @if ($product->variations->pluck('value')->filter()->unique()->isNotEmpty())
                                <div class="flex-between align-items-start flex-wrap gap-16">
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="text-gray-900 me-3">Size:</span>
                                        @foreach ($product->variations->pluck('value')->filter()->unique() as $size)
                                        <button type="button"
                                            class="size_button ms-5 border border-2 border-gray-300 d-flex align-items-center justify-content-center"
                                            data-size="{{ $size }}">
                                            {{ $size }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                                @endif


                                <!-- Colors Section -->
                                @if ($product->variations->pluck('hex_value')->filter()->unique()->isNotEmpty())
                                <div class="flex-between align-items-center flex-wrap gap-16 mt-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <span class="text-gray-900 me-3">Color:</span>
                                        @foreach ($product->variations->pluck('hex_value')->filter()->unique() as $color)
                                        <button type="button"
                                            class="color-list__button w-24 h-24 border border-2 border-gray-50 rounded-circle me-2"
                                            style="background-color: {{ $color }};"
                                            data-color="{{ $color }}">
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                            </div>

                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>
                            <div class="mt-0">
                                <span class="fw-medium text-gray-900">100% Guarantee Safe Checkout</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="product-details__sidebar py-40 px-32 border border-gray-100 rounded-16">
                    <div class="mb-32">
                        <label for="stock" class="text-lg mb-8 text-heading fw-semibold d-block">Total Stock: {{ $product->quantity }}</label>
                        <span class="text-xl d-flex">
                            <i class="ph ph-location"></i>
                        </span>
                        <div class="d-flex rounded-4 overflow-hidden">
                            <button type="button" class="quantity__minus flex-shrink-0 h-48 w-48 text-neutral-600 bg-gray-50 flex-center hover-bg-main-600 hover-text-white">
                                <i class="ph ph-minus"></i>
                            </button>
                            <input type="number" style="height: 48px;" class="quantity__input flex-grow-1 border border-gray-100 border-start-0 border-end-0 text-center w-32 px-16 " id="quantityInput" name="quantity" value="1" min="1">
                            <button type="button" class="quantity__plus flex-shrink-0 h-48 w-48 text-neutral-600 bg-gray-50 flex-center hover-bg-main-600 hover-text-white">
                                <i class="ph ph-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-32">
                        <div class="flex-between flex-wrap gap-8 border-bottom border-gray-100 pb-16 mb-16">
                            <span class="text-gray-500">Price</span>
                            <h6 class="text-lg mb-0 price-display">{{ $product->normal_price }}</h6>
                        </div>
                        <div class="flex-between flex-wrap gap-8">
                            <span class="text-gray-500">Shipping</span>
                            <h6 class="text-lg mb-0">Rs 350.00</h6>
                        </div>
                    </div>

                    @auth
                    <!-- Add To Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="size" id="selectedSize">
                        <input type="hidden" name="color" id="selectedColor">
                        <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                        <input type="hidden" name="price" id="hiddenPrice" value="{{ $product->normal_price }}">

                        <!-- Add To Cart Button -->
                        <button type="submit" class="btn btn-main w-100"
                            @if ($product->quantity == 0) disabled @endif>
                            Add To Cart
                        </button>
                    </form>


                    <!-- Buy Now Button -->
                    <a href="{{ route('buyNow.checkout', ['product_id' => $product->id]) }}"
                        id="buyNowBtn"
                        class="btn btn-outline-main rounded-8 fw-normal mt-16 w-100 @if ($product->quantity == 0) disabled @endif">
                        Buy Now
                    </a>


                    @else
                    <p class="text-danger">Please <a href="{{ route('login') }}">log in</a> to add items to the cart.</p>
                    @endauth

                    <div class="mt-32">
                        <div class="px-16 py-8 bg-main-50 rounded-8 flex-between gap-24 mb-14">
                            <span class="w-32 h-32 bg-white text-main-600 rounded-circle flex-center text-xl flex-shrink-0">
                                <i class="ph-fill ph-truck"></i>
                            </span>
                            <span class="text-sm text-neutral-600">Ship from <span class="fw-semibold">DK Mart</span> </span>
                        </div>
                        <div class="px-16 py-8 bg-main-50 rounded-8 flex-between gap-24 mb-0">
                            <span class="w-32 h-32 bg-white text-main-600 rounded-circle flex-center text-xl flex-shrink-0">
                                <i class="ph-fill ph-storefront"></i>
                            </span>
                            <span class="text-sm text-neutral-600">Sold by: <span class="fw-semibold">{{ $product->shop->shop_name ?? '' }}</span> </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="pt-80">
            <div class="product-dContent border rounded-24">
                <div class="product-dContent__header border-bottom border-gray-100 flex-between flex-wrap gap-16">
                    <ul class="nav common-tab nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <a href="#" class="btn bg-color-one rounded-16 flex-align gap-8 text-main-600 hover-bg-main-600 hover-text-white">
                        <img src="{{ asset('/frontend/assets/images/icon/satisfaction-icon.png') }}" alt="">
                        100% Satisfaction Guaranteed
                    </a>
                </div>
                <div class="product-dContent__box">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                            <div class="mb-40">
                                <h6 class="mb-24">Product Description</h6>
                                <p>{{ $product->product_description }}</p>
                            </div>
                            <div class="mb-40">
                                <h6 class="mb-24">Product Specifications</h6>
                                <ul class="mt-32">
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Available sizes:
                                            <span class="text-gray-500">
                                                {{ implode(', ', $product->variations->pluck('value')->filter()->unique()->toArray()) }}
                                            </span>
                                        </span>
                                    </li>
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Available colors:
                                            <span class="text-gray-500  gap-4">
                                                @foreach($product->variations->pluck('hex_value')->filter()->unique() as $color)
                                                <span class="w-14 h-14 rounded-circle" style="background-color: {{ $color }};"></span>
                                                @endforeach
                                            </span>
                                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <h6 class="mb-24">Product Reviews</h6>
                                    <div class="reviews">
                                        @forelse($reviews as $review)
                                        <div class="d-flex align-items-start gap-24 pb-44 border-bottom border-gray-100 mb-44">
                                            <!-- Reviewer Info -->
                                            <img src="{{ asset('/frontend/assets/images/icon/default-user.png') }}" alt="" class="w-52 h-52 object-fit-cover rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <div class="flex-between align-items-start gap-8">
                                                    <div>
                                                        <h6 class="mb-12 text-md">{{ $review->is_anonymous ? 'Anonymous' : $review->reviewer->name }}</h6>
                                                        <!-- Rating -->
                                                        <div class="flex-align gap-8">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="{{ $review->rating >= $i ? 'fa-star fas filled' : 'far fa-star' }}" style="color: #ffbf00;"></i>
                                                                @endfor
                                                        </div>
                                                    </div>
                                                    <!-- Review Date -->
                                                    <span class="text-gray-800 text-xs">{{ $review->created_at->format('d.m.Y') }}</span>
                                                </div>
                                                <!-- Review Text -->
                                                <p class="text-gray-700">{{ $review->review }}</p>
                                                <!-- Review Media -->
                                                @if($review->media)
                                                <div class="flex-wrap gap-8 mt-12">
                                                    @php
                                                    $mediaFiles = is_string($review->media) ? json_decode($review->media, true) : $review->media;
                                                    @endphp

                                                    @foreach ($mediaFiles as $media)
                                                    @if (in_array(pathinfo($media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset('storage/' . $media) }}" alt="Review Media" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                                    @elseif (in_array(pathinfo($media, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'webm']))
                                                    <video controls style="width: 100px; height: 100px;">
                                                        <source src="{{ asset('storage/' . $media) }}" type="video/{{ pathinfo($media, PATHINFO_EXTENSION) }}">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @empty
                                        <p>No reviews available for this product.</p>
                                        @endforelse
                                    </div>


                                    <!-- <div class="mt-56">
                                        <div class="">
                                            <h6 class="mb-24">Write a Review</h6>
                                            <span class="text-heading mb-8">What is it like to Product?</span>
                                            <div class="flex-align gap-8">
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            </div>
                                        </div>
                                        <div class="mt-32">
                                            <form action="#">   
                                                <div class="mb-32">
                                                    <label for="title" class="text-neutral-600 mb-8">Review Title</label>
                                                    <input type="text" class="common-input rounded-8" id="title" placeholder="Great Products">
                                                </div>
                                                <div class="mb-32">
                                                    <label for="desc" class="text-neutral-600 mb-8">Review Content</label>
                                                    <textarea class="common-input rounded-8" id="desc">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-main rounded-pill mt-48">Submit Review</button>
                                            </form>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="ms-xxl-5">
                                        <h6 class="mb-24">Customers Feedback</h6>
                                        <div class="d-flex flex-wrap gap-44">
                                            <!-- Average Rating -->
                                            <div class="border border-gray-100 rounded-8 px-40 py-52 flex-center flex-column flex-shrink-0 text-center">
                                                <h2 class="mb-6 text-main-600">{{ number_format($averageRating, 1) }}</h2>
                                                <div class="flex-center gap-8">
                                                    @php
                                                    $fullStars = floor($averageRating); // Number of full stars
                                                    $hasHalfStar = ($averageRating - $fullStars) >= 0.5; // Half-star condition
                                                    @endphp
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                        @endfor
                                                        @if ($hasHalfStar)
                                                        <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                                        @endif
                                                </div>
                                                <span class="mt-16 text-gray-500">Average Product Rating</span>
                                            </div>

                                            <!-- Rating Breakdown -->
                                            <div class="border border-gray-100 rounded-8 px-24 py-40 flex-grow-1">
                                                @foreach ($ratingCounts as $rating => $count)
                                                @php
                                                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                                @endphp
                                                <div class="flex-align gap-8 mb-20">
                                                    <span class="text-gray-900 flex-shrink-0">{{ $rating }}</span>
                                                    <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-main-600 rounded-pill" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                    <div class="flex-align gap-4">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <span class="text-xs fw-medium {{ $rating >= $i ? 'text-warning-600' : 'text-gray-600' }} d-flex">
                                                            <i class="ph-fill ph-star"></i>
                                                            </span>
                                                            @endfor
                                                    </div>
                                                    <span class="text-gray-900 flex-shrink-0">{{ $count }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- ========================== Product Details Two End =========================== -->






   



<script>

const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

</script>




























































<!-- =================================================================================================================== -->






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.querySelectorAll('.size_button').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.size_button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            document.getElementById('selectedSize').value = button.getAttribute('data-size');
        });
    });

    document.querySelectorAll('.color-list__button').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.color-list__button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            document.getElementById('selectedColor').value = button.getAttribute('data-color');
        });
    });
</script>

<script>
    var minus = $('.quantity__minus');
    var plus = $('.quantity__plus');
    var normalPrice = parseFloat('{{ $product->normal_price }}');

    $(plus).on('click', function() {
        var input = $(this).siblings('.quantity__input');
        var value = parseInt(input.val());
        value++; // Increment value
        input.val(value);

        updatePrice(value);
    });

    $(minus).on('click', function() {
        var input = $(this).siblings('.quantity__input');
        var value = parseInt(input.val());
        if (value > 1) {
            value--;
        }
        input.val(value);

        updatePrice(value);
    });

    function updatePrice(quantity) {
        var newPrice = (normalPrice * quantity).toFixed(2);
        $('.price-display').text(newPrice);
        $('#hiddenQuantity').val(quantity);
        $('#hiddenPrice').val(newPrice);
    }

    $(document).ready(function() {
        var initialQuantity = parseInt($('#quantityInput').val());
        updatePrice(initialQuantity);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Track the selected size and color
        let selectedSize = null;
        let selectedColor = null;
        const productHasSize = document.querySelectorAll('.size_button').length > 0;
        const productHasColor = document.querySelectorAll('.color-list__button').length > 0;

        // Add event listener for size buttons
        document.querySelectorAll('.size_button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.size_button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                selectedSize = button.getAttribute('data-size');
                document.getElementById('selectedSize').value = selectedSize;
            });
        });

        // Add event listener for color buttons
        document.querySelectorAll('.color-list__button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.color-list__button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                selectedColor = button.getAttribute('data-color');
                document.getElementById('selectedColor').value = selectedColor;
            });
        });

        // Handle Add to Cart form submission
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            // Check if size/color are required and selected
            if ((productHasSize && !selectedSize) || (productHasColor && !selectedColor)) {
                e.preventDefault();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select both a size and a color to proceed.',
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });


    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedSize = null;
        let selectedColor = null;

        const productHasSize = document.querySelectorAll('.size_button').length > 0;
        const productHasColor = document.querySelectorAll('.color-list__button').length > 0;

        // Size selection event listener
        document.querySelectorAll('.size_button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.size_button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                selectedSize = button.getAttribute('data-size');
            });
        });

        // Color selection event listener
        document.querySelectorAll('.color-list__button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.color-list__button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                selectedColor = button.getAttribute('data-color').replace('#', '');
            });
        });

        // Handle "Buy Now" button click
        document.getElementById('buyNowBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const quantity = document.getElementById('quantityInput').value || 1;

            if ((productHasSize && !selectedSize) || (productHasColor && !selectedColor)) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select both a size and a color to proceed.',
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    7
                    timerProgressBar: true
                });
            } else {
                const url = new URL("{{ url('/buy-now-checkout/' . $product->id) }}");
                url.searchParams.append('selectedSize', selectedSize || '');
                url.searchParams.append('selectedColor', selectedColor || '');
                url.searchParams.append('quantity', quantity);
                window.location.href = url;
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all product IDs in the similar products section
        const productIds = Array.from(document.querySelectorAll('.heart-icon')).map(icon => icon.getAttribute('data-product-id'));

        // Check if each product is in the wishlist
        productIds.forEach(productId => {
            fetch(`/wishlist/check/${productId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.in_wishlist) {
                        // If product is in wishlist, mark the heart icon as active
                        const heartIcon = document.querySelector(`#wishlist-icon-${productId}`);
                        if (heartIcon) {
                            heartIcon.classList.add('active');
                            heartIcon.querySelector('i').classList.replace('fa-regular', 'fa-solid');
                            heartIcon.querySelector('i').style.color = 'red';
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    // Function to toggle wishlist
    function toggleWishlist(button, productId) {
        // Toggle active state for heart icon
        button.classList.toggle('active');

        if (button.classList.contains('active')) {
            button.querySelector('i').classList.replace('fa-regular', 'fa-solid');
            button.querySelector('i').style.color = 'red';
        } else {
            button.querySelector('i').classList.replace('fa-solid', 'fa-regular');
            button.querySelector('i').style.color = '#ccc';
        }

        // Send request to toggle wishlist
        fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection