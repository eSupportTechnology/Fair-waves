<!-- Profe                        <div class="d-flex align-items-center mb-3">
                            <img src="h
                            {{-- {{ $dealer->profile_image_url }} --}}
                            "
                                 alt="
                                 {{-- {{ $dealer->name }} --}}
                                  "
                                 class="dealer-footer-logo me-3">
                        </div>ler Footer Section -->
<footer class="professional-footer">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row py-5">
            <!-- Dealer Information -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
             
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="footer-title">Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="#" class="footer-link">Home</a></li>
                        <li><a href="#" class="footer-link">Products</a></li>
                        <li><a href="#" class="footer-link">About Us</a></li>
                        <li><a href="#" class="footer-link">Contact</a></li>
                        <li><a href="#" class="footer-link">Showroom</a></li>
                    </ul>
                </div>
            </div>

            <!-- Customer Support -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="footer-title">Customer Support</h6>
                    <ul class="footer-links">
                        <li><a href="#" class="footer-link">Help Center</a></li>
                        <li><a href="#" class="footer-link">Shipping Information</a></li>
                        <li><a href="#" class="footer-link">Returns & Exchanges</a></li>
                        <li><a href="#" class="footer-link">Warranty Policy</a></li>
                        <li><a href="#" class="footer-link">Track Your Order</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="footer-title">Get In Touch</h6>
                    @if(isset($dealer) && $dealer->dealerProfile)
                        <!-- Dealer Contact Info -->
                        <div class="contact-info">
                            @if($dealer->dealerProfile->address)
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $dealer->dealerProfile->address }}</span>
                                </div>
                            @endif
                            @if($dealer->dealerProfile->phone)
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:{{ $dealer->dealerProfile->phone }}">{{ $dealer->dealerProfile->phone }}</a>
                                </div>
                            @endif
                            @if($dealer->email)
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:{{ $dealer->email }}">{{ $dealer->email }}</a>
                                </div>
                            @endif
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <span>Mon - Sat: 9:00 AM - 8:00 PM</span>
                            </div>
                        </div>
                    @else
                        <!-- Default Contact Info -->
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>123 Electronics Street, Tech City</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:+1555123456">+1 (555) 123-4567</a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:info@fairwaves.com">info@fairwaves.com</a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <span>Mon - Sat: 9:00 AM - 8:00 PM</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Professional Payment Methods Section -->
        <div class="payment-section">
            <div class="row align-items-center">
                <div class="col-md-12 text-center mb-3">
                    <h6 class="payment-title">Secure Payment Methods</h6>
                </div>
                <div class="col-md-12">
                    <div class="payment-methods">
                        <div class="payment-grid">
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/VISA1.webp') }}" alt="Visa" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/MASTER1.webp') }}" alt="Mastercard" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/AMEX1.webp') }}" alt="American Express" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/COMBANK1.webp') }}" alt="Commercial Bank" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/SAMPATH1.webp') }}" alt="Sampath Bank" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/HNB1.webp') }}" alt="HNB" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/BOC1.webp') }}" alt="Bank of Ceylon" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="{{ asset('frontend/newstyle/assets/images/new-bank-logo/NSB1.webp') }}" alt="NSB" class="payment-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright mb-0">
                        © {{ date('Y') }}
                        @if(isset($dealer))
                            {{ $dealer->dealerProfile->dealer_shop_name ?? $dealer->name }}
                        @else
                            Fair Waves
                        @endif
                        . All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-links-inline">
                        <a href="#" class="footer-link-inline">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="#" class="footer-link-inline">Terms of Service</a>
                        <span class="separator">|</span>
                        <a href="#" class="footer-link-inline">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Professional Footer Styling */
.professional-footer {
    background: linear-gradient(135deg, #1a1f2e 0%, #16213e 50%, #0f172a 100%);
    color: #e2e8f0;
    margin-top: auto;
    position: relative;
    overflow: hidden;
}

.professional-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #ff5800 50%, transparent 100%);
}

/* Dealer Footer Logo */
.dealer-footer-logo {
    height: 45px;
    width: 45px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid rgba(255, 88, 0, 0.3);
    transition: all 0.3s ease;
}

.dealer-footer-logo:hover {
    border-color: #ff5800;
    transform: scale(1.05);
}

.dealer-footer-placeholder {
    width: 45px;
    height: 45px;
    border-radius: 8px;
    background: linear-gradient(135deg, #ff5800, #ff7a3d);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    border: 2px solid rgba(255, 88, 0, 0.3);
}

/* Footer Widget Styling */
.footer-widget {
    height: 100%;
}

.footer-title {
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    position: relative;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #ff5800, #ff7a3d);
    border-radius: 2px;
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
    position: relative;
    padding-left: 0;
}

.footer-link {
    color: #94a3b8;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
}

.footer-link::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #ff5800;
    transition: width 0.3s ease;
}

.footer-link:hover {
    color: #ff5800;
    transform: translateX(5px);
}

.footer-link:hover::before {
    width: 100%;
}

/* Social Links */
.social-links {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.social-link {
    width: 42px;
    height: 42px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 88, 0, 0.3);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    text-decoration: none;
    font-size: 16px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #ff5800, #ff7a3d);
    transition: left 0.3s ease;
    z-index: 0;
}

.social-link i {
    position: relative;
    z-index: 1;
}

.social-link:hover {
    color: white;
    border-color: #ff5800;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 88, 0, 0.4);
}

.social-link:hover::before {
    left: 0;
}

/* Contact Information */
.contact-info {
    margin-top: 10px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 15px;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.contact-item:last-child {
    border-bottom: none;
}

.contact-item i {
    color: #ff5800;
    font-size: 16px;
    width: 20px;
    text-align: center;
    margin-top: 2px;
    flex-shrink: 0;
}

.contact-item span,
.contact-item a {
    color: #94a3b8;
    text-decoration: none;
    font-weight: 500;
    line-height: 1.5;
    transition: color 0.3s ease;
}

.contact-item a:hover {
    color: #ff5800;
}

.contact-item:hover {
    background: rgba(255, 88, 0, 0.05);
    border-radius: 8px;
    padding-left: 12px;
    border-bottom-color: rgba(255, 88, 0, 0.3);
}

/* Payment Methods Section */
.payment-section {
    background: rgba(0, 0, 0, 0.3);
    padding: 30px 0;
    margin: 30px 0 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px 15px 0 0;
}

.payment-title {
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
}

.payment-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 15px;
    align-items: center;
    justify-items: center;
    max-width: 800px;
    margin: 0 auto;
}

.payment-item {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 8px;
    padding: 12px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 60px;
}

.payment-item:hover {
    background: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    border-color: #ff5800;
}

.payment-logo {
    height: 35px;
    width: auto;
    max-width: 80px;
    object-fit: contain;
    filter: grayscale(0.3);
    transition: filter 0.3s ease;
}

.payment-item:hover .payment-logo {
    filter: grayscale(0);
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.4);
    padding: 20px 0;
    margin-top: 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright {
    color: #94a3b8;
    font-weight: 500;
}

.footer-links-inline {
    display: flex;
    align-items: center;
    gap: 15px;
    justify-content: flex-end;
    flex-wrap: wrap;
}

.footer-link-inline {
    color: #94a3b8;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: color 0.3s ease;
}

.footer-link-inline:hover {
    color: #ff5800;
}

.separator {
    color: #475569;
    font-weight: 300;
}

/* Responsive Design */
@media (max-width: 768px) {
    .professional-footer {
        text-align: center;
    }

    .dealer-footer-logo,
    .dealer-footer-placeholder {
        width: 40px;
        height: 40px;
    }

    .footer-title {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .social-links {
        justify-content: center;
    }

    .payment-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .payment-item {
        padding: 8px;
        min-height: 50px;
    }

    .payment-logo {
        height: 28px;
        max-width: 60px;
    }

    .footer-links-inline {
        justify-content: center;
        margin-top: 15px;
    }

    .contact-item {
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }

    .contact-item i {
        margin-top: 0;
    }
}

@media (max-width: 576px) {
    .payment-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .footer-links-inline {
        flex-direction: column;
        gap: 10px;
    }

    .separator {
        display: none;
    }
}
</style>
