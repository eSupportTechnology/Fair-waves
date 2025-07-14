<?php $__env->startSection('content'); ?>

<style>
.product-description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media (max-width: 990px) {
  .hide-on-tiny {
    display: none !important;
  }
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
            <div class="col-lg-3 hide-on-tiny" >
                <div class="shop-sidebar">
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Product Category</h6>
                        <form id="categoryFilterForm" action="<?php echo e(route('shop.index')); ?>" method="GET">
                            <!-- Preserve other filters -->
                            <?php if(request('min_price')): ?>
                                <input type="hidden" name="min_price" value="<?php echo e(request('min_price')); ?>">
                            <?php endif; ?>
                            <?php if(request('max_price')): ?>
                                <input type="hidden" name="max_price" value="<?php echo e(request('max_price')); ?>">
                            <?php endif; ?>
                            <?php if(request('subcategory_id')): ?>
                                <input type="hidden" name="subcategory_id" value="<?php echo e(request('subcategory_id')); ?>">
                            <?php endif; ?>
                            <?php if(request('subsubcategory_id')): ?>
                                <input type="hidden" name="subsubcategory_id" value="<?php echo e(request('subsubcategory_id')); ?>">
                            <?php endif; ?>
                            <?php if(request('color')): ?>
                                <input type="hidden" name="color" value="<?php echo e(request('color')); ?>">
                            <?php endif; ?>
                            <?php if(request('rating')): ?>
                                <input type="hidden" name="rating" value="<?php echo e(request('rating')); ?>">
                            <?php endif; ?>
                            
                            <ul class="overflow-y-auto max-h-540 scroll-sm">
                                <li class="mb-24 d-flex align-items-center">
                                    <input type="checkbox" id="all_categories" class="category-checkbox me-2" 
                                           onchange="handleAllCategoriesChange(this)" 
                                           <?php echo e((!isset($categoryIds) || empty($categoryIds)) || (isset($allCategoriesSelected) && $allCategoriesSelected) ? 'checked' : ''); ?>>
                                    <label for="all_categories" class="text-gray-900 hover-text-main-600 <?php echo e((!isset($categoryIds) || empty($categoryIds)) || (isset($allCategoriesSelected) && $allCategoriesSelected) ? 'font-bold' : ''); ?> mb-0 cursor-pointer">
                                        All Categories
                                    </label>
                                    <a href="<?php echo e(route('shop.index')); ?>" class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                        <i class="ph ph-arrow-square-out"></i>
                                    </a>
                                </li>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-24 d-flex align-items-center">
                                        <input type="checkbox" id="category_<?php echo e($category->id); ?>" 
                                               name="category_ids[]" value="<?php echo e($category->id); ?>" 
                                               class="category-checkbox me-2" 
                                               onchange="handleCategoryChange()"
                                               <?php echo e(isset($categoryIds) && in_array($category->id, $categoryIds) ? 'checked' : ''); ?>>
                                        <label for="category_<?php echo e($category->id); ?>" class="text-gray-900 hover-text-main-600 <?php echo e(isset($categoryIds) && in_array($category->id, $categoryIds) ? 'font-bold' : ''); ?> mb-0 cursor-pointer flex-grow-1">
                                            <?php echo e($category->name); ?> (<?php echo e($category->products_count); ?>)
                                        </label>
                                        <a href="<?php echo e(route('shop.index', ['category_id' => $category->id])); ?>" 
                                           class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                            <i class="ph ph-arrow-square-out"></i>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </form>
                    </div>

                    <!-- Brands Filter Section -->
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Brands</h6>
                        <form id="brandFilterForm" action="<?php echo e(route('shop.index')); ?>" method="GET">
                            <!-- Preserve other filters -->
                            <?php if(request('min_price')): ?>
                                <input type="hidden" name="min_price" value="<?php echo e(request('min_price')); ?>">
                            <?php endif; ?>
                            <?php if(request('max_price')): ?>
                                <input type="hidden" name="max_price" value="<?php echo e(request('max_price')); ?>">
                            <?php endif; ?>
                            <?php if(request('subcategory_id')): ?>
                                <input type="hidden" name="subcategory_id" value="<?php echo e(request('subcategory_id')); ?>">
                            <?php endif; ?>
                            <?php if(request('subsubcategory_id')): ?>
                                <input type="hidden" name="subsubcategory_id" value="<?php echo e(request('subsubcategory_id')); ?>">
                            <?php endif; ?>
                            <?php if(request('color')): ?>
                                <input type="hidden" name="color" value="<?php echo e(request('color')); ?>">
                            <?php endif; ?>
                            <?php if(request('rating')): ?>
                                <input type="hidden" name="rating" value="<?php echo e(request('rating')); ?>">
                            <?php endif; ?>
                            <?php if(request('category_ids')): ?>
                                <?php $__currentLoopData = request('category_ids'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="category_ids[]" value="<?php echo e($catId); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            
                            <ul class="overflow-y-auto max-h-540 scroll-sm">
                                <li class="mb-24 d-flex align-items-center">
                                    <input type="checkbox" id="all_brands" class="brand-checkbox me-2" 
                                           onchange="handleAllBrandsChange(this)" 
                                           <?php echo e((!isset($brandSlugs) || empty($brandSlugs)) || (isset($allBrandsSelected) && $allBrandsSelected) ? 'checked' : ''); ?>>
                                    <label for="all_brands" class="text-gray-900 hover-text-main-600 <?php echo e((!isset($brandSlugs) || empty($brandSlugs)) || (isset($allBrandsSelected) && $allBrandsSelected) ? 'font-bold' : ''); ?> mb-0 cursor-pointer">
                                        All Brands
                                    </label>
                                    <a href="<?php echo e(route('shop.index')); ?>" class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                        <i class="ph ph-arrow-square-out"></i>
                                    </a>
                                </li>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mb-24 d-flex align-items-center">
                                        <input type="checkbox" id="brand_<?php echo e($brand->id); ?>" 
                                               name="brand_slugs[]" value="<?php echo e($brand->slug); ?>" 
                                               class="brand-checkbox me-2" 
                                               onchange="handleBrandChange()"
                                               <?php echo e(isset($brandSlugs) && in_array($brand->slug, $brandSlugs) ? 'checked' : ''); ?>>
                                        <label for="brand_<?php echo e($brand->id); ?>" class="text-gray-900 hover-text-main-600 <?php echo e(isset($brandSlugs) && in_array($brand->slug, $brandSlugs) ? 'font-bold' : ''); ?> mb-0 cursor-pointer flex-grow-1">
                                            <?php echo e($brand->name); ?> (<?php echo e($brand->products_count); ?>)
                                        </label>
                                        <a href="<?php echo e(route('shop.index', ['brand_slug' => $brand->slug])); ?>" 
                                           class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                            <i class="ph ph-arrow-square-out"></i>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="col-lg-9">
                <!-- Search Results Header -->
                <?php if(isset($searchQuery) && !empty($searchQuery)): ?>
                    <div class="mb-32 p-24 bg-gray-50 rounded-8 border border-gray-200">
                        <div class="flex-wrap gap-16 flex-between">
                            <div>
                                <h5 class="mb-8 text-lg fw-semibold text-main-600">
                                    <i class="ph ph-magnifying-glass me-2"></i>Search Results for: "<?php echo e($searchQuery); ?>"
                                </h5>
                                <span class="text-gray-600">
                                    Found <?php echo e($products->total()); ?> product<?php echo e($products->total() != 1 ? 's' : ''); ?> matching your search
                                </span>
                            </div>
                            <a href="<?php echo e(route('shop.index')); ?>" class="gap-8 btn btn-outline-main-600 rounded-pill flex-align">
                                <i class="ph ph-x"></i>
                                Clear Search
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="flex-wrap gap-16 mb-40 flex-between">
                    <span class="text-gray-900">
                        Showing <?php echo e($products->firstItem()); ?>-<?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> results
                    </span>
                </div>

                <div class="list-grid-wrapper">
                    <?php if($products->count() > 0): ?>
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
                                <div class="gap-6 mt-16 mb-20 flex-align">
                                    <?php if($product->total_reviews!=0): ?>
                                    <div class="gap-2 rating-info d-flex">
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
                                        <span class="text-xs text-gray-500 fw-medium"><?php echo e(number_format($product->average_rating, 1)); ?></span>
                                        &nbsp;<span class="text-xs text-gray-500 fw-medium">(<?php echo e($product->total_reviews); ?>)</span>
                                    </div>
                                    <?php endif; ?>
                                    <!-- <button type="button" class="heart-icon ms-auto" id="wishlist-icon-<?php echo e($product->product_id); ?>" onclick="toggleWishlist(this, '<?php echo e($product->product_id); ?>')">
                                        <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                                    </button> -->
                                </div>

                                <div class="mt-8 mb-20 product-card__price">
                                    <?php if($isDealer): ?>
                                        <span class="text-heading text-md fw-semibold ">Rs <?php echo e(number_format($product->normal_price, 2)); ?> (<?php echo e($product->bv ? $product->bv : '0'); ?> BV)</span>
                                    <?php else: ?>
                                        <?php if($product->affiliate_price && $product->affiliate_price != $product->normal_price): ?>
                                            <span class="text-gray-500 text-sm text-decoration-line-through">Rs <?php echo e(number_format($product->affiliate_price, 2)); ?></span>
                                        <?php endif; ?>
                                        <span class="text-heading text-md fw-semibold ">Rs <?php echo e(number_format($product->normal_price, 2)); ?> </span>
                                    <?php endif; ?>
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
                                                    <?php if($isDealer): ?>
                                                        <h6 class="mb-0">Rs <?php echo e($product->normal_price); ?> (<?php echo e($product->bv ? $product->bv : '0'); ?> BV)</h6>
                                                    <?php else: ?>
                                                        <?php if($product->affiliate_price && $product->affiliate_price != $product->normal_price): ?>
                                                            <span class="text-gray-500 text-sm text-decoration-line-through me-2">Rs <?php echo e(number_format($product->affiliate_price, 2)); ?></span>
                                                        <?php endif; ?>
                                                        <h6 class="mb-0">Rs <?php echo e($product->normal_price); ?></h6>
                                                    <?php endif; ?>
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
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center py-80">
                                <div class="mb-24">
                                    <i class="ph ph-package text-6xl text-gray-400"></i>
                                </div>
                                <h4 class="mb-16 text-2xl fw-semibold text-gray-600">No Products Found</h4>
                                <p class="text-gray-500 mb-32">
                                    <?php if(isset($searchQuery) && !empty($searchQuery)): ?>
                                        Sorry, no products match your search for "<strong><?php echo e($searchQuery); ?></strong>".
                                        <br>Try searching with different keywords or
                                        <a href="<?php echo e(route('shop.index')); ?>" class="text-main-600 hover-text-main-700 fw-medium">
                                            browse all products
                                        </a>.
                                    <?php elseif(!empty($categoryIds) || !empty($brandSlugs)): ?>
                                        Sorry, no products match your current filter selection.
                                        Try adjusting your filters or
                                        <a href="<?php echo e(route('shop.index')); ?>" class="text-main-600 hover-text-main-700 fw-medium">
                                            browse all products
                                        </a>.
                                    <?php else: ?>
                                        Please check back later for new products.
                                    <?php endif; ?>
                                </p>
                                <a href="<?php echo e(route('shop.index')); ?>" class="btn btn-main rounded-8 py-12 px-24">
                                    <i class="ph ph-arrow-left me-2"></i>
                                    View All Products
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
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

// Category filter handling
function handleAllCategoriesChange(checkbox) {
    const categoryCheckboxes = document.querySelectorAll('input[name="category_ids[]"]');
    
    if (checkbox.checked) {
        // Check all category checkboxes
        categoryCheckboxes.forEach(cb => {
            cb.checked = true;
        });
        
        // Get all category IDs and submit
        const allCategoryIds = Array.from(categoryCheckboxes).map(cb => cb.value);
        const url = '<?php echo e(route("shop.index")); ?>' + buildQueryStringWithCategories(allCategoryIds);
        window.location.href = url;
    } else {
        // Uncheck all category checkboxes
        categoryCheckboxes.forEach(cb => {
            cb.checked = false;
        });
        
        // Submit form to show all products (no category filter)
        window.location.href = '<?php echo e(route("shop.index")); ?>' + buildQueryString(true);
    }
}

function handleCategoryChange() {
    const allCategoriesCheckbox = document.getElementById('all_categories');
    const categoryCheckboxes = document.querySelectorAll('input[name="category_ids[]"]');
    const checkedCategories = document.querySelectorAll('input[name="category_ids[]"]:checked');
    
    // Check if all categories are selected
    const allSelected = checkedCategories.length === categoryCheckboxes.length;
    
    if (checkedCategories.length > 0) {
        if (allSelected) {
            // All categories are selected, check "All Categories"
            allCategoriesCheckbox.checked = true;
        } else {
            // Some but not all categories selected, uncheck "All Categories"
            allCategoriesCheckbox.checked = false;
        }
        
        // Build URL with multiple category IDs
        const categoryIds = Array.from(checkedCategories).map(cb => cb.value);
        const url = '<?php echo e(route("shop.index")); ?>' + buildQueryStringWithCategories(categoryIds);
        window.location.href = url;
    } else {
        // If no categories selected, check "All Categories" and show all products
        allCategoriesCheckbox.checked = true;
        window.location.href = '<?php echo e(route("shop.index")); ?>' + buildQueryString(true);
    }
}

function buildQueryStringWithCategories(categoryIds) {
    const params = new URLSearchParams();
    
    // Add category IDs
    categoryIds.forEach(id => {
        params.append('category_ids[]', id);
    });
    
    // Preserve existing filters
    <?php if(request('search')): ?>
        params.append('search', '<?php echo e(request("search")); ?>');
    <?php endif; ?>
    <?php if(request('min_price')): ?>
        params.append('min_price', '<?php echo e(request("min_price")); ?>');
    <?php endif; ?>
    <?php if(request('max_price')): ?>
        params.append('max_price', '<?php echo e(request("max_price")); ?>');
    <?php endif; ?>
    <?php if(request('subcategory_id')): ?>
        params.append('subcategory_id', '<?php echo e(request("subcategory_id")); ?>');
    <?php endif; ?>
    <?php if(request('subsubcategory_id')): ?>
        params.append('subsubcategory_id', '<?php echo e(request("subsubcategory_id")); ?>');
    <?php endif; ?>
    <?php if(request('color')): ?>
        params.append('color', '<?php echo e(request("color")); ?>');
    <?php endif; ?>
    <?php if(request('rating')): ?>
        params.append('rating', '<?php echo e(request("rating")); ?>');
    <?php endif; ?>
    
    const queryString = params.toString();
    return queryString ? '?' + queryString : '';
}

// Brand filter handling
function handleAllBrandsChange(checkbox) {
    const brandCheckboxes = document.querySelectorAll('input[name="brand_slugs[]"]');
    
    if (checkbox.checked) {
        // Check all brand checkboxes
        brandCheckboxes.forEach(cb => {
            cb.checked = true;
        });
        
        // Get all brand slugs and submit
        const allBrandSlugs = Array.from(brandCheckboxes).map(cb => cb.value);
        const url = '<?php echo e(route("shop.index")); ?>' + buildQueryStringWithBrands(allBrandSlugs);
        window.location.href = url;
    } else {
        // Uncheck all brand checkboxes
        brandCheckboxes.forEach(cb => {
            cb.checked = false;
        });
        
        // Submit form to show all products (no brand filter)
        window.location.href = '<?php echo e(route("shop.index")); ?>' + buildQueryString(false, true);
    }
}

function handleBrandChange() {
    const allBrandsCheckbox = document.getElementById('all_brands');
    const brandCheckboxes = document.querySelectorAll('input[name="brand_slugs[]"]');
    const checkedBrands = document.querySelectorAll('input[name="brand_slugs[]"]:checked');
    
    // Check if all brands are selected
    const allSelected = checkedBrands.length === brandCheckboxes.length;
    
    if (checkedBrands.length > 0) {
        if (allSelected) {
            // All brands are selected, check "All Brands"
            allBrandsCheckbox.checked = true;
        } else {
            // Some but not all brands selected, uncheck "All Brands"
            allBrandsCheckbox.checked = false;
        }
        
        // Build URL with multiple brand slugs
        const brandSlugs = Array.from(checkedBrands).map(cb => cb.value);
        const url = '<?php echo e(route("shop.index")); ?>' + buildQueryStringWithBrands(brandSlugs);
        window.location.href = url;
    } else {
        // If no brands selected, check "All Brands" and show all products
        allBrandsCheckbox.checked = true;
        window.location.href = '<?php echo e(route("shop.index")); ?>' + buildQueryString(false, true);
    }
}

function buildQueryStringWithBrands(brandSlugs) {
    const params = new URLSearchParams();
    
    // Add brand slugs
    brandSlugs.forEach(slug => {
        params.append('brand_slugs[]', slug);
    });
    
    // Preserve existing filters including category IDs
    <?php if(request('search')): ?>
        params.append('search', '<?php echo e(request("search")); ?>');
    <?php endif; ?>
    <?php if(isset($categoryIds) && !empty($categoryIds)): ?>
        <?php $__currentLoopData = $categoryIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            params.append('category_ids[]', '<?php echo e($catId); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(request('min_price')): ?>
        params.append('min_price', '<?php echo e(request("min_price")); ?>');
    <?php endif; ?>
    <?php if(request('max_price')): ?>
        params.append('max_price', '<?php echo e(request("max_price")); ?>');
    <?php endif; ?>
    <?php if(request('subcategory_id')): ?>
        params.append('subcategory_id', '<?php echo e(request("subcategory_id")); ?>');
    <?php endif; ?>
    <?php if(request('subsubcategory_id')): ?>
        params.append('subsubcategory_id', '<?php echo e(request("subsubcategory_id")); ?>');
    <?php endif; ?>
    <?php if(request('color')): ?>
        params.append('color', '<?php echo e(request("color")); ?>');
    <?php endif; ?>
    <?php if(request('rating')): ?>
        params.append('rating', '<?php echo e(request("rating")); ?>');
    <?php endif; ?>
    
    const queryString = params.toString();
    return queryString ? '?' + queryString : '';
}

function buildQueryString(excludeCategoryId = false, excludeBrandSlug = false) {
    const params = new URLSearchParams();
    
    // Preserve existing filters
    <?php if(request('search')): ?>
        params.append('search', '<?php echo e(request("search")); ?>');
    <?php endif; ?>
    <?php if(request('min_price')): ?>
        params.append('min_price', '<?php echo e(request("min_price")); ?>');
    <?php endif; ?>
    <?php if(request('max_price')): ?>
        params.append('max_price', '<?php echo e(request("max_price")); ?>');
    <?php endif; ?>
    <?php if(request('subcategory_id')): ?>
        params.append('subcategory_id', '<?php echo e(request("subcategory_id")); ?>');
    <?php endif; ?>
    <?php if(request('subsubcategory_id')): ?>
        params.append('subsubcategory_id', '<?php echo e(request("subsubcategory_id")); ?>');
    <?php endif; ?>
    <?php if(request('color')): ?>
        params.append('color', '<?php echo e(request("color")); ?>');
    <?php endif; ?>
    <?php if(request('rating')): ?>
        params.append('rating', '<?php echo e(request("rating")); ?>');
    <?php endif; ?>
    
    // Preserve multiple category IDs if not excluding them
    <?php if(isset($categoryIds) && !empty($categoryIds)): ?>
        if (!excludeCategoryId) {
            <?php $__currentLoopData = $categoryIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                params.append('category_ids[]', '<?php echo e($catId); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        }
    <?php endif; ?>
    
    // Preserve multiple brand slugs if not excluding them
    <?php if(isset($brandSlugs) && !empty($brandSlugs)): ?>
        if (!excludeBrandSlug) {
            <?php $__currentLoopData = $brandSlugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandSlug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                params.append('brand_slugs[]', '<?php echo e($brandSlug); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        }
    <?php endif; ?>
    
    const queryString = params.toString();
    return queryString ? (excludeCategoryId || excludeBrandSlug ? '&' + queryString : '?' + queryString) : '';
}

// Style checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.textContent = `
        .category-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #3B82F6;
            cursor: pointer;
        }
        
        .brand-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #3B82F6;
            cursor: pointer;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
        
        .d-flex {
            display: flex;
        }
        
        .align-items-center {
            align-items: center;
        }
        
        .me-2 {
            margin-right: 0.5rem;
        }
        
        .ms-2 {
            margin-left: 0.5rem;
        }
        
        .mb-0 {
            margin-bottom: 0;
        }
        
        .flex-grow-1 {
            flex-grow: 1;
        }
        
        .text-decoration-none {
            text-decoration: none;
        }
    `;
    document.head.appendChild(style);
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/shop.blade.php ENDPATH**/ ?>