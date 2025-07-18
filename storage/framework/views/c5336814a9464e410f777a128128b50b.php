<?php $__env->startSection('title', 'Dealers Genealogy Tree'); ?>

<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-color: #2c78dc;
        --secondary-color: #f8f9fa;
        --success-color: #28a745;
        --info-color: #17a2b8;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --dark-color: #343a40;
        --light-color: #f8f9fa;
    }

    .genealogy-container {
        background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .genealogy-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .genealogy-header {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .genealogy-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .genealogy-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.25);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #fff;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .genealogy-tree-wrapper {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
    }

    .tree-controls {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .tree-control-btn {
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .tree-control-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        color: white;
        text-decoration: none;
    }

    .tree-scroll-container {
        overflow: auto;
        max-height: 80vh;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px solid #e9ecef;
        position: relative;
        cursor: grab;
        user-select: none;
    }

    .tree-scroll-container.dragging {
        cursor: grabbing;
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
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        border-radius: 10px;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .tree-scroll-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #667eea, var(--primary-color));
    }

    .tree-content {
        min-width: max-content;
        min-height: max-content;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
        transform-origin: center center;
        transition: transform 0.3s ease;
    }

    /* Zoom Controls */
    .zoom-controls {
        position: absolute;
        bottom: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        z-index: 1000;
    }

    .zoom-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .zoom-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    .zoom-btn:active {
        transform: scale(0.95);
    }

    .zoom-btn.reset {
        font-size: 0.9rem;
        font-weight: 600;
    }

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
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border: 3px solid #e9ecef;
        position: relative;
        min-width: 300px;
        max-width: 350px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .dealer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .dealer-card.root-dealer {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, #fff, #f8f9ff);
    }

    .dealer-card.level-1 {
        border-color: var(--success-color);
        background: linear-gradient(135deg, #fff, #f8fff8);
    }

    .dealer-card.level-2 {
        border-color: var(--info-color);
        background: linear-gradient(135deg, #fff, #f0fdff);
    }

    .dealer-card.level-3 {
        border-color: var(--warning-color);
        background: linear-gradient(135deg, #fff, #fffef0);
    }

    .dealer-card.level-4 {
        border-color: var(--danger-color);
        background: linear-gradient(135deg, #fff, #fff8f8);
    }

    .level-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .dealer-avatar {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .avatar-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .dealer-info h6 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .dealer-rank {
        color: #666;
        font-size: 0.9rem;
        margin: 0.5rem 0;
    }

    .dealer-code {
        background: #f8f9fa;
        color: #666;
        padding: 0.3rem 0.6rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .stat-box {
        text-align: center;
        background: #f8f9fa;
        padding: 0.8rem;
        border-radius: 8px;
    }

    .stat-box .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.2rem;
    }

    .stat-box .stat-label {
        font-size: 0.8rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .join-date {
        margin-top: 1rem;
        color: #666;
        font-size: 0.85rem;
        text-align: center;
    }

    .children-container {
        margin-top: 2rem;
        position: relative;
    }

    .children-tree-grid {
        display: flex;
        gap: 2rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .child-tree-wrapper {
        position: relative;
    }

    .connection-line {
        position: absolute;
        background: #ddd;
        z-index: 1;
    }

    .parent-line {
        width: 2px;
        height: 40px;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
    }

    .vertical-connector {
        position: absolute;
        width: 2px;
        height: 40px;
        background: #ddd;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }

    .horizontal-connector {
        position: absolute;
        height: 2px;
        background: #ddd;
        top: calc(100% + 40px);
        z-index: 1;
    }

    .child-connector {
        position: absolute;
        width: 2px;
        height: 40px;
        background: #ddd;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }

    .no-dealers-message {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .no-dealers-message i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
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
        font-weight: 500;
        color: #333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .genealogy-container {
            padding: 1rem;
        }

        .genealogy-title {
            font-size: 2rem;
        }

        .stats-overview {
            grid-template-columns: 1fr 1fr;
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

        .dealer-card {
            min-width: 250px;
            max-width: 280px;
        }

        .children-tree-grid {
            flex-direction: column;
            align-items: center;
        }

        .zoom-controls {
            bottom: 10px;
            right: 10px;
            gap: 0.3rem;
        }

        .zoom-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .zoom-btn.reset {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .genealogy-title {
            font-size: 1.5rem;
        }

        .stats-overview {
            grid-template-columns: 1fr;
        }

        .stat-value {
            font-size: 2rem;
        }

        .dealer-card {
            min-width: 200px;
            max-width: 250px;
        }

        .zoom-controls {
            bottom: 5px;
            right: 5px;
            gap: 0.2rem;
        }

        .zoom-btn {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }

        .zoom-btn.reset {
            font-size: 0.7rem;
        }
    }
</style>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Dealers Genealogy Tree</h2>
        <p>Complete hierarchy view of all dealers in the system</p>
    </div>
</div>

<div class="genealogy-container">
    <div class="genealogy-header">
        <h2 class="genealogy-title">
            <i class="fas fa-sitemap"></i>
            Complete Dealers Genealogy
        </h2>
        <p class="genealogy-subtitle">
            Comprehensive view of all dealer relationships and referral structure
        </p>
    </div>

    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-value"><?php echo e($totalDealers); ?></div>
            <div class="stat-label">Total Dealers</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e($activeDealers); ?></div>
            <div class="stat-label">Active Dealers</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e($inactiveDealers); ?></div>
            <div class="stat-label">Inactive Dealers</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e($totalLevels); ?></div>
            <div class="stat-label">Max Levels</div>
        </div>
    </div>
</div>

<?php if($completeTree): ?>
    <div class="card mb-4">
        <div class="card-body">
            <!-- Tree Controls -->
            <div class="tree-controls">
                <button class="tree-control-btn" onclick="toggleTreeView()">
                    <i class="fas fa-expand-alt"></i>
                    <span id="toggleText">Expand All</span>
                </button>
                <a href="<?php echo e(route('admin.index')); ?>" class="tree-control-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
                <!--button class="tree-control-btn" onclick="printTree()">
                    <i class="fas fa-print"></i>
                    Print Tree
                </button-->
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
                        <span class="legend-text">Root Dealer (Oldest)</span>
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
                        <span class="legend-text">Level 3+ (Extended Network)</span>
                    </div>
                </div>
            </div>

            <!-- Genealogy Tree -->
            <div class="genealogy-tree-wrapper" style="position: relative;">
                <div class="tree-scroll-container">
                    <div class="tree-content">
                        <?php echo $__env->make('AdminDashboard.partials.genealogy-tree-node', ['node' => $completeTree, 'isRoot' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                
                <!-- Zoom Controls -->
                <div class="zoom-controls">
                    <button class="zoom-btn" onclick="zoomIn()" title="Zoom In">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="zoom-btn" onclick="zoomOut()" title="Zoom Out">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="zoom-btn reset" onclick="resetZoom()" title="Reset Zoom">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="card mb-4">
        <div class="card-body">
            <div class="no-dealers-message">
                <i class="fas fa-users-slash"></i>
                <h4>No Dealers Found</h4>
                <p>There are no dealers in the system yet.</p>
                <a href="<?php echo e(route('dealers')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    View Dealers
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    // Tree view toggle functionality
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

    // Zoom functionality
    let currentZoom = 1;
    const minZoom = 0.5;
    const maxZoom = 2;
    const zoomStep = 0.1;

    function zoomIn() {
        if (currentZoom < maxZoom) {
            currentZoom += zoomStep;
            applyZoom();
        }
    }

    function zoomOut() {
        if (currentZoom > minZoom) {
            currentZoom -= zoomStep;
            applyZoom();
        }
    }

    function resetZoom() {
        currentZoom = 1;
        applyZoom();
    }

    function applyZoom() {
        const treeContent = document.querySelector('.tree-content');
        if (treeContent) {
            treeContent.style.transform = `scale(${currentZoom})`;
        }
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
            container.style.display = 'block';
        });
        
        // Add click handlers for dealer cards
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

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/AdminDashboard/genealogy.blade.php ENDPATH**/ ?>