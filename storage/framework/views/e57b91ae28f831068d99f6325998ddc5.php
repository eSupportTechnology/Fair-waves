<?php $__env->startSection('content'); ?>

<?php
    use App\Models\DealerProductLink;
?>

    <style>
        a.disabled {
            pointer-events: none;
            opacity: 0.6;
            cursor: not-allowed;
        }



        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            line-height: 1.5;
        }

        .card-wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        .img {
            /* width: 100%; */
            display: block;
        }

        .img-display {
            overflow: hidden;
        }

        .img-showcase {
            display: flex;
            width: 100%;
            transition: all 0.5s ease;
        }

        .img-showcase img {
            min-width: 100%;
        }

        .img-select {
            display: flex;
        }

        .img-item {
            margin: 0.3rem;
            width: 100px;
            height: 100px;
        }


        .img-item:nth-child(1),
        .img-item:nth-child(2),
        .img-item:nth-child(3) {
            margin-right: 0;
        }

        .img-item:hover {
            opacity: 0.8;
        }

        .product-content {
            padding: 2rem 1rem;
        }

      .product-title {

        text-transform: capitalize;
        font-weight: 700;
        position: relative;
        color: #12263a;
        margin: 1rem 0;
    } */

     .product-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 80px;
        background: #12263a;
    }

        .product-link {
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

        .product-link:hover {
            opacity: 0.9;
        }

        .product-rating {
            color: #ffc107;
        }

        .product-rating span {
            font-weight: 600;
            color: #252525;
        }

        .product-price {
            margin: 1rem 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .product-price span {
            font-weight: 400;
        }

        .last-price span {
            color: #f64749;
            text-decoration: line-through;
        }

        .new-price span {
            color: #256eff;
        }

        .product-detail h2 {
            text-transform: capitalize;
            color: #12263a;
            padding-bottom: 0.6rem;
        }

        .product-detail p {
            font-size: 0.9rem;
            padding: 0.3rem;
            opacity: 0.8;
        }

        .product-detail ul {
            margin: 1rem 0;
            font-size: 0.9rem;
        }

        .product-detail ul li {
            margin: 0;
            list-style: none;
            background: url(https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/checked.png) left center no-repeat;
            background-size: 18px;
            padding-left: 1.7rem;
            margin: 0.4rem 0;
            font-weight: 600;
            opacity: 0.9;
        }

        .product-detail ul li span {
            font-weight: 400;
        }

        .purchase-info {
            margin: 1.5rem 0;
        }

        .purchase-info input,
        .purchase-info .btn {
            border: 1.5px solid #ddd;
            border-radius: 25px;
            text-align: center;
            padding: 0.45rem 0.8rem;
            outline: 0;
            margin-right: 0.2rem;
            margin-bottom: 1rem;
        }

        .purchase-info input {
            width: 60px;
        }

        .purchase-info .btn {
            cursor: pointer;
            color: #fff;
        }

        .purchase-info .btn:first-of-type {
            background: #256eff;
        }

        .purchase-info .btn:last-of-type {
            background: #f64749;
        }

        .purchase-info .btn:hover {
            opacity: 0.9;
        }

        .social-links {
            display: flex;
            align-items: center;
        }

        .social-links a {
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

        .social-links a:hover {
            background: #000;
            border-color: transparent;
            color: #fff;
        }

        @media screen and (min-width: 992px) {
            .card {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 1.5rem;
            }

            .card-wrapper {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .product-imgs {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .product-content {
                padding-top: 0;
            }
        }
    </style>






<!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50" style="margin-top: 120px">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0"> Product Details</h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="/" class="gap-8 text-gray-900 flex-align hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> <?php echo e($product->product_name); ?> </li>
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
                                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <img class="img" src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                                    alt="<?php echo e($product->product_name); ?>">
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                    <div class="img-select">
                                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="img-item">
                                                <a href="#" data-id="<?php echo e($index + 1); ?>">
                                                    <img class="img" src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                                        alt="<?php echo e($product->product_name); ?>">
                                                </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>



                            </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="product-details__content">

                                <!-- <div class="flex-wrap gap-16 px-24 py-16 mb-24 flex-center bg-color-one rounded-8 position-relative z-1">
                                            <img src="<?php echo e(asset('/frontend/assets/images/bg/details-offer-bg.png')); ?>" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1">
                                            <div class="gap-16 flex-align">
                                                <span class="text-sm text-white">Special Offer:</span>
                                            </div>
                                            <div class="countdown" id="countdown11">
                                                <ul class="flex-wrap countdown-list flex-align">
                                                    <li class="gap-4 p-0 text-xs border countdown-list__item text-heading flex-align fw-medium w-28 h-28 rounded-4 border-main-600 flex-center"><span class="days"></span></li>
                                                    <li class="gap-4 p-0 text-xs border countdown-list__item text-heading flex-align fw-medium w-28 h-28 rounded-4 border-main-600 flex-center"><span class="hours"></span></li>
                                                    <li class="gap-4 p-0 text-xs border countdown-list__item text-heading flex-align fw-medium w-28 h-28 rounded-4 border-main-600 flex-center"><span class="minutes"></span></li>
                                                    <li class="gap-4 p-0 text-xs border countdown-list__item text-heading flex-align fw-medium w-28 h-28 rounded-4 border-main-600 flex-center"><span class="seconds"></span></li>
                                                </ul>
                                            </div>
                                            <span class="text-xs text-white">Remains untill the end of the offer</span>
                                        </div> -->

                                <h5 class="mb-12"><?php echo e($product->product_name); ?></h5>
                                <div class="flex-wrap gap-12 flex-align">
                                    <?php if($totalReviews != 0): ?>
                                        <div class="flex-wrap gap-12 flex-align">
                                            <div class="gap-8 flex-align">
                                                <?php
                                                    $fullStars = floor($averageRating); // Number of full stars
                                                    $hasHalfStar = $averageRating - $fullStars >= 0.5; // Half-star condition
                                                ?>
                                                <?php for($i = 0; $i < $fullStars; $i++): ?>
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i
                                                            class="ph-fill ph-star"></i></span>
                                                <?php endfor; ?>
                                                <?php if($hasHalfStar): ?>
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i
                                                            class="ph-fill ph-star-half"></i></span>
                                                <?php endif; ?>
                                            </div>
                                            <span
                                                class="text-sm fw-medium text-neutral-600"><?php echo e(number_format($averageRating, 1)); ?>

                                                Star Rating</span>
                                            <span class="text-sm text-gray-500 fw-medium">(<?php echo e($totalReviews); ?>)</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <span class="pt-32 mt-32 text-gray-700 border-gray-100 border-top d-block"></span>

                                <div class="my-0 flex-align gap-16 flex-wrap">
                                <!-- class="flex-align gap-8">
                                    <div class="flex-align gap-8 text-main-two-600">
                                        <i class="ph-fill ph-seal-percent  ext-xl"></i>
                                        -10%
                                    </div>
                                    <h6 class="mb-0">Rs <?php echo e($product->normal_price); ?></h6>
                                </div-->
                                <div class="flex-align gap-8">
                                    <span class="text-gray-700"> Price</span>
                                    <h6 class="text-xl text-gray-400 mb-0 fw-medium">Rs <?php echo e($product->normal_price); ?>

                                    <?php if(Auth::check() && Auth::user()->role === 'dealer'): ?>
              (<?php echo e($product->bv ? $product->bv : '0'); ?> IV)
                <?php endif; ?>
                                    </h6>
                                </div>
                                <?php if(Auth::check() && Auth::user()->role === 'dealer'): ?>
                                    <?php
                                        // Check if the dealer has already generated the link for this product
                                        $linkGenerated = DealerProductLink::where('dealer_id', Auth::user()->id)
                                            ->where('product_id', $product->id)
                                            ->first();
                                    ?>
                                    <div class="mt-2">
                                        <?php if($linkGenerated): ?>
                                            <button class="btn btn-success" disabled>
                                                Link Generated
                                            </button>
                                            <a href="/showroom/<?php echo e($linkGenerated->dealer->dealerProfile->dealer_shop_name); ?>/product/<?php echo e($linkGenerated->unique_code); ?>" class="btn btn-outline-success ms-2" style="background-color: #ff9800; color: #fff; border-color: #ff9800;"
                                               onmouseover="this.style.backgroundColor='#e65100'; this.style.color='#fff';"
                                               onmouseout="this.style.backgroundColor='#ff9800'; this.style.color='#fff';">
                                                View Link
                                            </a>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('dealer.link.generate')); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                <button type="submit" class="btn btn-main">
                                                    Generate Link
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>


                            </div>

                                <span class="pt-32 mt-32 text-gray-700 border-gray-100 border-top d-block"></span>

                                <div class="">
                                    <p class="mb-10 text-black">
                                        Availability:
                                        <?php if($product->quantity > 0): ?>
                                            <span class="text-success-600">In Stock</span>
                                        <?php else: ?>
                                            <span class="text-danger-600">Out of Stock</span>
                                        <?php endif; ?>
                                    </p>
                                    <!-- Sizes Section -->
                                    <?php if($product->variations->pluck('value')->filter()->unique()->isNotEmpty()): ?>
                                        <div class="flex-wrap gap-16 flex-between align-items-start">
                                            <div class="mb-5 d-flex align-items-center">
                                                <span class="text-gray-900 me-3">Size:</span>
                                                <?php $__currentLoopData = $product->variations->pluck('value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <button type="button"
                                                        class="border border-2 border-gray-300 size_button ms-5 d-flex align-items-center justify-content-center"
                                                        data-size="<?php echo e($size); ?>">
                                                        <?php echo e($size); ?>

                                                    </button>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                    <!-- Colors Section -->
                                    <?php if($product->variations->pluck('hex_value')->filter()->unique()->isNotEmpty()): ?>
                                        <div class="flex-wrap gap-16 mt-4 flex-between align-items-center">
                                            <div class="mb-4 d-flex align-items-center">
                                                <span class="text-gray-900 me-3">Color:</span>
                                                <?php $__currentLoopData = $product->variations->pluck('hex_value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <button type="button"
                                                        class="w-24 h-24 border border-2 color-list__button border-gray-50 rounded-circle me-2"
                                                        style="background-color: <?php echo e($color); ?>;"
                                                        data-color="<?php echo e($color); ?>">
                                                    </button>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <span class="pt-32 mt-32 text-gray-700 border-gray-100 border-top d-block"></span>
                                <div class="mt-0">
                                    <span class="text-gray-900 fw-medium">100% Guarantee Safe Checkout</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="px-32 py-40 border border-gray-100 product-details__sidebar rounded-16">
                        <div class="mb-32">
                            <label for="stock" class="mb-8 text-lg text-heading fw-semibold d-block">Total Stock:
                                <?php echo e($product->quantity); ?></label>
                            <span class="text-xl d-flex">
                                <i class="ph ph-location"></i>
                            </span>
                            <div class="overflow-hidden d-flex rounded-4">
                                <button type="button"
                                    class="flex-shrink-0 w-48 h-48 quantity__minus text-neutral-600 bg-gray-50 flex-center hover-bg-main-600 hover-text-white">
                                    <i class="ph ph-minus"></i>
                                </button>
                                <input type="number" style="height: 48px;"
                                    class="w-32 px-16 text-center border border-gray-100 quantity__input flex-grow-1 border-start-0 border-end-0 "
                                    id="quantityInput" name="quantity" value="1" min="1">
                                <button type="button"
                                    class="flex-shrink-0 w-48 h-48 quantity__plus text-neutral-600 bg-gray-50 flex-center hover-bg-main-600 hover-text-white">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-32">
                            <div class="flex-wrap gap-8 pb-16 mb-16 border-gray-100 flex-between border-bottom">
                                <span class="text-gray-500">Price</span>
                                <h6 class="mb-0 text-lg price-display"><?php echo e($product->normal_price ? $product->normal_price : $product->price); ?> </h6>
                            </div>
                            <div class="flex-wrap gap-8 flex-between">
                                <span class="text-gray-500">Shipping</span>
                                <h6 class="mb-0 text-lg">Rs 350.00</h6>
                            </div>
                        </div>

                        <?php if(auth()->guard()->check()): ?>
                            <!-- Add To Cart Form -->
                            <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="addToCartForm">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                <input type="hidden" name="size" id="selectedSize">
                                <input type="hidden" name="color" id="selectedColor">
                                <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                <input type="hidden" name="price" id="hiddenPrice" value="<?php echo e($product->normal_price); ?>">

                                <!-- Add To Cart Button -->
                                <button type="submit" class="btn btn-main w-100"
                                    <?php if($product->quantity == 0): ?> disabled <?php endif; ?>>
                                    Add To Cart
                                </button>
                            </form>


                            <!-- Buy Now Button -->
                            <a href="<?php echo e(route('buyNow.checkout', ['product_id' => $product->id])); ?>" id="buyNowBtn"
                                class="btn btn-outline-main rounded-8 fw-normal mt-16 w-100 <?php if($product->quantity == 0): ?> disabled <?php endif; ?>">
                                Buy Now
                            </a>
                        <?php else: ?>
                            <p class="text-danger">Please <a href="<?php echo e(route('login')); ?>">log in</a> to add items to the cart.
                            </p>
                        <?php endif; ?>

                        <div class="mt-32">
                            <div class="gap-24 px-16 py-8 bg-main-50 rounded-8 flex-between mb-14">
                                <span
                                    class="flex-shrink-0 w-32 h-32 text-xl bg-white text-main-600 rounded-circle flex-center">
                                    <i class="ph-fill ph-truck"></i>
                                </span>
                                <span class="text-sm text-neutral-600">Ship from <span class="fw-semibold">Fair Waves</span>
                                </span>
                            </div>
                            <div class="gap-24 px-16 py-8 mb-0 bg-main-50 rounded-8 flex-between">
                                <span
                                    class="flex-shrink-0 w-32 h-32 text-xl bg-white text-main-600 rounded-circle flex-center">
                                    <i class="ph-fill ph-storefront"></i>
                                </span>
                                <span class="text-sm text-neutral-600">Sold by: <span class="fw-semibold">Fair Waves</span> </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-80">
                <div class="border product-dContent rounded-24">
                    <div class="flex-wrap gap-16 border-gray-100 product-dContent__header border-bottom flex-between">
                        <ul class="mb-3 nav common-tab nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-description" type="button" role="tab"
                                    aria-controls="pills-description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-reviews" type="button" role="tab"
                                    aria-controls="pills-reviews" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <a href="#"
                            class="gap-8 btn bg-color-one rounded-16 flex-align text-main-600 hover-bg-main-600 hover-text-white">
                            <img class="img" src="<?php echo e(asset('/frontend/assets/images/icon/satisfaction-icon.png')); ?>"
                                alt="">
                            100% Satisfaction Guaranteed
                        </a>
                    </div>
                    <div class="product-dContent__box">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                aria-labelledby="pills-description-tab" tabindex="0">
                                <div class="mb-40">
                                    <h6 class="mb-24">Product Description</h6>
                                    <p><?php echo e($product->product_description); ?></p>
                                </div>
                                <?php
                                    $sizes = $product->variations->pluck('value')->filter()->unique();
                                    $colors = $product->variations->pluck('hex_value')->filter()->unique();
                                ?>

                                <?php if($sizes->isNotEmpty() || $colors->isNotEmpty()): ?>
                                    <div class="mb-40">
                                        <h6 class="mb-24">Product Specifications</h6>
                                        <ul class="mt-32">

                                            
                                            <?php if($sizes->isNotEmpty()): ?>
                                                <li class="text-gray-400 mb-14 flex-align gap-14">
                                                    <span
                                                        class="w-20 h-20 text-xs bg-main-50 text-main-600 flex-center rounded-circle">
                                                        <i class="ph ph-check"></i>
                                                    </span>
                                                    <span class="text-heading fw-medium">
                                                        Available sizes:
                                                        <span class="text-gray-500">
                                                            <?php echo e(implode(', ', $sizes->toArray())); ?>

                                                        </span>
                                                    </span>
                                                </li>
                                            <?php endif; ?>

                                    
                                    <?php if($colors->isNotEmpty()): ?>
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 text-xs bg-main-50 text-main-600 flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Available colors:
                                            <span class="flex-wrap gap-4 text-gray-500 d-inline-flex">
                                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="w-14 h-14 rounded-circle me-1" style="background-color: <?php echo e($color); ?>;"></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        </span>
                                    </li>
                                    <?php endif; ?>

                                        </ul>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="tab-pane fade" id="pills-reviews" role="tabpanel"
                                aria-labelledby="pills-reviews-tab" tabindex="0">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <h6 class="mb-24">Product Reviews</h6>
                                        <div class="reviews">
                                            <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div
                                                    class="gap-24 border-gray-100 d-flex align-items-start pb-44 border-bottom mb-44">
                                                    <!-- Reviewer Info -->
                                                    <img src="<?php echo e(asset('/frontend/assets/images/icon/default-user.png')); ?>"
                                                        alt=""
                                                        class="flex-shrink-0 w-52 h-52 object-fit-cover rounded-circle">
                                                    <div class="flex-grow-1">
                                                        <div class="gap-8 flex-between align-items-start">
                                                            <div>
                                                                <h6 class="mb-12 text-md">
                                                                    <?php echo e($review->is_anonymous ? 'Anonymous' : $review->reviewer->name); ?>

                                                                </h6>
                                                                <!-- Rating -->
                                                                <div class="gap-8 flex-align">
                                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                                        <i class="<?php echo e($review->rating >= $i ? 'fa-star fas filled' : 'far fa-star'); ?>"
                                                                            style="color: #ffbf00;"></i>
                                                                    <?php endfor; ?>
                                                                </div>
                                                            </div>
                                                            <!-- Review Date -->
                                                            <span
                                                                class="text-xs text-gray-800"><?php echo e($review->created_at->format('d.m.Y')); ?></span>
                                                        </div>
                                                        <!-- Review Text -->
                                                        <p class="text-gray-700"><?php echo e($review->review); ?></p>
                                                        <!-- Review Media -->
                                                        <?php if($review->media): ?>
                                                            <div class="flex-wrap gap-8 mt-12">
                                                                <?php
                                                                    $mediaFiles = is_string($review->media)
                                                                        ? json_decode($review->media, true)
                                                                        : $review->media;
                                                                ?>

                                                                <?php $__currentLoopData = $mediaFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(in_array(pathinfo($media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                                        <img src="<?php echo e(asset('storage/' . $media)); ?>"
                                                                            alt="Review Media" class="img-thumbnail"
                                                                            style="width: 100px; height: 100px; object-fit: cover;">
                                                                    <?php elseif(in_array(pathinfo($media, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'webm'])): ?>
                                                                        <video controls
                                                                            style="width: 100px; height: 100px;">
                                                                            <source src="<?php echo e(asset('storage/' . $media)); ?>"
                                                                                type="video/<?php echo e(pathinfo($media, PATHINFO_EXTENSION)); ?>">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <p>No reviews available for this product.</p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- <div class="mt-56">
                                                    <div class="">
                                                        <h6 class="mb-24">Write a Review</h6>
                                                        <span class="mb-8 text-heading">What is it like to Product?</span>
                                                        <div class="gap-8 flex-align">
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
                                                                <label for="title" class="mb-8 text-neutral-600">Review Title</label>
                                                                <input type="text" class="common-input rounded-8" id="title" placeholder="Great Products">
                                                            </div>
                                                            <div class="mb-32">
                                                                <label for="desc" class="mb-8 text-neutral-600">Review Content</label>
                                                                <textarea class="common-input rounded-8" id="desc">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</textarea>
                                                            </div>
                                                            <button type="submit" class="mt-48 btn btn-main rounded-pill">Submit Review</button>
                                                        </form>
                                                    </div>
                                                </div> -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="ms-xxl-5">
                                            <h6 class="mb-24">Customers Feedback</h6>
                                            <div class="flex-wrap d-flex gap-44">
                                                <!-- Average Rating -->
                                                <div
                                                    class="flex-shrink-0 px-40 text-center border border-gray-100 rounded-8 py-52 flex-center flex-column">
                                                    <h2 class="mb-6 text-main-600"><?php echo e(number_format($averageRating, 1)); ?>

                                                    </h2>
                                                    <div class="gap-8 flex-center">
                                                        <?php
                                                            $fullStars = floor($averageRating); // Number of full stars
                                                            $hasHalfStar = $averageRating - $fullStars >= 0.5; // Half-star condition
                                                        ?>
                                                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i
                                                                    class="ph-fill ph-star"></i></span>
                                                        <?php endfor; ?>
                                                        <?php if($hasHalfStar): ?>
                                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i
                                                                    class="ph-fill ph-star-half"></i></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <span class="mt-16 text-gray-500">Average Product Rating</span>
                                                </div>

                                                <!-- Rating Breakdown -->
                                                <div class="px-24 py-40 border border-gray-100 rounded-8 flex-grow-1">
                                                    <?php $__currentLoopData = $ratingCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $percentage =
                                                                $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                                        ?>
                                                        <div class="gap-8 mb-20 flex-align">
                                                            <span
                                                                class="flex-shrink-0 text-gray-900"><?php echo e($rating); ?></span>
                                                            <div class="h-8 bg-gray-100 progress w-100 rounded-pill"
                                                                role="progressbar" aria-label="Basic example"
                                                                aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                <div class="progress-bar bg-main-600 rounded-pill"
                                                                    style="width: <?php echo e($percentage); ?>%"></div>
                                                            </div>
                                                            <div class="gap-4 flex-align">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <span
                                                                        class="text-xs fw-medium <?php echo e($rating >= $i ? 'text-warning-600' : 'text-gray-600'); ?> d-flex">
                                                                        <i class="ph-fill ph-star"></i>
                                                                    </span>
                                                                <?php endfor; ?>
                                                            </div>
                                                            <span
                                                                class="flex-shrink-0 text-gray-900"><?php echo e($count); ?></span>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

        function slideImage() {
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
                document.querySelectorAll('.color-list__button').forEach(btn => btn.classList.remove(
                    'active'));
                button.classList.add('active');
                document.getElementById('selectedColor').value = button.getAttribute('data-color');
            });
        });
    </script>

    <script>
        var minus = $('.quantity__minus');
        var plus = $('.quantity__plus');
        var input = $('#quantityInput');
        var normalPrice = parseFloat('<?php echo e($product->normal_price); ?>');

        function updatePrice(quantity) {
            var newPrice = (normalPrice * quantity).toFixed(2);
            $('.price-display').text(newPrice);
            $('#hiddenQuantity').val(quantity);
            $('#hiddenPrice').val(newPrice);
        }

        $(plus).on('click', function() {
            var value = parseInt(input.val());
            value++;
            input.val(value);
            updatePrice(value);
        });

        $(minus).on('click', function() {
            var value = parseInt(input.val());
            if (value > 1) {
                value--;
            }
            input.val(value);
            updatePrice(value);
        });

        // ✅ Manual typing - price update
        input.on('input', function() {
            var value = parseInt($(this).val());

            updatePrice(value);
        });

        // ✅ On page load, calculate price
        $(document).ready(function() {
            var initialQuantity = parseInt(input.val());
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
                    document.querySelectorAll('.size_button').forEach(btn => btn.classList.remove(
                        'active'));
                    button.classList.add('active');
                    selectedSize = button.getAttribute('data-size');
                    document.getElementById('selectedSize').value = selectedSize;
                });
            });

            // Add event listener for color buttons
            document.querySelectorAll('.color-list__button').forEach(button => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.color-list__button').forEach(btn => btn.classList
                        .remove('active'));
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
                    document.querySelectorAll('.size_button').forEach(btn => btn.classList.remove(
                        'active'));
                    button.classList.add('active');
                    selectedSize = button.getAttribute('data-size');
                });
            });

            // Color selection event listener
            document.querySelectorAll('.color-list__button').forEach(button => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.color-list__button').forEach(btn => btn.classList
                        .remove('active'));
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
                    const url = new URL("<?php echo e(url('/buy-now-checkout/' . $product->id)); ?>");
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
            const productIds = Array.from(document.querySelectorAll('.heart-icon')).map(icon => icon.getAttribute(
                'data-product-id'));

            // Check if each product is in the wishlist
            productIds.forEach(productId => {
                fetch(`/wishlist/check/${productId}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.in_wishlist) {
                            // If product is in wishlist, mark the heart icon as active
                            const heartIcon = document.querySelector(`#wishlist-icon-${productId}`);
                            if (heartIcon) {
                                heartIcon.classList.add('active');
                                heartIcon.querySelector('i').classList.replace('fa-regular',
                                    'fa-solid');
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
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/product-details.blade.php ENDPATH**/ ?>