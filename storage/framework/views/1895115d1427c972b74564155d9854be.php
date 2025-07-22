<?php $__env->startSection('content'); ?>
    <style>
        .payment-page { padding: 40px 0; background: #f8f9fa; }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .payment-option {
            border: 2px solid #dee2e6;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: #6c757d;
        }
        .payment-option:hover, .payment-option.active {
            border-color: #007bff;
            color: #007bff;
            text-decoration: none;
        }
        .payment-option.active { background: #f8f9ff; }
        .payment-content { background: #f8f9fa; }
        .summary-total {
            border-top: 2px solid #dee2e6;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .cod-alert { background: #fff3cd; border-color: #ffeaa7; color: #856404; }
    </style>

    <!-- Breadcrumb -->
    <div class="bg-white border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0">Payment</h4>
                </div>
                <div class="col-auto">
                    <nav>
                        <a href="index.html" class="text-primary text-decoration-none">Home</a>
                        <span class="text-muted mx-2">/</span>
                        <span class="text-muted">Payment</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="payment-page">
        <div class="container">
            <div class="row">
                <!-- Payment Methods -->
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Choose Payment Method</h5>
                        </div>
                        <div class="card-body">
                            <!-- Payment Options -->
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="payment-option active p-3 rounded text-center" onclick="showPayment('card')">
                                        <img src="<?php echo e(asset('frontend/assets/images/imgs/card.png')); ?>" width="40" class="mb-2">
                                        <div class="fw-500">Credit/Debit Card</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="payment-option p-3 rounded text-center" onclick="showPayment('cod')">
                                        <img src="<?php echo e(asset('frontend/assets/images/imgs/cod.png')); ?>" width="40" class="mb-2">
                                        <div class="fw-500">Cash on Delivery</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Payment -->
                            <div id="card-payment" class="payment-content p-4 rounded">
                                <div class="text-center">
                                    <img src="<?php echo e(asset('frontend/assets/images/imgs/card.png')); ?>" width="50" class="mb-3">
                                    <p class="text-muted mb-4">You will be redirected to OnePay for secure payment. Your information is encrypted and protected.</p>
                                    <form action="<?php echo e(route('confirm.card.order', $order->order_code)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">Pay with OnePay</button>
                                    </form>
                                    <div class="alert alert-success py-2 mb-0">
                                        <small>🔒 SSL Encrypted & Secure</small>
                                    </div>
                                </div>
                            </div>

                            <!-- COD Payment -->
                            <div id="cod-payment" class="payment-content p-4 rounded d-none">
                                <div class="text-center">
                                    <img src="<?php echo e(asset('frontend/assets/images/imgs/cod.png')); ?>" width="50" class="mb-3">
                                    <div class="cod-alert alert mb-4">
                                        <strong>Instructions:</strong>
                                        <ul class="mb-0 mt-2 text-start">
                                            <li>Pay cash when you receive your order</li>
                                            <li>Check delivery status is 'Out for Delivery'</li>
                                            <li>Inspect items before payment</li>
                                        </ul>
                                    </div>
                                    <form action="<?php echo e(route('confirm.cod.order', $order->order_code)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-warning btn-lg w-100">Confirm COD Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rs. <?php echo e(number_format($order->total_cost - 300, 2)); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Delivery Fee</span>
                                <span>Rs. 300.00</span>
                            </div>
                            <div class="d-flex justify-content-between summary-total pt-3">
                                <span>Total</span>
                                <span>Rs. <?php echo e(number_format($order->total_cost, 2)); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPayment(type) {
            // Toggle active state
            document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
            event.target.closest('.payment-option').classList.add('active');

            // Show/hide content
            document.getElementById('card-payment').classList.toggle('d-none', type !== 'card');
            document.getElementById('cod-payment').classList.toggle('d-none', type !== 'cod');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/payment.blade.php ENDPATH**/ ?>