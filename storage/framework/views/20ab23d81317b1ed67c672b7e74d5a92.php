<?php $__env->startSection('dashboard-content'); ?>
<style>
    :root {
        --primary-color: #ff5800;
        --primary-light: #fff3e6;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --border-color: #e2e8f0;
        --shadow-light: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.12);
        --border-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .referrals-container {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 0;
    }

    .referrals-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #ff6b3d 100%);
        color: white;
        padding: 2rem;
        margin: 40px 0 2rem 0;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-medium);
        position: relative;
        overflow: hidden;
    }

    .referrals-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 1;
    }

    .referrals-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 1;
    }

    .header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        backdrop-filter: blur(10px);
    }

    .header-text h4 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .header-text p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-size: 1rem;
    }

    .referrals-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-light);
        overflow: hidden;
        border: 1px solid var(--border-color);
        transition: var(--transition);
    }

    .referrals-card:hover {
        box-shadow: var(--shadow-medium);
        transform: translateY(-2px);
    }

    .table-container {
        overflow-x: auto;
        border-radius: var(--border-radius);
    }

    .referrals-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
    }

    .referrals-table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, #ff6b3d 100%);
    }

    .referrals-table thead th {
        color: white;
        font-weight: 600;
        padding: 1.25rem 1rem;
        text-align: left;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .referrals-table thead th:first-child {
        border-top-left-radius: var(--border-radius);
    }

    .referrals-table thead th:last-child {
        border-top-right-radius: var(--border-radius);
    }

    .referrals-table tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid #f1f5f9;
    }

    .referrals-table tbody tr:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .referrals-table tbody tr:last-child {
        border-bottom: none;
    }

    .referrals-table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border: none;
        font-size: 0.95rem;
        color: var(--text-primary);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--primary-color), #ff6b3d);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 2px 8px rgba(255, 88, 0, 0.3);
    }

    .user-details h6 {
        margin: 0;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 1rem;
    }

    .user-details small {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    .email-badge {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #1565c0;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid #e3f2fd;
    }

    .time-badge {
        background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
        color: #7b1fa2;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid #f3e5f5;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .btn-modern {
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-approve {
        background: linear-gradient(135deg, var(--success-color) 0%, #34ce57 100%);
        color: white;
    }

    .btn-approve:hover {
        background: linear-gradient(135deg, #218838 0%, var(--success-color) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .btn-reject {
        background: linear-gradient(135deg, var(--danger-color) 0%, #e73c7e 100%);
        color: white;
    }

    .btn-reject:hover {
        background: linear-gradient(135deg, #c82333 0%, var(--danger-color) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        color: white;
    }

    .no-referrals {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-color);
    }

    .no-referrals-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
        font-size: 2rem;
        color: var(--text-secondary);
    }

    .no-referrals h5 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .no-referrals p {
        color: var(--text-secondary);
        margin: 0;
        font-size: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .referrals-header {
            margin: 20px 0 1.5rem 0;
            padding: 1.5rem;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .header-text h4 {
            font-size: 1.5rem;
        }

        .referrals-table thead th,
        .referrals-table tbody td {
            padding: 1rem 0.75rem;
        }

        .user-info {
            flex-direction: column;
            text-align: center;
            gap: 8px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }

        .email-badge,
        .time-badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .referrals-table {
            min-width: 600px;
        }
    }
</style>

<div class="referrals-container">
    <div class="container">
        <!-- Enhanced Header -->
        <div class="referrals-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="header-text">
                    <h4>Pending Referral Approvals</h4>
                    <p>Review and manage referral requests from your network</p>
                </div>
            </div>
        </div>

        <?php if($referrals->isEmpty()): ?>
            <div class="no-referrals">
                <div class="no-referrals-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h5>No Pending Referrals</h5>
                <p>You currently have no pending referral approvals. New referrals will appear here for your review.</p>
            </div>
        <?php else: ?>
            <div class="referrals-card">
                <div class="table-container">
                    <table class="referrals-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>Referred User</th>
                                <th><i class="fas fa-envelope me-2"></i>Contact</th>
                                <th><i class="fas fa-clock me-2"></i>Registration</th>
                                <th><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                <?php echo e(strtoupper(substr($ref->referred->name, 0, 1))); ?>

                                            </div>
                                            <div class="user-details">
                                                <h6><?php echo e($ref->referred->name); ?></h6>
                                                <small>ID: #<?php echo e($ref->referred->id); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="email-badge">
                                            <i class="fas fa-at me-1"></i>
                                            <?php echo e($ref->referred->email); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="time-badge">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?php echo e($ref->referred->created_at->diffForHumans()); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <form method="POST" action="<?php echo e(route('dealer.referrals.approve', $ref->id)); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn-modern btn-approve">
                                                    <i class="fas fa-check"></i>
                                                    Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="<?php echo e(route('dealer.referrals.reject', $ref->id)); ?>" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn-modern btn-reject">
                                                    <i class="fas fa-times"></i>
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/dealer/pending-referrals.blade.php ENDPATH**/ ?>