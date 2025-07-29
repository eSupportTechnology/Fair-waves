

<?php $__env->startSection('dashboard-content'); ?>
<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>

<style>
    .tracking-header-card {
        background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 40%, #ffffff 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(255, 88, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline-primary {
        border: 3px solid #ffffff;
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        opacity: 1;
        visibility: visible;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary:hover {
        background-color: #ffffff;
        border-color: #ffffff;
        color: #ff5800 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        text-shadow: none;
    }

    .tracking-header-title {
        color: #ffffff;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .tracking-header-title i {
        color: #ffffff;
        font-size: 1.8rem;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .order-summary-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .summary-title {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .summary-title i {
        color: #ff5800;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: none;
        color: #4a5568;
        font-weight: 600;
        padding: 1rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .product-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        background: #f7fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-name {
        font-weight: 600;
        color: #2d3748;
        font-size: 0.95rem;
    }

    .quantity-badge {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .price-column {
        font-weight: 600;
        color: #2d3748;
        font-size: 1rem;
    }

    .order-totals {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e2e8f0;
    }

    .tracking-info {
        background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid #38b2ac;
    }

    .tracking-detail {
        margin-bottom: 0.75rem;
    }

    .tracking-detail:last-child {
        margin-bottom: 0;
    }

    .tracking-number {
        background: #38b2ac;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-weight: 600;
    }

    .tracking-link {
        color: #38b2ac;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .tracking-link:hover {
        color: #319795;
        text-decoration: underline;
    }

    .progress-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .progress-wrapper {
        position: relative;
        padding: 2rem 0;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        margin: 2rem 0;
    }

    .progress-line {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 4px;
        background: #e2e8f0;
        z-index: 1;
        border-radius: 2px;
    }

    .progress-line-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 100%);
        transition: width 0.8s ease;
        border-radius: 2px;
    }

    .progress-step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: white;
        padding: 0.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        border: 3px solid;
        transition: all 0.3s ease;
    }

    .step-label {
        font-size: 0.75rem;
        font-weight: 600;
        max-width: 80px;
        line-height: 1.2;
        transition: all 0.3s ease;
    }

    .step-completed {
        background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
        border-color: #48bb78;
        color: #276749;
    }

    .step-completed .step-circle {
        background: #48bb78;
        border-color: #48bb78;
        color: white;
    }

    .step-completed .step-label {
        color: #276749;
    }

    .step-active {
        background: linear-gradient(135deg, #fed7d2 0%, #fbb6ce 100%);
        border-color: #ff5800;
        color: #c53030;
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(255, 88, 0, 0.3);
    }

    .step-active .step-circle {
        background: #ff5800;
        border-color: #ff5800;
        color: white;
        animation: pulse 2s infinite;
    }

    .step-active .step-label {
        color: #c53030;
        font-weight: 700;
    }

    .step-pending {
        background: #f7fafc;
        border-color: #e2e8f0;
        color: #a0aec0;
    }

    .step-pending .step-circle {
        background: #f7fafc;
        border-color: #e2e8f0;
        color: #a0aec0;
    }

    .step-pending .step-label {
        color: #a0aec0;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 88, 0, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 88, 0, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 88, 0, 0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .tracking-header-card,
        .order-summary-container,
        .progress-container {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .progress-steps {
            flex-wrap: wrap;
            gap: 1rem;
        }

        .progress-step {
            flex: 1;
            min-width: 100px;
        }

        .step-circle {
            width: 35px;
            height: 35px;
            font-size: 0.75rem;
        }

        .step-label {
            font-size: 0.7rem;
            max-width: 70px;
        }

        .product-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .product-image {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 576px) {
        .tracking-header-title {
            font-size: 1.25rem;
        }

        .summary-title {
            font-size: 1.1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .progress-steps {
            flex-direction: column;
            gap: 1.5rem;
        }

        .progress-line {
            display: none;
        }

        .step-active {
            transform: scale(1.05);
        }
    }
</style>

<div class="tracking-header-card">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="tracking-header-title">
            <i class="fas fa-shipping-fast"></i>
            Order Tracking Details - My Customer Orders
        </h4>
        <a href="javascript:history.back()" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>
            Back to Orders
        </a>
    </div>
</div>

<!-- Order Summary Section -->
<div class="order-summary-container">
    <h5 class="summary-title">
        <i class="fas fa-receipt"></i>
        Order Summary
    </h5>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="product-column">Product</th>
                    <th class="text-end">Unit Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orderData['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="product-info">
                        <div class="d-flex align-items-center">
                            <?php if($item->link->product->images->first()): ?>
                            <div class="product-image">
                                <img src="<?php echo e(asset('storage/' . $item->link->product->images->first()->image_path)); ?>" 
                                    alt="Product Image">
                            </div>
                            <?php endif; ?>
                            <span class="product-name"><?php echo e($item->link->product->product_name); ?></span>
                        </div>
                    </td>
                    <td class="text-end">Rs <?php echo e(number_format($item->order->cost / $item->order->quantity, 2)); ?></td>
                    <td class="text-center">
                        <span class="quantity-badge"><?php echo e($item->order->quantity); ?></span>
                    </td>
                    <td class="text-end price-column">Rs <?php echo e(number_format($item->order->cost, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="order-totals">
        <div class="row">
            <div class="col-md-8">
                <?php if($orderData['order']->tracking_number || $orderData['order']->tracking_link): ?>
                <div class="tracking-info">
                    <?php if($orderData['order']->tracking_number): ?>
                    <div class="tracking-detail">
                        <strong>Tracking Number:</strong> 
                        <span class="tracking-number"><?php echo e($orderData['order']->tracking_number); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($orderData['order']->tracking_link): ?>
                    <div class="tracking-detail mt-2">
                        <strong>Tracking Link:</strong> 
                        <a href="<?php echo e($orderData['order']->tracking_link); ?>" target="_blank" class="tracking-link">
                            Track with Courier <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <table class="table table-borderless">
                    <tr>
                        <td>Subtotal:</td>
                        <td class="text-end">Rs <?php echo e(number_format($orderData['order']->total_cost - 300, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>Delivery Fee:</td>
                        <td class="text-end">Rs 300.00</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Total:</td>
                        <td class="text-end">Rs <?php echo e(number_format($orderData['order']->total_cost, 2)); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Order Progress Section -->
<div class="progress-container">
    <div class="row">
        <div class="col-12">
            <h5 class="summary-title">
                <i class="fas fa-route"></i>
                Order Progress
            </h5>
            <div class="progress-wrapper">
                <?php
                    $statuses = [
                        'Pending' => 'Order Placed',
                        'Accepted' => 'Order Accepted', 
                        'Packed' => 'Order Packed',
                        'Pickup Done' => 'Order Picked Up',
                        'Ready to Ship' => 'Ready to Ship',
                        'Shipped' => 'Shipped',
                        'In Transit' => 'In Transit',
                        'Delivered' => 'Delivered',
                        'Cancelled' => 'Cancelled',
                        'Returned' => 'Returned'
                    ];
                    
                    $currentStatus = $orderData['order']->status;
                    $statusKeys = array_keys($statuses);
                    $currentIndex = array_search($currentStatus, $statusKeys);
                    
                    // Handle special cases
                    if (in_array($currentStatus, ['Cancelled', 'Returned'])) {
                        $progressPercentage = 0;
                    } else {
                        $progressPercentage = $currentIndex !== false ? (($currentIndex + 1) / count($statusKeys)) * 100 : 0;
                    }
                ?>

                <div class="progress-steps">
                    <div class="progress-line">
                        <div class="progress-line-fill" style="width: <?php echo e($progressPercentage); ?>%"></div>
                    </div>

                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $stepIndex = array_search($status, $statusKeys);
                            $isCompleted = $stepIndex < $currentIndex || $status === $currentStatus;
                            $isActive = $status === $currentStatus;
                            $isPending = $stepIndex > $currentIndex && !in_array($currentStatus, ['Cancelled', 'Returned']);
                            
                            // Handle special cases
                            if (in_array($currentStatus, ['Cancelled', 'Returned'])) {
                                $isCompleted = false;
                                $isActive = $status === $currentStatus;
                                $isPending = $status !== $currentStatus;
                            }
                        ?>

                        <div class="progress-step 
                            <?php if($isCompleted && !$isActive): ?> step-completed 
                            <?php elseif($isActive): ?> step-active 
                            <?php else: ?> step-pending 
                            <?php endif; ?>">
                            <div class="step-circle">
                                <?php if($isCompleted && !$isActive): ?>
                                    <i class="fas fa-check"></i>
                                <?php elseif($isActive): ?>
                                    <?php echo e($stepIndex + 1); ?>

                                <?php else: ?>
                                    <?php echo e($stepIndex + 1); ?>

                                <?php endif; ?>
                            </div>
                            <div class="step-label"><?php echo e($label); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="text-center mt-4">
                    <div class="alert alert-info" style="background: linear-gradient(135deg, #e6f3ff 0%, #cce7ff 100%); border: 1px solid #66b3ff; color: #0066cc;">
                        <strong>Current Status:</strong> <?php echo e($statuses[$currentStatus] ?? $currentStatus); ?>

                        <br>
                        <small>Order Code: <strong><?php echo e($orderData['order']->order_code); ?></strong></small>
                        <br>
                        <small>Order Date: <strong><?php echo e($orderData['order']->created_at->format('M d, Y h:i A')); ?></strong></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate progress bar on load
    const progressFill = document.querySelector('.progress-line-fill');
    if (progressFill) {
        progressFill.style.width = '0%';
        setTimeout(() => {
            progressFill.style.width = '<?php echo e($progressPercentage); ?>%';
        }, 500);
    }

    // Add subtle animations to completed steps
    const completedSteps = document.querySelectorAll('.step-completed');
    completedSteps.forEach((step, index) => {
        setTimeout(() => {
            step.style.opacity = '0';
            step.style.transform = 'translateY(20px)';
            setTimeout(() => {
                step.style.opacity = '1';
                step.style.transform = 'translateY(0)';
                step.style.transition = 'all 0.5s ease';
            }, 100);
        }, index * 200);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/dealer/dealer-product-order-track.blade.php ENDPATH**/ ?>