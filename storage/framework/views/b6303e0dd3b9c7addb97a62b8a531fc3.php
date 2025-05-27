<?php $__env->startSection('content'); ?>
<div class="content-header">
                    <div>
                        <h2 class="content-title card-title">Dashboard</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Today Earnings</h6>
                                    <span>Rs <?php echo e(number_format($totalEarningsToday, 2)); ?></span> <!-- Display total revenue -->
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Orders</h6>
                                    <span><?php echo e($totalOrders); ?></span> <!-- Display total orders -->
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Products</h6>
                                    <span><?php echo e($totalProducts); ?></span> <!-- Display total products -->
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body mb-4">
                            <article class="icontext">
                                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-groups"></i></span>
                                <div class="text">
                                    <h6 class="mb-1 card-title">Customers</h6>
                                    <span><?php echo e($customerCount); ?></span>
                                </div>
                            </article>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card mb-4">
                            <article class="card-body">
                                <h5 class="card-title">Sale statistics</h5>
                                <canvas id="myChart" height="120px"></canvas>
                            </article>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Recent Activities</h5>
                            <ul class="verti-timeline list-unstyled font-sm">
                                <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="material-icons md-play_circle_outline font-xxl animation-fade-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="me-3">
                                                <h6><span><?php echo e($activity['date']); ?></span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                            </div>
                                            <div class="media-body">
                                                <div><?php echo e($activity['message']); ?></div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </article>
                    </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <header class="card-header">
                        <h4 class="card-title">Latest orders</h4>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <div class="form-check align-middle">
                                                <input class="form-check-input" type="checkbox" id="transactionCheck01" />
                                                <label class="form-check-label" for="transactionCheck01"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle" scope="col">Order ID</th>
                                        <th class="align-middle" scope="col">Customer Name</th>
                                        <th class="align-middle" scope="col">Date</th>
                                        <th class="align-middle" scope="col">Total</th>
                                        <th class="align-middle" scope="col">Payment Status</th>
                                        <th class="align-middle" scope="col">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_iterable($orders) && $orders->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($order->id); ?></td>
                                                <td><?php echo e($order->order_code); ?></td>
                                                <td><?php echo e($order->customer_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                                <td>Rs <?php echo e(number_format($order->total_amount, 2)); ?></td>
                                                <td><?php echo e(ucfirst($order->payment_status)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No orders found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            </div>
                        </div>
                        <!-- table-responsive end// -->
                    </div>
                </div>

<script>
    var salesData = <?php echo json_encode($salesData, 15, 512) ?>;
    var ordersData = <?php echo json_encode($ordersData, 15, 512) ?>;
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('VendorDashboard.Vendormaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/VendorDashboard/vendorhome.blade.php ENDPATH**/ ?>