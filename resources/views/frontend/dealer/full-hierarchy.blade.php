@extends('layouts.user_sidebar')

@section('dashboard-content')
<div class="container">
    <h4 class="mb-4"><i class="fas fa-sitemap text-primary me-2"></i> Full Team Hierarchy</h4>

    @include('frontend.dealer.partials.hierarchy-tree', ['tree' => $tree])
</div>
@endsection
