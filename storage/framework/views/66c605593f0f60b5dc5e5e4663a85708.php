<?php $__env->startSection('content'); ?>

<style>
    /* Dealer Application Styles */
.dealer-application {
    background: linear-gradient(135deg, #ff5800 0%, #e04e00 100%);
    min-height: 100vh;
    padding: 2rem 0;
    width: 100%;
}

.application-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
    transform: translateY(0);
    transition: all 0.3s ease;
    width: 100%;
    margin: 0 auto;
}

.application-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.application-card .card-header {
    background: linear-gradient(135deg, #ff5800 0%, #ff7733 100%);
    color: white;
    padding: 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.application-card .card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    transform: rotate(45deg);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.application-card .card-header h2 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: relative;
    z-index: 1;
}

.application-card .card-header h2 i {
    margin-right: 0.5rem;
}

.application-card .card-header p {
    margin: 0.5rem 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

.application-card .card-body {
    padding: 2rem;
}

.dealer-application .form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.dealer-application .form-label {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dealer-application .form-label i {
    color: #ff5800;
    width: 1.25rem;
}

.dealer-application .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8fafc;
    width: 100%;
}

.dealer-application .form-control:focus {
    border-color: #ff5800;
    box-shadow: 0 0 0 3px rgba(255, 88, 0, 0.1);
    background: white;
    transform: translateY(-1px);
    outline: none;
}

.dealer-application .form-control[readonly] {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border-color: #cbd5e0;
    color: #4a5568;
}

.dealer-application .input-with-badge {
    display: flex;
    align-items: center;
    gap: 1rem;
    width: 100%;
}

.dealer-application .input-with-badge .form-control {
    flex: 1;
}

.dealer-application .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.875rem;
    white-space: nowrap;
}

.dealer-application .rank-badge {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.dealer-application .tier-badge {
    background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
    color: white;
}

.dealer-application .agreement-section {
    background: linear-gradient(135deg, #fff5f0 0%, #fed7d2 100%);
    border-radius: 12px;
    padding: 1.5rem;
    border: 2px solid #ff5800;
    margin: 1.5rem 0;
}

.dealer-application .form-check {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.dealer-application .form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    margin: 0;
    cursor: pointer;
    accent-color: #ff5800;
    flex-shrink: 0;
}

.dealer-application .form-check-label {
    font-size: 1rem;
    line-height: 1.5;
    cursor: pointer;
    color: #2d3748;
}

.dealer-application .form-check-label a {
    color: #ff5800;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.dealer-application .form-check-label a:hover {
    color: #e04e00;
    text-decoration: underline;
}

.dealer-application .submit-btn {
    background: linear-gradient(135deg, #ff5800 0%, #ff7733 100%);
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.dealer-application .submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 88, 0, 0.3);
    background: linear-gradient(135deg, #e04e00 0%, #cc4400 100%);
}

.dealer-application .submit-btn:active {
    transform: translateY(0);
}

.dealer-application .submit-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.dealer-application .submit-btn:hover::before {
    width: 300px;
    height: 300px;
}

.benefits-section {
    background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 0 0 2rem 0;
    border: 2px solid #3b82f6;
}

.benefits-title {
    color: #1e40af;
    font-weight: 700;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.benefits-title i {
    color: #ff5800;
}

.benefits-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.benefits-list li {
    padding: 0.5rem 0;
    color: #2d3748;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.benefits-list li::before {
    content: '✓';
    background: #48bb78;
    color: white;
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.contact-info {
    text-align: center;
    margin-top: 1.5rem;
}

.contact-info a {
    color: #ff5800;
    text-decoration: none;
}

.contact-info a:hover {
    color: #e04e00;
    text-decoration: underline;
}

.contact-info i {
    color: #ff5800;
    margin-right: 0.25rem;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .dealer-application {
        padding: 1.5rem 0;
    }

    .application-card .card-body {
        padding: 1.5rem;
    }
}

@media (max-width: 992px) {
    .application-card .card-header h2 {
        font-size: 2.25rem;
    }

    .dealer-application {
        padding: 1rem 0;
    }
}

@media (max-width: 768px) {
    .application-card .card-header h2 {
        font-size: 2rem;
    }

    .application-card {
        margin: 0.5rem;
    }

    .dealer-application {
        padding: 0.5rem 0;
    }

    .dealer-application .input-with-badge {
        flex-direction: column;
        align-items: stretch;
    }

    .dealer-application .status-badge {
        align-self: flex-start;
    }

    .application-card .card-body {
        padding: 1.25rem;
    }

    .benefits-section {
        padding: 1.25rem;
    }
}

@media (max-width: 576px) {
    .application-card .card-header h2 {
        font-size: 1.75rem;
    }

    .application-card .card-header p {
        font-size: 1rem;
    }

    .application-card .card-body {
        padding: 1rem;
    }

    .benefits-section {
        padding: 1rem;
    }

    .dealer-application .form-group {
        margin-bottom: 1.25rem;
    }
}

/* Focus states for accessibility */
.dealer-application .form-group.focused .form-label {
    color: #ff5800;
}

.dealer-application .agreement-section.agreed {
    background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%);
    border-color: #48bb78;
}

/* Loading state */
.dealer-application .submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.dealer-application .submit-btn:disabled:hover {
    transform: none;
    box-shadow: none;
}
</style>
<br><br><br><br><br><br>

<div class="dealer-application">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="application-card">
                    <div class="card-header">
                        <h2><i class="fas fa-handshake"></i> Become a Dealer</h2>
                        <p>Join our network of trusted dealers and unlock exclusive opportunities</p>
                    </div>

                    <div class="card-body">
                        <div class="benefits-section">
                            <h4 class="benefits-title">
                                <i class="fas fa-bullseye"></i>
                                Dealer Benefits
                            </h4>
                            <ul class="benefits-list">
                                <li>Exclusive product access and pricing</li>
                                <li>Marketing support and resources</li>
                                <li>Dedicated account management</li>
                                <li>Performance-based rewards</li>
                            </ul>
                        </div>

                        <form action="<?php echo e(route('dealer.apply')); ?>" method="POST" id="dealerApplicationForm">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user"></i>
                                    Your Name
                                </label>
                                <input type="text" class="form-control" value="<?php echo e(auth()->user()->name); ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <input type="email" class="form-control" value="<?php echo e(auth()->user()->email); ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-trophy"></i>
                                    Current Rank
                                </label>
                                <div class="input-with-badge">
                                    <input type="text" class="form-control" value="Beginner" readonly>
                                    <span class="status-badge rank-badge">
                                        <i class="fas fa-star"></i>
                                        Active
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-gem"></i>
                                    Current Tier
                                </label>
                                <div class="input-with-badge">
                                    <input type="text" class="form-control" value="Silver" readonly>
                                    <span class="status-badge tier-badge">
                                        <i class="fas fa-medal"></i>
                                        Silver
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-code"></i>
                                    Sponsered Dealer Code
                                </label>
                                <input type="text" class="form-control" name="dealer_code" placeholder="Enter dealer code" value="<?php echo e(old('dealer_code', $refCode ?? '')); ?>" required>
                                <?php $__errorArgs = ['dealer_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="agreement-section">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required>
                                    <label class="form-check-label" for="agreement">
                                        <strong>Agreement Confirmation</strong><br>
                                        I have carefully read and agree to abide by all terms and conditions outlined in the
                                        <a href="#" target="_blank">Dealer Agreement</a>. I understand my responsibilities
                                        and commitments as a dealer partner.
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="submit-btn">
                                <i class="fas fa-rocket"></i>
                                Submit Application
                            </button>
                        </form>

                        <div class="contact-info">
                            <small class="text-muted">
                                <i class="fas fa-phone"></i>
                                Need help? Contact our dealer support team at
                                <a href="mailto:dealers@company.com">dealers@company.com</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script >
    // Dealer Application JavaScript
$(document).ready(function() {

    // Form validation and submission
    $('#dealerApplicationForm').on('submit', function(e) {
        const agreementChecked = $('#agreement').is(':checked');

        if (!agreementChecked) {
            e.preventDefault();

            // Show SweetAlert if available, otherwise use regular alert
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Agreement Required',
                    text: 'Please agree to the Dealer Agreement before submitting.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ff5800'
                });
            } else {
                alert('Please agree to the Dealer Agreement before submitting.');
            }

            // Shake the agreement section
            $('.agreement-section').addClass('shake');
            setTimeout(function() {
                $('.agreement-section').removeClass('shake');
            }, 500);

            return false;
        }

        // Add loading state to button
        const submitBtn = $('.submit-btn');
        const originalText = submitBtn.html();

        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Processing Application...');
        submitBtn.prop('disabled', true);

        // Reset button after 5 seconds if form doesn't submit (fallback)
        setTimeout(function() {
            if (submitBtn.prop('disabled')) {
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }
        }, 5000);
    });

    // Add ripple effect to submit button
    $('.submit-btn').on('click', function(e) {
        const button = $(this);
        const ripple = $('<span class="ripple"></span>');

        // Calculate position for ripple
        const buttonOffset = button.offset();
        const xPos = e.pageX - buttonOffset.left;
        const yPos = e.pageY - buttonOffset.top;

        ripple.css({
            position: 'absolute',
            top: yPos + 'px',
            left: xPos + 'px',
            width: '0px',
            height: '0px',
            borderRadius: '50%',
            background: 'rgba(255, 255, 255, 0.5)',
            transform: 'translate(-50%, -50%)',
            animation: 'ripple-animation 0.6s ease-out'
        });

        button.append(ripple);

        setTimeout(function() {
            ripple.remove();
        }, 600);
    });

    // Smooth focus animations for form fields
    $('.form-control').on('focus', function() {
        $(this).closest('.form-group').addClass('focused');
    });

    $('.form-control').on('blur', function() {
        $(this).closest('.form-group').removeClass('focused');
    });

    // Agreement checkbox animation and validation
    $('#agreement').on('change', function() {
        const agreementSection = $('.agreement-section');
        const submitBtn = $('.submit-btn');

        if ($(this).is(':checked')) {
            agreementSection.addClass('agreed');
            submitBtn.removeClass('disabled-state');

            // Add success animation
            agreementSection.addClass('pulse-success');
            setTimeout(function() {
                agreementSection.removeClass('pulse-success');
            }, 1000);
        } else {
            agreementSection.removeClass('agreed');
            submitBtn.addClass('disabled-state');
        }
    });

    // Smooth scroll to top of form if there are validation errors
    function scrollToFormTop() {
        $('html, body').animate({
            scrollTop: $('.application-card').offset().top - 100
        }, 500);
    }

    // Form field validation on blur
    $('.form-control[required]').on('blur', function() {
        const field = $(this);
        const formGroup = field.closest('.form-group');

        if (field.val().trim() === '') {
            formGroup.addClass('error');
        } else {
            formGroup.removeClass('error');
        }
    });

    // Hover effects for interactive elements
    $('.benefits-list li').on('mouseenter', function() {
        $(this).addClass('hover-highlight');
    }).on('mouseleave', function() {
        $(this).removeClass('hover-highlight');
    });

    // Keyboard navigation support
    $('.form-check-input, .submit-btn').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            $(this).click();
        }
    });

    // Auto-resize text areas if any are added dynamically
    $('textarea').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Add loading states for any AJAX requests
    $(document).ajaxStart(function() {
        $('.submit-btn').addClass('loading');
    }).ajaxStop(function() {
        $('.submit-btn').removeClass('loading');
    });

    // Initialize tooltips if Bootstrap tooltips are available
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Handle window resize for responsive adjustments
    $(window).on('resize', function() {
        // Adjust form layout on window resize if needed
        const windowWidth = $(window).width();

        if (windowWidth < 768) {
            $('.input-with-badge').addClass('mobile-stacked');
        } else {
            $('.input-with-badge').removeClass('mobile-stacked');
        }
    });

    // Trigger resize handler on initial load
    $(window).trigger('resize');

    // Add custom CSS animations dynamically
    if (!$('#dealer-animations').length) {
        $('<style id="dealer-animations">')
            .text(`
                @keyframes ripple-animation {
                    0% { width: 0px; height: 0px; opacity: 1; }
                    100% { width: 200px; height: 200px; opacity: 0; }
                }

                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    25% { transform: translateX(-5px); }
                    75% { transform: translateX(5px); }
                }

                @keyframes pulse-success {
                    0% { box-shadow: 0 0 0 0 rgba(72, 187, 120, 0.7); }
                    70% { box-shadow: 0 0 0 10px rgba(72, 187, 120, 0); }
                    100% { box-shadow: 0 0 0 0 rgba(72, 187, 120, 0); }
                }

                .shake { animation: shake 0.5s ease-in-out; }
                .pulse-success { animation: pulse-success 1s ease-out; }

                .hover-highlight {
                    background-color: rgba(255, 88, 0, 0.1);
                    border-radius: 8px;
                    padding: 0.25rem;
                    margin: -0.25rem;
                    transition: all 0.3s ease;
                }

                .form-group.error .form-control {
                    border-color: #e53e3e;
                    box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
                }

                .disabled-state {
                    opacity: 0.6;
                    pointer-events: none;
                }

                .mobile-stacked .status-badge {
                    margin-top: 0.5rem;
                }
            `)
            .appendTo('head');
    }

    // Console log for debugging (remove in production)
    console.log('Dealer Application form initialized successfully');
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/become-a-dealer.blade.php ENDPATH**/ ?>