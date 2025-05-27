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
<section class="account d-flex justify-content-center align-items-center py-80" style="min-height: 100vh;">
    <div class="container container-lg">
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row gy-4 justify-content-center">
            <!-- Register Card Start -->
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="px-24 py-40 border border-gray-100 hover-border-main-600 transition-1 rounded-16">
                    <h6 class="mb-32 text-xl text-center">Register</h6>

                    <!-- Name -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="name" :value="__('Name')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="name" class="common-input w-100" type="text" name="name" :value="old('name')" placeholder="Enter the name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="address" :value="__('Address')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="address" class="common-input w-100" type="text" name="address" :value="old('address')" placeholder="Enter Address" required autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="dob" :value="__('Date of Birth')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="dob" class="common-input w-100" type="date" name="dob" :value="old('dob')" placeholder="Enter Date of Birth" required autocomplete="bday" />
                        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="phone" :value="__('Phone Number')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="phone" class="common-input w-100" type="tel" name="phone" :value="old('phone')" placeholder="Enter Phone Number" required autocomplete="tel" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="email" :value="__('Email address')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="email" class="common-input w-100" type="email" name="email" :value="old('email')" placeholder="Enter Email Address" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-24">
                        <x-input-label class="fw-bold" for="password" :value="__('Password')" />
                        <span class="text-danger">*</span>
                        <div class="position-relative">
                            <x-text-input id="password" class="common-input w-100" type="password" name="password" placeholder="Enter Password" required autocomplete="new-password" />
                            <span class="cursor-pointer toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="toggle-password"></span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Privacy Policy -->
                    <div class="my-48 text-center">
                        <p class="text-gray-500">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our 
                            <a href="{{ route('privacy-policy') }}"  class="text-main-600 text-decoration-underline">privacy policy</a>.
                        </p>
                    </div>
                    <!-- Submit Button -->
                    <div class="mt-48 text-center">
                        <x-primary-button type="submit" class="px-40 btn py-18">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                    <div class="mt-3 text-center">
                        <p>Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary">Login</a>
                        </p>
                </div>
            </div>
            <!-- Register Card End -->
        </div>
    </form>

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