<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fair Waves - Order Confirmation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
        }

        .email-container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #FF5722 0%, #E64A19 100%);
            padding: 50px 40px;
            text-align: center;
            color: white;
        }

        .logo {
            max-width: 280px;
            height: auto;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .company-tagline {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 5px;
            letter-spacing: 0.8px;
        }

        .content {
            padding: 50px 40px;
        }

        .order-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border-left: 5px solid #FF5722;
        }

        .info-card h3 {
            margin: 0 0 15px 0;
            color: #FF5722;
            font-size: 18px;
            font-weight: 600;
        }

        .info-card p {
            margin: 5px 0;
            color: #333;
            font-size: 14px;
        }

        .order-status {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-paid {
            background: #d4edda;
            color: #155724;
        }

        .status-not-paid {
            background: #f8d7da;
            color: #721c24;
        }

        .products-section {
            margin: 40px 0;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #FF5722;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 20px;
            margin: 15px 0;
            background: #f8f9fa;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
            border: 2px solid #e9ecef;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .product-meta {
            font-size: 14px;
            color: #666;
            margin: 3px 0;
        }

        .product-price {
            font-size: 18px;
            font-weight: 600;
            color: #FF5722;
            text-align: right;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
            border: 2px solid #e9ecef;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #dee2e6;
            font-size: 16px;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-size: 20px;
            font-weight: 600;
            color: #FF5722;
            padding-top: 20px;
            border-top: 2px solid #FF5722;
        }

        .payment-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
        }

        .payment-method {
            display: inline-block;
            padding: 10px 20px;
            background: #FF5722;
            color: white;
            border-radius: 25px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .next-steps {
            background: #e7f3ff;
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
            border-left: 5px solid #007bff;
        }

        .next-steps h3 {
            color: #007bff;
            margin-bottom: 15px;
        }

        .next-steps ul {
            list-style: none;
            padding: 0;
        }

        .next-steps li {
            padding: 8px 0;
            padding-left: 25px;
            position: relative;
        }

        .next-steps li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #007bff;
            font-weight: bold;
        }

        .footer {
            background: #333;
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .contact-info {
            margin: 20px 0;
        }

        .contact-info a {
            color: #FF5722;
            text-decoration: none;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #FF5722;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }

            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .order-info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-item {
                flex-direction: column;
                text-align: center;
            }

            .product-image {
                margin: 0 0 15px 0;
            }

            .product-price {
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="<?php echo e(asset('frontend\newstyle\assets\images\logo.png')); ?>" alt="Fair Waves Logo" class="logo">
            <h1>Order Confirmed!</h1>
            <p class="company-tagline">Thank you for choosing Fair Waves</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <h2 style="color: #333; margin-bottom: 20px;">Hello <?php echo e($order->customer_name); ?>,</h2>
            <p style="font-size: 16px; color: #666; margin-bottom: 30px;">
                Great news! We've received your order and it's being processed. Here are the details:
            </p>

            <!-- Order Information Grid -->
            <div class="order-info-grid">
                <div class="info-card">
                    <h3>Order Details</h3>
                    <p><strong>Order ID:</strong> <?php echo e($order->order_code); ?></p>
                    <p><strong>Order Date:</strong> <?php echo e($order->created_at->format('M d, Y')); ?></p>
                    <p><strong>Status:</strong>
                        <span class="order-status status-<?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                            <?php echo e($order->status); ?>

                        </span>
                    </p>
                </div>

                <div class="info-card">
                    <h3>Customer Information</h3>
                    <p><strong>Name:</strong> <?php echo e($order->customer_name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($order->email); ?></p>
                    <p><strong>Phone:</strong> <?php echo e($order->phone); ?></p>
                </div>

                <div class="info-card">
                    <h3>Delivery Address</h3>
                    <p><?php echo e($order->house_no); ?></p>
                    <?php if($order->apartment): ?>
                        <p><?php echo e($order->apartment); ?></p>
                    <?php endif; ?>
                    <p><?php echo e($order->city); ?></p>
                    <?php if($order->postal_code): ?>
                        <p><?php echo e($order->postal_code); ?></p>
                    <?php endif; ?>
                </div>

                <div class="info-card">
                    <h3>Payment Information</h3>
                    <div class="payment-method"><?php echo e($order->payment_method ?? 'Not Specified'); ?></div>
                    <p><strong>Payment Status:</strong>
                        <span class="order-status status-<?php echo e(strtolower(str_replace(' ', '-', $order->payment_status))); ?>">
                            <?php echo e($order->payment_status); ?>

                        </span>
                    </p>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <h2 class="section-title">Order Items</h2>
                <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item">
                        <?php if($item->product && $item->product->images->first()): ?>
                            <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>"
                                 alt="<?php echo e($item->product->product_name); ?>"
                                 class="product-image">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/placeholder-product.png')); ?>"
                                 alt="Product Image"
                                 class="product-image">
                        <?php endif; ?>

                        <div class="product-details">
                            <div class="product-name"><?php echo e($item->product->product_name ?? 'Product'); ?></div>
                            <div class="product-meta">Quantity: <?php echo e($item->quantity); ?></div>
                            <?php if($item->size): ?>
                                <div class="product-meta">Size: <?php echo e($item->size); ?></div>
                            <?php endif; ?>
                            <?php if($item->color): ?>
                                <div class="product-meta">Color: <?php echo e($item->color); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="product-price">
                            Rs. <?php echo e(number_format($item->cost, 2)); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3 style="margin-top: 0; color: #333;">Order Summary</h3>

                <?php
                    $subtotal = $orderItems->sum('cost');
                    $deliveryFee = 300; // Default delivery fee

                    // Try to get delivery fee from order items
                    foreach($orderItems as $item) {
                        if($item->product && $item->product->fee) {
                            $deliveryFee = max($deliveryFee, $item->product->fee->fee);
                        }
                    }
                ?>

                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>Rs. <?php echo e(number_format($subtotal, 2)); ?></span>
                </div>

                <div class="summary-row">
                    <span>Delivery Fee:</span>
                    <span>Rs. <?php echo e(number_format($deliveryFee, 2)); ?></span>
                </div>

                <div class="summary-row">
                    <span>Total Amount:</span>
                    <span>Rs. <?php echo e(number_format($order->total_cost, 2)); ?></span>
                </div>
            </div>

            <!-- Payment Instructions -->
            <?php if($order->payment_method === 'COD'): ?>
                <div class="payment-info">
                    <h3 style="color: #FF5722; margin-top: 0;">Cash on Delivery Instructions</h3>
                    <p>💰 <strong>Payment Method:</strong> Cash on Delivery (COD)</p>
                    <p>📦 You will pay <strong>Rs. <?php echo e(number_format($order->total_cost, 2)); ?></strong> in cash when you receive your order.</p>
                    <p>✅ Please have the exact amount ready for our delivery team.</p>
                    <p>📋 Don't forget to inspect your items before making the payment.</p>
                </div>
            <?php else: ?>
                <div class="payment-info">
                    <h3 style="color: #FF5722; margin-top: 0;">Payment Confirmation</h3>
                    <p>✅ <strong>Payment Status:</strong> <?php echo e($order->payment_status); ?></p>
                    <?php if($order->payment_status === 'Paid'): ?>
                        <p>🎉 Your payment has been successfully processed!</p>
                    <?php else: ?>
                        <p>⏳ Your payment is being processed and will be confirmed shortly.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>What happens next?</h3>
                <ul>
                    <li>We'll process your order within 1-2 business days</li>
                    <li>You'll receive a tracking notification once your order ships</li>
                    <li>Estimated delivery time: 3-5 business days</li>
                    <li>Our customer service team will contact you if any issues arise</li>
                </ul>
            </div>

            <?php
                    // Get the dealer shop name from the first order item's dealer product link
                    $dealerShopName = null;
                    if ($order->items && $order->items->count() > 0) {
                        $firstItem = $order->items->first();
                        if (
                            $firstItem->dealerProductLink &&
                            $firstItem->dealerProductLink->dealer &&
                            $firstItem->dealerProductLink->dealer->dealerProfile
                        ) {
                            $dealerShopName =
                                $firstItem->dealerProductLink->dealer->dealerProfile->dealer_shop_name ?? null;
                        }
                    }
                    // Log::info('Dealer Shop Name: ' . $dealerShopName);
                ?>

            <!-- Track Order Button -->
            <div style="text-align: center; margin: 40px 0;">
                <a
                
                href="<?php echo e(route('showroom.productTrackingView', ['dealer_shop_name' => $dealerShopName, 'order_code' => $order->order_code])); ?>"
                   style="display: inline-block; background: #FF5722; color: white; padding: 15px 30px;
                          text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 16px;">
                    Track Your Order
                </a>
            </div>

            <!-- Support Information -->
            <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; text-align: center;">
                <h3 style="color: #333; margin-top: 0;">Need Help?</h3>
                <p style="margin-bottom: 15px;">Our customer support team is here to help you!</p>
                <p style="margin: 5px 0;">📞 <strong>Phone:</strong> +94 112 222 888</p>
                <p style="margin: 5px 0;">📱 <strong>WhatsApp:</strong> +94 772 222 888</p>
                <p style="margin: 5px 0;">✉️ <strong>Email:</strong> support@fairwaves.lk</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="contact-info">
                <h3 style="margin-top: 0;">Fair Waves</h3>
                <p>Your trusted electronics partner in Sri Lanka</p>
                <p>📍 Colombo, Sri Lanka</p>
                <p>🌐 <a href="https://fairwaves.lk">www.fairwaves.lk</a></p>
            </div>

            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
                <a href="#">YouTube</a>
            </div>

            <p style="margin-top: 20px; font-size: 12px; opacity: 0.8;">
                © 2025 Fair Waves. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/emails/order-confirmation.blade.php ENDPATH**/ ?>