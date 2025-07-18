@extends('layouts.user_sidebar')

@section('dashboard-content')
<style>
    .order-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .order-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    .order-body {
        padding: 20px;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .order-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
    }

    .order-details {
        flex-grow: 1;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-accepted {
        background-color: #d4edda;
        color: #155724;
    }

    .status-packed {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-pickup {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .status-ready {
        background-color: #e2e3e5;
        color: #383d41;
    }

    .order-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }

    .page-title {
        margin-top: 30px;
        margin-bottom: 30px;
        color: #333;
        font-weight: 600;
    }
</style>

<div class="container py-4">
    <h4 class="page-title">Orders To Be Shipped</h4>

    @if($toBeShippedOrders->isEmpty())
        <div class="alert alert-info">
            No orders to be shipped at the moment.
        </div>
    @else
        @foreach($toBeShippedOrders as $order)
            <div class="order-card">
                <div class="order-header d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Order #{{ $order->order_code }}</h6>
                        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                    </div>
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
                        {{ $order->status }}
                    </span>
                </div>
                <div class="order-body">
                    @foreach($order->items as $item)
                        <div class="order-item">
                            @if($item->product && $item->product->images->first())
                                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                                     alt="{{ $item->product->product_name }}">
                            @else
                                <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default product image">
                            @endif
                            <div class="order-details">
                                <h6 class="mb-1">{{ $item->product->product_name }}</h6>
                                <p class="mb-0 text-muted">Quantity: {{ $item->quantity }}</p>
                                <p class="mb-0">Rs. {{ number_format($item->cost, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="order-meta">
                        <div>
                            <strong>Total Amount:</strong> Rs. {{ number_format($order->total_cost, 2) }}
                        </div>
                        <div>
                            <strong>Payment Status:</strong> 
                            <span class="text-{{ $order->payment_status == 'Paid' ? 'success' : 'warning' }}">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
