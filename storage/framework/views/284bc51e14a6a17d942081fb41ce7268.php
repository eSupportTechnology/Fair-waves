<?php $__env->startSection('content'); ?>

<style>

  .card {
    border-radius: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .checkout-card {
    flex: 1;
  }

  .error-message {
    color: red;
    font-size: 0.875rem;
  }

  .square-input {
    border-radius: 0;
    font-size: 14px;
  }

  .summary-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    width: 100%;
    min-width: 380px; /* Increased width */
    max-width: 480px; /* Increased max width */
  }

  .summary-details .total-section span {
    white-space: nowrap; /* Prevents wrapping */
  }

</style>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Payment</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <?php if(isset($dealer) && $dealer->dealerProfile && $dealer->dealerProfile->dealer_shop_name): ?>
                        <a href="<?php echo e(route('showroom.index', $dealer->dealerProfile->dealer_shop_name)); ?>" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                            <i class="ph ph-house"></i>
                            Home
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(url('/')); ?>" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                            <i class="ph ph-house"></i>
                            Home
                        </a>
                    <?php endif; ?>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> Payment </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<style>
.payment-section {
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 60px 0;
}

.payment-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.payment-card:hover {
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
}

.payment-title {
    color: #333;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.payment-tabs .nav-link {
    border: none;
    padding: 15px 25px;
    border-radius: 10px;
    color: #666;
    transition: all 0.3s ease;
    margin: 0 10px;
    position: relative;
    background: #f8f9fa;
}

.payment-tabs .nav-link.active {
    background: #fff;
    color: #ee520a;
    box-shadow: 0 2px 10px rgba(238,82,10,0.1);
}

.payment-tabs .nav-link:hover {
    transform: translateY(-2px);
}

.payment-form .form-label {
    font-weight: 500;
    color: #555;
    margin-bottom: 8px;
}

.payment-form .form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.payment-form .form-control:focus {
    border-color: #ee520a;
    box-shadow: 0 0 0 0.2rem rgba(238,82,10,0.1);
}

.btn-pay {
    background: linear-gradient(135deg, #ee520a, #ff6b2b);
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-pay:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(238,82,10,0.2);
}

.cod-info {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    border-left: 4px solid #ee520a;
}

</style>

<section class="payment-section">
    <div class="container">
        <div class="row checkout-summary-container">
            <!-- Payment -->
            <div class="col-md-8 mb-4">
                <div class="payment-card">
                    <div class="p-4">
            <h5 class="payment-title">Select Payment Method</h5>

            <!-- Payment Tabs -->
            <ul class="nav nav-tabs payment-tabs" id="paymentTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active d-flex flex-column align-items-center" id="credit-card-tab" data-bs-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="true">
                  <div class="mb-2">
                    <img src="<?php echo e(asset('frontend/assets/images/imgs/card.png')); ?>" style="width: 40px; height: auto;">
                  </div>
                  <span>Credit/Debit Card</span>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link d-flex flex-column align-items-center" id="cash-on-delivery-tab" data-bs-toggle="tab" href="#cash-on-delivery" role="tab" aria-controls="cash-on-delivery" aria-selected="false">
                  <div class="mb-2">
                    <img src="<?php echo e(asset('frontend/assets/images/imgs/cod.png')); ?>" style="width: 50px; height: auto;">
                  </div>
                  <span>Cash on Delivery</span>
                </a>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="paymentTabsContent">
            <form action="<?php echo e(route('dealer.confirm.card.order', $order->order_code)); ?>" method="POST">
            <?php echo csrf_field(); ?>
              <!-- Credit/Debit Card Payment -->
              <div class="tab-pane fade show active payment-form" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab">
                <div class="mb-4">
                  <label for="cardName" class="form-label">
                    <span class="text-danger me-1">*</span>Name on Card
                  </label>
                  <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter card holder name" required>
                </div>
                <div class="mb-4">
                  <label for="cardNumber" class="form-label">
                    <span class="text-danger me-1">*</span>Card Number
                  </label>
                  <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label for="expiryDate" class="form-label">
                      <span class="text-danger me-1">*</span>Expiry Date
                    </label>
                    <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label for="cvv" class="form-label">
                      <span class="text-danger me-1">*</span>CVV
                    </label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-pay text-white w-100">
                  <i class="fas fa-lock me-2"></i>Pay Now Securely
                </button>
                </form>
              </div>

              <!-- Cash on Delivery -->
              <div class="tab-pane fade" id="cash-on-delivery" role="tabpanel" aria-labelledby="cash-on-delivery-tab">
                <div class="cod-info mb-4">
                  <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Important Information</h6>
                  <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pay in cash to our courier upon delivery</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Verify delivery status is 'Out for Delivery' before accepting</li>
                    <li><i class="fas fa-shield-alt text-primary me-2"></i>100% Safe and Secure Delivery</li>
                  </ul>
                </div>
                <form action="<?php echo e(route('dealer.confirm.cod.order', $order->order_code)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-pay text-white w-100">
                        <i class="fas fa-handshake me-2"></i>Confirm Cash on Delivery
                    </button>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="col-md-4">
        <div class="card border-0 summary-card">
          <div class="card-body p-4">
            <h5 class="card-title mb-4" style="font-size: 24px; color: #333; font-weight: 600;">Order Summary</h5>
            
            <div class="summary-details">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span style="color: #666; font-size: 16px;">Subtotal</span>
                <span style="color: #333; font-size: 16px; font-weight: 500;">Rs. <?php echo e(number_format($order->total_cost - 300, 2)); ?></span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span style="color: #666; font-size: 16px;">Delivery Fee</span>
                <span style="color: #333; font-size: 16px; font-weight: 500;">Rs. 300.00</span>
              </div>
              
              <hr style="margin: 20px 0; opacity: 0.1;">
              
              <div class="d-flex justify-content-between align-items-center total-section">
                <span style="color: #333; font-size: 18px; font-weight: 600;">Total Amount</span>
                <span style="color: rgb(35, 98, 225); font-size: 20px; font-weight: 600;">Rs. <?php echo e(number_format($order->total_cost, 2)); ?></span>
              </div>
            </div>

            <div class="mt-4 d-flex align-items-center" style="color: #666;">
              <i class="fas fa-shield-alt me-2" style="color: #28a745;"></i>
              <span style="font-size: 14px;">Secure Payment</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/DealerShowroom/payment.blade.php ENDPATH**/ ?>