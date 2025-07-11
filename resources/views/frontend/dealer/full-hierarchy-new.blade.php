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
</style>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dealer.dashboard') }}">Dashboard</a></li>
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
                @if($user->directReferrals)
                    {{ $user->directReferrals->count() }}
                @else
                    0
                @endif
            </div>
            <div class="overview-stat-label">Direct Referrals</div>
        </div>
        <div class="overview-stat-card">
            <div class="overview-stat-value">{{ $user->dealerProfile->bv ?? 0 }}</div>
            <div class="overview-stat-label">Personal BV</div>
        </div>
        <div class="overview-stat-card">
            <div class="overview-stat-value">{{ $user->dealerProfile->cbv ?? 0 }}</div>
            <div class="overview-stat-label">Cumulative BV</div>
        </div>
        <div class="overview-stat-card">
            <div class="overview-stat-value">{{ $user->dealerProfile->rank ?? 'Beginner' }}</div>
            <div class="overview-stat-label">Current Rank</div>
        </div>
    </div>

    <!-- Tree Controls -->
    <div class="tree-controls">
        <button class="tree-control-btn" onclick="toggleTreeView()">
            <i class="fas fa-expand-alt"></i>
            <span id="toggleText">Expand All</span>
        </button>
        <a href="{{ route('dealer.dashboard') }}" class="tree-control-btn">
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
    
    <!-- Genealogy Tree -->
    <div class="genealogy-tree-wrapper">
        <div class="tree-scroll-container">
            @include('frontend.dealer.partials.enhanced-tree-node', ['node' => $completeTree, 'isRoot' => true])
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

    // Initialize with expanded view
    document.addEventListener('DOMContentLoaded', function() {
        const childrenContainers = document.querySelectorAll('.children-container');
        childrenContainers.forEach(container => {
            container.style.display = 'block';
        });
    });

    // Add smooth scrolling for better UX
    document.querySelectorAll('.dealer-card').forEach(card => {
        card.addEventListener('click', function() {
            this.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        });
    });
</script>
@endsection
