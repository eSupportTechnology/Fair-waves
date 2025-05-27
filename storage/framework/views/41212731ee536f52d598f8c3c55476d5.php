<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Reply</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .email-container {
            width: 100%;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }
        blockquote {
            font-style: italic;
            border-left: 4px solid #2980b9;
            padding-left: 10px;
            margin-left: 0;
            color: #555;
            background-color: #f0f8ff;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-content">
            <h2>Dear <?php echo e($inquiry->full_name); ?>,</h2>
            <p>Thank you for reaching out to us. We have received your inquiry regarding the subject <strong>"<?php echo e($inquiry->subject); ?>"</strong>.</p>
            
            <p>We value your input and appreciate the time you took to get in touch with us. Below is our response to your inquiry:</p>

            <blockquote>
                <p><?php echo e($inquiry->reply); ?></p>
            </blockquote>

            <p>If you have any further questions or need additional assistance, feel free to reach out to us at any time. We are here to help!</p>

            <p>Thank you for your continued trust in our services.</p>

            <p>Best regards,</p>
            <p><strong>The Customer Support Team</strong></p>
            <p><em>Your Company Name</em></p>

            <div class="footer">
                <p>&copy; <?php echo e(date('Y')); ?> Your Company Name. All rights reserved.</p>
                <p>Visit our website: <a href="https://dkmart.lk">dkmart.lk</a></p>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/AdminDashboard/emails/inquiry_reply.blade.php ENDPATH**/ ?>