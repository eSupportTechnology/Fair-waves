<?php $__env->startSection('dashboard-content'); ?>
<div class="container py-4">
    <br>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 d-flex align-items-center">
                <i class="fas fa-bell text-warning me-2"></i> Your Notifications
            </h4>
            <?php $unreadCount = $notifications->where('is_read', false)->count(); ?>
            <?php if($unreadCount > 0): ?>
                <span class="badge bg-danger ms-3 notification-badge"><?php echo e($unreadCount); ?></span>
            <?php endif; ?>
        </div>


    </div>

    <div class="notifications-wrapper">
        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="notification-card <?php echo e($note->is_read ? 'notification-read' : 'notification-unread'); ?>"
                 data-notification-id="<?php echo e($note->id); ?>">
                <div class="notification-indicator"></div>

                <div class="notification-content">
                    <div class="notification-header">
                        <div class="notification-type-wrapper">
                            <i class="notification-icon <?php echo e(getNotificationTypeIcon($note->type)); ?>"></i>
                            <span class="notification-type"><?php echo e(ucwords(str_replace('_', ' ', $note->type))); ?></span>
                            <?php if (! ($note->is_read)): ?>
                                <span class="new-badge">NEW</span>
                            <?php endif; ?>
                        </div>
                        <div class="notification-actions">
                            <?php if (! ($note->is_read)): ?>
                                <form action="<?php echo e(route('dealer.notifications.markAsRead', $note->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-success mark-read-btn">
                                        <i class="fas fa-check me-1"></i>Mark as Read
                                    </button>
                                </form>
                            <?php endif; ?>


                        </div>
                    </div>

                    <div class="notification-message">
                        <?php echo e($note->message); ?>

                    </div>

                    <div class="notification-footer">
                        <small class="badge bg-light text-dark ms-2">
                            <i class="fas fa-clock me-1"></i>
                            <?php echo e($note->created_at->diffForHumans()); ?>

                        </small>
                        <?php if($note->created_at->isToday()): ?>
                            <small class="badge bg-light text-dark ms-2">Today</small>
                        <?php elseif($note->created_at->isYesterday()): ?>
                            <small class="badge bg-light text-dark ms-2">Yesterday</small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-notifications">
                <div class="empty-icon">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <h5 class="empty-title">No Notifications Yet</h5>
                <p class="empty-description">You're all caught up! New notifications will appear here when they arrive.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if($notifications->hasPages()): ?>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($notifications->links()); ?>

        </div>
    <?php endif; ?>
</div>

<style>
.notification-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    animation: pulse-badge 2s infinite;
}

@keyframes pulse-badge {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.notifications-wrapper {
    max-width: 100%;
    color: #ee4b00;
}

.notification-card {
    background: #ffffff;
    border-radius: 12px;
    margin-bottom: 20px;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.notification-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    transform: translateY(-3px);
}

.notification-unread {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
    border-left: 5px solid #007bff;
}

.notification-read {
    background: #f8f9fa;
    border-left: 5px solid #dee2e6;
}

.notification-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: transparent;
}

.notification-unread .notification-indicator {
    background: linear-gradient(90deg, #007bff, #0056b3);
}

.notification-content {
    padding: 24px;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.notification-type-wrapper {
    display: flex;
    align-items: center;
    flex: 1;
}

.notification-icon {
    font-size: 1.2rem;
    margin-right: 12px;
    width: 20px;
    text-align: center;
}

.notification-icon.fa-info-circle { color: #17a2b8; }
.notification-icon.fa-exclamation-triangle { color: #ffc107; }
.notification-icon.fa-check-circle { color: #28a745; }
.notification-icon.fa-times-circle { color: #dc3545; }
.notification-icon.fa-user { color: #6f42c1; }
.notification-icon.fa-cog { color: #6c757d; }
.notification-icon.fa-envelope { color: #fd7e14; }
.notification-icon.fa-shopping-cart { color: #20c997; }

.notification-type {
    font-weight: 600;
    color: #ffffff;
    font-size: 1rem;
    margin-right: 12px;
}

.new-badge {
    background: #dc3545;
    color: white;
    font-size: 0.7rem;
    padding: 2px 8px;
    border-radius: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    animation: glow-red 2s ease-in-out infinite alternate;
}

@keyframes glow-red {
    from { box-shadow: 0 0 5px #dc3545; }
    to { box-shadow: 0 0 10px #dc3545, 0 0 15px #dc3545; }
}

.notification-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.mark-read-btn {
    font-size: 0.85rem;
    padding: 6px 12px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.mark-read-btn:hover {
    transform: translateY(-1px);
}

.notification-menu-btn {
    border: none;
    background: transparent;
    color: #6c757d;
    padding: 6px 10px;
}

.notification-menu-btn:hover {
    background: #f8f9fa;
    color: #495057;
}

.notification-message {
    color: #212529;
    line-height: 1.6;
    margin-bottom: 16px;
    font-size: 0.95rem;
}

.notification-footer {
    display: flex;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid #f1f3f4;
}

.empty-notifications {
    text-align: center;
    padding: 80px 40px;
    color: #6c757d;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 24px;
    opacity: 0.4;
}

.empty-title {
    color: #495057;
    font-weight: 600;
    margin-bottom: 12px;
    font-size: 1.5rem;
}

.empty-description {
    font-size: 1rem;
    margin: 0;
    max-width: 400px;
    margin: 0 auto;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .notification-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .notification-actions {
        align-self: flex-end;
        width: 100%;
        justify-content: flex-end;
    }

    .notification-type-wrapper {
        width: 100%;
    }

    .notification-content {
        padding: 20px 16px;
    }

    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .notification-card {
        background: #2d3748;
        border-color: #4a5568;
        color: #e2e8f0;
    }

    .notification-unread {
        background: linear-gradient(135deg, #2d3748 0%, #3a4556 100%);
    }

    .notification-read {
        background: #1a202c;
    }

    .notification-message {
        color: #e2e8f0;
    }

    .empty-notifications {
        color: #a0aec0;
    }
}
</style>

<?php
function getNotificationTypeIcon($type) {
    $icons = [
        'info' => 'fas fa-info-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'success' => 'fas fa-check-circle',
        'error' => 'fas fa-times-circle',
        'user' => 'fas fa-user',
        'system' => 'fas fa-cog',
        'message' => 'fas fa-envelope',
        'order' => 'fas fa-shopping-cart',
        'payment' => 'fas fa-credit-card',
        'reminder' => 'fas fa-clock',
        'update' => 'fas fa-sync-alt'
    ];

    return $icons[$type] ?? 'fas fa-bell';
}
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/notifications.blade.php ENDPATH**/ ?>