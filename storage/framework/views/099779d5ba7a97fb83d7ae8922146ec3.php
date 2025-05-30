<?php $__env->startSection('content'); ?>

<style>
.product-description {
    display: -webkit-box;
    -webkit-line-clamp: 3; 
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;  
}
</style>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">Shop</h6>
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
                <li class="text-sm text-main-600"> Product Shop </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- =============================== Shop Section Start ======================================== -->
<section class="shop py-80">
    <div class="container container-lg">
        <div class="row">

            <!-- Sidebar Start -->
            <div class="col-lg-3">
                <div class="shop-sidebar">
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Product Category</h6>
                        <ul class="overflow-y-auto max-h-540 scroll-sm">
                            <li class="mb-24">
                                <a href="<?php echo e(route('shop.index')); ?>" class="text-gray-900 hover-text-main-600 <?php echo e(!isset($categoryId) ? 'font-bold' : ''); ?>">
                                    All Categories
                                </a>
                            </li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-24">
                                    <a href="<?php echo e(route('shop.index', ['category_id' => $category->id])); ?>" 
                                       class="text-gray-900 hover-text-main-600 <?php echo e(isset($categoryId) && $categoryId == $category->id ? 'font-bold' : ''); ?>">
                                        <?php echo e($category->name); ?> (<?php echo e($category->products_count); ?>)
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="col-lg-9">
                <div class="flex-wrap gap-16 mb-40 flex-between">
                    <span class="text-gray-900">
                        Showing <?php echo e($products->firstItem()); ?>-<?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> results
                    </span>
                </div>

                <div class="list-grid-wrapper">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-16 border border-gray-100 product-card h-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <a href="<?php echo e(url('/product-details/' . $product->product_id)); ?>" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative">
                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                     alt="<?php echo e($product->product_name); ?>" 
                                     class="product-image">
                            </a>

                            <div class="mt-16 product-card__content">
                                <h6 class="mt-12 mb-8 text-lg title fw-semibold">
                                    <a href="<?php echo e(url('/product-details/' . $product->product_id)); ?>" class="link text-line-2" tabindex="0"><?php echo e($product->product_name); ?></a>
                                </h6>
                                <div class="flex-align mb-20 mt-16 gap-6">
                                    <?php if($product->total_reviews!=0): ?>
                                    <div class="rating-info d-flex gap-2">
                                        <?php
                                            $fullStars = floor($product->average_rating);
                                            $hasHalfStar = ($product->average_rating - $fullStars) >= 0.5;
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
                                    <!-- <button type="button" class="heart-icon ms-auto" id="wishlist-icon-<?php echo e($product->product_id); ?>" onclick="toggleWishlist(this, '<?php echo e($product->product_id); ?>')">
                                        <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                                    </button> -->
                                </div>

                                <div class="mt-8 mb-20 product-card__price">
                                    <span class="text-heading text-md fw-semibold ">Rs <?php echo e(number_format($product->normal_price, 2)); ?> <span class="text-gray-500 fw-normal">/Qty</span></span>
                                </div>
                                
                                <a href="#" 
                                   class="gap-8 px-24 product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 rounded-8 flex-center fw-medium add-to-cart-btn" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#cartModal_<?php echo e($product->product_id); ?>" 
                                   data-product-id="<?php echo e($product->product_id); ?>">
                                    Add To Cart <i class="ph ph-shopping-cart"></i> 
                                </a>
                            </div>
                        </div>

                        <!-- Cart Modal -->
                        <div class="modal fade" id="cartModal_<?php echo e($product->product_id); ?>" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="p-6 modal-content" style="border-radius: 0;">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row gx-5">
                                            <aside class="col-lg-5">
                                                <div class="mb-3 rounded-4 d-flex justify-content-center">
                                                    <img id="mainImage" class="rounded-4 fit" src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" style="width:250px" />
                                                </div>
                                            </aside>

                                            <main class="col-lg-7">
                                                <h6><?php echo e($product->product_name); ?></h6>
                                                <p class="product-description"><?php echo e($product->product_description); ?></p>
                                                
                                                <hr />

                                                <div class="mt-8 mb-3 product-price d-flex align-items-center">
                                                    <h6 class="mb-0">Rs <?php echo e($product->normal_price); ?></h6>
                                                </div>

                                                <?php if(auth()->guard()->check()): ?>
                                                <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <input type="hidden" name="price" value="<?php echo e($product->normal_price); ?>">
                                                    <button type="submit" class="mt-5 btn btn-main w-95">
                                                        Add To Cart
                                                    </button>
                                                </form>
                                                <?php else: ?>
                                                    <p class="mb-5 text-danger">Please <a href="<?php echo e(route('login')); ?>">log in</a> to add items to the cart.</p>
                                                <?php endif; ?>
                                            </main>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination Start -->
                <ul class="flex-wrap gap-16 pagination flex-center">
                    <li class="page-item">
                        <a class="border border-gray-100 page-link flex-center text-xxl rounded-8 fw-medium text-neutral-600" href="<?php echo e($products->previousPageUrl()); ?>">
                            <i class="ph-bold ph-arrow-left"></i>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $products->lastPage(); $i++): ?>
                        <li class="page-item <?php echo e($i == $products->currentPage() ? 'active' : ''); ?>">
                            <a class="border border-gray-100 page-link flex-center text-md rounded-8 fw-medium text-neutral-600" href="<?php echo e($products->url($i)); ?>"><?php echo e($i); ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="border border-gray-100 page-link flex-center text-xxl rounded-8 fw-medium text-neutral-600" href="<?php echo e($products->nextPageUrl()); ?>">
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- Pagination End -->
            </div>
            <!-- Content End -->
        </div>
    </div>
</section>
<!-- =============================== Shop Section End ======================================== -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Wishlist Handling Script -->
<script>
function toggleWishlist(button, productId) {
    button.classList.toggle('active');
    const icon = button.querySelector('i');

    if (button.classList.contains('active')) {
        icon.classList.replace('fa-regular', 'fa-solid');
        icon.style.color = 'red';
    } else {
        icon.classList.replace('fa-solid', 'fa-regular');
        icon.style.color = '#ccc';
    }

    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ product_id: productId })
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

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/brand-items.blade.php ENDPATH**/ ?>