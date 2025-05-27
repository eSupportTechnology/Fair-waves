@extends('layouts.user_sidebar')

@section('dashboard-content')
<style>
/* Existing styles remain unchanged */

/* Add tracking button styles */
.track-button {
    color: #fff;
    background-color: #ff7b00; /* Orange */
    border: none;
    padding: 5px 15px;
    border-radius: 5px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.track-button:hover {
    background-color: #e56b00; /* Darker orange */
}
</style>

<h4 class="px-2 py-2">My Orders</h4>


<!-- All Orders Tab -->
<div id="all-orders" class="tab-content active">
    @foreach ($orders as $order)
    <div class="order-card" style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
        <div class="order-card-header d-flex justify-content-between align-items-center" style="margin-bottom: 20px; border-bottom: 1px solid #eaeaea;">
            <span class="status {{ strtolower(str_replace(' ', '-', $order->status)) }}">{{ $order->status }}</span>
            
        </div>

        <div class="order-card-body d-flex align-items-center">
            <div class="order-image" style="margin-right: 15px;">
               <!-- Displaying the product image -->
               @foreach ($order->items as $orderItem)
                    @if ($orderItem->product && $orderItem->product->images->first())
                        <img src="{{ asset('storage/' . $orderItem->product->images->first()->image_path) }}" alt="Product Image" style="width: 70px; height: 80px;">
                    @endif
                @endforeach
            </div>
            <div class="order-info" style="font-size: 13px; color: black;">
                <p><a href="#" class="order-link">Order ID:</a> <a href="#" class="order-link">{{ $order->order_code }}</a></p>
                <p class="order-date">Order date: {{ $order->created_at->format('Y-m-d') }}</p>
                <p class="order-price">Total: Rs {{ number_format($order->total_cost, 2) }}</p>
            </div>
            <div style="text-align: right; margin-left: auto;">
                <a href="{{ route('user.track-order', $order->order_code) }}" class="track-button">Track Order</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
