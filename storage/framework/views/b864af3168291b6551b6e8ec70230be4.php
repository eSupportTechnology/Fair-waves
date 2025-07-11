
<div class="tree-node <?php echo e($isRoot ? 'current-user' : 'level-' . min($node['depth'], 4)); ?>">
    <?php if(!$isRoot): ?>
        <div class="level-indicator"><?php echo e($node['depth']); ?></div>
    <?php endif; ?>
    
    <div class="node-avatar">
        <?php echo e(strtoupper(substr($node['user']->name, 0, 2))); ?>

    </div>
    
    <div class="node-info">
        <h5>
            <?php if($isRoot): ?>
                <?php echo e($node['user']->name); ?> (You)
            <?php else: ?>
                <?php echo e($node['user']->name); ?>

            <?php endif; ?>
        </h5>
        
        <div class="rank">
            <?php echo e($node['user']->dealerProfile->rank ?? 'Beginner'); ?>

        </div>
        
        <?php if($node['user']->dealerProfile): ?>
            <div class="node-stats">
                <div class="stat-item">
                    <div class="stat-value"><?php echo e($node['user']->dealerProfile->bv ?? 0); ?></div>
                    <div class="stat-label">BV</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value"><?php echo e($node['user']->dealerProfile->cbv ?? 0); ?></div>
                    <div class="stat-label">CBV</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">
                        <?php if($node['user']->directReferrals): ?>
                            <?php echo e($node['user']->directReferrals->count()); ?>

                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </div>
                    <div class="stat-label">Direct</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value"><?php echo e(count($node['children'])); ?></div>
                    <div class="stat-label">Children</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if(!empty($node['children'])): ?>
    <div class="tree-children">
        <?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tree-child">
                <?php echo $__env->make('frontend.dealer.partials.professional-tree-node', ['node' => $child, 'isRoot' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <?php if($isRoot): ?>
        <div class="no-children">
            <i class="fas fa-users text-muted me-2"></i>
            No team members yet. Share your referral link to start building your team!
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/dealer/partials/professional-tree-node.blade.php ENDPATH**/ ?>