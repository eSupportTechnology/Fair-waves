<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Order Management</h2>
    </div>
</div>

<!-- Tabs for Order Statuses -->
<ul class="nav nav-tabs mb-3" id="orderTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'All' || !request('status') ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'All'])); ?>">All Orders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Packed' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Packed'])); ?>">Packed</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Pickup Done' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Pickup Done'])); ?>">Pickup Done</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Ready to Ship' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Ready to Ship'])); ?>">Ready to Ship</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Shipped' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Shipped'])); ?>">Shipped</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'In Transit' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'In Transit'])); ?>">In Transit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Delivered' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Delivered'])); ?>">Delivered</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Cancelled' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Cancelled'])); ?>">Cancelled</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request('status') === 'Returned' ? 'active' : ''); ?>" href="<?php echo e(route('orders', ['status' => 'Returned'])); ?>">Returned</a>
    </li>
</ul>

<!-- Orders Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($order->order_code); ?></td>
                            <td><b><?php echo e($order->customer_name); ?></b></td>
                            <td><?php echo e($order->email); ?></td>
                            <td>Rs. <?php echo e(number_format($order->total_cost, 2)); ?></td>
                            <td>
                                <span class="status <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                                    <?php echo e($order->status); ?>

                                </span>
                            </td>
                            <td><?php echo e($order->date); ?></td>
                            <td class="text-end">
                                <a href="<?php echo e(route('order-details', $order->order_code)); ?>" class="btn btn-view btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form id="deleteForm<?php echo e($order->id); ?>" action="<?php echo e(route('order.delete', $order->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('deleteForm<?php echo e($order->id); ?>', 'Are you sure you want to delete this order?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">No orders found for this section.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="pagination-area mt-15 mb-50">
    <?php echo e($orders->links()); ?>

</div>

<style>
    .status.packed {
        background-color: #0275d8; /* Blue for Packed */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Pickup Done Status */
    .status.pickup-done {
        background-color: #5bc0de; /* Light Blue for Pickup Done */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Ready to Ship Status */
    .status.ready-to-ship {
        background-color: #f0ad4e; /* Orange for Ready to Ship */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* In Transit Status */
    .status.in-transit {
        background-color: #6f42c1; /* Purple for In Transit */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>

<script>
function submitForm() {
    document.getElementById('orderSearchForm').submit();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/AdminDashboard/orders.blade.php ENDPATH**/ ?>