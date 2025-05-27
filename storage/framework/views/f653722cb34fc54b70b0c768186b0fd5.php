<?php $__env->startSection('content'); ?>
<style>
  .pending-status {
    color: #B8860B;
}

.approved-status {
    color: blue;
}

.rejected-status {
    color: red;
}

</style>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Vendors</h2>
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
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td> 
                                <td><?php echo e($vendor->name); ?></td> 
                                <td><?php echo e($vendor->address); ?></td> 
                                <td><?php echo e($vendor->email); ?></td> 
                                <td><?php echo e($vendor->phone); ?></td> 
                                <td>
                                    <span class="<?php echo e(strtolower($vendor->status)); ?>-status">
                                        <?php echo e(ucfirst($vendor->status)); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <?php if($vendor->status === 'approved'): ?>
                                        <!-- More Details Button -->
                                        <a href="<?php echo e(route('vendor-details', $vendor->id)); ?>" class="btn btn-info btn-sm me-2 text-white">More Details</a>
                                    <?php endif; ?>

                                    <?php if($vendor->status === 'pending'): ?>
                                        <form action="<?php echo e(route('admin.vendors.updateStatus', ['id' => $vendor->id, 'status' => 'approved'])); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if($vendor->status !== 'rejected'): ?>
                                        <form action="<?php echo e(route('admin.vendors.updateStatus', ['id' => $vendor->id, 'status' => 'rejected'])); ?>" method="POST" style="display:inline;">
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

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DK-Mart\resources\views/AdminDashboard/vendors.blade.php ENDPATH**/ ?>