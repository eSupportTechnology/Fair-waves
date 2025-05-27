<?php $__env->startSection('content'); ?>

    

    <!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Vendor Details</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="index.html" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> Vendor Details </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->
<!-- ============================== Vendor Two Details Start =============================== -->
<section class="vendor-two-details py-80">
    <div class="container container-lg">
        <div class="vendor-two-details-wrapper d-flex flex-wrap align-items-start gap-24">

            <!-- Shop Sidebar Start -->
            <div class="shop-sidebar">
                <button type="button" class="shop-sidebar__close d-lg-none d-flex w-32 h-32 flex-center border border-gray-100 rounded-circle hover-bg-main-600 bg-main-600 position-absolute inset-inline-end-0 me-10 mt-8 text-white border-main-600">
                    <i class="ph ph-x"></i>
                </button>
                <div class="d-flex flex-column gap-12 px-lg-0 px-3 py-lg-0 py-4">
                    <div class="bg-neutral-600 rounded-8 p-24">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="w-80 h-80 flex-center bg-white rounded-8 flex-shrink-0">
                                <?php if($vendornew->shop->shop_logo): ?>
                                    <img src="<?php echo e(asset('storage/' . $vendornew->shop->shop_logo)); ?>" alt="" class="cover-img rounded-8">
                                <?php else: ?>
                                    <img src="assets/images/default-shop-logo.png" alt="Default Logo" class="cover-img rounded-8">
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="mt-32">
                        <h6 class="text-white fw-semibold mb-12">
                            <a href="" class=""><?php echo e($vendornew->shop->shop_name); ?></a> 
                        </h6>
                            <div class="flex-align gap-6">
                                <div class="flex-align gap-8">
                                    <!-- Dynamic star rating -->
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <span class="text-15 fw-medium text-warning-600 d-flex">
                                            <i class="ph-fill ph-star"></i>
                                        </span>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-xs fw-medium text-white"><?php echo e($vendornew->rating); ?></span>
                                <span class="text-xs fw-medium text-white">(<?php echo e($vendornew->reviews_count); ?> reviews)</span>
                            </div>
                            <div class="vendors-two-item__content mt-16 flex-grow-1">
                                <div class="d-flex flex-column gap-14">
                                    <div class="flex-align gap-8">
                                        <span class="flex-center text-main-two-600 text-2xl flex-shrink-0">
                                            <i class="ph ph-map-pin-line text-white"></i>
                                        </span>
                                        <p class="text-md text-white"><?php echo e($vendornew->address); ?></p>
                                    </div>
                                    <div class="flex-align gap-8">
                                        <span class="flex-center text-main-two-600 text-2xl flex-shrink-0">
                                            <i class="ph ph-envelope-simple text-white"></i>
                                        </span>
                                        <a href="mailto:<?php echo e($vendornew->email); ?>" class="text-md text-white hover-text-main-60"><?php echo e($vendornew->email); ?></a>
                                    </div>
                                    <div class="flex-align gap-8">
                                        <span class="flex-center text-main-two-600 text-2xl flex-shrink-0">
                                            <i class="ph ph-phone text-white"></i>
                                        </span>
                                        <a href="tel:<?php echo e($vendornew->phone); ?>" class="text-md text-white hover-text-main-60"><?php echo e($vendornew->phone); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-32 d-flex flex-column gap-8">
                       
                        </div>
                    </div>
                    <div class="border border-gray-50 rounded-8 p-24">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Product Category</h6>
                        <ul class="max-h-540 overflow-y-auto scroll-sm">
                        <!-- All Categories Link -->
                            <li class="mb-24">
                                <a href="<?php echo e(request()->url()); ?>" 
                                class="text-gray-900 hover-text-main-600 <?php echo e(request('category_id') == null ? 'font-weight-bold' : ''); ?>">
                                All Categories
                                </a>
                            </li>
                            
                            <!-- Loop Through Categories -->
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-24">
                                    <!-- Add the category filter link with the 'category_id' parameter -->
                                    <a href="<?php echo e(request()->url()); ?>?category_id=<?php echo e($category->id); ?>" 
                                    class="text-gray-900 hover-text-main-600 <?php echo e(request('category_id') == $category->id ? 'font-weight-bold' : ''); ?>">
                                    <?php echo e($category->name); ?> 
                                    </a>
                                
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>


                    <div class="blog-sidebar border border-gray-100 rounded-8 p-32 mb-40">
                        <h6 class="text-xl mb-32 pb-32 border-bottom border-gray-100">Best Sell Products</h6>
                        <div class="d-flex flex-column gap-24">
                        <?php if($vendornew->best_selling_products): ?>
                            <?php $__currentLoopData = $vendornew->best_selling_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center flex-sm-nowrap flex-wrap gap-16">
                                    <a href="<?php echo e(route('showProductDetails', $product->id)); ?>" class="w-100 h-100 rounded-4 overflow-hidden w-76 h-76 flex-shrink-0 bg-color-three flex-center">
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                                    </a>
                                    <div class="flex-grow-1">
                                        <h6 class="text-lg mb-8 fw-medium">
                                            <a href="<?php echo e(route('showProductDetails', $product->id)); ?>" class="text-line-3"><?php echo e($product->name); ?></a>
                                        </h6>
                                        <div class="flex-align gap-6">
                                            <div class="flex-align gap-4">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <span class="text-xs fw-medium text-warning-600 d-flex">
                                                        <i class="ph-fill ph-star"></i>
                                                    </span>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="text-xs fw-medium text-neutral-500"><?php echo e($product->rating); ?></span>
                                            <span class="text-xs fw-medium text-neutral-500">(<?php echo e($product->reviews_count); ?>)</span>
                                        </div>
                                        <h6 class="text-md mb-0 mt-4">$<?php echo e(number_format($product->price, 2)); ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p>No best selling products available.</p>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Sidebar End -->

            <div class="vendor-two-details__contents">
                <!-- Search Filter Start -->
                <div class="d-flex align-items-center justify-content-between flex-wrap mt-40 mb-32 gap-16">
                    <div class="d-flex align-items-center justify-content-between justify-content-sm-end gap-16 flex-grow-1">
                        <span class="text-gray-900">Showing 1-20 of <?php echo e($products->total()); ?> result</span>  
                        <div class="d-flex align-items-center gap-8 d-sm-flex d-none">
                            <button type="button" class="grid-btn text-2xl d-flex w-48 h-48 border border-neutral-100 rounded-8 justify-content-center align-items-center border-main-600 text-white bg-main-600"><i class="ph ph-squares-four"></i></button>
                            <button type="button" class="list-btn text-2xl d-flex w-48 h-48 border border-neutral-100 rounded-8 justify-content-center align-items-center"><i class="ph ph-list-bullets"></i></button>
                        </div>
                        <button type="button" class="w-48 h-48 d-lg-none d-flex flex-center border border-gray-100 rounded-6 text-2xl sidebar-btn">
                           <i class="ph-bold ph-funnel"></i>
                       </button>
                    </div>
                </div>
                <!-- Search Filter End -->

               <!-- Products Start --> 
                <div class="list-grid-wrapper grid-cols-4">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <div class="product-card__thumb rounded-8 bg-gray-50 position-relative">
                                <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="w-100 h-100 flex-center">
                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="max-w-unset">
                                </a>
                            </div>
                            <div class="product-card__content mt-16">
                                <h5 class="text-lg fw-semibold mb-8">
                                    <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="text-gray-900"><?php echo e($product->product_name); ?></a>
                                </h5>
                                <div class="flex-align gap-6">
                                    <div class="flex-align gap-8">
                                        <?php if($product->total_reviews!=0): ?>
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
                                    </div>
                                    <div class="gap-4 flex-align">
                                    <span class="text-tertiary-600 text-md d-flex">
                                        <i class="ph-fill ph-storefront"></i>
                                    </span>
                                    <?php if($product->shop_id && $product->shop): ?> 
                                        <span class="text-xs text-gray-500">By <?php echo e($product->shop->shop_name); ?></span>
                                    <?php endif; ?>
                                    </div>
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
                                <div class="product-card__price mt-16 mb-30">
                                    <span class="text-heading text-md fw-semibold ">Rs <?php echo e(number_format($product->normal_price, 2)); ?><span class="text-gray-500 fw-normal">/Qty</span> </span>
                                </div>
                                <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" 
                                    style="width:230px" 
                                    class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-8 flex-center gap-8 fw-medium add-to-cart-btn" >
                                        Add To Cart <i class="ph ph-shopping-cart"></i> 
                                </a>
                            </div>
                        </div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500 mt-4">No products found.</p>
                        
                    <?php endif; ?>
                </div>
                <!-- Products End -->

              
                <!-- Pagination Start -->
                <div class="pagination mt-40">
                    <?php echo e($products->links()); ?>  
                </div>
                <!-- Pagination End -->
            </div>

        </div>
    </div>
</section>
<!-- ============================== Vendor Two Details End =============================== -->




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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/frontend/vendor-details.blade.php ENDPATH**/ ?>