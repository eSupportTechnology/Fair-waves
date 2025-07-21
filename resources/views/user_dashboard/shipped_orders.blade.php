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

    .status-shipped {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-in-transit {
        background-color: #d4edda;
        color: #155724;
    }

    .status-unavailable {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-rescheduled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-delivered {
        background-color: #d4edda;
        color: #155724;
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

    .tracking-info {
        background-color: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #007bff;
        margin-bottom: 15px;
    }

    .tracking-info .badge-info {
        background-color: #007bff;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.875rem;
    }

    .tracking-info .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
        background-color: #007bff;
        color: white;
        font-size: 0.8rem;
        padding: 4px 12px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .tracking-info .btn-outline-primary:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }

    .tracking-link-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 8px;
    }

    .tracking-link-text {
        background-color: #f1f3f4;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 6px 10px;
        font-size: 0.75rem;
        color: #495057;
        word-break: break-all;
        flex: 1;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .copy-btn {
        background-color: #28a745;
        border: 1px solid #28a745;
        color: white;
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .copy-btn:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .copy-btn:active {
        background-color: #1e7e34;
    }
</style>

<div class="container py-4">
    <h4 class="page-title">Shipped Orders</h4>

    @if($shippedOrders->isEmpty())
        <div class="alert alert-info">
            No shipped orders at the moment.
        </div>
    @else
        @foreach($shippedOrders as $order)
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
                    <!-- Tracking Information -->
                    @if($order->tracking_number || $order->tracking_link)
                        <div class="tracking-info mb-3 p-3" style="background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #007bff;">
                            @if($order->tracking_number)
                                <div class="mb-2">
                                    <strong>Tracking Number:</strong> 
                                    <span class="badge badge-info" style="background-color: #007bff; color: white; padding: 4px 8px; border-radius: 4px;">{{ $order->tracking_number }}</span>
                                </div>
                            @endif
                            @if($order->tracking_link)
                                <div class="mb-2">
                                    <strong>Track Your Order:</strong>
                                    <div class="tracking-link-container">
                                        <div class="tracking-link-text" id="tracking-link-{{ $order->id }}" title="{{ $order->tracking_link }}">
                                            {{ $order->tracking_link }}
                                        </div>
                                        <button class="copy-btn" onclick="copyTrackingLink('{{ $order->id }}')" title="Copy tracking link">
                                            <i class="fas fa-copy"></i> Copy
                                        </button>
                                        <a href="{{ $order->tracking_link }}" target="_blank" class="btn btn-sm btn-outline-primary" style="text-decoration: none;">
                                            <i class="fas fa-external-link-alt"></i> Track Order
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    
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

<script>
function copyTrackingLink(orderId) {
    const trackingElement = document.getElementById('tracking-link-' + orderId);
    const trackingLink = trackingElement.textContent || trackingElement.innerText;
    
    // Create a temporary textarea element to copy the text
    const tempTextarea = document.createElement('textarea');
    tempTextarea.value = trackingLink;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    tempTextarea.setSelectionRange(0, 99999); // For mobile devices
    
    try {
        document.execCommand('copy');
        
        // Show feedback to user
        const copyBtn = event.target.closest('.copy-btn');
        const originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        copyBtn.style.backgroundColor = '#28a745';
        
        setTimeout(() => {
            copyBtn.innerHTML = originalText;
            copyBtn.style.backgroundColor = '#28a745';
        }, 2000);
        
    } catch (err) {
        console.error('Failed to copy: ', err);
        // Fallback: select the text for manual copying
        trackingElement.select();
        alert('Please manually copy the selected tracking link');
    }
    
    document.body.removeChild(tempTextarea);
}
</script>

@endsection
