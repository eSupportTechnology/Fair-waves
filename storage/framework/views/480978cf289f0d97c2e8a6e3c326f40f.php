<?php $__env->startSection('dashboard-content'); ?>
<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>

<div class="tracking-header-card">
    <h4 class="tracking-header-title">Tracking Details</h4>
</div>

<!-- Order Summary Section -->
<div class="order-summary-container mt-4">
    <h5 class="summary-title">Order Summary</h5>
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
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="product-info">
                        <div class="d-flex align-items-center">
                            <?php if($item->product && $item->product->images->first()): ?>
                            <div class="product-image">
                                <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" 
                                    alt="Product Image">
                            </div>
                            <?php endif; ?>
                            <span class="product-name"><?php echo e($item->product->name); ?></span>
                        </div>
                    </td>
                    <td class="text-end">Rs <?php echo e(number_format($item->cost / $item->quantity, 2)); ?></td>
                    <td class="text-center">
                        <span class="quantity-badge"><?php echo e($item->quantity); ?></span>
                    </td>
                    <td class="text-end price-column">Rs <?php echo e(number_format($item->cost, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="order-totals mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="tracking-info">
                    <?php if($order->tracking_number): ?>
                    <div class="tracking-detail">
                        <strong>Tracking Number:</strong> 
                        <span class="tracking-number"><?php echo e($order->tracking_number); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($order->tracking_link): ?>
                    <div class="tracking-detail mt-2">
                        <strong>Tracking Link:</strong> 
                        <a href="<?php echo e($order->tracking_link); ?>" target="_blank" class="tracking-link">Track with Courier <i class="fas fa-external-link-alt"></i></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
                <table class="table table-borderless">
                    <tr>
                        <td>Subtotal:</td>
                        <td class="text-end">Rs <?php echo e(number_format($order->total_cost - 300, 2)); ?></td>
                    </tr>
                    <tr>
                        <td>Delivery Fee:</td>
                        <td class="text-end">Rs 300.00</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Total:</td>
                        <td class="text-end">Rs <?php echo e(number_format($order->total_cost, 2)); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="tracking-container mt-4">


    <div class="progress-container mt-4">
    <h5>Order Progress</h5>
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
                'Returned' => 'Returned',
            ];

            $currentStatusIndex = array_search($order->status, array_keys($statuses));
        ?>

        <ul class="progress-timeline">
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($currentStatusIndex >= array_search($key, array_keys($statuses)) ? 'completed' : ''); ?>">
                    <div class="step-circle"><?php echo e($loop->index + 1); ?></div>
                    <span class="step-label"><?php echo e($label); ?></span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>


    <br><br>
    <h5>Activity Logs</h5>
    <div class="activity-log-container">
        <ul class="activity-log-timeline">
            <?php
                $activityLogs = collect($order->activity_logs ?? []);
            ?>

            <?php if($activityLogs->isEmpty()): ?>
                <li class="activity-log-entry">
                    <p class="log-message">No activity logs available for this order.</p>
                </li>
            <?php else: ?>
                <?php $__currentLoopData = $activityLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="activity-log-step">
                        <div class="log-content">
                            <div class="log-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="log-details">
                                <p class="log-message"><?php echo e($log['message']); ?></p>
                                <span class="log-date"><?php echo e(\Carbon\Carbon::parse($log['timestamp'])->format('d M Y h:i A')); ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>


<style>
.tracking-header-card {
    margin-top: 30px;
    background: #ff6f1a;
    border-radius: 16px;
    padding: 28px 32px 18px 32px;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 8px rgba(255, 111, 26, 0.08);
    width: 100%;
    margin-bottom: 0px;
}

.order-summary-container {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

.summary-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1.5rem;
}

.table {
    margin-bottom: 0;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    padding: 15px;
    font-size: 0.9rem;
    color: #555;
    border-bottom: 2px solid #eee;
}

.table td {
    padding: 15px;
    vertical-align: middle;
    border-bottom: 1px solid #eee;
}

.product-info {
    min-width: 280px;
}

.product-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 15px;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-name {
    font-weight: 500;
    color: #333;
}

.quantity-badge {
    background: #f8f9fa;
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 500;
}

.price-column {
    font-weight: 500;
    color: #333;
}

.order-totals {
    border-top: 2px solid #eee;
    padding-top: 20px;
    margin-top: 10px;
}

.table-borderless td {
    padding: 8px 0;
    color: #555;
}

.tracking-info {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    border: 1px dashed #dee2e6;
    margin-bottom: 15px;
}

.tracking-detail {
    font-size: 14px;
    color: #444;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tracking-detail strong {
    min-width: 120px;
    color: #666;
}

.tracking-number {
    font-family: 'Roboto Mono', monospace;
    background: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    color: #333;
    font-size: 13px;
    letter-spacing: 0.5px;
}

.tracking-link {
    display: inline-flex;
    align-items: center;
    color: #ff6f1a;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    background: rgba(255, 111, 26, 0.1);
    transition: all 0.2s ease;
}

.tracking-link i {
    margin-left: 6px;
    font-size: 12px;
}

.tracking-link:hover {
    color: #fff;
    background: #ff6f1a;
    transform: translateY(-1px);
}

.tracking-header-title {
    color: #fff;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: 1px;
}

/* Main Container */
.activity-log-container {
    margin-top: 20px;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    border: 1px solid #ddd;
}

/* Vertical Timeline */
.activity-log-timeline {
    display: flex;
    flex-direction: column;
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
    border-left: 2px solid #ddd;
    left:30px;
}

.activity-log-step {
    position: relative;
    padding-left: 30px;
    margin-bottom: 20px;
}

.activity-log-step:last-child {
    margin-bottom: 0;
}

.log-content {
    display: flex;
    align-items: center;
}

.log-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #4caf50;
    color: white;
    text-align: center;
    line-height: 30px;
    font-size: 14px;
    position: absolute;
    left: -17px;
}

.log-details {
    margin-left: 10px;
}

.log-message {
    font-size: 14px;
    color: #333;
}

.log-date {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

/* Vertical Line Indicator */
.activity-log-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 12px;
    height: 100%;
    width: 2px;
    background: #ddd;
    z-index: -1;
}
</style>

</div>


<style>

    .progress-container {
        margin-top: 30px;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .progress-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        padding-top: 20px;
    }

    .progress-timeline {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        width: 100%;
        justify-content: space-between;
        position: relative;
    }

    .progress-timeline::before {
        content: '';
        position: absolute;
        top: 20%;
        left: 5%;
        width: 92%;
        height: 4px;
        background: #ddd;
        z-index: 0;
    }

    .progress-timeline li {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #ddd;
        color: white;
        line-height: 30px;
        font-size: 14px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .step-circle.completed {
        background: #4caf50;
    }

    .step-label {
        margin-top: 10px;
        font-size: 14px;
    }

    li.completed .step-circle {
        background-color: #4caf50;
        color: white;
    }
</style>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/user_dashboard/tracking-page.blade.php ENDPATH**/ ?>