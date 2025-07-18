@extends('layouts.user_sidebar')

@section('dashboard-content')
<style>
    .orders-list {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .order-item {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-image {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
    }

    .order-details {
        flex: 1;
    }

    .order-code {
        color: #333;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 8px;
    }

    .order-date {
        color: #666;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .order-total {
        font-weight: 600;
        color: #ee520a;
        font-size: 16px;
    }

    .order-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 14px;
        background-color: #fff3cd;
        color: #856404;
        display: inline-block;
        margin-bottom: 8px;
    }

    .action-button {
        padding: 8px 20px;
        border-radius: 6px;
        background: linear-gradient(135deg, #ee520a, #ff6b2b);
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(238,82,10,0.2);
        color: white;
    }

    .empty-orders {
        text-align: center;
        padding: 40px 20px;
        color: #666;
    }
</style>

<div class="container" style="padding-top: 34px; padding-bottom: 16px;">
    <h4 class="mb-4" style="margin-top: 30px; font-weight: 600;">Unpaid Orders</h4>

    @if($unpaidOrders->count() > 0)
        <div class="orders-list">
            @foreach($unpaidOrders as $order)
                <div class="order-item">
                    <div class="order-image-container">
                        @if($order->items->first() && $order->items->first()->product->images->first())
                            <img src="{{ asset('storage/' . $order->items->first()->product->images->first()->image_path) }}" 
                                alt="Product Image" 
                                class="order-image">
                        @else
                            <img src="{{ asset('images/placeholder.jpg') }}" 
                                alt="No Image" 
                                class="order-image">
                        @endif
                    </div>
                    <div class="order-details">
                        <div class="order-code">Order ID: {{ $order->order_code }}</div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                        <div class="order-status">Unpaid</div>
                        <div class="order-total">Rs. {{ number_format($order->total_cost, 2) }}</div>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('payment', ['order_code' => $order->order_code]) }}" 
                           class="action-button">
                            Pay Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-orders">
            <img src="{{ asset('images/empty-cart.png') }}" alt="No Orders" style="width: 120px; margin-bottom: 20px;">
            <h5>No unpaid orders found</h5>
            <p>All your orders have been paid for.</p>
        </div>
    @endif
</div>
@endsection
