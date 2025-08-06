<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Request Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #007bff;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0;
        }
        .status-approved {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .reason-section {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
        .admin-response {
            background-color: #e7f3ff;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #666;
            font-size: 14px;
        }
        .contact-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-container {
                padding: 20px;
            }
            .info-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">FAIR WAVES</div>
            <h2>{{ ucfirst($returnRequest->request_type) }} Request Status Update</h2>
        </div>

        <div style="margin-bottom: 20px;">
            <p>Dear <strong>{{ $returnRequest->customer_name }}</strong>,</p>
            
            @if($status === 'approved')
                <p>We are pleased to inform you that your {{ $returnRequest->request_type }} request has been <span class="status-badge status-approved">Approved</span>.</p>
                
                @if($returnRequest->request_type === 'cancel')
                    <p>Your order cancellation has been processed successfully. If you paid online, a refund will be initiated within 3-5 business days.</p>
                @else
                    <p>Your return request has been approved. Please follow the return instructions that will be sent separately, or contact our customer service for pickup arrangements.</p>
                @endif
            @else
                <p>We regret to inform you that your {{ $returnRequest->request_type }} request has been <span class="status-badge status-rejected">Rejected</span>.</p>
                
                <p>Please review the admin response below for details regarding this decision.</p>
            @endif
        </div>

        <div class="info-section">
            <h3 style="margin-top: 0; color: #007bff;">Request Details</h3>
            <div class="info-row">
                <span class="info-label">Request Type:</span>
                <span class="info-value">{{ ucfirst($returnRequest->request_type) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Code:</span>
                <span class="info-value">{{ $returnRequest->order_code }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Request Date:</span>
                <span class="info-value">{{ $returnRequest->created_at->format('F j, Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value">{{ ucfirst($status) }}</span>
            </div>
            @if($returnRequest->processed_at)
            <div class="info-row">
                <span class="info-label">Processed Date:</span>
                <span class="info-value">{{ $returnRequest->processed_at->format('F j, Y \a\t g:i A') }}</span>
            </div>
            @endif
        </div>

        <div class="reason-section">
            <h4 style="margin-top: 0; color: #856404;">Your {{ $returnRequest->request_type === 'cancel' ? 'Cancellation' : 'Return' }} Reason:</h4>
            <p style="margin-bottom: 0;">{{ $returnRequest->cancel_reason }}</p>
        </div>

        @if($returnRequest->admin_response)
        <div class="admin-response">
            <h4 style="margin-top: 0; color: #007bff;">Administrator Response:</h4>
            <p style="margin-bottom: 0;">{{ $returnRequest->admin_response }}</p>
        </div>
        @endif

        @if($status === 'approved')
            <div class="contact-info">
                <h4 style="color: #28a745;">Next Steps:</h4>
                @if($returnRequest->request_type === 'cancel')
                    <p><strong>Refund Process:</strong> If payment was made online, refund will be processed to your original payment method within 3-5 business days.</p>
                @else
                    <p><strong>Return Process:</strong> Our team will contact you within 24 hours with return instructions and pickup details.</p>
                @endif
                <p>For any questions, please contact our customer service team.</p>
            </div>
        @else
            <div class="contact-info">
                <h4 style="color: #dc3545;">Need Help?</h4>
                <p>If you have questions about this decision or need further assistance, please don't hesitate to contact our customer service team.</p>
            </div>
        @endif

        <div class="footer">
            <p>Thank you for choosing <strong>Fair Waves</strong></p>
            <p>This is an automated email. Please do not reply to this message.</p>
            <p style="font-size: 12px; color: #999;">
                If you have any questions, please contact our customer service team.<br>
                © {{ date('Y') }} Fair Waves. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
