<?php $__env->startSection('content'); ?>

<div class="content-header">
    <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Go back </a>
</div>

<div class="card mb-4">
    <div class="card-header bg-brand-2" style="height: 150px"></div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl col-lg flex-grow-0" style="flex-basis: 230px">
                <div class="img-thumbnail shadow w-100 bg-white position-relative text-center" style="height: 190px; width: 200px; margin-top: -120px">
                <img src="<?php echo e(asset('storage/' . $shop->shop_logo ?? '/backend/assets/imgs/brands/vendor-2.png')); ?>" class="center-xy img-fluid" alt="Logo Brand" />
                </div>
            </div>

            <div class="col-xl col-lg">
                <h3><?php echo e($shop->shop_name); ?></h3>
                <p><?php echo e($shop->shop_description ?? 'No description available.'); ?></p>
            </div>
        </div>

        <hr class="my-4" />

        <div class="row g-4">
            <div class="col-md-12 col-lg-4 col-xl-2">
                <article class="box">
                    <p class="mb-0 text-muted">Total sales:</p>
                    <h5 class="text-success"><?php echo e($totalSales); ?></h5>
                    <p class="mb-0 text-muted">Revenue:</p>
                    <h5 class="text-success mb-0">Rs <?php echo e(number_format($revenue, 2)); ?></h5>
                </article>
            </div>


            <div class="col-sm-6 col-lg-4 col-xl-3">
                <h6>Contact</h6>
                <p>
                    <?php echo e($vendor->name); ?> <br />
                    <?php echo e($vendor->email); ?> <br />
                    <?php echo e($vendor->phone); ?>

                </p>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3">
                <h6>Address</h6>
                <p>
                    <?php echo e($vendor->address); ?> <br />
                </p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title">Products by seller</h3>
        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-2 col-lg-3 col-md-6">
                    <div class="card card-product-grid" style="box-shadow: none;">
                        <?php if($product->images->isNotEmpty()): ?>
                            <a href="#" class="img-wrap">
                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" alt="<?php echo e($product->product_name); ?>" />
                            </a>
                        <?php endif; ?>
                        <div class="info-wrap">
                            <a href="#" class="title"><?php echo e($product->product_name); ?></a>
                            <div class="price mt-1">Rs <?php echo e(number_format($product->normal_price, 2)); ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<div class="pagination-area mt-30 mb-50">
    <?php echo e($products->links()); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DK-Mart\resources\views/AdminDashboard/vendor-details.blade.php ENDPATH**/ ?>