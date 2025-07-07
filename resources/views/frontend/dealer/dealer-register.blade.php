@extends ('frontend.master')

@section('content')
    <style>
        .account {
            display: flex;
            margin-right: 0px !important;
        }
    </style>


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
            <form method="POST" action="{{ route('dealer.register') }}">
                @csrf

                <div class="row gy-4 justify-content-center">
                    <!-- Register Card Start -->
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="px-24 py-40 border border-gray-100 hover-border-main-600 transition-1 rounded-16">
                            <h6 class="mb-32 text-xl text-center">Dealer Register</h6>

                            <!-- Name -->
                            {{-- <div class="mb-24">
                        <x-input-label class="fw-bold" for="name" :value="__('Name')" />
                        <span class="text-danger">*</span>
                        <x-text-input id="name" class="common-input w-100" type="text" name="name" :value="old('name')" placeholder="Enter the name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div> --}}

                            <!-- fName -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="fname" :value="__('Frist Name')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="fname" class="common-input w-100" type="text" name="fname"
                                    :value="old('fname')" placeholder="Enter the first name" required autofocus
                                    autocomplete="name" />
                                <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                            </div>

                            <!-- lName -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="lname" :value="__('Last Name')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="lname" class="common-input w-100" type="text" name="lname"
                                    :value="old('lname')" placeholder="Enter the last name" required autofocus
                                    autocomplete="name" />
                                <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="address" :value="__('Address')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="address" class="common-input w-100" type="text" name="address"
                                    :value="old('address')" placeholder="Enter Address" required autocomplete="address" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="dob" :value="__('Date of Birth')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="dob" class="common-input w-100" type="date" name="dob"
                                    :value="old('dob')" placeholder="Enter Date of Birth" required autocomplete="bday" />
                                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="phone" :value="__('Phone Number')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="phone" class="common-input w-100" type="tel" name="phone"
                                    :value="old('phone')" placeholder="Enter Phone Number" required autocomplete="tel" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="email" :value="__('Email address')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="email" class="common-input w-100" type="email" name="email"
                                    :value="old('email')" placeholder="Enter Email Address" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mb-24">
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

                            <!-- dealer code -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="dealer_code" :value="__('Dealer Code')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="dealer_code" class="common-input w-100" type="text" name="dealer_code"
                                    :value="old('dealer_code', $refCode ?? '')" placeholder="Enter the Dealer Code" required autofocus />
                                <x-input-error :messages="$errors->get('dealer_code')" class="mt-2" style="color: red" />
                            </div>


                            <!-- Privacy Policy -->
                            <div class="my-48 text-center">
                                <p class="text-gray-500">Your personal data will be used to process your order, support
                                    your experience throughout this website, and for other purposes described in our
                                    <a href="{{ route('PrivacyPolicy') }}"
                                        class="text-main-600 text-decoration-underline">privacy policy</a>.
                                </p>
                            </div>
                            <!-- Submit Button -->
                            <div class="mt-48 text-center">
                                <x-primary-button type="submit" class="btn btn-primary px-4 py-2">
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
@endsection




</body>

</html>
