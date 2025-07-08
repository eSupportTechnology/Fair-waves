<?php $__env->startSection('dashboard-content'); ?>
<div class="container">
    <h4 class="mb-4"><i class="fas fa-sitemap text-primary me-2"></i> Full Team Hierarchy</h4>

    <?php echo $__env->make('frontend.dealer.partials.hierarchy-tree', ['tree' => $tree], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/full-hierarchy.blade.php ENDPATH**/ ?>