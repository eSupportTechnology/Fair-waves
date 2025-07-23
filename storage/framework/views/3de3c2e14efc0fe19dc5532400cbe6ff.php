<?php $__env->startSection('dashboard-content'); ?>
<div class="container">
    <h4 class="mb-4"><i class="fas fa-user-plus text-primary me-2"></i>Pending Referral Approvals</h4>

    <?php if($referrals->isEmpty()): ?>
        <p class="text-muted">No pending referrals.</p>
    <?php else: ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($ref->referred->name); ?></td>
                        <td><?php echo e($ref->referred->email); ?></td>
                        <td><?php echo e($ref->referred->created_at->diffForHumans()); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('dealer.referrals.approve', $ref->id)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form method="POST" action="<?php echo e(route('dealer.referrals.reject', $ref->id)); ?>" class="d-inline ms-1">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/pending-referrals.blade.php ENDPATH**/ ?>