<?php $__env->startSection('content'); ?>



<div class="content-header">
    <div>
        <h2 class="content-title card-title">My Details</h2>
        <p>Manage your website information here</p>
    </div>
</div>

<!-- Display Flash Messages -->
<div class="container pt-4 px-4">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<div class="container pt-4 px-4">
    <h3 class="py-3">Basic Information</h3>

    <!-- Display Basic Information -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2">
                    <h5 class="py-3" style="font-weight: bold;">Basic Information</h5>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <!-- Trigger Modal for Editing Basic Information -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBasicInfoModal">
                        Edit
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Login Email</strong><br><?php echo e($customer->email); ?></td>
                            <td><strong>Password</strong><br>*********</td>
                            <td><strong>Login Phone Number</strong><br><?php echo e($customer->contactno ?: '-'); ?></td>
                            <td><strong>Payee Name</strong><br><?php echo e($customer->name); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h3 class="py-3">Promotion Methods</h3>

    <!-- Promotion Methods Table -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2">
                    <h5 class="py-3" style="font-weight: bold;">Promotion Methods</h5>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <!-- Trigger Modal for Editing Promotion Methods -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPromotionMethodsModal">
                        Edit
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Promotion Methods</strong><br>
                                <ul>
                                    <?php $__currentLoopData = $customer->promotion_method ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($method); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </td>
                            <td><strong>Social Media Platform</strong><br>
                                <?php if($customer->instagram_url): ?>
                                    Instagram: <a href="<?php echo e($customer->instagram_url); ?>" target="_blank"><?php echo e($customer->instagram_url); ?></a><br>
                                <?php endif; ?>
                                <?php if($customer->facebook_url): ?>
                                    Facebook: <a href="<?php echo e($customer->facebook_url); ?>" target="_blank"><?php echo e($customer->facebook_url); ?></a><br>
                                <?php endif; ?>
                                <?php if($customer->tiktok_url): ?>
                                    TikTok: <a href="<?php echo e($customer->tiktok_url); ?>" target="_blank"><?php echo e($customer->tiktok_url); ?></a><br>
                                <?php endif; ?>
                                <?php if($customer->youtube_url): ?>
                                    YouTube: <a href="<?php echo e($customer->youtube_url); ?>" target="_blank"><?php echo e($customer->youtube_url); ?></a><br>
                                <?php endif; ?>
                                <?php if($customer->content_website_url): ?>
                                    Website: <a href="<?php echo e($customer->content_website_url); ?>" target="_blank"><?php echo e($customer->content_website_url); ?></a><br>
                                <?php endif; ?>
                                <?php if($customer->content_whatsapp_url): ?>
                                    WhatsApp: <a href="<?php echo e($customer->content_whatsapp_url); ?>" target="_blank"><?php echo e($customer->content_whatsapp_url); ?></a><br>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->

<!-- Modal for Editing Basic Information -->
<div class="modal fade" id="editBasicInfoModal" tabindex="-1" aria-labelledby="editBasicInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBasicInfoModalLabel">Edit Basic Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('affiliate.updateBasicInfo')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="payeename" class="text-secondary">Payee Name</label>
                        <input type="text" id="payeename" name="payeename" class="form-control" value="<?php echo e($customer->name); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="loginemail" class="text-secondary">Login Email</label>
                        <input type="email" id="loginemail" name="loginemail" class="form-control" value="<?php echo e($customer->email); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="loginphone" class="text-secondary">Login Phone Number</label>
                        <input type="text" id="loginphone" name="loginphone" class="form-control" value="<?php echo e($customer->contactno); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Promotion Methods -->
<div class="modal fade" id="editPromotionMethodsModal" tabindex="-1" aria-labelledby="editPromotionMethodsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPromotionMethodsModalLabel">Edit Promotion Methods</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('affiliate.updateSiteInfo')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label class="text-secondary mb-2">Promotion Methods</label>
                        <?php
                            $promotionMethods = $customer->promotion_method ?? [];
                            $allMethods = ['Instagram', 'Facebook', 'TikTok', 'YouTube', 'Content website/blog', 'WhatsApp'];
                        ?>
                        <?php $__currentLoopData = $allMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="promotion_methods[]" 
                                       value="<?php echo e($method); ?>" 
                                       id="promotion_method_<?php echo e($loop->index); ?>" 
                                       <?php echo e(in_array($method, $promotionMethods) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="promotion_method_<?php echo e($loop->index); ?>">
                                    <?php echo e($method); ?>

                                </label>
                            </div>
                            <div class="form-group mt-2">
                                <input type="text" class="form-control" 
                                       name="<?php echo e(strtolower(str_replace(' ', '_', $method)) . '_url'); ?>" 
                                       placeholder="Enter <?php echo e($method); ?> URL"
                                       value="<?php echo e($customer->{strtolower(str_replace(' ', '_', $method)) . '_url'} ?? ''); ?>"
                                       <?php echo e(!in_array($method, $promotionMethods) ? 'disabled' : ''); ?>>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable or disable URL input based on checkbox selection
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const urlInput = this.closest('.form-check').nextElementSibling.querySelector('input[type="text"]');
                if (urlInput) {
                    urlInput.disabled = !this.checked;
                }
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AffiliateDashBoard.affmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DK-Mart\resources\views/AffiliateDashBoard/myWebsite.blade.php ENDPATH**/ ?>