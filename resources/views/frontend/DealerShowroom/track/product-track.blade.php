@extends('frontend.DealerShowroom.master')

@section('title', 'Track Order')

@section('content')
<div class="order-tracking-container">
    <div class="order-tracking-wrapper">
        <div class="order-tracking-content">
            <!-- Header Section -->
            <div class="tracking-header">
                <h1 class="tracking-title">Track Your Order</h1>
                <p class="tracking-subtitle">View your order status and tracking information</p>
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="tracking-loading">
                <div class="tracking-spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <p class="loading-text">Loading order details...</p>
            </div>

            <!-- Order Details Container -->
            <div id="trackingDetails" class="d-none">
                <!-- Content will be populated by JavaScript -->
            </div>

            <!-- Error State -->
            <div id="errorState" class="d-none">
                <div class="tracking-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span id="errorMessage"></span>
                </div>
                <div class="error-actions">
                    <button class="btn-retry" onclick="location.reload()">
                        <i class="fas fa-refresh"></i>Try Again
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Order Tracking Specific Styles */
.order-tracking-container {
    padding: 1rem;
    min-height: 60vh;
}

.order-tracking-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.order-tracking-content {
    width: 100%;
}

/* Header Styles */
.tracking-header {
    text-align: center;
    margin-bottom: 2rem;
}

.tracking-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.tracking-subtitle {
    color: #666;
    margin-bottom: 0;
    font-size: 1rem;
}

/* Loading Styles */
.tracking-loading {
    text-align: center;
    padding: 3rem 0;
}

.tracking-spinner .spinner-border {
    color: #ff5800;
    width: 3rem;
    height: 3rem;
}

.loading-text {
    margin-top: 1rem;
    color: #666;
    font-size: 0.95rem;
}

/* Error Styles */
.tracking-error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    margin-bottom: 1rem;
    border: 1px solid #f5c6cb;
}

.error-actions {
    text-align: center;
}

.btn-retry {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    cursor: pointer;
    font-size: 0.875rem;
}

.btn-retry:hover {
    background-color: #5a6268;
}

/* Card Styles */
.tracking-card {
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.tracking-card-header {
    background-color: #f8f9fa;
    padding: 1.25rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.tracking-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    color: #333;
}

.tracking-card-body {
    padding: 1.5rem;
}

/* Status Badge Styles */
.tracking-status-badge {
    font-size: 0.8rem;
    font-weight: 600;
    padding: 0.4rem 0.8rem;
    border-radius: 1rem;
    text-align: center;
    white-space: nowrap;
}

.tracking-status-pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.tracking-status-accepted {
    background-color: #cce5ff;
    color: #004085;
    border: 1px solid #80bdff;
}

.tracking-status-shipped {
    background-color: #ffe5cc;
    color: #cc4400;
    border: 1px solid #ff5800;
}

.tracking-status-delivered {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #28a745;
}

.tracking-status-cancelled, .tracking-status-returned {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #dc3545;
}

.tracking-payment-paid {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #28a745;
}

.tracking-payment-pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.tracking-payment-failed {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #dc3545;
}

/* Info Grid */
.tracking-info-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: 1fr;
}

.tracking-info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.tracking-info-item:last-child {
    border-bottom: none;
}

.tracking-info-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
}

.tracking-info-value {
    color: #6c757d;
    font-size: 0.9rem;
    word-wrap: break-word;
}

/* Timeline Styles */
.tracking-timeline {
    position: relative;
    padding-left: 2rem;
}

.tracking-timeline::before {
    content: '';
    position: absolute;
    left: 0.75rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #e9ecef;
}

.tracking-timeline-item {
    position: relative;
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.tracking-timeline-item:last-child {
    margin-bottom: 0;
}

.tracking-timeline-marker {
    position: absolute;
    left: -2.1rem;
    top: 0.25rem;
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 50%;
    border: 2px solid white;
    background-color: #e9ecef;
    box-shadow: 0 0 0 2px #e9ecef;
}

.tracking-timeline-marker.active {
    background-color: #ff5800;
    box-shadow: 0 0 0 2px #ff5800;
}

.tracking-timeline-marker.completed {
    background-color: #28a745;
    box-shadow: 0 0 0 2px #28a745;
}

.tracking-timeline-content h6 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #333;
}

.tracking-timeline-content p {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
}

/* Table Styles */
.tracking-table-container {
    overflow-x: auto;
    border-radius: 0.5rem;
}

.tracking-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.tracking-table th {
    background-color: #f8f9fa;
    padding: 1rem 0.75rem;
    text-align: left;
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
    white-space: nowrap;
}

.tracking-table td {
    padding: 1rem 0.75rem;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.tracking-table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Product Info */
.tracking-product-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.tracking-product-image {
    width: 3.5rem;
    height: 3.5rem;
    object-fit: cover;
    border-radius: 0.5rem;
    border: 2px solid #f1f3f4;
    flex-shrink: 0;
}

.tracking-product-placeholder {
    width: 3.5rem;
    height: 3.5rem;
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #adb5bd;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.tracking-product-details h6 {
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
}

.tracking-product-details small {
    color: #6c757d;
    font-size: 0.8rem;
}

.tracking-mobile-info {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 0.25rem;
    display: none;
}

/* Quantity Badge */
.tracking-qty-badge {
    background-color: #e9ecef;
    color: #495057;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Price Text */
.tracking-price {
    font-weight: 600;
    color: #333;
}

.tracking-total-price {
    font-weight: 700;
    color: #28a745;
}

/* Tracking Link */
.tracking-link {
    color: #ff5800;
    text-decoration: none;
    font-weight: 600;
    word-break: break-word;
}

.tracking-link:hover {
    color: #cc4400;
    text-decoration: underline;
}

/* Animations */
.tracking-fade-in {
    animation: trackingFadeIn 0.5s ease-in;
}

@keyframes trackingFadeIn {
    from { opacity: 0; transform: translateY(1rem); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Design */
@media (min-width: 576px) {
    .order-tracking-container {
        padding: 1.5rem;
    }

    .tracking-title {
        font-size: 2rem;
    }

    .tracking-info-item {
        flex-direction: row;
        align-items: center;
        gap: 1rem;
    }

    .tracking-info-label {
        min-width: 8rem;
        flex-shrink: 0;
    }
}

@media (min-width: 768px) {
    .order-tracking-container {
        padding: 2rem;
    }

    .tracking-header {
        margin-bottom: 3rem;
    }

    .tracking-title {
        font-size: 2.25rem;
    }

    .tracking-subtitle {
        font-size: 1.1rem;
    }

    .tracking-info-grid {
        grid-template-columns: 1fr 1fr;
    }

    .tracking-card-body {
        padding: 2rem;
    }

    .tracking-table th,
    .tracking-table td {
        padding: 1rem;
    }

    .tracking-product-image,
    .tracking-product-placeholder {
        width: 4rem;
        height: 4rem;
    }
}

@media (min-width: 992px) {
    .tracking-card-header {
        flex-wrap: nowrap;
    }

    .tracking-timeline {
        padding-left: 2.5rem;
    }

    .tracking-timeline::before {
        left: 1rem;
    }

    .tracking-timeline-marker {
        left: -2.375rem;
        width: 1rem;
        height: 1rem;
    }
}

/* Mobile specific styles */
@media (max-width: 767px) {
    .tracking-table th:nth-child(3),
    .tracking-table td:nth-child(3),
    .tracking-table th:nth-child(4),
    .tracking-table td:nth-child(4) {
        display: none;
    }

    .tracking-mobile-info {
        display: block;
    }

    .tracking-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .tracking-status-badge {
        align-self: flex-end;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const orderCode = @json($order_code);
    const shopName = @json($dealer_shop_name);
    const url = `/showroom/${shopName}/product-tracking/${orderCode}/data`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingState').classList.add('d-none');

            if (!data.success) {
                showError(data.message);
                return;
            }

            displayOrderDetails(data.order);
        })
        .catch(error => {
            console.error("Error:", error);
            document.getElementById('loadingState').classList.add('d-none');
            showError('An error occurred while loading order details. Please try again later.');
        });
});

function showError(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('errorState').classList.remove('d-none');
}

function displayOrderDetails(order) {
    const container = document.getElementById('trackingDetails');

    let html = `
        <div class="tracking-fade-in">
            <!-- Order Summary Card -->
            <div class="tracking-card">
                <div class="tracking-card-header">
                    <h5 class="tracking-card-title">Order Information</h5>
                    <span class="tracking-status-badge tracking-status-${order.status.toLowerCase()}">${order.status}</span>
                </div>
                <div class="tracking-card-body">
                    <div class="tracking-info-grid">
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Order Code:</span>
                            <span class="tracking-info-value tracking-price">${order.order_code}</span>
                        </div>
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Order Date:</span>
                            <span class="tracking-info-value">${formatDate(order.date)}</span>
                        </div>
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Customer:</span>
                            <span class="tracking-info-value">${order.customer_name}</span>
                        </div>
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Total Amount:</span>
                            <span class="tracking-info-value tracking-total-price">Rs. ${parseFloat(order.total_cost).toLocaleString()}</span>
                        </div>
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Phone:</span>
                            <span class="tracking-info-value">${order.phone}</span>
                        </div>
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Payment Status:</span>
                            <span class="tracking-status-badge tracking-payment-${(order.payment_status || 'pending').toLowerCase()}">${order.payment_status || 'Pending'}</span>
                        </div>
                        ${order.email ? `
                        <div class="tracking-info-item">
                            <span class="tracking-info-label">Email:</span>
                            <span class="tracking-info-value">${order.email}</span>
                        </div>
                        ` : ''}
                    </div>

                    ${order.tracking_number || order.tracking_link ? `
                        <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid #e9ecef;">
                        <h6 style="margin-bottom: 1rem; font-weight: 600;">Tracking Information</h6>
                        <div class="tracking-info-grid">
                            ${order.tracking_number ? `
                                <div class="tracking-info-item">
                                    <span class="tracking-info-label">Tracking Number:</span>
                                    <span class="tracking-info-value tracking-price">${order.tracking_number}</span>
                                </div>
                            ` : ''}
                            ${order.tracking_link ? `
                                <div class="tracking-info-item">
                                    <span class="tracking-info-label">Track Package:</span>
                                    <a href="${order.tracking_link}" target="_blank" class="tracking-link">
                                        <i class="fas fa-external-link-alt"></i> View on Courier Website
                                    </a>
                                </div>
                            ` : ''}
                        </div>
                    ` : ''}
                </div>
            </div>

            <!-- Order Progress Timeline -->
            <div class="tracking-card">
                <div class="tracking-card-header">
                    <h5 class="tracking-card-title">Order Progress</h5>
                </div>
                <div class="tracking-card-body">
                    ${generateTimeline(order.status)}
                </div>
            </div>

            <!-- Order Items -->
            <div class="tracking-card">
                <div class="tracking-card-header">
                    <h5 class="tracking-card-title">Order Items</h5>
                    <span class="tracking-status-badge" style="background-color: #e9ecef; color: #495057;">${order.items.length} Items</span>
                </div>
                <div style="padding: 0;">
                    ${generateItemsTable(order.items)}
                </div>
            </div>
        </div>
    `;

    container.innerHTML = html;
    container.classList.remove('d-none');
}

function generateTimeline(status) {
    const steps = [
        { key: 'pending', title: 'Order Placed', description: 'Your order has been received' },
        { key: 'accepted', title: 'Accepted', description: 'Your order has been confirmed' },
        { key: 'packed', title: 'Packed', description: 'Your order is packed and ready for pickup' },
        { key: 'pickup done', title: 'Pickup Done', description: 'Your order has been picked up by the courier' },
        { key: 'ready to ship', title: 'Ready to Ship', description: 'Your order is ready to be shipped' },
        { key: 'shipped', title: 'Shipped', description: 'Your order is on the way' },
        { key: 'in transit', title: 'In Transit', description: 'Your order is in transit' },
        { key: 'customer unavailable', title: 'Customer Unavailable', description: 'Delivery attempt was made but customer was unavailable' },
        // Conditionally add 'rescheduled' step only if status is 'rescheduled'
        ...(status && status.toLowerCase() === 'rescheduled'
            ? [{ key: 'rescheduled', title: 'Rescheduled', description: 'Delivery has been rescheduled' }]
            : []),
        { key: 'shipped', title: 'Shipped', description: 'Your order is on the way' },
        { key: 'delivered', title: 'Delivered', description: 'Order successfully delivered' },
        ...(status && status.toLowerCase() === 'cancelled'
            ? [{ key: 'cancelled', title: 'Cancelled', description: 'Order has been cancelled' }]
            : []),
        ...(status && status.toLowerCase() === 'returned'
            ? [{ key: 'returned', title: 'Returned', description: 'Order has been returned' }]
            : []),

    ];

    const statusIndex = steps.findIndex(step => step.key === status.toLowerCase());

    let html = '<div class="tracking-timeline">';

    steps.forEach((step, index) => {
        let markerClass = 'tracking-timeline-marker';
        if (index < statusIndex) {
            markerClass += ' completed';
        } else if (index === statusIndex) {
            markerClass += ' active';
        }

        html += `
            <div class="tracking-timeline-item">
                <div class="${markerClass}"></div>
                <div class="tracking-timeline-content">
                    <h6>${step.title}</h6>
                    <p>${step.description}</p>
                </div>
            </div>
        `;
    });

    html += '</div>';
    return html;
}

function generateItemsTable(items) {
    if (!items || items.length === 0) {
        return '<div style="padding: 2rem; text-align: center; color: #6c757d;">No items found in this order.</div>';
    }

    let html = `
        <div class="tracking-table-container">
            <table class="tracking-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="d-none d-md-table-cell">Size</th>
                        <th class="d-none d-md-table-cell">Color</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
    `;

    items.forEach(item => {
        const product = item.product || {};
        const productName = product.name || product.product_name || 'Product Name Not Available';
        const productImage = product.image || (product.images && product.images.length > 0 ? product.images[0].image_path : null);
        const price = parseFloat(item.cost || 0);
        const total = price * parseInt(item.quantity);

        html += `
            <tr>
                <td>
                    <div class="tracking-product-info">
                        ${productImage
                            ? `<img src="${productImage}" alt="${productName}" class="tracking-product-image">`
                            : `<div class="tracking-product-placeholder"><i class="fas fa-image"></i></div>`
                        }
                        <div class="tracking-product-details">
                            <h6>${productName}</h6>
                            <div class="tracking-mobile-info">
                                ${item.size ? `Size: ${item.size}` : ''}${item.size && item.color ? ' | ' : ''}${item.color ? `Color: ${item.color}` : ''}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="d-none d-md-table-cell">${item.size || 'N/A'}</td>
                <td class="d-none d-md-table-cell">${item.color || 'N/A'}</td>
                <td style="text-align: center;">
                    <span class="tracking-qty-badge">${item.quantity}</span>
                </td>
                <td style="text-align: right;" class="tracking-price">Rs. ${price.toLocaleString()}</td>
                <td style="text-align: right;" class="tracking-total-price">Rs. ${total.toLocaleString()}</td>
            </tr>
        `;
    });

    html += `
                </tbody>
            </table>
        </div>
    `;

    return html;
}

function formatDate(dateString) {
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    return new Date(dateString).toLocaleDateString('en-US', options);
}
</script>

@endsection
