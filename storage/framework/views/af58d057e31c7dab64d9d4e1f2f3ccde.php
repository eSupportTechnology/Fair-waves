<?php $__env->startSection('content'); ?>

<!-- Display Success Message -->
<?php if(session('status')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('status')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Display Error Message -->
<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Display Validation Errors -->
<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Affiliate Customers</h2>
    </div>
    <div>
        <a href="#" class="btn btn-light rounded font-md">Export</a>
    </div>
</div>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-2 col-6">
                <input type="date" value="02.05.2021" class="form-control" />
            </div>
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
                                <th>NIC</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td> 
                                <td><?php echo e($affiliate->name); ?></td> 
                                <td><?php echo e($affiliate->NIC); ?></td> 
                                <td><?php echo e($affiliate->address); ?></td> 
                                <td><?php echo e($affiliate->email); ?></td> 
                                <td><?php echo e($affiliate->contactno); ?></td> 
                                <td><?php echo e($affiliate->gender); ?></td>
                                <td><?php echo e(ucfirst($affiliate->status)); ?></td>
                                <td class="text-end">

                                    <!-- More Details Button -->
                                    <a href="<?php echo e(route('admin.affiliates.show', ['id' => $affiliate->id])); ?>" class="btn btn-info btn-sm me-2">More Details</a>


                                    <?php if($affiliate->status === 'pending'): ?>
                                        <form action="<?php echo e(route('admin.affiliates.updateStatus', ['id' => $affiliate->id, 'status' => 'approved'])); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <?php if($affiliate->status !== 'rejected'): ?>
                                        <form action="<?php echo e(route('admin.affiliates.updateStatus', ['id' => $affiliate->id, 'status' => 'rejected'])); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    <?php endif; ?>
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

<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            
        </ul>
    </nav>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DK-Mart\resources\views/AdminDashboard/affiliate_customers.blade.php ENDPATH**/ ?>