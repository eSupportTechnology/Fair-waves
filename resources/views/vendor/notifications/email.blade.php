<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset | Fair Waves</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .logo {
            text-align: center;
            margin-bottom: 1rem;
        }
        .logo img {
            max-width: 200px;
        }
        h1 {
            font-size: 24px;
            color: #f15a24;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 12px 24px;
            background-color: #f15a24;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .footer {
            margin-top: 2rem;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
        .subcopy {
            word-break: break-word;
            font-size: 14px;
            color: #555;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="logo">
            <img src="{{ asset('frontend/newstyle/assets/images/logo.png') }}"alt="logo"/>
        </div>

        <h1>Hi there!</h1>

        <p>
            You are receiving this email because we received a password reset request for your account.
        </p>

        <p style="text-align: center;">
            <a href="{{ $actionUrl }}" class="btn">Reset Password</a>
        </p>

        <p>
            This password reset link will expire in 60 minutes.<br>
            If you did not request a password reset, no further action is required.
        </p>

        <div class="subcopy">
            If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:<br>
            <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
        </div>

        <div class="footer">
            Regards,<br>
            <strong>Fair Waves</strong><br>
            Enjoy life with the waves 🌊
        </div>
    </div>
</body>
</html>
