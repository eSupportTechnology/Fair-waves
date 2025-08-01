<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
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
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            margin-bottom: 30px;
        }
        .verify-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .verify-button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .user-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('frontend/assets/images/logo/logo-two-black.png') }}" alt="Logo" class="logo">
            <h1 style="color: #333;">Verify Your Email Address</h1>
        </div>

        <div class="content">
            <p>Dear {{ $userData['fname'] }} {{ $userData['lname'] }},</p>
            
            <p>Thank you for registering with us! To complete your registration, please verify your email address by clicking the button below.</p>

            <div class="user-details">
                <h3>Registration Details:</h3>
                <p><strong>Name:</strong> {{ $userData['fname'] }} {{ $userData['lname'] }}</p>
                <p><strong>Email:</strong> {{ $userData['email'] }}</p>
                <p><strong>Phone:</strong> {{ $userData['phone'] }}</p>
                <p><strong>Address:</strong> {{ $userData['address'] }}</p>
            </div>

            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="verify-button">Verify Email Address</a>
            </div>

            <p>If the button above doesn't work, you can copy and paste the following link into your browser:</p>
            <p style="word-break: break-all; color: #007bff;">{{ $verificationUrl }}</p>

            <p><strong>Note:</strong> This verification link will expire in 60 minutes for security reasons.</p>

            <p>If you didn't create an account with us, please ignore this email.</p>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} Fair Waves. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
