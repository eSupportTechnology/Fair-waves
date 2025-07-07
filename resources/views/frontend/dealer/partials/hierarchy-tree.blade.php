<ul style="list-style-type: none;">
    @foreach ($tree as $node)
        <li style="margin-left: {{ $node['depth'] * 20 }}px;">
            <strong>{{ $node['user']->name }}</strong> —
            <small class="text-muted">{{ $node['user']->dealerProfile->rank ?? 'N/A' }}</small>
        </li>
        @if (!empty($node['children']))
            @include('frontend.dealer.partials.hierarchy-tree', ['tree' => $node['children']])
        @endif
    @endforeach
</ul>
