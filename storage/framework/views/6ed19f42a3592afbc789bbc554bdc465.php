

<?php $__env->startSection('content'); ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Customers</h2>
    </div>
    <div>
        <a href="#" class="btn btn-light rounded font-md">Export</a>
    </div>
</div>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <!-- Removed the date filter form -->
        </div>
    </header>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registered Date</th>
                            <th>Total Orders</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($customers->firstItem() + $index); ?></td> <!-- Display correct customer number -->
                                <td><?php echo e($customer->name); ?></td> 
                                <td><?php echo e($customer->email); ?></td> 
                                <td><?php echo e($customer->phone); ?></td> 
                                <td><?php echo e($customer->created_at->format('Y-m-d')); ?></td> 
                                <td><?php echo e($customer->customer_orders_count); ?></td> 
                                <td class="text-end">
                                    <a href="<?php echo e(route('customer-details', $customer->id)); ?>" class="btn btn-view btn-sm me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>                                  
                            </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- .col// -->
        </div>
        <!-- .row // -->
    </div>
    <!-- card-body end// -->
</div>
<!-- card end// -->

<!-- Pagination Area -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <?php echo e($customers->links()); ?>  
        </ul>
    </nav>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/AdminDashboard/customer.blade.php ENDPATH**/ ?>