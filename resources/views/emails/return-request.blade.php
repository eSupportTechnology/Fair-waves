<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($returnRequest->request_type === 'cancel')Order Cancellation Request@else Product Return Request @endif</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #ff5800;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px -30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .order-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .order-info h3 {
            margin-top: 0;
            color: #ff5800;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 5px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-label {
            font-weight: bold;
            color: #666;
        }
        .cancel-reason {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .cancel-reason h4 {
            margin-top: 0;
            color: #856404;
        }
        .action-button {
            background: #ff5800;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .action-button:hover {
            background: #e04e00;
            color: white;
            text-decoration: none;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .urgent {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        @if($returnRequest->request_type === 'cancel')
        <h1>🚨 Order Cancellation Request</h1>
        <p><strong>⚠️ URGENT: Customer has requested to cancel their order</strong></p>
        @else
        <h1>📦 Product Return Request</h1>
        <p><strong>📋 NOTICE: Customer has requested to return their product</strong></p>
        @endif

        <p>Dear Admin,</p>
        
        @if($returnRequest->request_type === 'cancel')
            <p>A customer has submitted a request to cancel their order. Please review the details below and take appropriate action.</p>
        @else
            <p>A customer has submitted a request to return their product. Please review the details below and take appropriate action.</p>
        @endif

        <div class="order-info">
            <h3>📋 Order Information</h3>
            <div class="info-row">
                <span class="info-label">Order Code:</span>
                <span><strong>{{ $returnRequest->order_code }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Customer Name:</span>
                <span>{{ $returnRequest->customer_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span>{{ $returnRequest->phone }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span>{{ $returnRequest->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Date:</span>
                <span>{{ \Carbon\Carbon::parse($returnRequest->order_date)->format('F j, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Request Submitted:</span>
                <span>{{ $returnRequest->created_at ? $returnRequest->created_at->format('F j, Y \a\t g:i A') : 'Just now' }}</span>
            </div>
        </div>

        <div class="cancel-reason">
            @if($returnRequest->request_type === 'cancel')
                <h4>💬 Reason for Cancellation:</h4>
            @else
                <h4>💬 Reason for Return:</h4>
            @endif
            <p>{{ $returnRequest->cancel_reason }}</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('order-details', $returnRequest->order_code) }}?return_request_id={{ $returnRequest->id }}" class="action-button">
                🔍 Review Order & Process Request
            </a>
        </div>

        <p><strong>Next Steps:</strong></p>
        <ul>
            <li>Click the button above to review the full order details</li>
            @if($returnRequest->request_type === 'cancel')
                <li>Evaluate the cancellation request</li>
                <li>Approve or reject the request with appropriate reasoning</li>
            @else
                <li>Evaluate the product return request</li>
                <li>Approve or reject the request with appropriate reasoning</li>
            @endif
            <li>Customer will be notified of your decision</li>
        </ul>

        <div class="footer">
            <p>This is an automated notification from the Fair Waves Order Management System.</p>
            <p>Please do not reply to this email. Use the admin dashboard to process the request.</p>
            <p><strong>Timestamp:</strong> {{ now()->format('F j, Y \a\t g:i A T') }}</p>
        </div>
    </div>
</body>
</html>
