

<?php $__env->startSection('dashboard-content'); ?>
<style>
    :root {
        --primary-color: #ff5800;
        --success-color: #28a745;
        --info-color: #17a2b8;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
    }
    
    .genealogy-container {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
    }
    
    .genealogy-header {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--primary-color), #ff6b3d);
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(255, 88, 0, 0.3);
    }
    
    .genealogy-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }
    
    .genealogy-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
    }
    
    .team-overview-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .overview-stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: 2px solid #e9ecef;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .overview-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        border-color: var(--primary-color);
    }
    
    .overview-stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    
    .overview-stat-label {
        font-size: 0.9rem;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .tree-controls {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .tree-control-btn {
        background: white;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .tree-control-btn:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 88, 0, 0.3);
    }
    
    .tree-legend {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
    }
    
    .legend-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid;
        flex-shrink: 0;
    }
    
    .legend-text {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
    }
    
    .genealogy-tree-wrapper {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
        overflow: hidden;
        position: relative;
    }

    .tree-scroll-container {
        width: 100%;
        height: 70vh;
        overflow: auto;
        position: relative;
        padding: 1rem;
        cursor: grab;
        
        /* Custom Scrollbar Styling */
        scrollbar-width: thin;
        scrollbar-color: var(--primary-color) rgba(255, 255, 255, 0.1);
    }

    .tree-scroll-container.dragging {
        cursor: grabbing;
        user-select: none;
    }

    .tree-scroll-container::-webkit-scrollbar {
        width: 12px;
        height: 12px;
    }

    .tree-scroll-container::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .tree-scroll-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary-color), #ff6b3d);
        border-radius: 10px;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .tree-scroll-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #ff6b3d, var(--primary-color));
    }

    .tree-scroll-container::-webkit-scrollbar-corner {
        background: rgba(255, 255, 255, 0.1);
    }

    .tree-content {
        min-width: max-content;
        min-height: max-content;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .genealogy-title {
            font-size: 2rem;
        }
        
        .genealogy-container {
            padding: 1rem;
        }
        
        .tree-scroll-container {
            height: 60vh;
        }
    }

    @media (max-width: 768px) {
        .genealogy-title {
            font-size: 1.8rem;
        }
        
        .team-overview-stats {
            grid-template-columns: 1fr;
        }
        
        .tree-controls {
            flex-direction: column;
            align-items: center;
        }
        
        .tree-control-btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
        
        .legend-grid {
            grid-template-columns: 1fr;
        }
        
        .tree-scroll-container {
            height: 50vh;
            padding: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .genealogy-title {
            font-size: 1.5rem;
        }
        
        .genealogy-header {
            padding: 1.5rem;
        }
        
        .overview-stat-value {
            font-size: 1.5rem;
        }
        
        .tree-scroll-container {
            height: 45vh;
        }
    }
</style>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('dealer.dashboard')); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Full Team Hierarchy</li>
    </ol>
</nav>

<div class="genealogy-container">
    <!-- Header Section -->
    <div class="genealogy-header">
        <h2 class="genealogy-title">
            <i class="fas fa-sitemap"></i>
            Team Genealogy Tree
        </h2>
        <p class="genealogy-subtitle">
            Complete hierarchy view of your dealer network and referral structure
        </p>
    </div>

    <!-- Team Overview Statistics -->
    <div class="team-overview-stats">
        <div class="overview-stat-card">
            <div class="overview-stat-value">
                <?php if($user->directReferrals): ?>
                    <?php echo e($user->directReferrals->count()); ?>

                <?php else: ?>
                    0
                <?php endif; ?>
            </div>
            <div class="overview-stat-label">Direct Referrals</div>
        </div>
        <div class="overview-stat-card">
            <div class="overview-stat-value"><?php echo e($user->dealerProfile->bv ?? 0); ?></div>
            <div class="overview-stat-label">Personal BV</div>
        </div>
        <div class="overview-stat-card">
            <div class="overview-stat-value"><?php echo e($user->dealerProfile->cbv ?? 0); ?></div>
            <div class="overview-stat-label">Cumulative BV</div>
        </div>
        <div class="overview-stat-card">
            <div class="overview-stat-value"><?php echo e($user->dealerProfile->rank ?? 'Beginner'); ?></div>
            <div class="overview-stat-label">Current Rank</div>
        </div>
    </div>

    <!-- Tree Controls -->
    <div class="tree-controls">
        <button class="tree-control-btn" onclick="toggleTreeView()">
            <i class="fas fa-expand-alt"></i>
            <span id="toggleText">Expand All</span>
        </button>
        <a href="<?php echo e(route('dealer.dashboard')); ?>" class="tree-control-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>
        <button class="tree-control-btn" onclick="printTree()">
            <i class="fas fa-print"></i>
            Print Tree
        </button>
    </div>
    
    <!-- Legend -->
    <div class="tree-legend">
        <h6 class="mb-3">
            <i class="fas fa-info-circle text-primary me-2"></i>
            Hierarchy Legend
        </h6>
        <div class="legend-grid">
            <div class="legend-item">
                <div class="legend-color" style="background: var(--primary-color); border-color: var(--primary-color);"></div>
                <span class="legend-text">You (Team Leader)</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #28a745; border-color: #28a745;"></div>
                <span class="legend-text">Level 1 (Direct Referrals)</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #17a2b8; border-color: #17a2b8;"></div>
                <span class="legend-text">Level 2 (Sub-dealers)</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #ffc107; border-color: #ffc107;"></div>
                <span class="legend-text">Level 3+ (Extended Team)</span>
            </div>
        </div>
    </div>
    
    <!-- Genealogy Tree with Scrollable Container -->
    <div class="genealogy-tree-wrapper">
        <div class="tree-scroll-container">
            <div class="tree-content">
                <?php echo $__env->make('frontend.dealer.partials.enhanced-tree-node', ['node' => $completeTree, 'isRoot' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleTreeView() {
        const treeNodes = document.querySelectorAll('.genealogy-tree-node');
        const toggleBtn = document.getElementById('toggleText');
        const isExpanded = toggleBtn.innerText === 'Collapse All';
        
        treeNodes.forEach(node => {
            const childrenContainer = node.querySelector('.children-container');
            if (childrenContainer) {
                if (isExpanded) {
                    childrenContainer.style.display = 'none';
                    node.classList.add('collapsed');
                } else {
                    childrenContainer.style.display = 'block';
                    node.classList.remove('collapsed');
                }
            }
        });
        
        toggleBtn.innerText = isExpanded ? 'Expand All' : 'Collapse All';
    }

    function printTree() {
        window.print();
    }

    // Drag and move functionality
    let isDragging = false;
    let startX, startY, scrollLeft, scrollTop;

    function initializeDragMove() {
        const treeContainer = document.querySelector('.tree-scroll-container');
        if (!treeContainer) return;

        // Mouse down event
        treeContainer.addEventListener('mousedown', (e) => {
            // Only allow dragging if we're not clicking on a dealer card or interactive element
            if (e.target.closest('.dealer-card') || e.target.closest('button') || e.target.closest('a')) {
                return;
            }
            
            isDragging = true;
            treeContainer.classList.add('dragging');
            startX = e.pageX - treeContainer.offsetLeft;
            startY = e.pageY - treeContainer.offsetTop;
            scrollLeft = treeContainer.scrollLeft;
            scrollTop = treeContainer.scrollTop;
            
            // Prevent text selection while dragging
            e.preventDefault();
        });

        // Mouse move event
        treeContainer.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            
            e.preventDefault();
            const x = e.pageX - treeContainer.offsetLeft;
            const y = e.pageY - treeContainer.offsetTop;
            const walkX = (x - startX) * 2; // Scroll speed multiplier
            const walkY = (y - startY) * 2;
            
            treeContainer.scrollLeft = scrollLeft - walkX;
            treeContainer.scrollTop = scrollTop - walkY;
        });

        // Mouse up event
        treeContainer.addEventListener('mouseup', () => {
            isDragging = false;
            treeContainer.classList.remove('dragging');
        });

        // Mouse leave event (in case mouse leaves the container while dragging)
        treeContainer.addEventListener('mouseleave', () => {
            isDragging = false;
            treeContainer.classList.remove('dragging');
        });

        // Touch events for mobile support
        treeContainer.addEventListener('touchstart', (e) => {
            if (e.target.closest('.dealer-card') || e.target.closest('button') || e.target.closest('a')) {
                return;
            }
            
            isDragging = true;
            treeContainer.classList.add('dragging');
            const touch = e.touches[0];
            startX = touch.pageX - treeContainer.offsetLeft;
            startY = touch.pageY - treeContainer.offsetTop;
            scrollLeft = treeContainer.scrollLeft;
            scrollTop = treeContainer.scrollTop;
        });

        treeContainer.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            
            e.preventDefault();
            const touch = e.touches[0];
            const x = touch.pageX - treeContainer.offsetLeft;
            const y = touch.pageY - treeContainer.offsetTop;
            const walkX = (x - startX) * 2;
            const walkY = (y - startY) * 2;
            
            treeContainer.scrollLeft = scrollLeft - walkX;
            treeContainer.scrollTop = scrollTop - walkY;
        });

        treeContainer.addEventListener('touchend', () => {
            isDragging = false;
            treeContainer.classList.remove('dragging');
        });
    }

    // Initialize with expanded view
    document.addEventListener('DOMContentLoaded', function() {
        const childrenContainers = document.querySelectorAll('.children-container');
        childrenContainers.forEach(container => {
            container.style.display = 'flex';
        });
        
        // Smooth scrolling for tree navigation
        document.querySelectorAll('.dealer-card').forEach(card => {
            card.addEventListener('click', function() {
                this.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            });
        });

        // Initialize drag and move functionality
        initializeDragMove();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/dealer/full-hierarchy.blade.php ENDPATH**/ ?>