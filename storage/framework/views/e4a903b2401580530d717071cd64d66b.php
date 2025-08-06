<?php $__env->startSection('dashboard-content'); ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Flash Messages -->
    <div class="flash-messages-container" style="margin-top: 40px;">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session('warning')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i><?php echo e(session('warning')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
    
    <style>
        :root {
            --primary-color: #ff5800;
            --primary-light: #fff5f2;
            --secondary-color: #2d3748;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color), #ff7733);
            color: white;
            padding: 1.5rem 0;
            margin: -25px -25px 1.5rem -25px;
            border-radius: 0 0 12px 12px;
            margin-top: 20px;
        }

        .rank-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            border: 1px solid #e5e7eb;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            margin-bottom: 1rem;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stats-card .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .stats-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .progress-custom {
            height: 8px;
            border-radius: 10px;
            background-color: #e5e7eb;
        }

        .progress-bar-custom {
            background: linear-gradient(90deg, var(--primary-color), #ff7733);
            border-radius: 10px;
        }

        .table-custom {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 1.5rem;
        }

        .table-custom thead {
            background-color: var(--primary-light);
            color: var(--secondary-color);
        }

        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            border: var(--primary-color);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .btn-primary-custom:hover {
            background: #e54d00;
            border-color: #e54d00;
        }

        .referral-link-box {
            background: var(--primary-light);
            border: 2px dashed var(--primary-color);
            border-radius: 12px;
            padding: 1.25rem;
        }

        .commission-breakdown {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 1.5rem;
        }

        .commission-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .commission-item:last-child {
            border-bottom: none;
        }

        .rank-progress-container {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 1.5rem;
        }

        .rank-tier {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            border: 2px solid transparent;
        }

        .rank-tier.active {
            background: var(--primary-light);
            border-color: var(--primary-color);
        }

        .rank-tier.completed {
            background: #f0fdf4;
            border-color: var(--success-color);
        }

        .rank-number {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .withdrawal-section {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 1.5rem;
        }

        .withdrawal-days {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .day-badge {
            padding: 0.5rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .day-badge.available {
            background: #dcfce7;
            color: #166534;
        }

        .day-badge.unavailable {
            background: #fef2f2;
            color: #991b1b;
        }

        .team-hierarchy {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 1.5rem;
        }

        .hierarchy-node {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            border-left: 4px solid var(--primary-color);
            background: #f8f9fa;
        }

        .node-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .col-lg-4 {
            overflow: hidden;
        }

        .team-hierarchy,
        .stats-card,
        .withdrawal-section {
            min-height: auto;
            flex-shrink: 0;
        }


        /* Mobile Responsive Styles */
        @media (max-width: 992px) {
            .dashboard-header {
                margin-left: 0;
                margin-right: 0;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                padding: 1rem 0;
                text-align: center;
            }

            .dashboard-header h2 {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }

            .dashboard-header p {
                font-size: 0.9rem;
            }

            .rank-badge {
                margin-top: 1rem;
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .stats-card {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .stats-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }

            .stats-card h3 {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }

            .stats-card p {
                font-size: 0.875rem;
            }

            /* Rank Progress Mobile */
            .rank-progress-container {
                padding: 1rem;
            }

            .rank-tier {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
                padding: 0.75rem;
                text-align: left;
            }

            .rank-tier>div:first-child {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                width: 100%;
            }

            .rank-number {
                width: 30px;
                height: 30px;
                font-size: 0.75rem;
            }

            /* Commission breakdown mobile */
            .commission-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
                padding: 1rem 0;
            }

            .commission-item .text-end {
                align-self: flex-end;
            }

            /* Table responsive */
            .table-responsive {
                font-size: 0.875rem;
            }

            .table th,
            .table td {
                padding: 0.5rem 0.25rem;
                white-space: nowrap;
            }

            .table th:first-child,
            .table td:first-child {
                padding-left: 0.75rem;
            }

            .table th:last-child,
            .table td:last-child {
                padding-right: 0.75rem;
            }

            /* Referral link mobile */
            .referral-link-box {
                padding: 1rem;
            }

            .referral-link-box .d-flex {
                flex-direction: column;
                gap: 0.75rem;
            }

            .referral-link-box code {
                font-size: 0.75rem;
                word-break: break-all;
            }

            /* Withdrawal section mobile */
            .withdrawal-section h4 {
                font-size: 1.75rem;
            }

            .day-badge {
                font-size: 0.75rem;
                padding: 0.4rem 0.75rem;
            }

            /* Team hierarchy mobile */
            .hierarchy-node {
                gap: 0.75rem;
                padding: 0.625rem;
            }

            .hierarchy-node[style*="margin-left"] {
                margin-left: 1rem !important;
            }

            .node-avatar {
                width: 30px;
                height: 30px;
                font-size: 0.75rem;
            }

            /* Quick actions mobile */
            .d-grid {
                gap: 0.75rem !important;
            }

            .btn-sm {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .dashboard-header {
                margin-left: 0;
                margin-right: 0;
            }

            .dashboard-header .container-fluid {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .dashboard-header {
                margin-bottom: 1rem;


            }

            .dashboard-header .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .dashboard-header h2 {
                font-size: 1.25rem;
            }

            .dashboard-header p {
                font-size: 0.825rem;
            }

            .stats-card {
                padding: 0.875rem;
            }

            .stats-card h3 {
                font-size: 1.375rem;
            }

            .rank-progress-container,
            .commission-breakdown,
            .withdrawal-section,
            .team-hierarchy {
                padding: 0.875rem;
            }

            .rank-progress-container h4 {
                font-size: 1.125rem;
                margin-bottom: 1rem;
            }

            .commission-breakdown h5,
            .team-hierarchy h5 {
                font-size: 1.125rem;
            }

            .referral-link-box {
                padding: 0.875rem;
            }

            .table-custom .p-3 {
                padding: 0.875rem !important;
            }

            .table th,
            .table td {
                padding: 0.5rem 0.125rem;
                font-size: 0.8rem;
            }

            .table th:first-child,
            .table td:first-child {
                padding-left: 0.5rem;
            }

            .table th:last-child,
            .table td:last-child {
                padding-right: 0.5rem;
            }

            /* Hide less critical columns on very small screens */
            .table th:nth-child(5),
            .table td:nth-child(5) {
                display: none;
            }

            .node-avatar {
                width: 28px;
                height: 28px;
                font-size: 0.7rem;
            }

            .hierarchy-node {
                padding: 0.5rem;
                gap: 0.625rem;
            }

            .rank-tier {
                padding: 0.625rem;
            }

            .commission-item {
                padding: 0.875rem 0;
            }

            .withdrawal-days {
                gap: 0.375rem;
            }

            .day-badge {
                font-size: 0.7rem;
                padding: 0.375rem 0.625rem;
            }
        }

        /* Landscape phone adjustments */
        @media (max-width: 896px) and (orientation: landscape) {
            .dashboard-header {
                padding: 0.75rem 0;
            }

            .stats-card {
                padding: 0.875rem;
            }

            .rank-progress-container,
            .commission-breakdown,
            .withdrawal-section,
            .team-hierarchy {
                padding: 1rem;
            }
        }

        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                min-height: 44px;
            }

            .stats-card:hover {
                transform: none;
            }

            .table-custom tbody tr:hover {
                background-color: inherit;
            }
        }

        /* Print styles */
        @media print {
            .dashboard-header {
                background: white !important;
                color: black !important;
            }

            .stats-card,
            .commission-breakdown,
            .rank-progress-container {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .btn {
                display: none !important;
            }
        }

        /* Quick Action Buttons Custom Styles */
        .quick-action-btn {
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            opacity: 1; /* Always show full opacity */
        }

        .quick-action-btn:hover {
            opacity: 1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .quick-action-btn.btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3) !important;
            color: white !important;
            border-color: #007bff !important;
        }

        .quick-action-btn.btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085) !important;
            border-color: #004085 !important;
        }

        .quick-action-btn.btn-info {
            background: linear-gradient(135deg, #17a2b8, #138496) !important;
            color: white !important;
            border-color: #17a2b8 !important;
        }

        .quick-action-btn.btn-info:hover {
            background: linear-gradient(135deg, #138496, #0f6674) !important;
            border-color: #0f6674 !important;
        }

        .quick-action-btn.btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800) !important;
            color: #212529 !important;
            border-color: #ffc107 !important;
        }

        .quick-action-btn.btn-warning:hover {
            background: linear-gradient(135deg, #e0a800, #c69500) !important;
            border-color: #c69500 !important;
        }

        .quick-action-btn.btn-success {
            background: linear-gradient(135deg, #28a745, #1e7e34) !important;
            color: white !important;
            border-color: #28a745 !important;
        }

        .quick-action-btn.btn-success:hover {
            background: linear-gradient(135deg, #1e7e34, #155724) !important;
            border-color: #155724 !important;
        }

        .quick-action-btn i {
            opacity: 1; /* Always show full opacity */
        }

        .quick-action-btn:hover i {
            opacity: 1;
        }

        /* Quick Actions Mobile Responsive */
        @media (max-width: 768px) {
            .quick-action-btn {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                min-height: 48px;
            }

            .quick-action-btn i {
                font-size: 1rem;
            }

            .d-grid {
                gap: 0.75rem !important;
            }

            .stats-card h6 {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .quick-action-btn {
                padding: 0.875rem 1rem;
                font-size: 0.85rem;
                min-height: 52px;
            }

            .quick-action-btn i {
                font-size: 0.95rem;
            }

            .d-grid {
                gap: 0.875rem !important;
            }
        }

        /* Ensure proper touch targets */
        @media (hover: none) and (pointer: coarse) {
            .quick-action-btn {
                min-height: 44px;
                padding: 0.75rem 1rem;
            }
        }

        /* View Full Hierarchy Button Styles */
        .view-hierarchy-btn {
            background: var(--primary-color) !important;
            color: white !important;
            border: 2px solid var(--primary-color) !important;
            font-weight: 500 !important;
            padding: 0.6rem 1.25rem !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            font-size: 0.9rem !important;
            box-shadow: 0 2px 4px rgba(255, 88, 0, 0.2) !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .view-hierarchy-btn:hover {
            background: #e54d00 !important;
            border-color: #e54d00 !important;
            color: white !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(255, 88, 0, 0.3) !important;
        }

        .view-hierarchy-btn:focus {
            background: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 88, 0, 0.25) !important;
        }

        .view-hierarchy-btn:active {
            background: #d44400 !important;
            border-color: #d44400 !important;
            transform: translateY(0) !important;
        }

        .view-hierarchy-btn i {
            font-size: 0.85rem !important;
        }

        /* Mobile responsive for hierarchy button */
        @media (max-width: 768px) {
            .view-hierarchy-btn {
                font-size: 0.85rem !important;
                padding: 0.5rem 1rem !important;
            }
        }

        /* Profile Image Styles */
        .profile-image-dashboard {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .profile-placeholder-dashboard {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff5800, #ff7a3d);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            border: 3px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .profile-image-dashboard,
            .profile-placeholder-dashboard {
                width: 50px;
                height: 50px;
            }

            .profile-placeholder-dashboard {
                font-size: 20px;
            }
        }
    </style>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-1 col-2 text-center">
                    <!-- Profile Image -->
                    <div class="profile-image-container">
                        <?php if($dealerProfile->user->profile_image): ?>
                            <img src="<?php echo e($dealerProfile->user->profile_image_url); ?>"
                                 alt="Profile Image"
                                 class="profile-image-dashboard">
                        <?php else: ?>
                            <div class="profile-placeholder-dashboard">
                                <?php echo e(substr($dealerProfile->user->name, 0, 1)); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-7 col-10">
                    <h2 class="mb-2">Welcome back, <?php echo e($dealerProfile->user->name); ?>!</h2>
                    <p class="mb-0 opacity-75">Manage your dealer network and track your commissions</p>
                </div>
                <div class="col-md-4 col-12 text-md-end text-center">
                    <div class="rank-badge">
                        <i class="fas fa-crown"></i>
                        <span><?php echo e($dealerProfile->rank); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-3 mb-md-4">
        <div class="col-6 col-lg-3 mb-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--info-color);">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="h4 mb-1"><?php echo e($teamCount); ?></h3>
                <p class="text-muted mb-0">Total Team Members</p>
            </div>
        </div>
        <div class="col-6 col-lg-3 mb-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--success-color);">
                    <i class="fas fa-coins"></i>
                </div>
                <h3 class="h4 mb-1"><?php echo e($dealerProfile->bv); ?></h3>
                <p class="text-muted mb-0">Current IV</p>
            </div>
        </div>
        <div class="col-6 col-lg-3 mb-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning-color);">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="h4 mb-1"><?php echo e($dealerProfile->cbv); ?></h3>
                <p class="text-muted mb-0">Total CIV</p>
            </div>
        </div>
        <div class="col-6 col-lg-3 mb-3">
            <div class="stats-card">
                <div class="stats-icon" style="background: rgba(255, 88, 0, 0.1); color: var(--primary-color);">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="h4 mb-1">₹<?php echo e(number_format($weeklyEarnings, 2)); ?></h3>
                <p class="text-muted mb-0">Weekly Earnings</p>
            </div>
        </div>
    </div>

        <div class="rank-progress-container">
            <h4 class="mb-3"><i class="fas fa-trophy text-warning me-2"></i>Rank Progress</h4>
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2 flex-wrap">
                            <span class="mb-1 mb-sm-0">
                                Progress to <?php echo e($nextRankData['name'] ?? 'N/A'); ?>

                            </span>
                            <span class="fw-bold"><?php echo e($currentCBV); ?> / <?php echo e($nextRankData['target_cbv'] ?? '-'); ?> CBV</span>
                        </div>
                        <div class="progress">
    <div class="progress-bar" role="progressbar" style="width: <?php echo e($progressPercent); ?>%;" aria-valuenow="<?php echo e($progressPercent); ?>" aria-valuemin="0" aria-valuemax="100">
        <?php echo e(number_format($progressPercent, 2)); ?>%
    </div>
</div>

                    </div>

                    <?php if($nextRankData && count($nextRankData['methods']) > 0): ?>
                        <div class="mt-4">
                            <h6>Next Rank Requirements (<?php echo e($nextRankData['name']); ?>):</h6>
                            <div class="row">
                                <?php $__currentLoopData = $nextRankData['methods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $metCBV = $currentCBV >= $method['cbv'];
                                        $metLinks = $linkCount >= ($method['links'] ?? 0);
                                        $metAssistants = $marketingAssistants >= ($method['assistants'] ?? 0);

                                        $isComplete = $metCBV && $metLinks && $metAssistants;
                                        $isActive = !$isComplete && ($metCBV || $metLinks || $metAssistants);
                                    ?>
                                    <div class="col-md-4 col-12 d-flex">
                                        <div class="rank-tier <?php echo e($isComplete ? 'completed' : ($isActive ? 'active' : '')); ?> flex-fill">
                                            <div>
                                                <div class="rank-number" style="background: <?php echo e($isComplete ? 'var(--success-color)' : ($isActive ? 'var(--primary-color)' : '#6b7280')); ?>;">
                                                    <?php echo e($isComplete ? '✓' : $index + 1); ?>

                                                </div>
                                                <div>
                                                    <div class="fw-bold">Method <?php echo e($index + 1); ?></div>
                                                    <small class="text-muted">
                                                        <?php echo e($method['cbv']); ?> CBV
                                                        <?php echo e($method['links'] ? '+ ' . $method['links'] . ' Links' : ''); ?>

                                                        <?php echo e($method['assistants'] ? '+ ' . $method['assistants'] . ' MA' : ''); ?>

                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 col-12">
                    <div class="text-center mt-3 mt-md-0">
                        <div class="rank-badge mb-3" style="font-size: 1.1rem; padding: 1rem 2rem;">
                            <i class="fas fa-medal me-2"></i>
                            <?php echo e($dealerProfile->rank); ?>

                        </div>
                        <p class="text-muted">Current Dealership Tier</p>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <span class="badge bg-warning text-dark"><?php echo e(ucfirst($dealerProfile->tier)); ?> Dealer</span>
                            <span class="badge bg-info"><?php echo e($dealerProfile->bv); ?> BV</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 col-12">
                <!-- Referral Management -->
                <div class="commission-breakdown">
                    <h5 class="mb-3"><i class="fas fa-share-alt text-primary me-2"></i>Referral Management</h5>
                    <div class="referral-link-box">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="mb-0">Your Referral Link</h6>
                            <button class="btn btn-primary-custom btn-sm" onclick="copyReferralLink()">
                                <i class="fas fa-copy me-1"></i>Copy Link
                            </button>
                        </div>
                        <div class="bg-white p-3 rounded border">
                            <?php
                            $referralLink = url('/become-a-dealer') . '?ref=' . ($dealerProfile->dealer_code ?? '');
                        ?>
                            <code id="referralLink"
                                style="word-break: break-all;"><?php echo e($referralLink); ?></code>
                        </div>
                        <small class="text-muted mt-2 d-block">
                            Share this link to earn 20% commission on direct referrals
                        </small>
                    </div>
                </div>

                <!-- Commission Breakdown -->
                <div class="commission-breakdown">
                    <h5 class="mb-3"><i class="fas fa-calculator text-success me-2"></i>Commission Breakdown</h5>

                    <div class="commission-item">
                        <div>
                            <strong>Direct Commission (20%)</strong>
                            <br><small class="text-muted">From direct referral purchases</small>
                        </div>
                        <div class="text-end">
                            <strong class="text-success">₹<?php echo e(number_format($commissionBreakdown['direct'], 2)); ?></strong>
                        </div>
                    </div>

                    <div class="commission-item">
                        <div>
                            <strong>Layer 1 Commission (5%)</strong>
                            <br><small class="text-muted">From level 1 sub-dealers</small>
                        </div>
                        <div class="text-end">
                            <strong class="text-success">₹<?php echo e(number_format($commissionBreakdown['layer1'], 2)); ?></strong>
                        </div>
                    </div>

                    <div class="commission-item">
                        <div>
                            <strong>Layer 2 Commission (3%)</strong>
                            <br><small class="text-muted">From level 2 sub-dealers</small>
                        </div>
                        <div class="text-end">
                            <strong class="text-success">₹<?php echo e(number_format($commissionBreakdown['layer2'], 2)); ?></strong>
                        </div>
                    </div>

                    <div class="commission-item">
                        <div>
                            <strong>Weekly Team Commission (4%)</strong>
                            <br><small class="text-muted">Based on team BV</small>
                        </div>
                        <div class="text-end">
                            <strong class="text-success">₹<?php echo e(number_format($commissionBreakdown['team'], 2)); ?></strong>
                        </div>
                    </div>

                    <div class="commission-item bg-light">
                        <div>
                            <strong>Total Weekly Earnings</strong>
                        </div>
                        <div class="text-end">
                            <strong class="text-primary fs-5">₹<?php echo e(number_format($totalWeeklyEarnings, 2)); ?></strong>
                        </div>
                    </div>
                </div>


                <!-- Recent Team Activity -->
                <div class="table-custom">
                    <div class="p-3 border-bottom">
                        <h5 class="mb-0"><i class="fas fa-activity text-info me-2"></i>Recent Team Activity</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Action</th>
                                    <th>Amount</th>
                                    <th>Commission</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="node-avatar me-2" style="width: 25px; height: 25px; font-size: 0.7rem;">
                                                    <?php echo e($activity['initials']); ?>

                                                </div>
                                                <span class="d-none d-sm-inline"><?php echo e($activity['name']); ?></span>
                                                <span class="d-sm-none"><?php echo e(substr($activity['name'], 0, 1)); ?>. <?php echo e(Str::after($activity['name'], ' ')); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($activity['type'] === 'purchase'): ?>
                                                <span class="badge bg-success">Purchase</span>
                                            <?php else: ?>
                                                <span class="badge bg-primary">Joined</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($activity['amount']): ?>
                                                ₹<?php echo e(number_format($activity['amount'], 2)); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-success">
                                            <?php if($activity['commission']): ?>
                                                +₹<?php echo e(number_format($activity['commission'], 2)); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($activity['date']->diffForHumans()); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="5" class="text-center text-muted">No recent activity.</td></tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4 d-flex flex-column gap-4">
                <!-- Withdrawal Section -->
                <div class="withdrawal-section">
                    <h5 class="mb-3"><i class="fas fa-money-bill-wave text-success me-2"></i>Withdrawals</h5>

                    <div class="text-center mb-3">
                        <h4 class="text-success">₹<?php echo e(number_format($availableWithdrawalLKR, 2)); ?></h4>
                        <small class="text-muted">Available for withdrawal</small>
                    </div>

                    <div class="withdrawal-days">
                        <?php $__currentLoopData = ['Thu', 'Fri', 'Sat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="day-badge <?php echo e(Carbon\Carbon::now()->format('D') === $day ? 'today' : 'available'); ?>"><?php echo e($day); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="day-badge unavailable">Other Days</div>
                    </div>

                    <form method="POST" action="<?php echo e(route('dealer.withdraw.request')); ?>" id="withdrawalForm" onsubmit="handleWithdrawalSubmit(event)">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success w-100 mb-2" <?php echo e(!$isWithdrawalDay ? 'disabled' : ''); ?> id="withdrawalBtn">
                            <i class="fas fa-download me-2"></i>Request Withdrawal
                        </button>
                    </form>

                    <small class="text-muted d-block text-center">
                        <?php if($isWithdrawalDay): ?>
                            Withdrawals allowed today
                        <?php elseif($nextWithdrawalDayFormatted): ?>
                            Next withdrawal window: <?php echo e($nextWithdrawalDayFormatted); ?>

                        <?php else: ?>
                            Withdrawals not available this week
                        <?php endif; ?>
                    </small>
                </div>


                <!-- Team Hierarchy -->

<!-- Team Hierarchy -->
<div class="team-hierarchy flex-grow-1">
    <h5 class="mb-3"><i class="fas fa-sitemap text-primary me-2"></i>Team Overview</h5>
    <div class="hierarchy-node">
        <div class="node-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?></div>
        <div>
            <div class="fw-bold">You</div>
            <small class="text-muted"><?php echo e(auth()->user()->dealerProfile->rank ?? '-'); ?></small>
        </div>
    </div>

    <div style="margin-left: 1.5rem;">
        <?php $__empty_1 = true; $__currentLoopData = $directReferrals->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="hierarchy-node">
                <div class="node-avatar"><?php echo e(strtoupper(substr($referral->name, 0, 2))); ?></div>
                <div>
                    <div class="fw-bold"><?php echo e($referral->name); ?></div>
                    <small class="text-muted"><?php echo e($referral->dealerProfile->rank ?? 'N/A'); ?></small>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted ms-3">No team members yet.</p>
        <?php endif; ?>

        <?php if($directReferrals->count() > 3): ?>
            <div class="text-center mt-2">
                <small class="text-muted">+<?php echo e($directReferrals->count() - 3); ?> more members</small>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-3">
        <a href="<?php echo e(route('dealer.team.full')); ?>" class="view-hierarchy-btn" style="display: inline-flex !important; visibility: visible !important; opacity: 1 !important;">
            <i class="fas fa-eye me-1"></i>View Full Hierarchy
        </a>
    </div>
</div>

                <!-- Quick Actions -->
                <div class="stats-card">
                    <h6 class="mb-3"><i class="fas fa-bolt text-warning me-2"></i>Quick Actions</h6>
                    <div class="d-grid gap-3">
                        <a href="<?php echo e(route('dealer.referrals.pending')); ?>" class="btn btn-primary btn-sm w-100 quick-action-btn">
                            <i class="fas fa-user-plus me-2"></i>
                            Approve New Members (<?php echo e($pendingReferralsCount); ?>)
                        </a>
                        <a href="<?php echo e(route('dealer.analytics')); ?>" class="btn btn-info btn-sm w-100 quick-action-btn">
                            <i class="fas fa-chart-bar me-2"></i>
                            View Analytics
                        </a>
                        <a href="<?php echo e(route('dealer.notifications')); ?>" class="btn btn-warning btn-sm w-100 quick-action-btn">
                            <i class="fas fa-bell me-2"></i>
                            Notifications (<?php echo e($notificationCount); ?>)
                        </a>
                        <a href="<?php echo e(route('dealer.products.dashboard')); ?>" class="btn btn-success btn-sm w-100 quick-action-btn">
                            <i class="fas fa-box me-2"></i>
                            Dealer's Products
                        </a>
                        <a href="<?php echo e(route('dealer.customer.orders')); ?>" class="btn btn-purple btn-sm w-100 quick-action-btn">
                            <i class="fas fa-shopping-bag me-2"></i>
                            Dealer's Orders
                        </a>
                    </div>
                    <style>
                        .btn-purple {
                            background-color: #6f42c1;
                            border-color: #6f42c1;
                            color: #fff;
                        }
                        .btn-purple:hover {
                            background-color: #5a32a3;
                            border-color: #5a32a3;
                            color: #fff;
                        }
                    </style>
                </div>


            </div>
        </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyReferralLink() {
            const linkText = document.getElementById('referralLink').textContent;
            navigator.clipboard.writeText(linkText).then(function() {
                // Show success message
                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-primary-custom');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-primary-custom');
                }, 2000);
            }).catch(function() {
                // Fallback for browsers that don't support clipboard API
                const textArea = document.createElement('textarea');
                textArea.value = linkText;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                const btn = event.target.closest('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
                btn.classList.add('btn-success');
                btn.classList.remove('btn-primary-custom');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-primary-custom');
                }, 2000);
            });
        }

        // Simulate real-time updates
        function updateStats() {
            // This would typically fetch from your API
            console.log('Updating stats...');
        }

        // Update stats every 30 seconds
        setInterval(updateStats, 30000);

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bars on load
            setTimeout(() => {
                const progressBars = document.querySelectorAll('.progress-bar-custom');
                progressBars.forEach(bar => {
                    bar.style.transition = 'width 1s ease-in-out';
                });
            }, 500);

            // Add touch feedback for mobile
            if ('ontouchstart' in window) {
                const cards = document.querySelectorAll('.stats-card');
                cards.forEach(card => {
                    card.addEventListener('touchstart', function() {
                        this.style.transform = 'scale(0.98)';
                    });
                    card.addEventListener('touchend', function() {
                        this.style.transform = '';
                    });
                });
            }

            // Improve table scrolling on mobile
            const tableContainer = document.querySelector('.table-responsive');
            if (tableContainer && window.innerWidth <= 768) {
                tableContainer.addEventListener('scroll', function() {
                    if (this.scrollLeft > 0) {
                        this.classList.add('scrolled');
                    } else {
                        this.classList.remove('scrolled');
                    }
                });
            }
        });

        // Handle orientation changes
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                // Recalculate layout if needed
                window.dispatchEvent(new Event('resize'));
            }, 100);
        });

        // Optimize for performance on low-end devices
        if (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 2) {
            // Disable animations on low-end devices
            const style = document.createElement('style');
            style.textContent = `
                *, *::before, *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                    scroll-behavior: auto !important;
                }
            `;
            document.head.appendChild(style);
        }

        // Withdrawal form debugging
        function handleWithdrawalSubmit(event) {
            console.log('Withdrawal form submitted!');
            const form = event.target;
            const action = form.action;
            console.log('Form action:', action);
            
            // Show loading state
            const btn = document.getElementById('withdrawalBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            btn.disabled = true;
            
            // Let the form submit normally
            return true;
        }

        // Check if withdrawal button is enabled/disabled on page load
        document.addEventListener('DOMContentLoaded', function() {
            const withdrawalBtn = document.getElementById('withdrawalBtn');
            if (withdrawalBtn) {
                console.log('Withdrawal button status:', {
                    disabled: withdrawalBtn.disabled,
                    today: '<?php echo e(Carbon\Carbon::now()->format('D')); ?>',
                    isWithdrawalDay: <?php echo e($isWithdrawalDay ? 'true' : 'false'); ?>

                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/dashboard.blade.php ENDPATH**/ ?>