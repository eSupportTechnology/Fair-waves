<?php $__env->startSection('dashboard-content'); ?>
<div class="container">
    <h4 class="mb-4">Orders for <?php echo e($dealerProductLink->product->name); ?></h4>

    <?php if($orders->isEmpty()): ?>
        <p class="text-muted">No orders found for this product.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->order->order->customer_name); ?></td>
                        <td><?php echo e($order->order->quantity); ?></td>
                        <td>₹<?php echo e(number_format($order->total_price, 2)); ?></td>
                        <td><?php echo e(ucfirst($order->order->order->status)); ?></td>
                        <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                        <td>
                            <a href="https://track.example.com/order/<?php echo e($order->id); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-external-link-alt"></i> Track
                            </a>
                            <form action="<?php echo e(route('dealer.products.orders.delete', $order->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this order?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="<?php echo e(route('dealer.products.dashboard')); ?>" class="btn btn-outline-primary mt-3">
        <i class="fas fa-arrow-left"></i> Back to Product Links
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/dealer-product-orders.blade.php ENDPATH**/ ?>