<?php $__env->startSection('content'); ?>
<!-- =============================== Shop Section Start ======================================== -->
<section class="shop py-80">
    <div class="container container-lg">
        <div class="row">
            <!-- Content Start -->
            <div class="col-lg-12">

            <?php if(isset($keyword) && $keyword != ''): ?>
                <h6 style="margin-bottom:10px">Search Results for "<span class="text-main-600"><?php echo e($keyword); ?></span>"</h6>
            <?php endif; ?>

                <div class="list-grid-wrapper mt-3">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-16 border border-gray-100 product-card h-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative">
                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                     alt="<?php echo e($product->product_name); ?>" 
                                     class="product-image">
                            </a>

                            <div class="mt-16 product-card__content">
                                <h6 class="mt-12 mb-8 text-lg title fw-semibold">
                                    <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="link text-line-2" tabindex="0"><?php echo e($product->product_name); ?></a>
                                </h6>
                                <div class="flex-align mb-20 mt-16 gap-6">
                                    <?php if($product->total_reviews != 0): ?>
                                    <div class="rating-info d-flex gap-2">
                                        <?php
                                        $fullStars = floor($product->average_rating); // Number of full stars
                                        $hasHalfStar = ($product->average_rating - $fullStars) >= 0.5; // Half-star condition
                                        ?>
                                        <?php for($i = 0; $i < $fullStars; $i++): ?>
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        <?php endfor; ?>
                                        <?php if($hasHalfStar): ?>
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                        <?php endif; ?>
                                        <span class="text-xs fw-medium text-gray-500"><?php echo e(number_format($product->average_rating, 1)); ?></span>
                                        &nbsp;<span class="text-xs fw-medium text-gray-500">(<?php echo e($product->total_reviews); ?>)</span>
                                    </div>
                                    <?php endif; ?>
                                    <!-- Heart Icon -->
                                    <button type="button" class="heart-icon ms-auto" 
                                            id="wishlist-icon-<?php echo e($product->product_id); ?>" 
                                            onclick="toggleWishlist(this, '<?php echo e($product->product_id); ?>')">
                                        <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                                    </button>
                                </div>

                                <div class="mt-8">
                                    <?php
                                        // Calculate the percentage sold
                                        $percentageSold = $product->total_quantity > 0 
                                            ? ($product->sold_quantity / $product->total_quantity) * 100 
                                            : 0;
                                    ?>

                                    <div class="h-4 progress w-100 bg-color-three rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="<?php echo e($percentageSold); ?>" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-main-two-600 rounded-pill" style="width: <?php echo e($percentageSold); ?>%;"></div>
                                    </div>
                                    <span class="mt-8 text-xs text-gray-900 fw-medium">
                                        Sold: <?php echo e($product->sold_quantity); ?>/<?php echo e($product->total_quantity); ?>

                                    </span>
                                </div>

                                <div class="my-20 product-card__price">
                                    <span class="text-heading text-md fw-semibold ">Rs <?php echo e(number_format($product->normal_price, 2)); ?> <span class="text-gray-500 fw-normal">/Qty</span></span>
                                </div>
                                <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" style="width:230px" class="gap-8 px-24 product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 rounded-8 flex-center fw-medium add-to-cart-btn" data-bs-toggle="modal" data-bs-target="#cartModal_<?php echo e($product->product_id); ?>" data-product-id="<?php echo e($product->product_id); ?>">
                                    Add To Cart <i class="ph ph-shopping-cart"></i> 
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($products->isEmpty()): ?>
                    <p>No products found for "<span class="text-main-600"><?php echo e($keyword); ?></span>".</p>
                <?php endif; ?>
            </div>
            <!-- Content End -->
        </div>
    </div>
</section>

<!-- =============================== Shop Section End ======================================== -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/frontend/searchView.blade.php ENDPATH**/ ?>