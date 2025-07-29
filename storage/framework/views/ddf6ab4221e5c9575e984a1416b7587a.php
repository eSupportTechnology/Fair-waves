<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Edit Delivery Fee</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('fees.update', ['fee' => $fee->id])); ?>" method="POST">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="feeAmount" class="form-label">Fee Amount</label>
                    <input type="number" class="form-control" id="feeAmount" name="fee"
                           value="<?php echo e(old('fee', $fee->fee)); ?>" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Fee</button>
                <a href="<?php echo e(route('fees.index')); ?>" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/fee/edit.blade.php ENDPATH**/ ?>