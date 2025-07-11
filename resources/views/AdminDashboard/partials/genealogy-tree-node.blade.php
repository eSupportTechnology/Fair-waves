{{-- Enhanced Admin Genealogy Tree Node Component with Professional Branches --}}
<div class="genealogy-tree-node {{ $isRoot ? 'root-node' : 'child-node' }}" data-level="{{ $node['depth'] ?? 0 }}">
    <div class="node-container">
        {{-- Connection Lines --}}
        @if(!$isRoot)
            <div class="connection-line parent-line"></div>
        @endif
        
        {{-- Node Card --}}
        <div class="dealer-card {{ $isRoot ? 'root-dealer' : 'level-' . min($node['depth'] ?? 0, 4) }}">
            {{-- Level Badge --}}
            @if(!$isRoot)
                <div class="level-badge">Level {{ $node['depth'] }}</div>
            @endif
            
            {{-- Avatar Section --}}
            <div class="dealer-avatar">
                <div class="avatar-circle">
                    {{ strtoupper(substr($node['user']->name, 0, 2)) }}
                </div>
                @if($isRoot)
                    <div class="crown-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                @endif
            </div>
            
            {{-- Dealer Info --}}
            <div class="dealer-info">
                <h6 class="dealer-name">
                    @if($isRoot)
                        {{ $node['user']->name }} <span class="root-badge">(Root)</span>
                    @else
                        {{ $node['user']->name }}
                    @endif
                </h6>
                
                <div class="dealer-rank">
                    <i class="fas fa-medal"></i>
                    {{ $node['user']->dealerProfile->rank ?? 'Beginner' }}
                </div>
                
                <div class="dealer-code">
                    Code: {{ $node['user']->dealerProfile->dealer_code ?? 'N/A' }}
                </div>
            </div>
            
            {{-- Stats Grid --}}
            @if($node['user']->dealerProfile)
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-value">
                            @if($node['user']->directReferrals)
                                {{ $node['user']->directReferrals->count() }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="stat-label">Direct</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value">{{ count($node['children'] ?? []) }}</div>
                        <div class="stat-label">Team</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value">{{ $node['user']->dealerProfile->bv ?? 0 }}</div>
                        <div class="stat-label">BV</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value">{{ $node['user']->dealerProfile->cbv ?? 0 }}</div>
                        <div class="stat-label">CBV</div>
                    </div>
                </div>
            @endif
            
            {{-- Join Date --}}
            <div class="join-date">
                <i class="fas fa-calendar-alt"></i>
                Joined: {{ $node['user']->created_at->format('M d, Y') }}
            </div>
            
            {{-- Dealer Status --}}
            <div class="mt-2 text-center">
                @if($node['user']->dealer_status == 1)
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle"></i>
                        Active
                    </span>
                @else
                    <span class="badge bg-danger">
                        <i class="fas fa-times-circle"></i>
                        Inactive
                    </span>
                @endif
            </div>
            
            {{-- Email and Phone --}}
            <div class="mt-2">
                <small class="text-muted d-block">
                    <i class="fas fa-envelope"></i>
                    {{ $node['user']->email }}
                </small>
                @if($node['user']->phone)
                    <small class="text-muted d-block">
                        <i class="fas fa-phone"></i>
                        {{ $node['user']->phone }}
                    </small>
                @endif
            </div>
            
            {{-- Quick Actions --}}
            <div class="mt-3 d-flex gap-2 justify-content-center">
                <a href="{{ route('dealer-details', $node['user']->id) }}" 
                   class="btn btn-sm btn-primary" 
                   title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('dealer.edit', $node['user']->id) }}" 
                   class="btn btn-sm btn-warning" 
                   title="Edit Dealer">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
        </div>
    </div>
    
    {{-- Children Container with Proper Tree Structure --}}
    @if(!empty($node['children']) && count($node['children']) > 0)
        <div class="children-container">
            {{-- Vertical connector from parent --}}
            <div class="vertical-connector"></div>
            
            {{-- Horizontal line connecting all children --}}
            @if(count($node['children']) > 1)
                <div class="horizontal-connector" style="left: 0; right: 0;"></div>
            @endif
            
            {{-- Children Grid with proper tree layout --}}
            <div class="children-tree-grid">
                @foreach($node['children'] as $index => $child)
                    <div class="child-tree-wrapper">
                        {{-- Individual child connector --}}
                        <div class="child-connector"></div>
                        
                        {{-- Recursive child node --}}
                        @include('AdminDashboard.partials.genealogy-tree-node', ['node' => $child, 'isRoot' => false])
                    </div>
                @endforeach
            </div>
        </div>
    @else
        @if($isRoot)
            <div class="mt-3 text-center">
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i>
                    This dealer has no referrals yet
                </small>
            </div>
        @endif
    @endif
</div>

<style>
    .genealogy-tree-node {
        position: relative;
        margin: 1.5rem 0;
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
        min-width: 280px;
        max-width: 320px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        margin: 0 0.5rem;
    }
    
    .dealer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }
    
    .dealer-card.root-dealer {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, #fff, #f8f9ff);
        border-width: 4px;
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
        top: -12px;
        right: -12px;
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        z-index: 10;
    }
    
    .dealer-avatar {
        position: relative;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
    }
    
    .avatar-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), #667eea);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        border: 4px solid white;
    }
    
    .crown-icon {
        position: absolute;
        top: -8px;
        right: calc(50% - 35px + 50px);
        color: #ffd700;
        font-size: 1.2rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .dealer-info {
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .dealer-info h6 {
        margin: 0 0 0.5rem 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        word-break: break-word;
    }
    
    .root-badge {
        background: var(--primary-color);
        color: white;
        padding: 0.15rem 0.5rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 500;
    }
    
    .dealer-rank {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: rgba(0,0,0,0.05);
        padding: 0.5rem;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .dealer-code {
        background: #f8f9fa;
        color: #666;
        padding: 0.3rem 0.6rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .stat-box {
        text-align: center;
        background: #f8f9fa;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .stat-box:hover {
        background: #e9ecef;
        transform: translateY(-2px);
    }
    
    .stat-box .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.2rem;
        display: block;
    }
    
    .stat-box .stat-label {
        font-size: 0.7rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .join-date {
        color: #666;
        font-size: 0.75rem;
        text-align: center;
        margin: 1rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    /* Tree Connection Lines - Professional Style */
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
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dealer-card {
            min-width: 250px;
            max-width: 280px;
            padding: 1rem;
        }
        
        .children-tree-grid {
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .stat-box {
            padding: 0.6rem 0.3rem;
        }
        
        .stat-box .stat-value {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 480px) {
        .dealer-card {
            min-width: 200px;
            max-width: 250px;
        }
        
        .dealer-avatar {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
