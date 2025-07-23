<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Update</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .order-info {
            background-color: #f8f9ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }

        .order-code {
            color: #667eea;
            font-weight: 600;
            font-size: 18px;
        }

        .status-badge {
            display: inline-block;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 10px 0;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 30px 0 15px 0;
            border-bottom: 2px solid #667eea;
            padding-bottom: 8px;
        }

        .summary-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-weight: 500;
            color: #666;
            min-width: 120px;
        }

        .summary-value {
            font-weight: 600;
            color: #333;
            text-align: right;
            flex: 1;
        }

        .total-cost {
            color: #667eea !important;
            font-size: 18px;
        }

        .tracking-number {
            font-family: 'Courier New', monospace;
            background-color: #f0f0f0;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        .tracking-link {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .tracking-link:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .tracking-item {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 10px 0;
            border-radius: 0 8px 8px 0;
        }

        .tracking-item .summary-item {
            border-bottom: none;
            padding: 8px 0;
        }

        .footer {
            background-color: #f8f9ff;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .footer p {
            margin: 0;
            color: #666;
            font-size: 16px;
        }

        .thank-you {
            color: #667eea;
            font-weight: 600;
        }

        .icon {
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-right: 8px;
            vertical-align: middle;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content {
                padding: 25px 20px;
            }

            .summary-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .summary-label {
                min-width: auto;
            }

            .summary-value {
                text-align: left;
            }

            .tracking-link {
                display: block;
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📦 Order Update</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Hi {{ $order->customer_name }},
            </div>

            <div class="order-info">
                <p>Your order <span class="order-code">#{{ $order->order_code }}</span> has been updated!</p>
                <div class="status-badge">{{ $newStatus }}</div>
            </div>

            <div class="summary-title">📋 Order Summary</div>

            <ul class="summary-list">
                <li class="summary-item">
                    <span class="summary-label">💰 Total Cost:</span>
                    <span class="summary-value total-cost">Rs. {{ number_format($order->total_cost, 2) }}</span>
                </li>
                <li class="summary-item">
                    <span class="summary-label">📊 Status:</span>
                    <span class="summary-value">{{ $newStatus }}</span>
                </li>
                <li class="summary-item">
                    <span class="summary-label">📅 Placed On:</span>
                    <span class="summary-value">{{ \Carbon\Carbon::parse($order->date)->toFormattedDateString() }}</span>
                </li>
            </ul>

            @if ($order->tracking_number || $order->tracking_link)
            <div class="tracking-item">
                <div style="font-weight: 600; color: #f57c00; margin-bottom: 10px; font-size: 16px;">
                    🚚 Tracking Information
                </div>

                @if ($order->tracking_number)
                <div class="summary-item">
                    <span class="summary-label">📋 Tracking Number:</span>
                    <span class="summary-value">
                        <span class="tracking-number">{{ $order->tracking_number }}</span>
                    </span>
                </div>
                @endif

                @if ($order->tracking_link)
                <div class="summary-item">
                    <span class="summary-label">🔗 Track Your Order:</span>
                    <span class="summary-value">
                        <a href="{{ $order->tracking_link }}" target="_blank" class="tracking-link">
                            Track Package
                        </a>
                    </span>
                </div>
                @endif
            </div>
            @endif
        </div>

        <div class="footer">
            <p><span class="thank-you">Thank you for shopping with us! 🙏</span></p>
            <p>We appreciate your business and look forward to serving you again.</p>
        </div>
    </div>
</body>
</html>
