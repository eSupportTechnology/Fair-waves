<?php $__empty_1 = true; $__currentLoopData = $productLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="product-card">
        <div class="product-card-header">
            <h5 class="mb-0">
                <i class="fas fa-cube text-primary me-2"></i>
                <?php echo e($link->product->product_name); ?>

            </h5>
        </div>
        
        <div class="product-card-body">
            <div class="row">
                <!-- Left side - Affiliate link content -->
                <div class="col-lg-9 col-12 order-lg-1 order-1">
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-link text-success me-1"></i>
                            Affiliate Link:
                        </label>
                        <div class="affiliate-link-container">
                            <input type="text" 
                                   class="affiliate-link-input" 
                                   value="<?php echo e(url('showroom/'.$link->dealer->dealerProfile->dealer_shop_name.'/product/'.$link->unique_code)); ?>" 
                                   id="affiliate-link-<?php echo e($link->id); ?>" 
                                   readonly>
                            <button class="copy-btn" 
                                    type="button" 
                                    onclick="copyAffiliateLink(<?php echo e($link->id); ?>)">
                                <i class="fas fa-copy me-1"></i>
                                Copy Link
                            </button>
                        </div>
                    </div>

                    <!-- Mobile action buttons -->
                    <div class="action-buttons-mobile d-lg-none">
                        <div class="action-buttons">
                            <a href="<?php echo e(route('dealer.products.orders', $link->id)); ?>" 
                               class="action-btn action-btn-view">
                                <i class="fas fa-list"></i>
                                View Orders
                            </a>
                            <form action="<?php echo e(route('dealer.products.delete', $link->id)); ?>" 
                                  method="POST" 
                                  class="d-inline-flex flex-fill"
                                  onsubmit="return confirmDelete()">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        class="action-btn action-btn-delete w-100">
                                    <i class="fas fa-trash"></i>
                                    Delete Link
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Right side - Desktop action buttons -->
                <div class="col-lg-3 col-12 order-lg-2 order-2">
                    <div class="action-buttons-desktop d-none d-lg-block">
                        <a href="<?php echo e(route('dealer.products.orders', $link->id)); ?>" 
                           class="action-btn action-btn-view w-100 mb-2">
                            <i class="fas fa-list"></i>
                            View Orders
                        </a>
                        <form action="<?php echo e(route('dealer.products.delete', $link->id)); ?>" 
                              method="POST" 
                              onsubmit="return confirmDelete()">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" 
                                    class="action-btn action-btn-delete w-100">
                                <i class="fas fa-trash"></i>
                                Delete Link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty-state">
        <i class="fas fa-box-open"></i>
        <h5>No Product Links Yet</h5>
        <p class="mb-0">You haven't generated any product links yet. Start creating links to earn commissions!</p>
    </div>
<?php endif; ?>

<script>
function copyAffiliateLink(linkId) {
    const inputElement = document.getElementById('affiliate-link-' + linkId);
    const copyButton = event.target.closest('button');
    
    // Copy to clipboard
    navigator.clipboard.writeText(inputElement.value).then(function() {
        // Success feedback
        const originalText = copyButton.innerHTML;
        copyButton.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        copyButton.style.background = 'linear-gradient(135deg, #28a745, #1e7e34)';
        
        setTimeout(() => {
            copyButton.innerHTML = originalText;
            copyButton.style.background = 'linear-gradient(135deg, #6c757d, #545b62)';
        }, 2000);
    }).catch(function() {
        // Fallback for browsers that don't support clipboard API
        inputElement.select();
        inputElement.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');
        
        const originalText = copyButton.innerHTML;
        copyButton.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        copyButton.style.background = 'linear-gradient(135deg, #28a745, #1e7e34)';
        
        setTimeout(() => {
            copyButton.innerHTML = originalText;
            copyButton.style.background = 'linear-gradient(135deg, #6c757d, #545b62)';
        }, 2000);
    });
}

function confirmDelete() {
    return confirm('Are you sure you want to delete this product link? This action cannot be undone.');
}
</script>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/partials/dealer-products.blade.php ENDPATH**/ ?>