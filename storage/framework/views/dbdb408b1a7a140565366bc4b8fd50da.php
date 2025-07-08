<?php $__env->startSection('content'); ?>



<!--


==============================================================================================================================================================


                                                                        home page


=============================================================================================================================================================== -->



<style>
   /* Custom styles */
   .carousel-item {
       background-size: cover;
       background-position: center;
       height: 400px; /* Adjust height as needed */
       width: 100%;
       position: relative;
   }

/* Mobile (up to 576px) */
@media (max-width: 576px) {
    .carousel-item {
        height: 30vh; /* Adjust height for mobile */

    }

    .carousel{
       margin-top: 65px;
    }
}

/* Tablet (576px to 768px) */
@media (min-width: 577px){
    .carousel-item {
        height: 45vh; /* Adjust height for tablets */
        margin-top: 125px;

    }
}



   /* Each carousel item with a different image */


   .carousel-item-next, .carousel-item-prev, .carousel-item.active {
       transition: transform 0.5s ease;
   }

   /* Optional: Ensure the carousel controls are visible */
   .carousel-control-prev-icon, .carousel-control-next-icon {
       background-color: black; /* For better visibility */
   }

   /* Hide the carousel control buttons */
   .carousel-control-prev, .carousel-control-next {
       display: none;
   }

   /* Style the dots (indicators) */
   .carousel-indicators li {
       background-color: transparent;
       width: 20px;
       height: 20px;
       border-radius: 0;
       border: 2px solid white;
       margin: 0 5px; /* Adds some space between dots */
   }

   .carousel-indicators .active {
       background-color: white;
       transform: scale(1.2);
   }


   .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
    background: 0 0;
    color: inherit;
    border: none;
    padding: 0 !important;
    font: inherit;
    font-size: 37px!important;
}


.product-image {
    width: 100%;
    height: 178px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}


.grid-product-img {
    width: 100%;
    height: 178px;
    object-fit: cover;
    display: block;
}


</style>

<body>



    <!-- Carousel Section -->
    <!-- Carousel Section -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" s>
    <div class="carousel-inner">
        <!-- Loop through the sliders and display each one -->
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>" style="background-image: url('<?php echo e(asset('storage/' . $slider->image)); ?>');">
                <!-- You can optionally add text or content inside each carousel item -->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="carousel-indicators">
        <!-- Loop through sliders to generate the correct indicators -->
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo e($index); ?>" class="<?php echo e($index === 0 ? 'active' : ''); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


    <div class="site-common-con">
        <div class="home-product d-flex">
            <div class="home-product-title exclusive">
                <p class="home-page-product-title">Online Exclusive</p>
            </div>
            <div class="view-all-txt">
                <a class="view-all-link" href="/shop">VIEW ALL</a>
            </div>
        </div>

        <div id="category_products_list_28" class="products-grid row">
            <div class="home-product-list owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 2600px;">
                    <?php $__currentLoopData = $Onlineexclusive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="owl-item active" style="width: 216.638px;">
                                <div class="item items-28">
                                    <div class="grid-product-wapper">
                                        <!-- Discount Tag -->
                                        <?php if($product->discount > 0): ?>
                                            <div class="normal-pro-promo-tags">
                                                <div class="discout-tag">
                                                    <span class="discount-amount"><?php echo e($product->discount); ?>%</span>
                                                    <span class="off-txt">OFF</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>">
                                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="grid-product-img" loading="eager" width="178" height="178">
                                            </a>
                                            <div class="products-btn-set">
                                                <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="home-buynow">BUY NOW</a>
                                            </div>
                                        </div>

                                        <!-- Product Title & Prices -->
                                        <div class="grid-pro-drtail-con">
                                            <div class="col-md-12 grid-product-title">
                                                <div class="pro-name-compact" title="<?php echo e($product->product_name); ?>">
                                                    <?php echo e($product->product_name); ?>

                                                </div>
                                            </div>
                                            <div class="u">
                                                <span class="market-price">Rs. <?php echo e(number_format($product->regular_price, 2)); ?></span>
                                                <span class="selling-price">Rs. <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>




<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Owl Carousel CSS -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/frontend/newstyle/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css"> -->

<!-- Include Owl Carousel JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script> -->


<script>
    $(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        loop: true,              // Enable looping
        margin: 10,              // Margin between items
        nav: true,               // Show next/prev arrows

        dots: false,             // Disable dots navigation
        autoplay: false,          // Enable auto-scrolling
        autoplayTimeout: 2000,   // Auto-scroll interval in ms
        responsive: {
            0: {
                items: 2         // Show 1 item for small screens
            },
            600: {
                items: 3         // Show 3 items for medium screens
            },
            1000: {
                items: 5         // Show 5 items for large screens
            }
        }
    });
});

</script>




















    <div class="site-common-con">
        <div class="home-product d-flex">
            <div class="home-product-title">
                <p class="home-page-product-title">Top Selling</p>
            </div>
            <div class="view-all-txt">
                <a class="view-all-link" href="/shop">VIEW ALL</a>
            </div>
        </div>

        <div id="category_products_list_28" class="products-grid row">
            <div class="home-product-list owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 2600px;">
                    <?php $__currentLoopData = $topSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="owl-item active" style="width: 216.638px;">
                                <div class="item items-28">
                                    <div class="grid-product-wapper">
                                        <!-- Discount Tag -->
                                        <?php if($product->discount > 0): ?>
                                            <div class="normal-pro-promo-tags">
                                                <div class="discout-tag">
                                                    <span class="discount-amount"><?php echo e($product->discount); ?>%</span>
                                                    <span class="off-txt">OFF</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>">
                                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="grid-product-img" loading="eager" width="178" height="178">
                                            </a>
                                            <div class="products-btn-set">
                                                <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="home-buynow">BUY NOW</a>
                                            </div>
                                        </div>

                                        <!-- Product Title & Prices -->
                                        <div class="grid-pro-drtail-con">
                                            <div class="col-md-12 grid-product-title">
                                                <div class="pro-name-compact" title="<?php echo e($product->product_name); ?>">
                                                    <?php echo e($product->product_name); ?>

                                                </div>
                                            </div>
                                            <div class="u">
                                                <span class="market-price">Rs. <?php echo e(number_format($product->regular_price, 2)); ?></span>
                                                <span class="selling-price">Rs. <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="site-common-con">
        <div class="home-product d-flex">
            <div class="home-product-title">
                <p class="home-page-product-title">Below Rs.10,000</p>
            </div>
            <div class="view-all-txt">
                <a class="view-all-link" href="/shop">VIEW ALL</a>
            </div>
        </div>

        <div id="category_products_list_28" class="products-grid row">
            <div class="home-product-list owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 2600px;">
                    <?php $__currentLoopData = $belowrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="owl-item active" style="width: 216.638px;">
                                <div class="item items-28">
                                    <div class="grid-product-wapper">
                                        <!-- Discount Tag -->
                                        <?php if($product->discount > 0): ?>
                                            <div class="normal-pro-promo-tags">
                                                <div class="discout-tag">
                                                    <span class="discount-amount"><?php echo e($product->discount); ?>%</span>
                                                    <span class="off-txt">OFF</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>">
                                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" class="grid-product-img" loading="eager" width="178" height="178">
                                            </a>
                                            <div class="products-btn-set">
                                                <a href="<?php echo e(route('showProductDetails', $product->product_id)); ?>" class="home-buynow">BUY NOW</a>
                                            </div>
                                        </div>

                                        <!-- Product Title & Prices -->
                                        <div class="grid-pro-drtail-con">
                                            <div class="col-md-12 grid-product-title">
                                                <div class="pro-name-compact" title="<?php echo e($product->product_name); ?>">
                                                    <?php echo e($product->product_name); ?>

                                                </div>
                                            </div>
                                            <div class="u">
                                                <span class="market-price">Rs. <?php echo e(number_format($product->regular_price, 2)); ?></span>
                                                <span class="selling-price">Rs. <?php echo e(number_format($product->normal_price, 2)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-common-con" style="margin-bottom: 50px; margin-top: 30px;">
    <div class="row m-0">
        <!-- First Banner Image (Left Side) -->
        <?php if(isset($banners[0])): ?>
            <div class="col-12 col-sm-6 custom-4-banner">
                <img src="<?php echo e(asset('storage/' . $banners[0]->image)); ?>" class="img-fluid" alt="Banner 1">
            </div>
        <?php endif; ?>

        <!-- Second Banner Image (Right Side) -->
        <?php if(isset($banners[1])): ?>
            <div class="col-12 col-sm-6 custom-4-banner">
                <img src="<?php echo e(asset('storage/' . $banners[1]->image)); ?>" class="img-fluid" alt="Banner 2">
            </div>
        <?php endif; ?>
    </div>

    <!-- Single Banner Image (Full Width) -->
    <?php if(isset($banners[2])): ?>
        <a href="<?php echo e($banners[2]->url ?? '#'); ?>">
            <div class="col-12 col-sm-12 single-banner-m">
                <img src="<?php echo e(asset('storage/' . $banners[2]->image)); ?>" class="img-fluid" alt="Single Banner">
            </div>
        </a>
    <?php endif; ?>
</div>


































































<!--

=====================================================================================================================================================
                                     Home page end

===================================================================================================================================================== -->





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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/home.blade.php ENDPATH**/ ?>