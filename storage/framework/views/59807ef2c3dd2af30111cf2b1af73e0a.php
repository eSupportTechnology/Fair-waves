<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fair Waves - Order Update</title>
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

.greeting {
    font-size: 24px;
    color: #333;
    margin-bottom: 30px;
    font-weight: 500;
}

.order-info {
    background-color: #fff3e0;
    border-left: 6px solid #FF5722;
    padding: 30px;
    margin: 35px 0;
    border-radius: 0 12px 12px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.order-details {
    flex: 1;
}

.order-details p {
    margin: 0 0 15px 0;
    font-size: 18px;
}

.order-code {
    color: #FF5722;
    font-weight: 600;
    font-size: 20px;
}

.status-badge {
    display: inline-block;
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin: 0;
    white-space: nowrap;
}

.summary-title {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin: 40px 0 25px 0;
    border-bottom: 3px solid #FF5722;
    padding-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.summary-grid {
    margin-bottom: 30px;
}

.summary-list {
    list-style: none;
    padding: 0;
    margin: 0;
    background-color: #fafafa;
    border-radius: 12px;
    padding: 25px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-label {
    font-weight: 500;
    color: #666;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.summary-value {
    font-weight: 600;
    color: #333;
    text-align: right;
    font-size: 16px;
}

.total-cost {
    color: #FF5722 !important;
    font-size: 20px;
}

.tracking-number {
    font-family: 'Courier New', monospace;
    background-color: #f0f0f0;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 14px;
    color: #333;
}

.tracking-link {
    background: linear-gradient(135deg, #FF5722, #E64A19);
    color: white !important;
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 16px;
    display: inline-block;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    box-shadow: 0 4px 15px rgba(255, 87, 34, 0.2);
}

.tracking-link:hover {
    background: linear-gradient(135deg, #E64A19, #D84315);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
}

.tracking-section {
    background-color: #fff8e1;
    border-left: 6px solid #FF9800;
    padding: 30px;
    margin: 30px 0;
    border-radius: 0 12px 12px 0;
}

.tracking-header {
    font-weight: 600;
    color: #FF6F00;
    margin-bottom: 20px;
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.tracking-grid {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 30px;
    align-items: center;
}

.tracking-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.tracking-item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
}

.footer {
    background-color: #fff3e0;
    padding: 40px;
    text-align: center;
    border-top: 1px solid #eee;
}

.footer p {
    margin: 0 0 10px 0;
    color: #666;
    font-size: 18px;
}

.thank-you {
    color: #FF5722;
    font-weight: 600;
    font-size: 20px;
}

.company-info {
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid #ddd;
    font-size: 16px;
    color: #888;
}

.brand-accent {
    color: #FF5722;
}

/* Desktop specific enhancements */
@media (min-width: 768px) {
    .email-container {
        max-width: 900px;
        margin: 40px auto;
    }

    .content {
        padding: 60px 50px;
    }

    .header {
        padding: 60px 50px;
    }

    .summary-grid {
        gap: 40px;
    }

    .order-info {
        padding: 40px;
    }

    .tracking-section {
        padding: 40px;
    }
}

/* Large desktop */
@media (min-width: 1200px) {
    .email-container {
        max-width: 1000px;
    }

    .summary-grid {
    }
}

/* Tablet and mobile */
@media (max-width: 767px) {
    .email-container {
        margin: 15px;
        border-radius: 12px;
    }

    .header {
        padding: 30px 25px;
    }

    .logo {
        max-width: 200px;
    }

    .header h1 {
        font-size: 28px;
    }

    .content {
        padding: 30px 25px;
    }

    .greeting {
        font-size: 20px;
    }

    .order-info {
        flex-direction: column;
        align-items: flex-start;
        padding: 25px;
    }

    .summary-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .summary-list {
        padding: 20px;
    }

    .summary-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 12px 0;
    }

    .summary-value {
        text-align: left;
    }

    .tracking-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        text-align: center;
    }

    .tracking-item-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .tracking-link {
        display: block;
        text-align: center;
        margin-top: 15px;
    }

    .footer {
        padding: 30px 25px;
    }
}
</style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="<?php echo e(asset('frontend/newstyle/assets/images/logo.png')); ?>" alt="Fair Waves Logo" class="logo">
            <h1>Order Update</h1>
            <div class="company-tagline">Enjoy Life with the Waves</div>
        </div>

        <div class="content">
            <div class="greeting">
                Hi <?php echo e($order->customer_name); ?>,
            </div>

            <div class="order-info">
                <div class="order-details">
                    <p>Your order <span class="order-code">#<?php echo e($order->order_code); ?></span> has been updated!</p>
                </div>
                <div class="status-badge"><?php echo e($newStatus); ?></div>
            </div>

            <div class="summary-title">
                📋 Order Summary
            </div>

            <div class="summary-grid">
                <ul class="summary-list">
                    <li class="summary-item">
                        <span class="summary-label">💰 Total Cost:</span>
                        <span class="summary-value total-cost">Rs. <?php echo e(number_format($order->total_cost, 2)); ?></span>
                    </li>
                    <li class="summary-item">
                        <span class="summary-label">📊 Status:</span>
                        <span class="summary-value"><?php echo e($newStatus); ?></span>
                    </li>
                    <li class="summary-item">
                        <span class="summary-label">📅 Placed On:</span>
                        <span class="summary-value"><?php echo e(\Carbon\Carbon::parse($order->date)->toFormattedDateString()); ?></span>
                    </li>
                </ul>

            </div>

            <?php if($order->tracking_number || $order->tracking_link): ?>
            <div class="tracking-section">
                <div class="tracking-header">
                    🚚 Tracking Information
                </div>

                <div class="tracking-grid">
                    <div class="tracking-info">
                        <?php if($order->tracking_number): ?>
                        <div class="tracking-item-row">
                            <span class="summary-label">📋 Tracking Number:</span>
                            <span class="tracking-number"><?php echo e($order->tracking_number); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if($order->tracking_link): ?>
                    <div>
                        <a href="<?php echo e($order->tracking_link); ?>" target="_blank" class="tracking-link">
                            Track Package
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <p><span class="thank-you">Thank you for shopping with Fair Waves! 🌊</span></p>
            <p>We appreciate your business and look forward to serving you again.</p>

            <div class="company-info">
                <p><strong class="brand-accent">Fair Waves</strong> - Enjoy Life with the Waves</p>
                <p>Your trusted partner for quality products and exceptional service</p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/emails/order-status-updated.blade.php ENDPATH**/ ?>