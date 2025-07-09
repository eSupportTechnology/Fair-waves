<?php $__env->startSection('dashboard-content'); ?>
<div class="container">
    <h4 class="mb-4">My Product Links</h4>

    <div style="max-height: 70vh; overflow-y: auto;">
        <?php echo $__env->make('frontend.dealer.partials.dealer-products', ['productLinks' => $productLinks], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/dealer-products-dashboard.blade.php ENDPATH**/ ?>