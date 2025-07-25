@extends('layouts.user_sidebar')

@section('dashboard-content')
<div class="dealer-orders-container">
    <div class="page-header">
        <h4 class="page-title">My Customer Orders</h4>
    </div>
    <div class="orders-content">

    @forelse ($groupedOrders as $orderCode => $orderData)
    <div class="order-card">
        <div class="order-card-header">
            <span class="status {{ strtolower(str_replace(' ', '-', $orderData['order']->status)) }}">
                {{ $orderData['order']->status }}
            </span>
        </div>

        <div class="order-info">
            <div class="info-grid">
                <div class="info-item">
                    <i class="fas fa-hashtag"></i>
                    <div class="info-content">
                        <label>Order ID</label>
                        <span>{{ $orderData['order']->order_code }}</span>
                    </div>
                </div>
                <div class="info-item">
                    <i class="far fa-calendar-alt"></i>
                    <div class="info-content">
                        <label>Order Date</label>
                        <span>{{ $orderData['order']->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="products-container">
            @foreach($orderData['items'] as $item)
            <div class="product-item">
                <div class="product-image">
                    @if($item->link->product->images->first())
                    <img src="{{ asset('storage/' . $item->link->product->images->first()->image_path) }}" 
                         alt="Product Image">
                    @endif
                </div>
                <div class="product-details">
                    <h6>{{ $item->link->product->name }}</h6>
                    <div class="product-meta">
                        <span class="quantity">
                            <i class="fas fa-cubes"></i> {{ $item->order->quantity }} units
                        </span>
                        <span class="price">
                            <i class="fas fa-tag"></i> Rs {{ number_format($item->order->cost, 2) }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="order-footer">
            <div class="total-section">
                <span class="total-label">Total Amount</span>
                <span class="total-amount">Rs {{ number_format($orderData['order']->total_cost, 2) }}</span>
            </div>
            <div class="action-buttons">
                <a href="{{ route('dealer.track-order', $orderData['order']->order_code) }}" class="track-btn">
                    <i class="fas fa-truck"></i> Track Order
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="no-orders">
        <i class="fas fa-box-open empty-icon"></i>
        <h5>No orders found</h5>
        <p>You have no customer orders yet.</p>
    </div>
    @endforelse
</div>

<style>
    .page-header {
        margin-bottom: 20px;
        background: linear-gradient(135deg, #ff6f1a 0%, #ff9248 100%);
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(255, 111, 26, 0.15);
        display: flex;
        align-items: center;
        height: 60px;
        margin-top: 25px;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .order-card {
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #eaeaea;
    }

    .order-card-header {
        padding-bottom: 12px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f0f0f0;
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status.pending { background: #fff3cd; color: #856404; }
    .status.accepted { background: #d4edda; color: #155724; }
    .status.packed { background: #cce5ff; color: #004085; }
    .status.shipped { background: #d1ecf1; color: #0c5460; }
    .status.delivered { background: #d4edda; color: #155724; }
    .status.cancelled { background: #f8d7da; color: #721c24; }

    .order-info {
        margin-bottom: 16px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-item i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
        color: #ff6f1a;
    }

    .info-content {
        display: flex;
        flex-direction: column;
    }

    .info-content label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 2px;
    }

    .info-content span {
        font-weight: 500;
        color: #333;
    }

    .products-container {
        display: grid;
        gap: 12px;
        margin-bottom: 16px;
        max-height: 200px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .products-container::-webkit-scrollbar {
        width: 6px;
    }

    .products-container::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 3px;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 8px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .product-image {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-details h6 {
        margin: 0 0 4px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .product-meta {
        display: flex;
        gap: 16px;
    }

    .product-meta span {
        font-size: 0.85rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .product-meta i {
        font-size: 0.8rem;
        color: #ff6f1a;
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
    }

    .total-section {
        display: flex;
        flex-direction: column;
    }

    .total-label {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 4px;
    }

    .total-amount {
        font-size: 1.1rem;
        font-weight: 600;
        color: #ff6f1a;
    }

    .track-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ff6f1a;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .track-btn:hover {
        background: #e65800;
        color: white;
        transform: translateY(-1px);
    }

    .no-orders {
        text-align: center;
        padding: 48px 24px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .empty-icon {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 16px;
    }

    .no-orders h5 {
        color: #495057;
        margin-bottom: 8px;
    }

    .no-orders p {
        color: #6c757d;
        margin: 0;
    }
</style>
@endsection
