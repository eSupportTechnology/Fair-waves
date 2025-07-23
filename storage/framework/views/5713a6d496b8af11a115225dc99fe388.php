
<div class="genealogy-tree-node <?php echo e($isRoot ? 'root-node' : 'child-node'); ?>" data-level="<?php echo e($node['depth'] ?? 0); ?>">
    <div class="node-container">
        
        <?php if(!$isRoot): ?>
            <div class="connection-line parent-line"></div>
        <?php endif; ?>
        
        
        <div class="dealer-card <?php echo e($isRoot ? 'current-dealer' : 'team-member'); ?> level-<?php echo e(min($node['depth'] ?? 0, 4)); ?>">
            
            <?php if(!$isRoot): ?>
                <div class="level-badge">Level <?php echo e($node['depth']); ?></div>
            <?php endif; ?>
            
            
            <div class="dealer-avatar">
                <div class="avatar-circle">
                    <?php echo e(strtoupper(substr($node['user']->name, 0, 2))); ?>

                </div>
                <?php if($isRoot): ?>
                    <div class="crown-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            
            <div class="dealer-info">
                <h6 class="dealer-name">
                    <?php if($isRoot): ?>
                        <?php echo e($node['user']->name); ?> <span class="you-badge">(You)</span>
                    <?php else: ?>
                        <?php echo e($node['user']->name); ?>

                    <?php endif; ?>
                </h6>
                
                <div class="dealer-rank">
                    <i class="fas fa-medal"></i>
                    <?php echo e($node['user']->dealerProfile->rank ?? 'Beginner'); ?>

                </div>
                
                <div class="dealer-code">
                    Code: <?php echo e($node['user']->dealerProfile->dealer_code ?? 'N/A'); ?>

                </div>
            </div>
            
            
            <?php if($node['user']->dealerProfile): ?>
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-value">
                            <?php if($node['user']->directReferrals): ?>
                                <?php echo e($node['user']->directReferrals->count()); ?>

                            <?php else: ?>
                                0
                            <?php endif; ?>
                        </div>
                        <div class="stat-label">Direct</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value"><?php echo e(count($node['children'] ?? [])); ?></div>
                        <div class="stat-label">Team</div>
                    </div>
                </div>
            <?php endif; ?>
            
            
            <div class="join-date">
                <i class="fas fa-calendar-alt"></i>
                Joined: <?php echo e($node['user']->created_at->format('M Y')); ?>

            </div>
        </div>
    </div>
    
    
    <?php if(!empty($node['children']) && count($node['children']) > 0): ?>
        <div class="children-container">
            
            <div class="vertical-connector"></div>
            
            
            <?php if(count($node['children']) > 1): ?>
                <div class="horizontal-connector"></div>
            <?php endif; ?>
            
            
            <div class="children-tree-grid">
                <?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="child-tree-wrapper">
                        
                        <div class="child-connector"></div>
                        
                        
                        <?php echo $__env->make('frontend.dealer.partials.enhanced-tree-node', ['node' => $child, 'isRoot' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php else: ?>
        <?php if($isRoot): ?>
            <div class="no-team-message">
                <div class="empty-state">
                    <i class="fas fa-users-slash text-muted"></i>
                    <p class="text-muted mb-0">No team members yet</p>
                    <small class="text-muted">Share your referral link to build your team!</small>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<style>
    .genealogy-tree-node {
        position: relative;
        margin: 1rem 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .node-container {
        position: relative;
        display: flex;
        justify-content: center;
        z-index: 2;
    }
    
    .dealer-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border: 3px solid #e9ecef;
        position: relative;
        min-width: 280px;
        max-width: 320px;
        text-align: center;
        transition: all 0.3s ease;
        margin: 0 0.5rem;
    }
    
    .dealer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .dealer-card.current-dealer {
        background: linear-gradient(135deg, #ff5800, #ff6b3d);
        color: white;
        border-color: #ff5800;
        box-shadow: 0 6px 25px rgba(255, 88, 0, 0.3);
    }
    
    .dealer-card.level-1 {
        border-color: #28a745;
        background: linear-gradient(135deg, #ffffff, #f8fff9);
    }
    
    .dealer-card.level-2 {
        border-color: #17a2b8;
        background: linear-gradient(135deg, #ffffff, #f8fdff);
    }
    
    .dealer-card.level-3 {
        border-color: #ffc107;
        background: linear-gradient(135deg, #ffffff, #fffdf8);
    }
    
    .dealer-card.level-4 {
        border-color: #dc3545;
        background: linear-gradient(135deg, #ffffff, #fff8f8);
    }
    
    .level-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #28a745;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    .dealer-card.level-2 .level-badge {
        background: #17a2b8;
    }
    
    .dealer-card.level-3 .level-badge {
        background: #ffc107;
        color: #333;
    }
    
    .dealer-card.level-4 .level-badge {
        background: #dc3545;
    }
    
    .dealer-avatar {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .avatar-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #ff5800;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 auto;
        border: 4px solid white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .dealer-card.current-dealer .avatar-circle {
        background: rgba(255,255,255,0.2);
        border-color: white;
    }
    
    .crown-icon {
        position: absolute;
        top: -8px;
        right: calc(50% - 35px + 50px);
        color: #ffd700;
        font-size: 1.2rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .dealer-name {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: inherit;
    }
    
    .you-badge {
        background: rgba(255,255,255,0.2);
        padding: 0.15rem 0.5rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 500;
    }
    
    .dealer-card:not(.current-dealer) .you-badge {
        background: #ff5800;
        color: white;
    }
    
    .dealer-rank {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: rgba(0,0,0,0.05);
        padding: 0.5rem;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    
    .dealer-card.current-dealer .dealer-rank {
        background: rgba(255,255,255,0.15);
    }
    
    .dealer-code {
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 1rem;
        font-family: monospace;
        background: rgba(0,0,0,0.05);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
    }
    
    .dealer-card.current-dealer .dealer-code {
        background: rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.9);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .stat-box {
        background: rgba(0,0,0,0.05);
        padding: 0.5rem;
        border-radius: 8px;
        text-align: center;
    }
    
    .dealer-card.current-dealer .stat-box {
        background: rgba(255,255,255,0.15);
    }
    
    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ff5800;
    }
    
    .dealer-card.current-dealer .stat-value {
        color: white;
    }
    
    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.8;
    }
    
    .join-date {
        font-size: 0.75rem;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .dealer-card.current-dealer .join-date {
        color: rgba(255,255,255,0.9);
    }
    
    /* Tree Connection Lines */
    .children-container {
        position: relative;
        margin-top: 2rem;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .vertical-connector {
        position: absolute;
        top: -2rem;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 2rem;
        background: #28a745;
        border-radius: 2px;
        z-index: 1;
    }
    
    .horizontal-connector {
        position: absolute;
        top: -1rem;
        left: 0;
        right: 0;
        height: 3px;
        background: #28a745;
        border-radius: 2px;
        z-index: 1;
    }
    
    .children-tree-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 3rem;
        position: relative;
        width: 100%;
        min-width: max-content;
    }
    
    .child-tree-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .child-connector {
        position: absolute;
        top: -2rem;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 2rem;
        background: #28a745;
        border-radius: 2px;
        z-index: 1;
    }
    
    .connection-line {
        position: absolute;
        background: #28a745;
        border-radius: 2px;
    }
    
    .parent-line {
        top: -2rem;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 2rem;
        z-index: 1;
    }
    
    .no-team-message {
        margin-top: 3rem;
        text-align: center;
        width: 100%;
    }
    
    .empty-state {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .children-tree-grid {
            gap: 2rem;
        }
        
        .dealer-card {
            min-width: 260px;
            max-width: 290px;
        }
    }
    
    @media (max-width: 768px) {
        .dealer-card {
            min-width: 240px;
            max-width: 270px;
            padding: 1rem;
        }
        
        .children-tree-grid {
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 0.25rem;
        }
        
        .stat-box {
            padding: 0.25rem;
        }
        
        .horizontal-connector {
            display: none;
        }
    }
    
    @media (max-width: 480px) {
        .dealer-card {
            min-width: 220px;
            max-width: 250px;
        }
        
        .avatar-circle {
            width: 60px;
            height: 60px;
            font-size: 1.2rem;
        }
    }
</style>
<?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/partials/enhanced-tree-node.blade.php ENDPATH**/ ?>