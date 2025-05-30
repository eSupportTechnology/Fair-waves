<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="text-center text-primary mb-4">Product Details</h3>

                <!-- Product Info & Affiliate Details in Compact Grid -->
                <div class="row mb-3">
                    <div class="col-6 mb-2">
                        <p><strong>Product ID:</strong> <?php echo e($product->product_id); ?></p>
                        <p><strong>Name:</strong> <?php echo e($product->product_name); ?></p>
                        <p><strong>Category:</strong> <span class="badge bg-info text-white"><?php echo e($product->category->name ?? 'N/A'); ?></span></p>
                        <p><strong>Quantity:</strong> <?php echo e($product->quantity); ?></p>
                        <p><strong>Brand:</strong> <?php echo e($product->brand->name ?? 'N/A'); ?></p>
                    </div>
                    <div class="col-6 mb-2">
                        <p><strong>Price:</strong> Rs. <?php echo e($product->normal_price); ?></p>
                        <?php if($product->is_affiliate): ?>
                            <p><strong>Affiliate Price:</strong> Rs. <?php echo e($product->affiliate_price); ?></p>
                            <p><strong>Commission :</strong> <?php echo e($product->commission_percentage); ?>%</p>
                            <p><strong>Commission Price:</strong> Rs. <?php echo e($product->commission_price); ?></p>
                        <?php endif; ?>

                        <!-- Sizes Section -->
                        <?php if($product->variations->pluck('value')->filter()->unique()->isNotEmpty()): ?>
                            <div class="flex-between align-items-start flex-wrap gap-16">
                                <div class="d-flex align-items-center mb-5">
                                    <span class="text-gray-900 me-3">Size:</span>
                                    <?php $__currentLoopData = $product->variations->pluck('value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span><?php echo e($size); ?><?php echo e($index < $product->variations->pluck('value')->filter()->unique()->count() - 1 ? ',' : ''); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Colors Section -->
                        <?php if($product->variations->pluck('hex_value')->filter()->unique()->isNotEmpty()): ?>
                            <div class="flex-between align-items-center flex-wrap gap-16">
                                <div class="d-flex align-items-center mb-4">
                                    <span class="text-gray-900 me-3">Color:</span>
                                    <?php $__currentLoopData = $product->variations->pluck('hex_value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span
                                            class="color-list__button border border-2 border-gray-50 rounded-circle me-2"
                                            style="background-color: <?php echo e($color); ?>; width: 20px; height: 20px;"
                                            data-color="<?php echo e($color); ?>">
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- Product Description Section -->
                <div class="mb-4">
                    <h5 class="text-secondary">Description</h5>
                    <p class="text-muted"><?php echo e($product->product_description ?? 'No description available.'); ?></p>
                </div>

                <!-- Images Section -->
                <h5 class="text-secondary mt-4">Product Images</h5>
                <div class="d-flex flex-wrap mt-2">
                    <?php if($product->images->isNotEmpty()): ?>
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" class="img-thumbnail me-2 mb-2" style="width: 12%;" alt="Product Image" />
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p class="text-muted">No images available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/product-details.blade.php ENDPATH**/ ?>