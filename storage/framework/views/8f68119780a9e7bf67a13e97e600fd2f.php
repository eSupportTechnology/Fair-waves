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
                                        
                                    </div>
                                </div>
                            </div>
                        </div> <!-- modal-body -->
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/withdraw/partials/bank_modals.blade.php ENDPATH**/ ?>