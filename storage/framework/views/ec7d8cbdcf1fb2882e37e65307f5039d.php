<?php $__env->startSection('content'); ?>

    <style>
        .card {
            margin-bottom: 20px;
            padding: 15px;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order-cards-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .details-cards-row {
            display: flex;
            justify-content: space-between;
        }

        .details-cards-row .item-details-card {
            width: 100%;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .card-name {
            font-size: 14px;
            font-weight: 500;
        }

        .icon-container {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .icon-container i {
            font-size: 22px;
        }

        .badge-soft-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .badge-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .badge-soft-primary {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .badge-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .profile-image-container {
            position: relative;
            display: inline-block;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-body {
            padding: 20px;
        }

        .profile-info-item {
            margin-bottom: 15px;
        }

        .profile-info-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .profile-info-value {
            font-size: 16px;
        }

        .dealer-card {
            background-color: #e8f4fc;
            border-left: 4px solid #0d6efd;
        }
    </style>

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dealer Details</h2>
            <p>Complete dealer information</p>
        </div>
        <div>
            <a href="<?php echo e(route('dealers')); ?>" class="btn btn-light rounded font-md">
                <i class="fas fa-arrow-left"></i> Back to Dealers
            </a>
            <a href="<?php echo e(route('dealer.edit', $dealer->id)); ?>" class="btn btn-primary rounded font-md">
                <i class="fas fa-edit"></i> Edit Dealer
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Dealer Profile Information -->
        <div class="col-md-4">
            <div class="card profile-card">
                <div class="profile-header text-center">
                    <div class="profile-image-container">
                        <img src="<?php echo e($dealer->profile_image_url); ?>" alt="Profile Image" class="profile-image">
                    </div>
                    <h4 class="mt-3"><?php echo e($dealer->name); ?></h4>
                    <p class="text-muted mb-0"><?php echo e($dealer->email); ?></p>
                    <span
                        class="badge <?php echo e($dealer->dealer_status == 1 ? 'badge-soft-success' : 'badge-soft-danger'); ?> px-3 py-2 mt-2">
                        <?php echo e($dealer->dealer_status == 1 ? 'Active' : 'Inactive'); ?>

                    </span>
                </div>
                <div class="profile-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-info-item">
                                <div class="profile-info-label">Phone</div>
                                <div class="profile-info-value"><?php echo e($dealer->phone ?? 'N/A'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="profile-info-item">
                                <div class="profile-info-label">Address</div>
                                <div class="profile-info-value"><?php echo e($dealer->address ?? 'N/A'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="profile-info-item">
                                <div class="profile-info-label">Gender</div>
                                <div class="profile-info-value"><?php echo e($dealer->gender ?? 'N/A'); ?></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="profile-info-item">
                                <div class="profile-info-label">Date of Birth</div>
                                <div class="profile-info-value">
                                    <?php echo e($dealer->dob ? \Carbon\Carbon::parse($dealer->dob)->format('F d, Y') : 'N/A'); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="profile-info-item">
                                <div class="profile-info-label">Registered On</div>
                                <div class="profile-info-value">
                                    <?php echo e($dealer->created_at->format('F d, Y')); ?>

                                </div>
                            </div>
                        </div>
                        <?php if($dealer->dealerProfile): ?>
                            <div class="col-md-12">
                                <div class="profile-info-item">
                                    <div class="profile-info-label">Dealer Code</div>
                                    <div class="profile-info-value fw-bold">
                                        <?php echo e($dealer->dealerProfile->dealer_code); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>




        </div>

        <!-- Summary Cards and Orders -->
        <div class="col-md-8">
            <!-- Summary Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="d-flex align-items-center">
                            <div class="icon-container bg-primary-light">
                                <i class="fas fa-shopping-bag text-primary"></i>
                            </div>
                            <div>
                                <h6 class="card-name">Total Orders</h6>
                                <h3 class="mb-0"><?php echo e($totalOrders); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="d-flex align-items-center">
                            <div class="icon-container bg-success-light">
                                <i class="fas fa-dollar-sign text-success"></i>
                            </div>
                            <div>
                                <h6 class="card-name">Total Spent</h6>
                                <h3 class="mb-0">$<?php echo e(number_format($totalCost, 2)); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="d-flex align-items-center">
                            <div class="icon-container bg-info-light">
                                <i class="fas fa-box text-info"></i>
                            </div>
                            <div>
                                <h6 class="card-name">Total Products</h6>
                                <h3 class="mb-0"><?php echo e($totalProducts); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Referrals Section -->
            <?php if(count($referrals) > 0): ?>
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Referrals</h5>
                        <p class="mb-0">People referred by this dealer</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Referred</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e($referral->referred->name ?? 'N/A'); ?></td>
                                            <td><?php echo e($referral->referred->email ?? 'N/A'); ?></td>
                                            <td><?php echo e($referral->created_at->format('Y-m-d')); ?></td>
                                            <td>
                                                <?php if($referral->referred && $referral->referred->role == 'customer'): ?>
                                                    <span class="badge badge-soft-info">Customer</span>
                                                <?php else: ?>
                                                    <span class="badge badge-soft-primary">Dealer</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Orders Section -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($order->order_code); ?></td>
                                        <td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                                        <td>$<?php echo e(number_format($order->total_cost, 2)); ?></td>
                                        <td>
                                            <?php
                                                $statusClass = 'badge-soft-info';
                                                if ($order->status == 'completed') {
                                                    $statusClass = 'badge-soft-success';
                                                }
                                                if ($order->status == 'processing') {
                                                    $statusClass = 'badge-soft-primary';
                                                }
                                                if ($order->status == 'cancelled') {
                                                    $statusClass = 'badge-soft-danger';
                                                }
                                            ?>
                                            <span class="badge <?php echo e($statusClass); ?>">
                                                <?php echo e(ucfirst($order->status)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('order-details', $order->order_code)); ?>"
                                                class="btn btn-sm btn-view">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No orders found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Bank Details Section -->
            <?php if($dealer->bankDetail): ?>
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Bank Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Bank Name:</strong> <?php echo e($dealer->bankDetail->bank_name ?? 'N/A'); ?></p>
                        <p><strong>Branch:</strong> <?php echo e($dealer->bankDetail->bank_branch ?? 'N/A'); ?></p>
                        <p><strong>Account Name:</strong> <?php echo e($dealer->bankDetail->account_name ?? 'N/A'); ?></p>
                        <p><strong>Account Number:</strong> <?php echo e($dealer->bankDetail->account_number ?? 'N/A'); ?></p>
                        <p><strong>Account Type:</strong> <?php echo e($dealer->bankDetail->account_type ?? 'N/A'); ?></p>
                        <p>
                            <strong>Status:</strong>
                            <span
                                class="badge
                        <?php if($dealer->bankDetail->bank_status == 'approved'): ?> badge-soft-success
                        <?php elseif($dealer->bankDetail->bank_status == 'rejected'): ?> badge-soft-danger
                        <?php else: ?> badge-soft-primary <?php endif; ?>">
                                <?php echo e(ucfirst($dealer->bankDetail->bank_status ?? 'pending')); ?>

                            </span>
                        </p>
                        <?php if($dealer->bankDetail->bank_front_image || $dealer->bankDetail->bank_back_image): ?>
                            <div class="d-flex gap-3 mt-3">
                                <?php if($dealer->bankDetail->bank_front_image): ?>
                                    <div>
                                        <p class="mb-1">Front Image</p>
                                        <img src="<?php echo e(asset('storage/' . $dealer->bankDetail->bank_front_image)); ?>"
                                            alt="Front" width="100">
                                    </div>
                                <?php endif; ?>
                                <?php if($dealer->bankDetail->bank_back_image): ?>
                                    <div>
                                        <p class="mb-1">Back Image</p>
                                        <img src="<?php echo e(asset('storage/' . $dealer->bankDetail->bank_back_image)); ?>"
                                            alt="Back" width="100">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Actions -->
                        <?php if($dealer->bankDetail->bank_status !== 'approved'): ?>
                            <form action="<?php echo e(route('admin.bank.approve', $dealer->bankDetail->id)); ?>" method="POST"
                                class="d-inline-block">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Approve this bank detail?')">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if($dealer->bankDetail->bank_status !== 'rejected'): ?>
                            <form action="<?php echo e(route('admin.bank.reject', $dealer->bankDetail->id)); ?>" method="POST"
                                class="d-inline-block ms-2">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Reject this bank detail?')">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <!-- KYC Details Section -->
            <!-- KYC Details -->
<?php if($dealer->kycDetail): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">KYC Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Document Type:</strong> <?php echo e($dealer->kycDetail->kyc_doc_type); ?></p>
            <p><strong>Document Number:</strong> <?php echo e($dealer->kycDetail->kyc_doc_number); ?></p>
            <p><strong>Status:</strong>
                <?php if($dealer->kycDetail->kyc_status === 'approved'): ?>
                    <span class="badge bg-success">Approved</span>
                <?php elseif($dealer->kycDetail->kyc_status === 'pending'): ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                <?php else: ?>
                    <span class="badge bg-danger">Rejected</span>
                <?php endif; ?>
            </p>

            <?php if($dealer->kycDetail->kyc_status === 'rejected' && $dealer->kycDetail->kyc_reject_reason): ?>
                <p><strong>Reject Reason:</strong> <?php echo e($dealer->kycDetail->kyc_reject_reason); ?></p>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Front of Document</label>
                    <img src="<?php echo e(asset('storage/' . $dealer->kycDetail->kyc_doc_front)); ?>" class="img-fluid rounded border" alt="Front Document">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Back of Document</label>
                    <img src="<?php echo e(asset('storage/' . $dealer->kycDetail->kyc_doc_back)); ?>" class="img-fluid rounded border" alt="Back Document">
                </div>
                <div class="col-md-4 mb-3">
                    <label>Selfie with Document</label>
                    <img src="<?php echo e(asset('storage/' . $dealer->kycDetail->selfie)); ?>" class="img-fluid rounded border" alt="Selfie">
                </div>
            </div>

            <!-- Actions -->
            <?php if($dealer->kycDetail->kyc_status !== 'approved'): ?>
                <form action="<?php echo e(route('admin.kyc.approve', $dealer->kycDetail->id)); ?>" method="POST" class="d-inline-block">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve KYC?')">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </form>
            <?php endif; ?>

            <?php if($dealer->kycDetail->kyc_status !== 'rejected'): ?>
                <!-- Trigger reject modal -->
                <button type="button" class="btn btn-danger btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#rejectKycModal">
                    <i class="fas fa-times"></i> Reject
                </button>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

        </div>
    </div>

    <!-- Reject KYC Modal -->
<div class="modal fade" id="rejectKycModal" tabindex="-1" aria-labelledby="rejectKycModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('admin.kyc.reject', $dealer->kycDetail->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectKycModalLabel">Reject KYC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejectReason" class="form-label">Reason for Rejection</label>
                        <textarea name="reason" id="rejectReason" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/dealer-details.blade.php ENDPATH**/ ?>