{{-- Professional Tree Node Component --}}
<div class="tree-node {{ $isRoot ? 'current-user' : 'level-' . min($node['depth'], 4) }}">
    @if(!$isRoot)
        <div class="level-indicator">{{ $node['depth'] }}</div>
    @endif
    
    <div class="node-avatar">
        {{ strtoupper(substr($node['user']->name, 0, 2)) }}
    </div>
    
    <div class="node-info">
        <h5>
            @if($isRoot)
                {{ $node['user']->name }} (You)
            @else
                {{ $node['user']->name }}
            @endif
        </h5>
        
        <div class="rank">
            {{ $node['user']->dealerProfile->rank ?? 'Beginner' }}
        </div>
        
        @if($node['user']->dealerProfile)
            <div class="node-stats">
                <div class="stat-item">
                    <div class="stat-value">
                        @if($node['user']->directReferrals)
                            {{ $node['user']->directReferrals->count() }}
                        @else
                            0
                        @endif
                    </div>
                    <div class="stat-label">Direct</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ count($node['children']) }}</div>
                    <div class="stat-label">Children</div>
                </div>
            </div>
        @endif
    </div>
</div>

@if(!empty($node['children']))
    <div class="tree-children">
        @foreach($node['children'] as $child)
            <div class="tree-child">
                @include('frontend.dealer.partials.professional-tree-node', ['node' => $child, 'isRoot' => false])
            </div>
        @endforeach
    </div>
@else
    @if($isRoot)
        <div class="no-children">
            <i class="fas fa-users text-muted me-2"></i>
            No team members yet. Share your referral link to start building your team!
        </div>
    @endif
@endif
