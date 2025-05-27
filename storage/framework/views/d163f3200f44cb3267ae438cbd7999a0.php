<?php $__env->startSection('dashboard-content'); ?>
<style>
    .review-images {
        display: flex;
        gap: 10px;
    }

    .review-images img {
        width: 10%;
        height: auto;
        object-fit: cover;
    }

    .button-tabs {
        display: flex;
        gap: 10px;
    }

    .tab-button {
        padding: 5px 15px;
        border: 1px solid #ced4da;
        background-color: #ffffff;
        color: #6c757d;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .tab-button.active,
    .tab-button:hover {
        background-color: white;
        color: rgb(255, 123, 0);
        border-color: rgb(255, 123, 0);
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .btn-review {
        color: orange !important;
        /* Text color set to orange */
        background-color: white;
        /* Background color set to white */
        border: 1px solid orange;
        /* Border set to orange */
        padding: 4px 28px;
        /* Add padding for button */
        border-radius: 5px;
        /* Optional: Round the corners */
        text-decoration: none;
        /* Remove underline */
        font-weight: bold;
        /* Make text bold */
        font-size: 14px;

    }

    /* Optional: Add hover effect */
    .btn-review:hover {
        background-color: white;
        /* Background color on hover */
        color: orange !important;
        /* Text color on hover */
    }
</style>

<h4 class="px-2 py-2">My Reviews</h4>
<div class="mt-4 d-flex justify-content-between align-items-center">
    <div class="button-tabs">
        <button class="mb-1 tab-button active" data-target="to-be-reviewed">To be Reviewed (<?php echo e($toBeReviewedItems->count()); ?>)</button>
        <button class="mb-1 tab-button" data-target="history">History (<?php echo e($historyItems->count()); ?>)</button>
    </div>
</div>

<!-- To be reviewed Tab -->
<div id="to-be-reviewed" class="tab-content active">
    <div class="mt-3 order-items">
        <?php $__empty_1 = true; $__currentLoopData = $toBeReviewedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="px-3 order-items-list">
            <div class="order-item d-flex align-items-center justify-content-between" style="padding: 10px; border-bottom: 1px solid #eaeaea;">
                <div style="display: flex; align-items: center;">
                    <div style="margin-right: 15px;">
                        <a href="#">
                            <?php if($item->product->images->isNotEmpty()): ?>
                            <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" width="70" height="70" class="img-xs" alt="Item" />
                            <?php else: ?>
                            <img src="<?php echo e(asset('path/to/default-image.jpg')); ?>" width="40" height="40" class="img-xs" alt="Default Image" />
                            <?php endif; ?>
                        </a>
                    </div>
                    <div style="line-height: 1.7;color:black;">
                        <span style="font-weight: 600; font-size: 15px;margin-top:15px;"><?php echo e($item->product->product_name); ?></span><br>
                        <div class="d-flex align-items-center">
                            <?php if($item->color!=null): ?>
                            <span class="d-flex align-items-center me-2">
                                <strong>Color:</strong>
                                <span style="display: inline-block; background-color: <?php echo e($item->color); ?>; border: 1px solid #e8ebec; height: 15px; width: 15px; border-radius: 50%;" title="Color"></span>
                            </span> |
                            <?php endif; ?>
                            <?php if($item->size!=null): ?>
                            <span class="me-2 ms-2">Size: <span style="font-weight: 600;"><?php echo e($item->size); ?></span></span> |
                            <?php endif; ?>
                            <span class="ms-2">Qty: <span style="font-weight: 600;"><?php echo e($item->quantity); ?></span></span>
                        </div>
                        <h6 class="mt-2" style="font-weight: bold;font-size: 15px">Rs <?php echo e(number_format($item->cost, 2)); ?></h6>
                    </div>
                </div>
                <div class="ml-auto" style="text-align: right;">
                    <a href="<?php echo e(route('write-review', $item->id)); ?>" class="btn-review">Review</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No items to be reviewed.</p>
        <?php endif; ?>
    </div>
</div>

<!-- History Tab -->
<div id="history" class="tab-content">
    <div class="mt-3 order-items">
        <?php $__empty_1 = true; $__currentLoopData = $historyItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="px-3 order-items-list">
            <div class="order-item d-flex align-items-center" style="padding: 15px; border-bottom: 1px solid #eaeaea; margin-bottom: 20px;">
                <!-- Product Info Column -->
                <div class="col-md-5">
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        <a href="#">
                            <?php if($item->product->images->isNotEmpty()): ?>
                            <img src="<?php echo e(asset('storage/' . $item->product->images->first()->image_path)); ?>" width="70" height="70" class="img-xs" alt="Item Image" />
                            <?php else: ?>
                            <img src="<?php echo e(asset('path/to/default-image.jpg')); ?>" width="40" height="40" class="img-xs" alt="Default Image" />
                            <?php endif; ?>
                        </a>
                        <div style="line-height: 1.7; color: black; margin-left: 15px;">
                            <span style="font-weight: 600; font-size: 15px;"><?php echo e($item->product->product_name); ?></span><br>
                            <div class="d-flex align-items-center mt-2">
                                <?php if($item->color): ?>
                                <span class="d-flex align-items-center me-2">
                                    <strong>Color:</strong>
                                    <span style="display: inline-block; background-color: <?php echo e($item->color); ?>; border: 1px solid #e8ebec; height: 15px; width: 15px; border-radius: 50%;" title="Color"></span>
                                </span> |
                                <?php endif; ?>
                                <?php if($item->size): ?>
                                <span class="me-2 ms-2">Size: <span style="font-weight: 600;"><?php echo e($item->size); ?></span></span> |
                                <?php endif; ?>
                                <span class="ms-2">Qty: <span style="font-weight: 600;"><?php echo e($item->quantity); ?></span></span>
                            </div>
                            <h6 class="mt-2" style="font-weight: bold;font-size: 15px;">Rs <?php echo e(number_format($item->cost, 2)); ?></h6>
                        </div>
                    </div>
                </div>

                <!-- Review Details Column -->
                <div class="col-md-5">
                    <div class="mb-4">
                        <p class="text-dark mb-1" style="font-weight: bold;">Date - <?php echo e($item->review->created_at->format('d.m.Y')); ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="text-dark mb-1" style="font-weight: bold;">Rating & Review</p>
                        <div class="d-flex align-items-center">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="<?php echo e($item->review->rating >= $i ? 'fa-star fas filled' : 'far fa-star'); ?>" style="color: gold;"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-muted mt-2"><?php echo e($item->review->review ?? 'No review available.'); ?></p>
                    </div>

                    <div class="mb-4">
                        <p class="text-dark mb-1" style="font-weight: bold;">Review Media</p>
                        <div class="d-flex flex-wrap justify-content-start mt-2">
                            <?php
                            $mediaFiles = is_string($item->review->media) ? json_decode($item->review->media, true) : $item->review->media;
                            ?>

                            <?php if(!empty($mediaFiles)): ?>
                            <?php $__currentLoopData = $mediaFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(in_array(pathinfo($media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                            <!-- Display Image -->
                            <div class="me-2 mb-2">
                                <img src="<?php echo e(asset('storage/' . $media)); ?>" alt="Review Media" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <?php elseif(in_array(pathinfo($media, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'webm'])): ?>
                            <!-- Display Video -->
                            <div class="me-2 mb-2">
                                <video controls class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                    <source src="<?php echo e(asset('storage/' . $media)); ?>" type="video/<?php echo e(pathinfo($media, PATHINFO_EXTENSION)); ?>">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <?php else: ?>
                            <!-- Unsupported Media -->
                            <div class="me-2 mb-2">
                                <span class="badge bg-warning">Unsupported Media Type</span>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <p>No media available for this review.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Delete Button Column -->
                <div class="col-md-2 text-end">
                    <div class="mb-4">
                        <form action="<?php echo e(route('customer.reviews.destroy', $item->review->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm mt-5" onclick="return confirm('Are you sure you want to delete this review?');">
                                <i class="fas fa-trash"></i> Delete Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No review history.</p>
        <?php endif; ?>
    </div>
</div>




<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(this.getAttribute('data-target')).classList.add('active');
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/user_dashboard/My-Reviews.blade.php ENDPATH**/ ?>