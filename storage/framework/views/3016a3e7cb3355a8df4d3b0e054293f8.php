<?php $__env->startSection('content'); ?>
    <style>
        .btn-approve {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-approve:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-reject {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Pending Withdrawals</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="<?php echo e(route('admin.withdrawals.pending')); ?>">
                <div class="search-container" style="max-width: 800px; margin: 0 auto;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg"
                            placeholder="Search by name, email, or phone..." value="<?php echo e(request('search')); ?>"
                            style="border-radius: 30px 0 0 30px; padding-left: 20px;">
                        <button class="btn btn-primary btn-lg" type="submit"
                            style="border-radius: 0 30px 30px 0; padding: 0 25px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <?php if(request('search')): ?>
                        <div class="mt-2">
                            <a href="<?php echo e(route('admin.withdrawals.pending')); ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-times"></i> Clear search
                            </a>
                            <span class="ms-2 text-muted">Search results for:
                                <strong>"<?php echo e(request('search')); ?>"</strong></span>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="withdrawalTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dealer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>BV</th>
                            <th>Bank Details</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($withdrawals->firstItem() + $index); ?></td>
                                <td><?php echo e($withdrawal->dealer->name ?? 'N/A'); ?></td>
                                <td><?php echo e($withdrawal->dealer->email ?? 'N/A'); ?></td>
                                <td><?php echo e($withdrawal->dealer->phone ?? 'N/A'); ?></td>
                                <td>Rs. <?php echo e(number_format($withdrawal->amount, 2)); ?></td>
                                <td><?php echo e(number_format($withdrawal->bv, 2)); ?></td>
                                <td>
                                    <?php if($withdrawal->bankDetail): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#bankModal<?php echo e($withdrawal->id); ?>">
                                            Live View
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo e($withdrawal->created_at->format('Y-m-d')); ?></td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('admin.withdrawals.show', $withdrawal->id)); ?>"
                                        class="btn btn-info btn-sm me-1" data-bs-toggle="tooltip" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.withdrawals.approve', $withdrawal->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-approve btn-sm me-1"
                                            onclick="return confirm('Approve this withdrawal?')" data-bs-toggle="tooltip"
                                            title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('admin.withdrawals.reject', $withdrawal->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-reject btn-sm"
                                            onclick="return confirm('Reject this withdrawal?')" data-bs-toggle="tooltip"
                                            title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center">No pending withdrawals found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>




            </div>
        </div>
    </div>

    <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($withdrawal->bankDetail): ?>
            <!-- Bank Detail Modal -->
            <div class="modal fade" id="bankModal<?php echo e($withdrawal->id); ?>" tabindex="-1"
                aria-labelledby="bankModalLabel<?php echo e($withdrawal->id); ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="bankModalLabel<?php echo e($withdrawal->id); ?>">
                                Bank Details - <?php echo e($withdrawal->dealer->name ?? 'N/A'); ?>

                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 shadow-sm">
                                        <h6 class="fw-bold mb-2">Bank Info</h6>
                                        <p class="mb-1"><strong>Bank Name:</strong>
                                            <?php echo e($withdrawal->bankDetail->bank_name); ?></p>
                                        <p class="mb-1"><strong>Branch:</strong>
                                            <?php echo e($withdrawal->bankDetail->bank_branch); ?></p>
                                        <p class="mb-1"><strong>Account Name:</strong>
                                            <?php echo e($withdrawal->bankDetail->account_name); ?></p>
                                        <p class="mb-1"><strong>Account Number:</strong>
                                            <?php echo e($withdrawal->bankDetail->account_number); ?></p>
                                        
                                        <p class="mb-0"><strong>Status:</strong>
                                            <span
                                                class="badge
                                            <?php if($withdrawal->bankDetail->bank_status == 'approved'): ?> bg-success
                                            <?php elseif($withdrawal->bankDetail->bank_status == 'rejected'): ?> bg-danger
                                            <?php else: ?> bg-warning text-dark <?php endif; ?>">
                                                <?php echo e(ucfirst($withdrawal->bankDetail->bank_status)); ?>

                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 shadow-sm">
                                        <h6 class="fw-bold mb-3">Bank Card Images</h6>
                                        <div class="mb-3">
                                            <p class="mb-1"><strong>Front:</strong></p>
                                            <?php if($withdrawal->bankDetail->bank_front_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $withdrawal->bankDetail->bank_front_image)); ?>"
                                                    class="img-fluid rounded shadow-sm border" alt="Front Image">
                                            <?php else: ?>
                                                <span class="text-muted">N/A</span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <p class="mb-1"><strong>Back:</strong></p>
                                            <?php if($withdrawal->bankDetail->bank_back_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $withdrawal->bankDetail->bank_back_image)); ?>"
                                                    class="img-fluid rounded shadow-sm border" alt="Back Image">
                                            <?php else: ?>
                                                <span class="text-muted">N/A</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- modal-body -->
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="pagination-area mt-3 mb-5">
        <?php echo e($withdrawals->links()); ?>

    </div>

    <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
            $('#withdrawalTable').DataTable({
                paging: false,
                info: false,
                searching: false,
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 7
                }]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/withdraw/pending.blade.php ENDPATH**/ ?>