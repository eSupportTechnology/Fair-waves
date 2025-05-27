<style>
    .footer-item-two-wrapper {
        gap: 10px;
    }
   

</style>
<!-- ========================== Shipping Section Start ============================ -->
    <section class="shipping mb-80 mt-80" id="shipping">
        <div class="container container-lg">
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6" data-aos="zoom-in" data-aos-duration="400">
                    <div class="gap-16 shipping-item flex-align rounded-16 bg-main-two-50 hover-bg-main-100 transition-2">
                        <span class="flex-shrink-0 w-56 h-56 text-white flex-center rounded-circle bg-main-two-600 text-32"><i class="ph-fill ph-car-profile"></i></span>
                        <div class="">
                            <h6 class="mb-0">Free Shipping</h6>
                            <span class="text-sm text-heading">Enjoy free shipping across the country</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6" data-aos="zoom-in" data-aos-duration="600">
                    <div class="gap-16 shipping-item flex-align rounded-16 bg-main-two-50 hover-bg-main-100 transition-2">
                        <span class="flex-shrink-0 w-56 h-56 text-white flex-center rounded-circle bg-main-two-600 text-32"><i class="ph-fill ph-hand-heart"></i></span>
                        <div class="">
                            <h6 class="mb-0"> 100% Satisfaction</h6>
                            <span class="text-sm text-heading">Guaranteed satisfaction with every purchase</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800">
                    <div class="gap-16 shipping-item flex-align rounded-16 bg-main-two-50 hover-bg-main-100 transition-2">
                        <span class="flex-shrink-0 w-56 h-56 text-white flex-center rounded-circle bg-main-two-600 text-32"><i class="ph-fill ph-credit-card"></i></span>
                        <div class="">
                            <h6 class="mb-0"> Secure Payments</h6>
                            <span class="text-sm text-heading">Make secure payments with confidence</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="gap-16 shipping-item flex-align rounded-16 bg-main-two-50 hover-bg-main-100 transition-2">
                        <span class="flex-shrink-0 w-56 h-56 text-white flex-center rounded-circle bg-main-two-600 text-32"><i class="ph-fill ph-chats"></i></span>
                        <div class="">
                            <h6 class="mb-0"> 24/7 Support</h6>
                            <span class="text-sm text-heading">Get support anytime, day or night</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================== Shipping Section End ============================ -->

<!-- ==================== Footer Two Start Here ==================== -->
<footer class="py-40 overflow-hidden footer" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border: 1px solid #e0e0e0;">

    <div class="container container-lg" style="margin-right: 20px; margin-left:20px;">

        <div class="flex-wrap footer-item-two-wrapper d-flex align-items-start">

            <div class="footer-item max-w-275" data-aos="fade-up" data-aos-duration="200">
                <div class="footer-item__logo">
                    <a href="index.html"> <img src="<?php echo e(asset('frontend/assets/images/logo/footer-logo-new.png')); ?> " alt="" style="margin-bottom:20px;"></a>

                </div>
                <p class="mb-24" style="max-width: 300px;">DK Mart is Your trusted online shopping destination in Sri Lanka, offering a wide range of quality products at unbeatable prices. Shop with confidence, convenience, and local expertise!  </p>
              
            </div>
            
            <div class="footer-item" data-aos="fade-up" data-aos-duration="400"style="margin-left: 45px;">
                <h6 class="footer-item__title">About us</h6>
                <ul class="footer-menu">
                    <li class="mb-16">
                        <a href="<?php echo e(route('about')); ?>" class="text-gray-600 hover-text-main-600">Company Profile</a>
                    </li>
                    <li class="mb-16">
                        <a href="/shop" class="text-gray-600 hover-text-main-600">Shop</a>
                    </li>
                    <li class="mb-16">
                        <a href="<?php echo e(route('contact')); ?>" class="text-gray-600 hover-text-main-600">Contact Us</a>
                    </li>
                    <li class="mb-16">
                        <a href="<?php echo e(route('frontend.vendor')); ?>" class="text-gray-600 hover-text-main-600">Vendors</a>
                    </li>
                </ul>
            </div>

           
            <div class="footer-item" data-aos="fade-up" data-aos-duration="800">
                <h6 class="footer-item__title">My Account</h6>
                <ul class="footer-menu">
                    <li class="mb-16">
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-600 hover-text-main-600">My Account</a>
                    </li>
                   
                    <li class="mb-16">
                        <a href="<?php echo e(route('cart')); ?>"  class="text-gray-600 hover-text-main-600">Shoping Cart</a>
                    </li>
                   
                    <li class="mb-16">
                        <a href="<?php echo e(route('wishlist')); ?>"  class="text-gray-600 hover-text-main-600">Wishlist</a>
                    </li>
                    <li class="mb-16">
                        <a href="shop.html" class="text-gray-600 hover-text-main-600">Order History</a>
                    </li>
                   
                </ul>
            </div>

            <div class="footer-item" data-aos="fade-up" data-aos-duration="1000">
                <h6 class="footer-item__title">Information</h6>
                <ul class="footer-menu">
                    <li class="mb-16">
                        <a href="<?php echo e(route('vendor_register')); ?>" class="text-gray-600 hover-text-main-600">Become a Vendor</a>
                    </li>
                    <li class="mb-16">
                        <a href="<?php echo e(route('affiliate_home')); ?>" class="text-gray-600 hover-text-main-600">Affiliate Program</a>
                    </li>
                    <li class="mb-16">
                        <a href= "<?php echo e(route('privacy-policy')); ?>"class="text-gray-600 hover-text-main-600">Privacy Policy</a>
                    </li>
                  
                </ul>
            </div>
            
            <div class="footer-item" data-aos="fade-up" data-aos-duration="1200" style="margin-right: 35px;">
                <h6 class="">Connect with us</h6>
                    <?php
                        $companySettings = \App\Models\CompanySettings::first(); 
                    ?>

              <div class="gap-14 mb-14 flex-align">
                    <span class="flex-shrink-0 border border-gray-100 w-30 h-30 flex-center rounded-circle text-main-two-600 text-md"><i class="ph-fill ph-phone-call"></i></span>
                    <a href="tel:0787004900" class="text-gray-900 text-md hover-text-main-600"><?php echo e($companySettings->contact); ?></a>
                </div>
                <div class="gap-14 mb-14 flex-align">
                    <span class="flex-shrink-0 border border-gray-100 w-30 h-30 flex-center rounded-circle text-main-two-600 text-md"><i class="ph-fill ph-envelope"></i></span>
                    <a href="mailto:<?php echo e($companySettings->email); ?>" class="text-gray-900 text-md hover-text-main-600"><?php echo e($companySettings->email); ?></a>
                </div>
                <div class="gap-14 mb-14 flex-align">
                    <span class="flex-shrink-0 border border-gray-100 w-30 h-30 flex-center rounded-circle text-main-two-600 text-md"><i class="ph-fill ph-map-pin"></i></span>
                    <span class="text-gray-900 text-md "><?php echo e($companySettings->address); ?></span>
                </div>
                <ul class="gap-16 flex-align" >
                    <li>
                        <a href="https://www.facebook.com" class="text-xl w-44 h-44 flex-center bg-main-two-50 text-main-two-600 rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-facebook-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com" class="text-xl w-44 h-44 flex-center bg-main-two-50 text-main-two-600 rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-twitter-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com" class="text-xl w-44 h-44 flex-center bg-main-two-50 text-main-two-600 rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-instagram-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.pinterest.com" class="text-xl w-44 h-44 flex-center bg-main-two-50 text-main-two-600 rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-linkedin-logo"></i>
                        </a>
                    </li>
                </ul>
           
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="py-8 bottom-footer bg-color-three">
    <div class="container container-lg"style="margin-right: 20px; margin-left:20px;">
        <div class="flex-wrap gap-16 py-16 bottom-footer__inner flex-between">
            <p class="bottom-footer__text wow fadeInLeftBig">DK-Mart eCommerce &copy; 2024. All Rights Reserved Powered by eSupport Technologies </p>
            <div class="flex-wrap gap-8 flex-align wow fadeInRightBig">
                <span class="text-sm text-heading">We Are Accepting</span>
                <img src="frontend/assets/images/thumbs/payment-method.jpg" alt=""style="margin-right: 35px; ">
            </div>
        </div>
    </div>
</div>

<!-- ==================== Footer Two End Here ==================== --><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/includes/footer.blade.php ENDPATH**/ ?>