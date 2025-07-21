<?php $__env->startSection('content'); ?>
<div class="content-header mb-4">
    <div>
        <h2 class="content-title card-title">Approved Withdrawal Requests</h2>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header pb-0">
        <form method="GET" action="<?php echo e(route('admin.withdrawals.approved')); ?>" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control"
                    placeholder="Search by name, email, or phone">
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> Search
                </button>
            </div>
        </form>
    </div>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Dealer</th>
                        <th>Amount</th>
                        <th>BV</th>
                        <th>Requested At</th>
                        <th>Status</th>
                        <th>Live View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration + ($withdrawals->currentPage() - 1) * $withdrawals->perPage()); ?></td>
                            <td>
                                <strong><?php echo e($withdrawal->dealer->name ?? 'N/A'); ?></strong><br>
                                <small><?php echo e($withdrawal->dealer->email ?? ''); ?></small>
                            </td>
                            <td>Rs. <?php echo e(number_format($withdrawal->amount, 2)); ?></td>
                            <td><?php echo e(number_format($withdrawal->bv, 2)); ?></td>
                            <td><?php echo e($withdrawal->created_at->format('Y-m-d H:i')); ?></td>
                            <td>
                                <span class="badge bg-success">Approved</span>
                            </td>
                            <td>
                                <?php if($withdrawal->bankDetail): ?>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#bankModal<?php echo e($withdrawal->id); ?>">
                                        Live View
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted">No Details</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">No approved withdrawal requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            <?php echo e($withdrawals->links()); ?>

        </div>
    </div>
</div>

<!-- Modals -->
<?php echo $__env->make('AdminDashboard.withdraw.partials.bank_modals', ['withdrawals' => $withdrawals], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/withdraw/approved.blade.php ENDPATH**/ ?>