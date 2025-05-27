<?php $__env->startSection('content'); ?>
<style>
    a.disabled {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
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
                            <div class="product-details__thumb-slider border border-gray-100 rounded-16">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="">
                                    <div class="product-details__thumb flex-center">
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="img-responsive rounded-15">
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="mt-24">
                                <div class="product-details__images-slider">
                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <div class="max-w-120 max-h-120 h-100 flex-center border border-gray-100 rounded-15 p-0">
                                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="img-responsive rounded-15">
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="product-details__content">

                            <div class="flex-center mb-24 flex-wrap gap-16 bg-color-one rounded-8 py-16 px-24 position-relative z-1">
                                <img src="<?php echo e(asset('/frontend/assets/images/bg/details-offer-bg.png')); ?>" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1">
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
                            </div>

                            <h5 class="mb-12"><?php echo e($product->product_name); ?></h5>
                            <div class="flex-align flex-wrap gap-12">
                                <?php if($totalReviews!=0): ?>
                                <div class="flex-align gap-12 flex-wrap">
                                    <div class="flex-align gap-8">
                                        <?php
                                        $fullStars = floor($averageRating); // Number of full stars
                                        $hasHalfStar = ($averageRating - $fullStars) >= 0.5; // Half-star condition
                                        ?>
                                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            <?php endfor; ?>
                                            <?php if($hasHalfStar): ?>
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                            <?php endif; ?>
                                    </div>
                                    <span class="text-sm fw-medium text-neutral-600"><?php echo e(number_format($averageRating, 1)); ?> Star Rating</span>
                                    <span class="text-sm fw-medium text-gray-500">(<?php echo e($totalReviews); ?>)</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                            <div class="my-0 flex-align gap-16 flex-wrap">
                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-8 text-main-two-600">
                                        <i class="ph-fill ph-seal-percent text-xl"></i>
                                        -10%
                                    </div>
                                    <h6 class="mb-0">Rs <?php echo e($product->normal_price); ?></h6>
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
                                    <?php if($product->quantity > 0): ?>
                                    <span class="text-success-600">In Stock</span>
                                    <?php else: ?>
                                    <span class="text-danger-600">Out of Stock</span>
                                    <?php endif; ?>
                                </p>
                                <!-- Sizes Section -->
                                <?php if($product->variations->pluck('value')->filter()->unique()->isNotEmpty()): ?>
                                <div class="flex-between align-items-start flex-wrap gap-16">
                                    <div class="d-flex align-items-center mb-5">
                                        <span class="text-gray-900 me-3">Size:</span>
                                        <?php $__currentLoopData = $product->variations->pluck('value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button type="button"
                                            class="size_button ms-5 border border-2 border-gray-300 d-flex align-items-center justify-content-center"
                                            data-size="<?php echo e($size); ?>">
                                            <?php echo e($size); ?>

                                        </button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>


                                <!-- Colors Section -->
                                <?php if($product->variations->pluck('hex_value')->filter()->unique()->isNotEmpty()): ?>
                                <div class="flex-between align-items-center flex-wrap gap-16 mt-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <span class="text-gray-900 me-3">Color:</span>
                                        <?php $__currentLoopData = $product->variations->pluck('hex_value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button type="button"
                                            class="color-list__button w-24 h-24 border border-2 border-gray-50 rounded-circle me-2"
                                            style="background-color: <?php echo e($color); ?>;"
                                            data-color="<?php echo e($color); ?>">
                                        </button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endif; ?>

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
                        <label for="stock" class="text-lg mb-8 text-heading fw-semibold d-block">Total Stock: <?php echo e($product->quantity); ?></label>
                        <span class="text-xl d-flex">
                            <i class="ph ph-location"></i>
                        </span>
                        <div class="d-flex rounded-4 overflow-hidden">
                            <button type="button" class="quantity__minus flex-shrink-0 h-48 w-48 text-neutral-600 bg-gray-50 flex-center hover-bg-main-600 hover-text-white">
                                <i class="ph ph-minus"></i>
                            </button>
                            <input type="number" class="quantity__input flex-grow-1 border border-gray-100 border-start-0 border-end-0 text-center w-32 px-16" id="quantityInput" name="quantity" value="1" min="1">
                            <button type="button" class="quantity__plus flex-shrink-0 h-48 w-48 text-neutral-600 bg-gray-50 flex-center hover-bg-main-600 hover-text-white">
                                <i class="ph ph-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-32">
                        <div class="flex-between flex-wrap gap-8 border-bottom border-gray-100 pb-16 mb-16">
                            <span class="text-gray-500">Price</span>
                            <h6 class="text-lg mb-0 price-display"><?php echo e($product->normal_price); ?></h6>
                        </div>
                        <div class="flex-between flex-wrap gap-8">
                            <span class="text-gray-500">Shipping</span>
                            <h6 class="text-lg mb-0">Rs 350.00</h6>
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
                    <a href="<?php echo e(route('buyNow.checkout', ['product_id' => $product->id])); ?>"
                        id="buyNowBtn"
                        class="btn btn-outline-main rounded-8 fw-normal mt-16 w-100 <?php if($product->quantity == 0): ?> disabled <?php endif; ?>">
                        Buy Now
                    </a>


                    <?php else: ?>
                    <p class="text-danger">Please <a href="<?php echo e(route('login')); ?>">log in</a> to add items to the cart.</p>
                    <?php endif; ?>

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
                            <span class="text-sm text-neutral-600">Sold by: <span class="fw-semibold"><?php echo e($product->shop->shop_name ?? ''); ?></span> </span>
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
                        <img src="<?php echo e(asset('/frontend/assets/images/icon/satisfaction-icon.png')); ?>" alt="">
                        100% Satisfaction Guaranteed
                    </a>
                </div>
                <div class="product-dContent__box">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                            <div class="mb-40">
                                <h6 class="mb-24">Product Description</h6>
                                <p><?php echo e($product->product_description); ?></p>
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
                                                <?php echo e(implode(', ', $product->variations->pluck('value')->filter()->unique()->toArray())); ?>

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
                                                <?php $__currentLoopData = $product->variations->pluck('hex_value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="w-14 h-14 rounded-circle" style="background-color: <?php echo e($color); ?>;"></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="d-flex align-items-start gap-24 pb-44 border-bottom border-gray-100 mb-44">
                                            <!-- Reviewer Info -->
                                            <img src="<?php echo e(asset('/frontend/assets/images/icon/default-user.png')); ?>" alt="" class="w-52 h-52 object-fit-cover rounded-circle flex-shrink-0">
                                            <div class="flex-grow-1">
                                                <div class="flex-between align-items-start gap-8">
                                                    <div>
                                                        <h6 class="mb-12 text-md"><?php echo e($review->is_anonymous ? 'Anonymous' : $review->reviewer->name); ?></h6>
                                                        <!-- Rating -->
                                                        <div class="flex-align gap-8">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <i class="<?php echo e($review->rating >= $i ? 'fa-star fas filled' : 'far fa-star'); ?>" style="color: #ffbf00;"></i>
                                                                <?php endfor; ?>
                                                        </div>
                                                    </div>
                                                    <!-- Review Date -->
                                                    <span class="text-gray-800 text-xs"><?php echo e($review->created_at->format('d.m.Y')); ?></span>
                                                </div>
                                                <!-- Review Text -->
                                                <p class="text-gray-700"><?php echo e($review->review); ?></p>
                                                <!-- Review Media -->
                                                <?php if($review->media): ?>
                                                <div class="flex-wrap gap-8 mt-12">
                                                    <?php
                                                    $mediaFiles = is_string($review->media) ? json_decode($review->media, true) : $review->media;
                                                    ?>

                                                    <?php $__currentLoopData = $mediaFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(in_array(pathinfo($media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                    <img src="<?php echo e(asset('storage/' . $media)); ?>" alt="Review Media" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                                    <?php elseif(in_array(pathinfo($media, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'webm'])): ?>
                                                    <video controls style="width: 100px; height: 100px;">
                                                        <source src="<?php echo e(asset('storage/' . $media)); ?>" type="video/<?php echo e(pathinfo($media, PATHINFO_EXTENSION)); ?>">
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
                                                <h2 class="mb-6 text-main-600"><?php echo e(number_format($averageRating, 1)); ?></h2>
                                                <div class="flex-center gap-8">
                                                    <?php
                                                    $fullStars = floor($averageRating); // Number of full stars
                                                    $hasHalfStar = ($averageRating - $fullStars) >= 0.5; // Half-star condition
                                                    ?>
                                                    <?php for($i = 0; $i < $fullStars; $i++): ?>
                                                        <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                        <?php endfor; ?>
                                                        <?php if($hasHalfStar): ?>
                                                        <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                                        <?php endif; ?>
                                                </div>
                                                <span class="mt-16 text-gray-500">Average Product Rating</span>
                                            </div>

                                            <!-- Rating Breakdown -->
                                            <div class="border border-gray-100 rounded-8 px-24 py-40 flex-grow-1">
                                                <?php $__currentLoopData = $ratingCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                                ?>
                                                <div class="flex-align gap-8 mb-20">
                                                    <span class="text-gray-900 flex-shrink-0"><?php echo e($rating); ?></span>
                                                    <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-main-600 rounded-pill" style="width: <?php echo e($percentage); ?>%"></div>
                                                    </div>
                                                    <div class="flex-align gap-4">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <span class="text-xs fw-medium <?php echo e($rating >= $i ? 'text-warning-600' : 'text-gray-600'); ?> d-flex">
                                                            <i class="ph-fill ph-star"></i>
                                                            </span>
                                                            <?php endfor; ?>
                                                    </div>
                                                    <span class="text-gray-900 flex-shrink-0"><?php echo e($count); ?></span>
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

<!-- ========================== Similar Product Start ============================= -->
<section class="new-arrival pb-80">
    <div class="container container-lg" style="width: 90%">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0">You Might Also Like</h5>
                <div class="flex-align gap-16">
                    <a href="shop.html" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">All Products</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="new-arrival-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="new-arrival-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-arrival__slider arrow-style-two">
            <?php $__currentLoopData = $similarProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similarProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="product-card h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                    <a href="<?php echo e(route('showProductDetails', $similarProduct->product_id)); ?>" class="product-card__thumb flex-center">
                        <img src="<?php echo e(asset('storage/' . $similarProduct->images->first()->image_path)); ?>" alt="<?php echo e($similarProduct->name); ?>" style="width: 200px; height: 200px; object-fit: cover;">
                    </a>

                    <div class="product-card__content p-sm-2 w-100">
                        <h6 class="title text-lg fw-semibold mt-12 mb-8">
                            <a href="<?php echo e(route('showProductDetails', $similarProduct->product_id)); ?>" class="link text-line-2"><?php echo e($similarProduct->product_name); ?></a>
                        </h6>
                        <div class="flex-align gap-4">
                            <span class="text-main-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                            <span class="text-gray-500 text-xs">By <?php echo e($similarProduct->shop->shop_name ?? ''); ?></span>
                        </div>

                        <div class="flex-align mb-20 mt-16 gap-6">
                            <div class="rating-info d-flex gap-2">
                                <span class="text-xs fw-medium text-gray-500">4.8</span>
                                <span class="text-15 fw-medium text-warning-600 d-flex">
                                    <i class="ph-fill ph-star"></i>
                                </span>
                                <span class="text-xs fw-medium text-gray-500">(17k)</span>
                            </div>
                            <!-- Heart Icon -->
                            <button type="button" class="heart-icon ms-auto"
                                id="wishlist-icon-<?php echo e($similarProduct->product_id); ?>"
                                data-product-id="<?php echo e($similarProduct->product_id); ?>"
                                onclick="toggleWishlist(this, '<?php echo e($similarProduct->product_id); ?>')">
                                <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>



<!-- ========================== Similar Product End ============================= -->






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
    var normalPrice = parseFloat('<?php echo e($product->normal_price); ?>');

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
        const productIds = Array.from(document.querySelectorAll('.heart-icon')).map(icon => icon.getAttribute('data-product-id'));

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
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/frontend/product-details.blade.php ENDPATH**/ ?>