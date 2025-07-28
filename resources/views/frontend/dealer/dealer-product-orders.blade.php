@extends('layouts.user_sidebar')

@section('dashboard-content')
<style>
.orders-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.orders-header {
    background: linear-gradient(135deg, #ffffff 0%, #f7fafc 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.orders-header h2 {
    color: #2d3748;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.orders-header h2 i {
    background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.5rem;
}

.product-info {
    background: linear-gradient(135deg, #fff5f0 0%, #fed7d2 100%);
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-top: 1rem;
    border-left: 4px solid #ff5800;
}

.product-info .product-name {
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

.orders-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 2rem;
}

.orders-table {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.orders-table thead {
    background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 100%);
}

.orders-table thead th {
    color: white;
    font-weight: 600;
    padding: 1.25rem 1rem;
    text-align: left;
    border: none;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.orders-table tbody tr {
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.orders-table tbody tr:hover {
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.orders-table tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border: none;
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.customer-name {
    font-weight: 600;
    color: #2d3748;
    margin: 0;
}

.quantity-badge {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.total-amount {
    font-weight: 700;
    font-size: 1.1rem;
    color: #2d3748;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.total-amount i {
    color: #48bb78;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: capitalize;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-pending {
    background: linear-gradient(135deg, #fed7d2 0%, #feb2a8 100%);
    color: #c53030;
}

.status-processing {
    background: linear-gradient(135deg, #feebc8 0%, #f6e05e 100%);
    color: #d69e2e;
}

.status-shipped {
    background: linear-gradient(135deg, #bee3f8 0%, #90cdf4 100%);
    color: #2b6cb0;
}

.status-delivered {
    background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
    color: #276749;
}

.status-cancelled {
    background: linear-gradient(135deg, #fed7d2 0%, #fbb6ce 100%);
    color: #c53030;
}

.order-date {
    color: #4a5568;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.order-date i {
    color: #a0aec0;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.action-btn {
    padding: 0.625rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.action-btn-track {
    background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 100%);
    color: white;
}

.action-btn-track:hover {
    background: linear-gradient(135deg, #e04e00 0%, #ff5800 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 88, 0, 0.3);
    color: white;
}

.action-btn-delete {
    background: linear-gradient(135deg, #fed7d2 0%, #feb2a8 100%);
    color: #c53030;
    border: 1px solid #feb2a8;
}

.action-btn-delete:hover {
    background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(248, 113, 113, 0.3);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    color: #4a5568;
    font-weight: 600;
    margin-bottom: 1rem;
}

.empty-state p {
    color: #718096;
    font-size: 1.1rem;
    max-width: 400px;
    margin: 0 auto;
}

.back-button {
    background: linear-gradient(135deg, #ff5800 0%, #ff6b3d 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(255, 88, 0, 0.2);
}

.back-button:hover {
    background: linear-gradient(135deg, #e04e00 0%, #ff5800 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 88, 0, 0.3);
    color: white;
}

.back-button i {
    transition: transform 0.3s ease;
}

.back-button:hover i {
    transform: translateX(-3px);
}

.orders-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.summary-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    border-left: 4px solid transparent;
}

.summary-card.total-orders {
    border-left-color: #ff5800;
}

.summary-card.total-revenue {
    border-left-color: #48bb78;
}

.summary-card.pending-orders {
    border-left-color: #ed8936;
}

.summary-card h4 {
    color: #2d3748;
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0.5rem 0;
}

.summary-card p {
    color: #718096;
    margin: 0;
    font-weight: 500;
}

.summary-card i {
    font-size: 1.5rem;
    opacity: 0.7;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .orders-container {
        padding: 1.5rem 0;
    }
    
    .orders-header {
        padding: 1.5rem;
    }
}

@media (max-width: 992px) {
    .orders-table {
        font-size: 0.875rem;
    }
    
    .orders-table thead th,
    .orders-table tbody td {
        padding: 1rem 0.75rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .action-btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
    }
}

@media (max-width: 768px) {
    .orders-header h2 {
        font-size: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .orders-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    
    .customer-info {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .customer-avatar {
        width: 32px;
        height: 32px;
        font-size: 0.75rem;
    }
    
    .orders-summary {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .orders-container {
        padding: 1rem 0;
    }
    
    .orders-header {
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .orders-header h2 {
        font-size: 1.25rem;
    }
    
    .empty-state {
        padding: 2rem 1rem;
    }
    
    .empty-state i {
        font-size: 3rem;
    }
    
    .back-button {
        width: 100%;
        justify-content: center;
        padding: 1rem;
    }
}

/* Animation for loading states */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.orders-card,
.orders-header,
.summary-card {
    animation: fadeInUp 0.6s ease-out;
}

.orders-table tbody tr {
    animation: fadeInUp 0.4s ease-out;
}

.orders-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.orders-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.orders-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.orders-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.orders-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="orders-container">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="orders-header">
            <h2>
                <i class="fas fa-shopping-cart"></i>
                Product Orders
            </h2>
          
        </div>

        @if($orders->count() > 0)
            <!-- Summary Cards -->
           

            <!-- Orders Table -->
            <div class="orders-card">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user me-2"></i>Customer</th>
                            <th><i class="fas fa-sort-numeric-up me-2"></i>Quantity</th>
                            <th><i class="fas fa-rupee-sign me-2"></i>Total Amount</th>
                            <th><i class="fas fa-info-circle me-2"></i>Status</th>
                            <th><i class="fas fa-calendar me-2"></i>Order Date</th>
                            <th><i class="fas fa-cogs me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($order->order->order->customer_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div class="customer-name">
                                            {{ $order->order->order->customer_name ?? 'Unknown Customer' }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="quantity-badge">
                                        <i class="fas fa-boxes"></i>
                                        {{ $order->order->quantity ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    <div class="total-amount">
                                        <i class="fas fa-rupee-sign"></i>
                                        {{ number_format($order->total_price ?? 0, 2) }}
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $status = strtolower($order->order->order->status ?? 'pending');
                                        $statusClass = 'status-' . $status;
                                        $statusIcon = match($status) {
                                            'pending' => 'fas fa-clock',
                                            'processing' => 'fas fa-cog fa-spin',
                                            'shipped' => 'fas fa-shipping-fast',
                                            'delivered' => 'fas fa-check-circle',
                                            'cancelled' => 'fas fa-times-circle',
                                            default => 'fas fa-question-circle'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="{{ $statusIcon }}"></i>
                                        {{ ucfirst($order->order->order->status ?? 'Pending') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="order-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $order->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="https://track.example.com/order/{{ $order->id }}" 
                                           target="_blank" 
                                           class="action-btn action-btn-track"
                                           title="Track Order">
                                            <i class="fas fa-external-link-alt"></i>
                                            Track
                                        </a>
                                        <form action="{{ route('dealer.products.orders.delete', $order->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirmDelete('{{ $order->order->order->customer_name ?? 'this order' }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="action-btn action-btn-delete"
                                                    title="Delete Order">
                                                <i class="fas fa-trash-alt"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No Orders Found</h3>
                <p>There are currently no orders for this product. Orders will appear here when customers make purchases through your affiliate link.</p>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('dealer.products.dashboard') }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Back to Product Links
            </a>
        </div>
    </div>
</div>

<script>
function confirmDelete(customerName) {
    return confirm(`Are you sure you want to delete the order for ${customerName}? This action cannot be undone.`);
}

// Add loading animation when navigating
document.addEventListener('DOMContentLoaded', function() {
    const backButton = document.querySelector('.back-button');
    const actionButtons = document.querySelectorAll('.action-btn-track');
    
    if (backButton) {
        backButton.addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        });
    }
    
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Opening...';
        });
    });
});

// Enhance table responsiveness
window.addEventListener('resize', function() {
    const table = document.querySelector('.orders-table');
    const container = document.querySelector('.orders-card');
    
    if (window.innerWidth < 768 && table && container) {
        container.style.overflowX = 'auto';
    } else if (container) {
        container.style.overflowX = 'visible';
    }
});
</script>
@endsection
