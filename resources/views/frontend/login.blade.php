@extends('frontend.master')

@section('content')

<style>
    .account {
        display: flex;
        margin-right: 0 !important;
        min-height: 85vh;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 576px) {
        .login-card {
            padding: 20px 15px;
        }
    }
</style>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">My Account</h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="{{ url('/') }}" class="gap-8 text-gray-900 flex-align hover-text-main-600">
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
<section class="account">
    <div class="container container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
                <div class="login-card px-4 px-md-5 py-5 border border-gray-100 rounded-16 shadow-sm bg-white">
                    <h6 class="mb-4 text-xl text-center">Login</h6>

                    <!-- Show Error Message -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <x-input-label class="fw-bold" for="email" :value="__('Email Address')" />
                            <span class="text-danger">*</span>
                            <x-text-input id="email" class="common-input w-100" style="box-shadow: none;" type="text" name="email" :value="old('email')" placeholder="Enter your email" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="fw-bold">Password <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input id="password" type="password" name="password" class="common-input w-100"
                                    placeholder="Enter Password" required autocomplete="new-password">

                                <span id="toggle-password"
                                    style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #007bff; font-size: 14px;">
                                    Show
                                </span>
                            </div>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function initPasswordToggle() {
                                const passwordInput = document.getElementById('password');
                                const toggleText = document.getElementById('toggle-password');

                                // Remove previous listeners if any
                                toggleText?.replaceWith(toggleText.cloneNode(true));
                                const newToggle = document.getElementById('toggle-password');

                                newToggle.addEventListener('click', function() {
                                    const isHidden = passwordInput.type === 'password';
                                    passwordInput.type = isHidden ? 'text' : 'password';
                                    newToggle.textContent = isHidden ? 'Hide' : 'Show';
                                });
                            }

                            document.addEventListener('DOMContentLoaded', initPasswordToggle);

                            // Optional: if you're using Livewire, re-init after updates
                            document.addEventListener('livewire:load', initPasswordToggle);
                            document.addEventListener('livewire:update', initPasswordToggle);
                        </script>

                        <!-- Remember Me and Login -->
                        <div class="mt-4 mb-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary px-4 py-2">{{ __('Log in') }}</button>

                            <label for="remember_me" class="mt-3 mt-md-0">
                                <input id="remember_me" type="checkbox" name="remember" class="me-1" />
                                <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <div class="text-center mb-3">
                                <a href="{{ route('password.request') }}" class="text-sm text-danger fw-semibold">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                        @endif

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0">Don't have an account?
                                <a href="{{ route('register') }}" class="text-primary fw-bold">Sign up</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =============================== Account Section End =========================== -->

@endsection
