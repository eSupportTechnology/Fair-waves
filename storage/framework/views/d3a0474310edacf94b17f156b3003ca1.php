<!-- Profe                        <div class="d-flex align-items-center mb-3">
                            <img src="h
                            
                            "
                                 alt="
                                 
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
                    <!-- Return/Cancel Order Button -->
                    <div class="return-order-section mb-4">
                        <h6 class="footer-title">Need Help with Your Order?</h6>
                        <button type="button" class="btn btn-return-order" data-bs-toggle="modal" data-bs-target="#returnOrderModal">
                            <i class="fas fa-undo-alt me-2"></i>
                            Return/Cancel Order
                        </button>
                        <p class="mt-2 mb-0 text-muted small">
                            <i class="fas fa-info-circle me-1"></i>
                            Quick and easy return or cancellation process
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="footer-title">Quick Links</h6>
                    <ul class="footer-links">
                        <?php if(isset($dealer)): ?>
                            <li><a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="footer-link">Home</a></li>
                            <li><a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>#products-section" class="footer-link">Products</a></li>
                            <li><a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>" class="footer-link">About Us</a></li>
                            <li><a href="<?php echo e(route('showroom.about', $dealer->dealerProfile->dealer_shop_name)); ?>#contact-section" class="footer-link contact-about-scroll">Contact</a></li>
                        <?php else: ?>
                            <li><a href="" class="footer-link">Home</a></li>
                            <li><a href="" class="footer-link">Products</a></li>
                            <li><a href="" class="footer-link">About Us</a></li>
                            <li><a href="" class="footer-link">Contact</a></li>
                        <?php endif; ?>
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
                        
                    </ul>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-widget">
                    <h6 class="footer-title">Get In Touch</h6>
                    <?php if(isset($dealer) && $dealer->dealerProfile): ?>
                        <!-- Dealer Contact Info -->
                        <div class="contact-info">
                            <?php if($dealer->dealerProfile->address): ?>
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo e($dealer->dealerProfile->address); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($dealer->dealerProfile->phone): ?>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:<?php echo e($dealer->dealerProfile->phone); ?>"><?php echo e($dealer->dealerProfile->phone); ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if($dealer->email): ?>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:<?php echo e($dealer->email); ?>"><?php echo e($dealer->email); ?></a>
                                </div>
                            <?php endif; ?>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <span>Mon - Sat: 9:00 AM - 8:00 PM</span>
                            </div>
                        </div>
                    <?php else: ?>
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
                    <?php endif; ?>
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
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/VISA1.webp')); ?>" alt="Visa" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/MASTER1.webp')); ?>" alt="Mastercard" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/AMEX1.webp')); ?>" alt="American Express" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/COMBANK1.webp')); ?>" alt="Commercial Bank" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/SAMPATH1.webp')); ?>" alt="Sampath Bank" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/HNB1.webp')); ?>" alt="HNB" class="payment-logo">
                            </div>
                            <div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/BOC1.webp')); ?>" alt="Bank of Ceylon" class="payment-logo">
                            </div>
                            <!--div class="payment-item">
                                <img src="<?php echo e(asset('frontend/newstyle/assets/images/new-bank-logo/NSB1.webp')); ?>" alt="NSB" class="payment-logo">
                            </div-->
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
                        © <?php echo e(date('Y')); ?>

                        <?php if(isset($dealer)): ?>
                            <?php echo e($dealer->dealerProfile->dealer_shop_name ?? $dealer->name); ?>

                        <?php else: ?>
                            <?php echo e($companySettings->title ?? 'Fair Waves'); ?>

                        <?php endif; ?>
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

<!-- Return/Cancel Order Modal -->
<div class="modal fade" id="returnOrderModal" tabindex="-1" aria-labelledby="returnOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="returnOrderModalLabel">
                    <i class="fas fa-undo-alt me-2"></i>Return or Cancel Products Request
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div id="modal-success-alert" class="alert alert-success alert-dismissible fade" role="alert" style="display: none;">
                    <strong>Success!</strong> <span id="modal-success-message"></span>
                    <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                
                <div id="modal-error-alert" class="alert alert-danger alert-dismissible fade" role="alert" style="display: none;">
                    <strong>Error!</strong>
                    <ul id="modal-error-list" class="mb-0"></ul>
                    <button type="button" class="close" onclick="this.parentElement.style.display='none';" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Quick Return:</strong> Enter your Order ID to auto-fill your details and submit a return request.
                </div>

                <form id="returnOrderForm" method="POST" action="<?php echo e(route('return-product.submit')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    
                    <style>
                        .modal-auto-filled {
                            background-color: #e8f5e8 !important;
                            border-color: #28a745 !important;
                        }
                        .modal-loading-field {
                            background-color: #f8f9fa !important;
                            border-color: #007bff !important;
                        }
                        .modal-auto-fill-message {
                            margin-top: 5px;
                            margin-bottom: 5px;
                        }
                        .modal .form-group {
                            margin-bottom: 1rem;
                        }
                        .modal .req {
                            color: #dc3545;
                        }
                    </style>
                    
                    <div class="row">
                        <p class="order-title fw-bold text-primary mb-3">Order Information</p>
                        
                        <div class="form-group col-sm-6">
                            <label class="form-label">Order ID<span class="req">*</span></label>
                            <input type="text" class="form-control" name="order_id" id="modal_order_id" required 
                                   placeholder="Enter your order ID (e.g., ORD-XXXXXXXX)" 
                                   title="Enter your order ID to auto-fill customer information">
                            <small class="form-text text-muted">
                                <i class="fa fa-info-circle"></i> Enter your Order ID to automatically fill customer details
                            </small>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-label">Billing customer name <span class="req">*</span></label>
                            <input type="text" class="form-control" name="customer_name" id="modal_customer_name" required
                                   placeholder="Will be auto-filled when Order ID is entered">
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-label">Phone <span class="req">*</span></label>
                            <input type="text" class="form-control" name="phone" id="modal_phone" required
                                   placeholder="Will be auto-filled when Order ID is entered">
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label class="form-label">Order Date<span class="req">*</span></label>
                            <input type="date" class="form-control" name="order_date" id="modal_order_date" required
                                   title="Will be auto-filled when Order ID is entered">
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label class="form-label">Email<span class="req">*</span></label>
                            <input type="email" class="form-control" name="email" id="modal_email" required
                                   placeholder="Will be auto-filled when Order ID is entered">
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="form-label">Request Type<span class="req">*</span></label>
                            <select class="form-control" name="request_type" id="modal_request_type" required>
                                <option value="">Select Request Type</option>
                                <option value="cancel">Cancel Order</option>
                                <option value="return">Return Product</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="form-label" id="modal_reason_label">Why do you want to cancel or reject this order?<span class="req">*</span></label>
                            <textarea class="form-control" name="reason" id="modal_reason" rows="4" placeholder="Please explain your reason..." required></textarea>
                        </div>

                    </div>

                    <div class="form-group col-sm-12">
                        <div class="tacbox terms-conditions-container">
                            <input id="modal_t_and_c_agree" type="checkbox" name="t_and_c_agree" required="required"> 
                            <label for="modal_t_and_c_agree" class="form-label">I agree to <a href="#" target="_blank">Terms & Conditions</a></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" form="returnOrderForm" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>Submit Request
                </button>
            </div>
        </div>
    </div>
</div>

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

/* Return/Cancel Order Button Styling */
.btn-return-order {
    background: linear-gradient(135deg, #ff5800 0%, #ff7a3d 100%);
    color: white !important;
    border: none;
    border-radius: 12px;
    padding: 14px 28px;
    font-weight: 600;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(255, 88, 0, 0.3);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 200px;
    border: 2px solid transparent;
    cursor: pointer;
}

.btn-return-order i,
.btn-return-order span {
    position: relative;
    z-index: 1;
}

.btn-return-order:focus {
    outline: none;
    box-shadow: 0 4px 15px rgba(255, 88, 0, 0.3), 0 0 0 3px rgba(255, 88, 0, 0.1);
}

/* Return Order Section Enhanced Styling */
.return-order-section {
    background: rgba(255, 88, 0, 0.05);
    border: 1px solid rgba(255, 88, 0, 0.1);
    border-radius: 15px;
    padding: 25px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.return-order-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ff5800, #ff7a3d, #ff5800);
}

.return-order-section:hover {
    background: rgba(255, 88, 0, 0.08);
    border-color: rgba(255, 88, 0, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 88, 0, 0.1);
}

.return-order-section .footer-title {
    color: #ff5800;
    margin-bottom: 20px;
}

.return-order-section p.text-muted {
    color: #94a3b8 !important;
    font-style: italic;
    margin-top: 15px;
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

<script>
// Auto-fill functionality for Return Order Modal
document.addEventListener('DOMContentLoaded', function() {
    const modalOrderIdInput = document.getElementById('modal_order_id');
    const modalLoadingSpinner = document.getElementById('modal_loading_spinner');
    const modalOrderStatus = document.getElementById('modal_order_status');
    
    // Form fields to auto-fill
    const modalCustomerName = document.getElementById('modal_customer_name');
    const modalPhone = document.getElementById('modal_phone');
    const modalEmail = document.getElementById('modal_email');
    const modalOrderDate = document.getElementById('modal_order_date');

    let debounceTimer;

    if (modalOrderIdInput) {
        modalOrderIdInput.addEventListener('input', function() {
            const orderId = this.value.trim();
            
            // Clear previous timer
            clearTimeout(debounceTimer);
            
            // Clear previous status
            modalOrderStatus.innerHTML = '';
            
            if (orderId.length >= 3) {
                // Show loading spinner
                modalLoadingSpinner.style.display = 'block';
                
                // Debounce the API call
                debounceTimer = setTimeout(function() {
                    fetchOrderData(orderId);
                }, 500);
            } else {
                modalLoadingSpinner.style.display = 'none';
                clearFormFields();
            }
        });
    }

    function fetchOrderData(orderId) {
        fetch(`/api/order/${orderId}`)
            .then(response => response.json())
            .then(data => {
                modalLoadingSpinner.style.display = 'none';
                
                if (data.success) {
                    // Auto-fill form fields
                    modalCustomerName.value = data.customer_name || '';
                    modalPhone.value = data.phone || '';
                    modalEmail.value = data.email || '';
                    modalOrderDate.value = data.order_date || '';
                    
                    // Show success message
                    modalOrderStatus.innerHTML = `
                        <div class="alert alert-success alert-sm mb-0">
                            <i class="fas fa-check-circle me-2"></i>
                            Order found! Customer details have been auto-filled.
                        </div>
                    `;
                } else {
                    // Show error message
                    modalOrderStatus.innerHTML = `
                        <div class="alert alert-warning alert-sm mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            ${data.message || 'Order not found. Please check your Order ID.'}
                        </div>
                    `;
                    clearFormFields();
                }
            })
            .catch(error => {
                modalLoadingSpinner.style.display = 'none';
                console.error('Error fetching order data:', error);
                
                modalOrderStatus.innerHTML = `
                    <div class="alert alert-danger alert-sm mb-0">
                        <i class="fas fa-times-circle me-2"></i>
                        Error loading order data. Please try again.
                    </div>
                `;
                clearFormFields();
            });
    }

    function clearFormFields() {
        modalCustomerName.value = '';
        modalPhone.value = '';
        modalEmail.value = '';
        modalOrderDate.value = '';
    }

    // Reset form when modal is closed
    const returnModal = document.getElementById('returnOrderModal');
    if (returnModal) {
        returnModal.addEventListener('hidden.bs.modal', function() {
            document.getElementById('returnOrderForm').reset();
            modalOrderStatus.innerHTML = '';
            modalLoadingSpinner.style.display = 'none';
        });
    }

    // Handle form submission
    const returnForm = document.getElementById('returnOrderForm');
    if (returnForm) {
        returnForm.addEventListener('submit', function(e) {
            // Add any additional validation if needed
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            submitBtn.disabled = true;
            
            // The form will submit normally, but we show loading state
            // Reset button state after a short delay if there's an error
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 5000);
        });
    }
});
</script>

<!-- Return/Cancel Order Modal Auto-fill JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let modalOrderIdTimeout;
    const modalOrderIdInput = document.getElementById('modal_order_id');
    const modalCustomerNameInput = document.getElementById('modal_customer_name');
    const modalPhoneInput = document.getElementById('modal_phone');
    const modalEmailInput = document.getElementById('modal_email');
    const modalOrderDateInput = document.getElementById('modal_order_date');
    const modalRequestTypeSelect = document.getElementById('modal_request_type');
    const modalReasonLabel = document.getElementById('modal_reason_label');
    const modalForm = document.getElementById('returnOrderForm');
    
    // Auto-fill functionality for Order ID
    if (modalOrderIdInput) {
        modalOrderIdInput.addEventListener('input', function() {
            clearTimeout(modalOrderIdTimeout);
            const orderId = this.value.trim();
            
            if (orderId.length >= 3) {
                modalOrderIdTimeout = setTimeout(() => {
                    fetchModalOrderData(orderId);
                }, 800); // Debounce for 800ms
            } else {
                clearModalAutoFilledFields();
            }
        });
    }
    
    // Update reason label based on request type
    if (modalRequestTypeSelect) {
        modalRequestTypeSelect.addEventListener('change', function() {
            const selectedType = this.value;
            if (selectedType === 'cancel') {
                modalReasonLabel.innerHTML = 'Why do you want to cancel this order?<span class="req">*</span>';
            } else if (selectedType === 'return') {
                modalReasonLabel.innerHTML = 'Why do you want to return this product?<span class="req">*</span>';
            } else {
                modalReasonLabel.innerHTML = 'Why do you want to cancel or reject this order?<span class="req">*</span>';
            }
        });
    }
    
    // Form submission handling
    if (modalForm) {
        const submitButton = document.querySelector('button[form="returnOrderForm"]');
        
        modalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            console.log('Footer modal form submitted'); // Debug log
            
            const formData = new FormData(this);
            const originalText = submitButton ? submitButton.innerHTML : 'Submit Request';
            
            // Show loading state
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            }
            
            // Debug: Log form data
            console.log('Form data being sent:', Object.fromEntries(formData.entries()));
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response received:', response.status, response.statusText);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showModalSuccess(data.message);
                    this.reset();
                    clearModalAutoFilledFields();
                    
                    // Close modal after 2 seconds
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('returnOrderModal'));
                        if (modal) modal.hide();
                    }, 2000);
                } else {
                    showModalErrors(data.errors || ['An error occurred while submitting your request.']);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModalErrors(['A network error occurred. Please try again.']);
            })
            .finally(() => {
                // Restore button state
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }
            });
        });
        
        // Also handle button click directly
        if (submitButton) {
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Submit button clicked'); // Debug log
                modalForm.dispatchEvent(new Event('submit'));
            });
        }
    }
    
    function fetchModalOrderData(orderId) {
        // Show loading state
        setModalLoadingState(true);
        
        fetch(`/api/order/${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    populateModalOrderData(data.data);
                    showModalAutoFillMessage('Order found! Customer details have been auto-filled.', 'success');
                } else {
                    clearModalAutoFilledFields();
                    showModalAutoFillMessage(data.message || 'Order not found. Please check your Order ID.', 'error');
                }
            })
            .catch(error => {
                console.error('Error fetching order data:', error);
                clearModalAutoFilledFields();
                showModalAutoFillMessage('Error fetching order data. Please try again.', 'error');
            })
            .finally(() => {
                setModalLoadingState(false);
            });
    }
    
    function populateModalOrderData(orderData) {
        // Auto-fill fields and add styling
        if (modalCustomerNameInput) {
            modalCustomerNameInput.value = orderData.customer_name || '';
            modalCustomerNameInput.classList.add('modal-auto-filled');
        }
        
        if (modalPhoneInput) {
            modalPhoneInput.value = orderData.phone || '';
            modalPhoneInput.classList.add('modal-auto-filled');
        }
        
        if (modalEmailInput) {
            modalEmailInput.value = orderData.email || '';
            modalEmailInput.classList.add('modal-auto-filled');
        }
        
        if (modalOrderDateInput) {
            modalOrderDateInput.value = orderData.order_date || '';
            modalOrderDateInput.classList.add('modal-auto-filled');
        }
    }
    
    function clearModalAutoFilledFields() {
        const fields = [modalCustomerNameInput, modalPhoneInput, modalEmailInput, modalOrderDateInput];
        
        fields.forEach(field => {
            if (field) {
                field.value = '';
                field.classList.remove('modal-auto-filled', 'modal-loading-field');
            }
        });
        
        // Clear any auto-fill messages
        const existingMessage = document.querySelector('.modal-auto-fill-message');
        if (existingMessage) {
            existingMessage.remove();
        }
    }
    
    function setModalLoadingState(isLoading) {
        const fields = [modalCustomerNameInput, modalPhoneInput, modalEmailInput, modalOrderDateInput];
        
        fields.forEach(field => {
            if (field) {
                if (isLoading) {
                    field.classList.add('modal-loading-field');
                    field.classList.remove('modal-auto-filled');
                } else {
                    field.classList.remove('modal-loading-field');
                }
            }
        });
    }
    
    function showModalAutoFillMessage(message, type) {
        // Remove existing message
        const existingMessage = document.querySelector('.modal-auto-fill-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Create new message
        const messageDiv = document.createElement('div');
        messageDiv.className = `modal-auto-fill-message small ${type === 'success' ? 'text-success' : 'text-danger'}`;
        messageDiv.innerHTML = `<i class="fa fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
        
        // Insert after order ID input
        if (modalOrderIdInput && modalOrderIdInput.parentNode) {
            modalOrderIdInput.parentNode.appendChild(messageDiv);
        }
    }
    
    function showModalSuccess(message) {
        const successAlert = document.getElementById('modal-success-alert');
        const successMessage = document.getElementById('modal-success-message');
        
        if (successAlert && successMessage) {
            successMessage.textContent = message;
            successAlert.style.display = 'block';
            successAlert.classList.add('show');
            
            // Hide error alert if visible
            const errorAlert = document.getElementById('modal-error-alert');
            if (errorAlert) {
                errorAlert.style.display = 'none';
                errorAlert.classList.remove('show');
            }
        }
    }
    
    function showModalErrors(errors) {
        const errorAlert = document.getElementById('modal-error-alert');
        const errorList = document.getElementById('modal-error-list');
        
        if (errorAlert && errorList) {
            errorList.innerHTML = '';
            
            if (Array.isArray(errors)) {
                errors.forEach(error => {
                    const li = document.createElement('li');
                    li.textContent = error;
                    errorList.appendChild(li);
                });
            } else if (typeof errors === 'object') {
                Object.values(errors).flat().forEach(error => {
                    const li = document.createElement('li');
                    li.textContent = error;
                    errorList.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = errors.toString();
                errorList.appendChild(li);
            }
            
            errorAlert.style.display = 'block';
            errorAlert.classList.add('show');
            
            // Hide success alert if visible
            const successAlert = document.getElementById('modal-success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
                successAlert.classList.remove('show');
            }
        }
    }

    // Handle contact navigation for footer links (same as header)
    // Smooth scrolling for contact links (for current page dealer info)
    document.querySelectorAll('.footer-link.contact-scroll').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    block: 'start'
                });
            }
        });
    });

    // Handle contact navigation to about page for footer links
    document.querySelectorAll('.footer-link.contact-about-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.includes('#contact-section')) {
                // Let the browser handle navigation to the about page
                // The hash will be handled by the about page's JavaScript
                window.location.href = href;
            }
        });
    });
});
</script>
<?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/layouts/footer.blade.php ENDPATH**/ ?>