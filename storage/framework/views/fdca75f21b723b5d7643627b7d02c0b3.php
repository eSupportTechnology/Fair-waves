<ul style="list-style-type: none;">
    <?php $__currentLoopData = $tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li style="margin-left: <?php echo e($node['depth'] * 20); ?>px;">
            <strong><?php echo e($node['user']->name); ?></strong> —
            <small class="text-muted"><?php echo e($node['user']->dealerProfile->rank ?? 'N/A'); ?></small>
        </li>
        <?php if(!empty($node['children'])): ?>
            <?php echo $__env->make('frontend.dealer.partials.hierarchy-tree', ['tree' => $node['children']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/partials/hierarchy-tree.blade.php ENDPATH**/ ?>