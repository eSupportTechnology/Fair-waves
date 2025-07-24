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

        .form-input.error {
            border-color: #dc3545;
            background: #fff5f5;
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

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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

        .password-requirements {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #1565c0;
        }

        .password-requirements h4 {
            margin-bottom: 8px;
            font-size: 14px;
            color: #0d47a1;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 16px;
        }

        .password-requirements li {
            margin-bottom: 4px;
        }

        .password-strength {
            height: 4px;
            background: #e1e5e9;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: #ffc107; width: 50%; }
        .strength-good { background: #17a2b8; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }

        .password-match {
            font-size: 12px;
            margin-top: 5px;
            padding: 5px 0;
        }

        .match-success { color: #28a745; }
        .match-error { color: #dc3545; }

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
                Create a new password for your Fair Waves account. Make sure it's strong and secure.
            </p>

            <!-- Status Messages -->
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            <div class="password-requirements">
                <h4>Password Requirements:</h4>
                <ul>
                    <li>At least 8 characters long</li>
                    <li>Include uppercase and lowercase letters</li>
                    <li>Include at least one number</li>
                    <li>Include at least one special character</li>
                </ul>
            </div>

            <form id="resetForm" action="{{ route('password.store') }}" method="POST">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="Enter your email address"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    @error('email')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter your new password"
                        required
                        autocomplete="new-password"
                    />
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    @error('password')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input"
                        placeholder="Confirm your new password"
                        required
                        autocomplete="new-password"
                    />
                    <div class="password-match" id="passwordMatch"></div>
                    @error('password_confirmation')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    Reset Password
                </button>
            </form>

            <div class="back-link">
                <a href="#" onclick="goBack()">← Back to Login</a>
            </div>
        </div>
    </div>

    <script>
        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const strengthBar = document.getElementById('strengthBar');

            // Length check
            if (password.length >= 8) strength += 1;

            // Uppercase check
            if (/[A-Z]/.test(password)) strength += 1;

            // Lowercase check
            if (/[a-z]/.test(password)) strength += 1;

            // Number check
            if (/[0-9]/.test(password)) strength += 1;

            // Special character check
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            // Update strength bar
            strengthBar.className = 'password-strength-bar';
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength === 3) {
                strengthBar.classList.add('strength-fair');
            } else if (strength === 4) {
                strengthBar.classList.add('strength-good');
            } else if (strength >= 5) {
                strengthBar.classList.add('strength-strong');
            }

            return strength;
        }

        // Password match checker
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('passwordMatch');

            if (confirmPassword.length === 0) {
                matchDiv.textContent = '';
                return;
            }

            if (password === confirmPassword) {
                matchDiv.textContent = '✓ Passwords match';
                matchDiv.className = 'password-match match-success';
            } else {
                matchDiv.textContent = '✗ Passwords do not match';
                matchDiv.className = 'password-match match-error';
            }
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
            checkPasswordMatch();
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            checkPasswordMatch();
        });

        // Form submission
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const email = document.getElementById('email').value;

            // Basic validation
            if (!email || !password || !confirmPassword) {
                e.preventDefault();
                alert('Please fill in all fields.');
                return false;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match.');
                return false;
            }

            if (checkPasswordStrength(password) < 3) {
                e.preventDefault();
                alert('Please choose a stronger password.');
                return false;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = 'Resetting Password...';
            submitBtn.disabled = true;
        });

        // Back button functionality
        function goBack() {
            window.location.href = "{{ route('login') }}";
        }

        // Add hover effects
        document.querySelector('.submit-btn').addEventListener('mouseenter', function() {
            if (!this.disabled) {
                this.style.background = 'linear-gradient(135deg, #e55a2b, #e8851a)';
            }
        });

        document.querySelector('.submit-btn').addEventListener('mouseleave', function() {
            if (!this.disabled) {
                this.style.background = 'linear-gradient(135deg, #ff6b35, #f7931e)';
            }
        });
    </script>
</body>
</html>
