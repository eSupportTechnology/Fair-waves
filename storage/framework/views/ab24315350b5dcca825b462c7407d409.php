

<?php $__env->startSection('dashboard-content'); ?>
<style>
    .order-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .order-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    .order-body {
        padding: 20px;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .order-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
    }

    .order-details {
        flex-grow: 1;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-accepted {
        background-color: #d4edda;
        color: #155724;
    }

    .status-packed {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-pickup {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .status-ready {
        background-color: #e2e3e5;
        color: #383d41;
    }

    .order-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }

    .page-title {
        margin-top: 30px;
        margin-bottom: 30px;
        color: #333;
        font-weight: 600;
    }
</style>

<div class="container py-4">
    <h4 class="page-title">Orders To Be Shipped</h4>

    <?php if($toBeShippedOrders->isEmpty()): ?>
        <div class="alert alert-info">
            No orders to be shipped at the moment.
        </div>
    <?php else: ?>
        <?php $__currentLoopData = $toBeShippedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="order-card">
                <div class="order-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Order #<?php echo e($order->order_code); ?></h6>
                        <small class="text-muted"><?php echo e($order->created_at->format('M d, Y')); ?></small>
                    </div>
                    <span class="status-badge status-<?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                        <?php echo e($order->status); ?>

                    </span>
                </div>
                <div class="order-body">
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="order-item">
                            <?php if($item->product && $item->product->images->first()): ?>
                                <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" 
                                     alt="<?php echo e($item->product->product_name); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('path/to/default-image.jpg')); ?>" alt="Default product image">
                            <?php endif; ?>
                            <div class="order-details">
                                <h6 class="mb-1"><?php echo e($item->product->product_name); ?></h6>
                                <p class="mb-0 text-muted">Quantity: <?php echo e($item->quantity); ?></p>
                                <p class="mb-0">Rs. <?php echo e(number_format($item->cost, 2)); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="order-meta">
                        <div>
                            <strong>Total Amount:</strong> Rs. <?php echo e(number_format($order->total_cost, 2)); ?>

                        </div>
                        <div>
                            <strong>Payment Status:</strong> 
                            <span class="text-<?php echo e($order->payment_status == 'Paid' ? 'success' : 'warning'); ?>">
                                <?php echo e($order->payment_status); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/user_dashboard/to_be_shipped.blade.php ENDPATH**/ ?>