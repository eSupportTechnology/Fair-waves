@extends('layouts.user_sidebar')

@section('dashboard-content')
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
        overflow-x: auto;
    }
    
    .tree-scroll-container {
        min-width: 100%;
        padding: 1rem;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .genealogy-container {
            padding: 1rem;
        }
        
        .genealogy-header {
            padding: 1rem;
        }
        
        .genealogy-title {
            font-size: 1.5rem;
        }
        
        .team-overview-stats {
            grid-template-columns: 1fr 1fr;
        }
        
        .tree-controls {
            flex-direction: column;
            align-items: center;
        }
        
        .tree-control-btn {
            width: 100%;
            max-width: 250px;
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .team-overview-stats {
            grid-template-columns: 1fr;
        }
        
        .overview-stat-value {
            font-size: 1.5rem;
        }
    }
        font-size: 0.8rem;
        font-weight: 500;
        color: #495057;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    
    .current-user .node-info .rank {
        background: rgba(255,255,255,0.2);
        color: white;
    }
    
    .node-stats {
        display: flex;
        justify-content: space-around;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }
    
    .current-user .node-stats {
        border-top-color: rgba(255,255,255,0.2);
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-value {
        font-size: 1.1rem;
        font-weight: bold;
        color: var(--primary-color);
    }
    
    .current-user .stat-value {
        color: white;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    
    .current-user .stat-label {
        color: rgba(255,255,255,0.8);
    }
    
    .tree-children {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
        position: relative;
    }
    
    .tree-children::before {
        content: '';
        position: absolute;
        top: -2rem;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 2rem;
        background: #dee2e6;
    }
    
    .tree-child {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .tree-child::before {
        content: '';
        position: absolute;
        top: -2rem;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 2rem;
        background: #dee2e6;
    }
    
    .tree-child::after {
        content: '';
        position: absolute;
        top: -2rem;
        left: 0;
        right: 0;
        height: 2px;
        background: #dee2e6;
    }
    
    .tree-child:only-child::after {
        display: none;
    }
    
    .tree-child:first-child::after {
        left: 50%;
    }
    
    .tree-child:last-child::after {
        right: 50%;
    }
    
    .level-indicator {
        position: absolute;
        top: -0.5rem;
        left: -0.5rem;
        background: var(--primary-color);
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .tree-node.level-1 .level-indicator {
        background: #28a745;
    }
    
    .tree-node.level-2 .level-indicator {
        background: #17a2b8;
    }
    
    .tree-node.level-3 .level-indicator {
        background: #ffc107;
    }
    
    .tree-node.level-4 .level-indicator {
        background: #dc3545;
    }
    
    .no-children {
        padding: 2rem;
        text-align: center;
        color: #6c757d;
        font-style: italic;
    }
    
    .tree-legend {
        background: white;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        margin-right: 0.75rem;
        border: 2px solid;
    }
    
    .legend-item:last-child {
        margin-bottom: 0;
    }
    
    @media (max-width: 768px) {
        .hierarchy-tree {
            padding: 1rem;
        }
        
        .tree-node {
            min-width: 240px;
            padding: 1rem;
        }
        
        .tree-children {
            flex-direction: column;
            gap: 1rem;
        }
        
        .node-avatar {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }
        
        .node-stats {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .tree-legend {
            padding: 0.75rem;
        }
        
        .legend-item {
            font-size: 0.85rem;
        }
    }
    
    .tree-children.collapsed {
        display: none !important;
    }
    
    .tree-node.collapsible .tree-children {
        display: flex;
    }
    
    .tree-node.collapsible.collapsed .tree-children {
        display: none;
    }
}
</style>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dealer.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Full Team Hierarchy</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h4 class="mb-0">
                    <i class="fas fa-sitemap text-primary me-2"></i>
                    Full Team Hierarchy
                </h4>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-outline-secondary btn-sm" onclick="toggleTreeView()">
                        <i class="fas fa-expand-alt me-1"></i>
                        <span id="toggleText">Expand All</span>
                    </button>
                    <a href="{{ route('dealer.dashboard') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                    </a>
                </div>
            </div>
            
            <!-- Team Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                            @if($user->directReferrals)
                                {{ $user->directReferrals->count() }}
                            @else
                                0
                            @endif
                        </h5>
                            <p class="card-text text-muted">Direct Referrals</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $user->dealerProfile->bv ?? 0 }}</h5>
                            <p class="card-text text-muted">Total BV</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-info">{{ $user->dealerProfile->cbv ?? 0 }}</h5>
                            <p class="card-text text-muted">Total CBV</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-warning">{{ $user->dealerProfile->rank ?? 'Beginner' }}</h5>
                            <p class="card-text text-muted">Current Rank</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tree-legend">
                <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i>Legend</h6>
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="legend-item">
                            <div class="legend-color" style="background: var(--primary-color); border-color: var(--primary-color);"></div>
                            <span>You (Team Leader)</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #28a745; border-color: #28a745;"></div>
                            <span>Level 1 (Direct)</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #17a2b8; border-color: #17a2b8;"></div>
                            <span>Level 2</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #ffc107; border-color: #ffc107;"></div>
                            <span>Level 3+</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="hierarchy-tree">
                <div class="tree-container">
                    @include('frontend.dealer.partials.professional-tree-node', ['node' => $completeTree, 'isRoot' => true])
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleTreeView() {
        const treeContainer = document.querySelector('.tree-container');
        const treeChildren = treeContainer.querySelectorAll('.tree-children');
        const toggleText = document.getElementById('toggleText');
        const isExpanded = toggleText.innerText === 'Collapse All';
        
        treeChildren.forEach(children => {
            if (isExpanded) {
                children.classList.add('collapsed');
            } else {
                children.classList.remove('collapsed');
            }
        });
        
        toggleText.innerText = isExpanded ? 'Expand All' : 'Collapse All';
        
        // Update button icon
        const icon = document.querySelector('#toggleText').previousElementSibling;
        icon.className = isExpanded ? 'fas fa-compress-alt me-1' : 'fas fa-expand-alt me-1';
    }
    
    // Add click functionality to individual nodes
    document.addEventListener('DOMContentLoaded', function() {
        const treeNodes = document.querySelectorAll('.tree-node');
        
        treeNodes.forEach(node => {
            if (node.querySelector('.tree-children')) {
                node.style.cursor = 'pointer';
                node.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const children = this.querySelector('.tree-children');
                    if (children) {
                        children.classList.toggle('collapsed');
                    }
                });
            }
        });
    });
</script>
@endsection
