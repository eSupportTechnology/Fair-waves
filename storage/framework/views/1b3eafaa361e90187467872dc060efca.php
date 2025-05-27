<?php $__env->startSection('content'); ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Order Details</h2>
    </div>
</div>

<div class="card">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                <span> <i class="material-icons md-calendar_today"></i> <b><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('D, M d, Y, h:i A')); ?></b> </span> <br />
                <a href="#" class="fw-bold">Order ID: #<?php echo e($order->order_code); ?></a>
            </div>
            <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                <form action="<?php echo e(route('order.updateStatus', $order->order_code)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <select name="status" class="form-select d-inline-block mb-lg-0 mr-5 mw-200">
                        <option selected disabled><?php echo e($order->status); ?></option>
                        <?php
                            $statuses = [
                                'Packed' => 'Pickup Done',
                                'Pickup Done' => 'Ready to Ship',
                                'Ready to Ship' => 'Shipped',
                                'Shipped' => 'In Transit',
                                'In Transit' => 'Delivered',
                                'Delivered' => '',
                                'Cancelled' => '',
                                'Returned' => '',
                            ];
                        ?>

                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $current => $next): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($order->status === $current && $next): ?>
                                <option value="<?php echo e($next); ?>"><?php echo e($next); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- Add options for 'Cancelled' and 'Returned' if needed -->
                        <?php if(!in_array($order->status, ['Cancelled', 'Returned'])): ?>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Returned">Returned</option>
                        <?php endif; ?>
                    </select>

                    <button type="submit" class="btn btn-primary p-2">Update</button>
                </form>
                <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print"></i></a>
            </div>
        </div>
    </header>
    <div class="card-body">
        <!-- Customer, Shipping, and Billing Details -->
        <div class="row mb-50 mt-20 order-info-wrap">
            <div class="col-md-4">
                <article class="icontext align-items-start">
                    <span class="icon icon-sm rounded-circle bg-primary-light">
                        <i class="text-primary material-icons md-person"></i>
                    </span>
                    <div class="text">
                        <h6 class="mb-1">Customer</h6>
                        <p class="mb-1">
                            <?php echo e($order->customer_name); ?> <br />
                            <?php echo e($order->email); ?> <br />
                            <?php echo e($order->phone); ?>

                        </p>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="icontext align-items-start">
                    <span class="icon icon-sm rounded-circle bg-primary-light">
                        <i class="text-primary material-icons md-local_shipping"></i>
                    </span>
                    <div class="text">
                        <h6 class="mb-1">Shipping Details</h6>
                        <p class="mb-1">
                            Address: <?php echo e($order->house_no); ?>, <?php echo e($order->apartment); ?><br />
                            City: <?php echo e($order->city); ?> <br />
                            Postal code: <?php echo e($order->postal_code); ?> <br />
                        </p>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="icontext align-items-start">
                    <span class="icon icon-sm rounded-circle bg-primary-light">
                        <i class="text-primary material-icons md-place"></i>
                    </span>
                    <div class="text">
                        <h6 class="mb-1">Billing Details </h6>
                        <p class="mb-1">
                        Pay method: <?php echo e($order->payment_method); ?> <br />
                        Amount charged: Rs <?php echo e($order->total_cost); ?> <br />
                        Payment Status: <?php echo e($order->payment_status); ?>

                        </p>
                    </div>
                </article>
            </div>
        </div>

        <!-- Product Details -->
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50%">Product</th>
                                <th width="20%">Unit Price</th>
                                <th width="5%">Quantity</th>
                                <th width="20%" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                    <a class="itemside" href="#">
                                        <div class="left">
                                            <?php if($item->product->images->isNotEmpty()): ?>
                                                <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" width="40" height="40" class="img-xs" alt="Item" />
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('path/to/default-image.jpg')); ?>" width="40" height="40" class="img-xs" alt="Default Image" />
                                            <?php endif; ?>
                                        </div>
                                        <div><?php echo e($item->product->product_name); ?></div>
                                    </a>
                                    </td>
                                    <td>Rs <?php echo e($item->product->normal_price); ?></td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td class="text-end">Rs <?php echo e($item->product->normal_price * $item->quantity); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="col-lg-4">
                <div class="card shadow-sm bg-light">
                    <div class="card-body">
                        <h6 class="mb-3">Order Summary</h6>
                        <dl class="dlist">
                            <dt>Subtotal:</dt>
                            <dd>Rs <?php echo e(number_format($order->total_cost - 300, 2)); ?></dd>
                        </dl> 
                        <dl class="dlist">
                            <dt>Delivery Fee:</dt>
                            <dd>Rs 300.00</dd>
                        </dl>
                        <dl class="dlist">
                            <dt class="h5">Total:</dt>
                            <dd><b class="h5">Rs <?php echo e(number_format($order->total_cost, 2)); ?></b></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        top: 30%;
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

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DK-Mart\resources\views/AdminDashboard/order-details.blade.php ENDPATH**/ ?>