<!DOCTYPE html>
<html lang="en" class="color-two font-exo">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> DK-Mart</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="frontend/assets/images/logo/favicon.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="frontend/assets/css/bootstrap.min.css">
    <!-- select 2 -->
    <link rel="stylesheet" href="frontend/assets/css/select2.min.css">
    <!-- Slick -->
    <link rel="stylesheet" href="frontend/assets/css/slick.css">
    <!-- Jquery Ui -->
    <link rel="stylesheet" href="frontend/assets/css/jquery-ui.css">
    <!-- animate -->
    <link rel="stylesheet" href="frontend/assets/css/animate.css">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="frontend/assets/css/aos.css">
    <!-- Main css -->
    <link rel="stylesheet" href="frontend/assets/css/main.css">
</head> 
<body>
    
    @include('includes.navbar-2')

 <!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">My Account</h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="index.html" class="gap-8 text-gray-900 flex-align hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> Account </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->
<!-- =============================== Account Section Start =========================== -->
<section class="account d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container container-lg">

  

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row gy-4 justify-content-center">
            <!-- Login Card Start -->
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="px-24 py-40 border border-gray-100 hover-border-main-600 transition-1 rounded-16">
                    <h6 class="mb-32 text-xl text-center">Login</h6>

                    <!-- Show Error Message -->
        @if ($errors->any())
            <div class="alert alert-danger mb-24">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                    <!--  Email Address -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="email" :value="__('Email Address')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="email" class="common-input w-100" style="box-shadow: none;" type="text" name="email" :value="old('email')" placeholder="Enter your username or email" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="password" :value="__('Password')" />
                        <span class="text-danger">*</span>
                        <div class="position-relative">
                            <x-text-input id="password" class="common-input w-100" type="password" name="password" placeholder="Enter Password" required autocomplete="current-password" />
                            <span class="cursor-pointer toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="toggle-password"></span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-48 mb-24">
                        <div class="flex-wrap gap-3 d-flex align-items-center">
                            <x-primary-button class="px-40 btn py-18">{{ __('Log in') }}</x-primary-button>
                            
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="mt-48 text-center">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-danger-600 fw-semibold hover-text-decoration-underline">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="mt-3 text-center">
                        <p>Don't have an account? 
                            <a href="{{ route('register') }}" class="text-primary">Sign up</a>
                        </p>
                    </div>
                </form>
                </div>
                </div>
            </div>

    </div>
</section>
<!-- =============================== Account Section End =========================== -->


    
    
    
@include('includes.footer')
  

    
    <!-- Jquery js -->
    <script src="frontend/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="frontend/assets/js/boostrap.bundle.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="frontend/assets/js/phosphor-icon.js"></script>
    <!-- Select 2 -->
    <script src="frontend/assets/js/select2.min.js"></script>
    <!-- Slick js -->
    <script src="frontend/assets/js/slick.min.js"></script>
    <!-- Slick js -->
    <script src="frontend/assets/js/count-down.js"></script>
    <!-- jquery UI js -->
    <script src="frontend/assets/js/jquery-ui.js"></script>
    <!-- wow js -->
    <script src="frontend/assets/js/wow.min.js"></script>
    <!-- AOS Animation -->
    <script src="frontend/assets/js/aos.js"></script>
    <!-- marque -->
    <script src="frontend/assets/js/marque.min.js"></script>
    <!-- marque -->
    <script src="frontend/assets/js/vanilla-tilt.min.js"></script>
    <!-- Counter -->
    <script src="frontend/assets/js/counter.min.js"></script>
    <!-- main js -->
    <script src="frontend/assets/js/main.js"></script>

    <!-- JavaScript for Password Toggle -->
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password');

            // Toggle the input type
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('ph-eye-slash');
                toggleIcon.classList.add('ph-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('ph-eye');
                toggleIcon.classList.add('ph-eye-slash');
            }
        });
    </script>

    </body>
</html>