<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Fair Waves</title>
    <link rel="icon" sizes="16x16" href="{{ asset('frontend\newstyle\assets\images\Fire Waves LOGO.png') }}" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #ff6b35, #f7931e);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #ff6b35;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .tagline {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-section {
            margin-top: 30px;
        }

        .description {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #ff6b35;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 107, 53, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #ff6b35;
        }

        .status-message {
            background: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
            font-size: 14px;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 8px;
            border-left: 4px solid #dc3545;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 25px;
                margin: 10px;
            }

            .logo {
                width: 180px;
            }

            .company-name {
                font-size: 24px;
            }
        }

        .wave-decoration {
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .wave-decoration:nth-child(2) {
            top: -30px;
            right: -30px;
            left: auto;
            bottom: auto;
            background: radial-gradient(circle, rgba(247, 147, 30, 0.1) 0%, transparent 70%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wave-decoration"></div>
        <div class="wave-decoration"></div>

        <div class="logo-section">
            <img src="{{ asset('frontend/newstyle/assets/images/logo.png') }}"
                                             alt="logo" class ="logo" />
        </div>

        <div class="form-section">
            <p class="description">
                Forgot your password? No problem. Just enter your email address and we'll send you a password reset link to get you back on track.
            </p>

            <!-- Success Status Message -->
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            <form id="resetForm" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="Enter your email address"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                    @error('email')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    Send Reset Link
                </button>
            </form>

            <div class="back-link">
                <a href="#" onclick="goBack()">← Back to Login</a>
            </div>
        </div>
    </div>

    <script>
        // Form validation (basic client-side validation)
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;

            if (!email) {
                e.preventDefault();
                // Create and show error message
                showError('Please enter your email address.');
                return false;
            }

            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                showError('Please enter a valid email address.');
                return false;
            }

            // Show loading state
            const submitBtn = this.querySelector('.submit-btn');
            submitBtn.innerHTML = 'Sending...';
            submitBtn.disabled = true;
        });

        // Function to show error messages
        function showError(message) {
            // Remove any existing error messages
            const existingError = document.querySelector('.client-error-message');
            if (existingError) {
                existingError.remove();
            }

            // Create new error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message client-error-message';
            errorDiv.textContent = message;

            // Insert after the email input
            const emailInput = document.getElementById('email');
            emailInput.parentNode.appendChild(errorDiv);
        }

        // Back button functionality
        function goBack() {
            // In a real application, this would navigate to your login page
            window.location.href = "{{ route('login') }}";
        }

        // Add some interactive effects
        document.querySelector('.submit-btn').addEventListener('mouseenter', function() {
            this.style.background = 'linear-gradient(135deg, #e55a2b, #e8851a)';
        });

        document.querySelector('.submit-btn').addEventListener('mouseleave', function() {
            this.style.background = 'linear-gradient(135deg, #ff6b35, #f7931e)';
        });
    </script>
</body>
</html>
