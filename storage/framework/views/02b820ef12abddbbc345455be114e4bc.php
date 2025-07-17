<?php $__env->startSection('dashboard-content'); ?>
<div class="container">
    <h4 class="mb-4"><i class="fas fa-bell text-warning me-2"></i>Your Notifications</h4>

    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="alert <?php echo e($note->is_read ? 'alert-secondary' : 'alert-info'); ?>">
            <strong><?php echo e($note->type); ?></strong>: <?php echo e($note->message); ?>

            <br><small class="text-muted"><?php echo e($note->created_at->diffForHumans()); ?></small>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">You have no notifications.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/dealer/notifications.blade.php ENDPATH**/ ?>