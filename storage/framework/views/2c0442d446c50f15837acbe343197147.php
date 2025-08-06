<?php $__env->startSection('dashboard-content'); ?>
<div class="container">
    <h4 class="mb-4"><i class="fas fa-chart-bar text-info me-2"></i>Dealer Analytics</h4>

    <div class="row">
        <div class="col-md-4">
            <div class="stats-card p-3">
                <h6>Total Team</h6>
                <h3 class="text-primary"><?php echo e($teamCount ?? 'N/A'); ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card p-3">
                <h6>Current BV</h6>
                <h3 class="text-success"><?php echo e($dealerProfile->bv); ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card p-3">
                <h6>Total CBV</h6>
                <h3 class="text-warning"><?php echo e($dealerProfile->cbv); ?></h3>
            </div>
        </div>
    </div>

    <p class="text-muted mt-4">Detailed analytics coming soon. You’ll be able to track week-wise earnings, team growth trends, and conversion rates.</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/analytics.blade.php ENDPATH**/ ?>