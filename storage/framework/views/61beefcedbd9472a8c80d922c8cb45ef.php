<?php $__empty_1 = true; $__currentLoopData = $productLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card mb-3 w-100">
            <div class="card-body">
            <h5><?php echo e($link->product->product_name); ?></h5>
            <p class="mb-1">
                <strong>Affiliate Link:</strong>
                <input type="text" class="form-control d-inline-block w-75" value="<?php echo e(url('showroom/'.$link->dealer->dealerProfile->dealer_shop_name.'/product/'.$link->unique_code)); ?>" id="affiliate-link-<?php echo e($link->id); ?>" readonly>
                <button class="btn btn-sm btn-outline-secondary text-dark" type="button" onclick="navigator.clipboard.writeText(document.getElementById('affiliate-link-<?php echo e($link->id); ?>').value)">
                Copy
                </button>
            </p>

            <div class="d-flex gap-2 mt-3">
                <a href="<?php echo e(route('dealer.products.orders', $link->id)); ?>" class="btn btn-sm btn-outline-info text-dark">
                <i class="fas fa-list"></i> View Orders
                </a>
                <form action="<?php echo e(route('dealer.products.delete', $link->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-sm btn-outline-danger text-dark" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i> Delete Link
                </button>
                </form>
            </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">You haven't generated any product links yet.</p>
    <?php endif; ?>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/partials/dealer-products.blade.php ENDPATH**/ ?>