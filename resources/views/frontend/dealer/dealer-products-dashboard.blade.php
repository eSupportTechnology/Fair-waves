@extends('layouts.user_sidebar')

@section('dashboard-content')
<div class="container">
    <h4 class="mb-4">My Product Links</h4>

    <div style="max-height: 70vh; overflow-y: auto;">
        @include('frontend.dealer.partials.dealer-products', ['productLinks' => $productLinks])
    </div>
</div>
@endsection
