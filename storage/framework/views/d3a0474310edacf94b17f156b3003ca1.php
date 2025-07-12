<!-- Footer Section -->
<footer class="footer-section bg-dark text-white">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row py-5">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?php echo e(asset('frontend/newstyle/assets/images/Fire Waves LOGO.png')); ?>"
                             alt="Fair Waves Logo"
                             class="footer-logo me-3"
                             style="height: 40px; width: auto;">
                        <h5 class="mb-0 text-white">FAIR WAVES</h5>
                    </div>
                    <p class="text-muted mb-3">
                        Your trusted partner for premium electronics and exceptional service.
                        We bring you the latest technology at competitive prices.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-muted me-3 hover-orange"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-muted me-3 hover-orange"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-muted me-3 hover-orange"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-muted hover-orange"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="text-white mb-3">Quick Links</h6>
                    
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="" class="text-muted text-decoration-none hover-orange">Home</a></li>
                        <li class="mb-2"><a href="" class="text-muted text-decoration-none hover-orange">Products</a></li>
                        <li class="mb-2"><a href="" class="text-muted text-decoration-none hover-orange">About Us</a></li>
                        <li class="mb-2"><a href="" class="text-muted text-decoration-none hover-orange">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- Customer Service -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="text-white mb-3">Customer Service</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-orange">Help & Support</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-orange">Shipping Info</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-orange">Returns & Exchanges</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-orange">Terms & Conditions</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-orange">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="text-white mb-3">Contact Info</h6>
                    <div class="contact-info">
                        <div class="d-flex mb-2">
                            <i class="fas fa-map-marker-alt me-2 mt-1 text-muted"></i>
                            <p class="text-muted mb-0">123 Electronics Street, Tech City, TC 12345</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="fas fa-phone me-2 mt-1 text-muted"></i>
                            <p class="text-muted mb-0">+1 (555) 123-4567</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="fas fa-envelope me-2 mt-1 text-muted"></i>
                            <p class="text-muted mb-0">info@fairwaves.com</p>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-clock me-2 mt-1 text-muted"></i>
                            <p class="text-muted mb-0">Mon - Sat: 9:00 AM - 8:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="row border-top border-secondary py-3">
            <div class="col-md-6">
                <p class="text-muted mb-0">© <?php echo e(date('Y')); ?> Fair Waves. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted mb-0">Powered by <span class="text-white">Fair Waves Team</span></p>
            </div>
        </div>
    </div>
</footer>

<style>
.footer-section {
    margin-top: auto;
}

.footer-widget h6 {
    color: #ff5800;
    font-weight: 600;
}

.social-links a {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: #ff5800;
    color: white !important;
    transform: translateY(-2px);
}

.hover-orange:hover {
    color: #ff5800 !important;
}

.contact-info i {
    color: #ff5800;
    width: 20px;
}

.footer-logo {
    transition: transform 0.3s ease;
}

.footer-logo:hover {
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .footer-section .col-md-6.text-md-end {
        text-align: center !important;
    }

    .social-links {
        text-align: center;
        margin-top: 1rem;
    }
}
</style>
<?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/layouts/footer.blade.php ENDPATH**/ ?>