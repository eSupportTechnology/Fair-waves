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
                    <a href="/home" class="gap-8 text-gray-900 flex-align hover-text-main-600">
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
                    <button type="button" class="w-32 h-32 mt-8 border border-gray-100 shop-sidebar__close d-lg-none d-flex flex-center rounded-circle hover-bg-main-600 position-absolute inset-inline-end-0 me-10 hover-text-white hover-border-main-600">
                        <i class="ph ph-x"></i>
                    </button>
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Product Category</h6>
                        <ul class="overflow-y-auto max-h-540 scroll-sm">
                            <li class="mb-24">
                                <a href="<?php echo e(route('shop.index')); ?>" 
                                class="text-gray-900 hover-text-main-600 <?php echo e(!isset($categoryId) ? 'font-bold' : ''); ?>">
                                    All Categories
                                </a>
                            </li>
                           <!-- Category Filter -->
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-24">
                                    <a href="<?php echo e(route('shop.index', [
                                        'category_id' => $category->id, 
                                        'min_price' => $minPrice, 
                                        'max_price' => $maxPrice,
                                        'color' => $color
                                    ])); ?>" 
                                    class="text-gray-900 hover-text-main-600 <?php echo e(isset($categoryId) && $categoryId == $category->id ? 'font-bold' : ''); ?>">
                                        <?php echo e($category->name); ?> (<?php echo e($category->products_count); ?>)
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Filter by Price</h6>
                        <div class="custom--range">
                            <div id="slider-range"></div>
                            <div class="flex-wrap-reverse gap-8 mt-24 flex-between ">
                            <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                                <input type="hidden" name="min_price" id="min_price" value="<?php echo e($minPrice ?? 0); ?>">
                                <input type="hidden" name="max_price" id="max_price" value="<?php echo e($maxPrice ?? 20000); ?>">
                                <button type="submit" class="btn btn-main h-40 flex-align">Filter </button>
                            </form>         

                                <div class="gap-8 custom--range__content flex-align">
                                    <span class="flex-shrink-0 text-gray-500 text-md">Price:</span>
                                    <input type="text" class="custom--range__prices text-neutral-600 text-start text-md fw-medium" id="amount" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Filter by Color</h6>
                        <ul class="overflow-y-auto color-filter-list max-h-540 scroll-sm">
                            <?php
                                $displayedColors = []; 
                            ?>
                            <!-- Color Filter -->
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($variation->type == 'color' && !in_array($variation->hex_value, $displayedColors)): ?> 
                                        <li class="mb-16 color-item">
                                            <div class="form-check common-check common-radio checked-black">
                                                <input class="form-check-input" type="radio" name="color" id="color<?php echo e($variation->id); ?>" value="<?php echo e($variation->hex_value); ?>" style="display: none;" onclick="filterByColor('<?php echo e($variation->hex_value); ?>')">
                                                <label class="border-gray-100 form-check-label color-swatch" for="color<?php echo e($variation->id); ?>" 
                                                    style="background-color: <?php echo e($variation->hex_value); ?>; display: inline-block; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; transition: box-shadow 0.3s; border: 1px solid gray;"
                                                    onmouseover="this.style.boxShadow='0 0 5px rgba(0,0,0,0.5)';" 
                                                    onmouseout="if (!this.classList.contains('selected')) this.style.boxShadow='none';"></label>
                                            </div>
                                        </li>
                                        <?php
                                            $displayedColors[] = $variation->hex_value;
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Rating</h6>
                        <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                            <!-- Existing Filters -->
                            <input type="hidden" name="min_price" value="<?php echo e($minPrice); ?>">
                            <input type="hidden" name="max_price" value="<?php echo e($maxPrice); ?>">
                            <input type="hidden" name="category_id" value="<?php echo e($categoryId); ?>">
                            <input type="hidden" name="color" value="<?php echo e($color); ?>">

                            <!-- Rating Options -->
                            <?php for($i = 5; $i >= 1; $i--): ?>
                                <div class="form-check mb-3">
                                    <input 
                                        class="form-check-input" 
                                        type="radio" 
                                        name="rating" 
                                        value="<?php echo e($i); ?>" 
                                        id="rating<?php echo e($i); ?>" 
                                        <?php echo e(request('rating') == $i ? 'checked' : ''); ?>

                                    >
                                    <label class="form-check-label" for="rating<?php echo e($i); ?>">
                                        <?php for($j = 1; $j <= $i; $j++): ?>
                                            <i class="ph-fill ph-star text-warning-600"></i>
                                        <?php endfor; ?>
                                        <?php for($j = $i + 1; $j <= 5; $j++): ?>
                                            <i class="ph-fill ph-star text-gray-200"></i>
                                        <?php endfor; ?>
                                    </label>
                                </div>
                            <?php endfor; ?>

                            <button type="submit" class="btn btn-main w-50 mt-4">Apply Filter</button>
                        </form>
                    </div>
                        
                </div>
            </div>
            <!-- Sidebar End -->

           <!-- Content Start -->
            <div class="col-lg-9">
                <!-- Top Start -->
                <div class="flex-wrap gap-16 mb-40 flex-between ">
                    <span class="text-gray-900">
                        Showing <?php echo e($products->firstItem()); ?>-<?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> results
                    </span>
                    <div class="flex-wrap gap-16 position-relative flex-align">
                        <div class="gap-16 list-grid-btns flex-align">
                            <button type="button" class="text-2xl border border-gray-100 w-44 h-44 flex-center rounded-6 list-btn">
                                <i class="ph-bold ph-list-dashes"></i>
                            </button>
                            <button type="button" class="text-2xl text-white border w-44 h-44 flex-center border-main-600 bg-main-600 rounded-6 grid-btn">
                                <i class="ph ph-squares-four"></i>
                            </button>
                        </div>  
                        <button type="button" class="text-2xl border border-gray-100 w-44 h-44 d-lg-none d-flex flex-center rounded-6 sidebar-btn">
                            <i class="ph-bold ph-funnel"></i>
                        </button>
                    </div>
                </div>
                <!-- Top End -->

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
                               
                              
                                <a href="#" 
                                style="width:230px" 
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
                                                    <a class="rounded-4 main-image-link" href="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>">
                                                        <img id="mainImage" class="rounded-4 fit" src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" style="width:250px" />
                                                    </a>
                                                </div>
                                                <div class="mb-3 d-flex justify-content-center">
                                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a class="mx-1 rounded-2 thumbnail-image" data-image="<?php echo e(asset('storage/' . $image->image_path)); ?>" href="javascript:void(0);">
                                                            <img class="thumbnail rounded-2" src="<?php echo e(asset('storage/' . $image->image_path)); ?>" style="width:80px" />
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </aside>

                                            <main class="col-lg-7">
                                                <h6><?php echo e($product->product_name); ?></h6>
                                                <p class="product-description"><?php echo e($product->product_description); ?></p>
                                                <div class="flex-align flex-wrap gap-12 mt-12">
                                                    <?php if($product->total_reviews!=0): ?>
                                                    <div class="flex-align gap-12 flex-wrap">
                                                        <div class="flex-align gap-8">
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
                                                        </div>
                                                        <span class="text-sm fw-medium text-neutral-600"><?php echo e(number_format($product->average_rating, 1)); ?> Star Rating</span>
                                                        <span class="text-sm fw-medium text-gray-500">(<?php echo e($product->total_reviews); ?>)</span>
                                                    </div>                                               
                                                    <?php endif; ?>
                                                </div>
                                                <hr />
                                                
                                                <div class="mt-3 mb-12 product-availability">
                                                    <span>Availability :</span>
                                                    <?php if($product->quantity > 1): ?>
                                                        <span class="ms-1" style="color:#4caf50;">In stock</span>
                                                    <?php else: ?>
                                                        <span class="ms-1" style="color:red;">Out of stock</span>
                                                    <?php endif; ?>
                                                </div>

                                                 <!-- Sizes Section -->
                                                <?php if($product->variations->pluck('value')->filter()->unique()->isNotEmpty()): ?>
                                                    <div class="flex-wrap gap-16 mb-8 flex-between align-items-start">
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

                                                <div class="mt-8 mb-3 product-price d-flex align-items-center">
                                                    <span class="" style="margin-right: 10px;">                                                   
                                                    <h6 class="mb-0">Rs <?php echo e($product->normal_price); ?></h6>
                                                    </span>
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
                                                        <button type="submit" class="mt-5 btn btn-main w-95" 
                                                                <?php if($product->quantity == 0): ?> disabled <?php endif; ?>>
                                                            Add To Cart
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <p class="mb-5 text-danger">Please <a href="<?php echo e(route('login')); ?>">log in</a> to add items to the cart.</p>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('showProductDetails', $product->product_id )); ?>" style="text-decoration: none; font-size:14px; color: #297aa5; margin-top:15px">
                                                    View Full Details<i class="fa-solid fa-circle-right"></i>
                                                </a>
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

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


   
    <script>
        $(function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 20000,
                values: [ <?php echo e($minPrice ?? 0); ?>, <?php echo e($maxPrice ?? 20000); ?> ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "Rs " + ui.values[ 0 ] + " - Rs " + ui.values[ 1 ] );
                    $( "#min_price" ).val(ui.values[0]);
                    $( "#max_price" ).val(ui.values[1]);
                }
            });
            $( "#amount" ).val( "Rs " + $( "#slider-range" ).slider( "values", 0 ) + " - Rs " + $( "#slider-range" ).slider( "values", 1 ) );
        });
    </script>

    <script>
            // image thumbnails
            $(document).ready(function() {
            // When a thumbnail is clicked
            $('.thumbnail-image').click(function() {
                var newImageSrc = $(this).data('image');  // Get the image URL from the data attribute
                $('#mainImage').attr('src', newImageSrc);  // Update the main image's src
            });
        });


    // Change the box shadow of the selected color
        const colorInputs = document.querySelectorAll('input[name="color"]');
        colorInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Remove the selected box shadow from all labels
                colorInputs.forEach(input => {
                    const label = document.querySelector(`label[for="${input.id}"]`);
                    label.style.boxShadow = 'none';
                    label.classList.remove('selected'); // Remove selected class
                });
                // Add box shadow for the selected label
                const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                selectedLabel.style.boxShadow = '0 0 5px rgba(255, 69, 0, 0.7)'; 
                selectedLabel.classList.add('selected'); 
            });
        });
    </script>
    <script>
    function filterByColor(color) {
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);
        params.set('color', color); // Set the color parameter

        // Make sure to keep existing price and category filters
        params.set('min_price', document.getElementById('min_price').value);
        params.set('max_price', document.getElementById('max_price').value);
        params.set('category_id', "<?php echo e($categoryId); ?>");

        window.location.href = url.pathname + '?' + params.toString();
    }


    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        console.log('Product ID:', productId);
    });
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
document.addEventListener('DOMContentLoaded', function () {
    const productIds = [...document.querySelectorAll('.heart-icon')].map(button => button.id.replace('wishlist-icon-', ''));

    // Fetch wishlist status for all products on the page
    fetch('/wishlist/check-multiple', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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


<?php $__env->stopSection(); ?>



 
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/frontend/shop.blade.php ENDPATH**/ ?>