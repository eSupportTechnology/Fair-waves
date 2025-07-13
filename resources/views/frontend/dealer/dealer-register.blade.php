@extends ('frontend.master')

@section('content')
    <style>
        .account {
            display: flex;
            margin-right: 0px !important;
        }
        
        .shop-name-validation {
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            border: 1px solid transparent;
        }
        
        .shop-name-validation.success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .shop-name-validation.error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        .shop-name-validation.loading {
            background-color: #e2e3e5;
            border-color: #d6d8db;
            color: #6c757d;
        }
        
        .form-control.error {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .form-control.success {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
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
            <form method="POST" action="{{ route('dealer.register.submit') }}">
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

                            <!-- Gender -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="gender" :value="__('Gender')" />
                                <span class="text-danger">*</span>
                                <select id="gender" name="gender" class="common-input w-100" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- Shop Name -->
                            <div class="mb-24">
                                <x-input-label class="fw-bold" for="shop_name" :value="__('Shop Name')" />
                                <span class="text-danger">*</span>
                                <x-text-input id="shop_name" class="common-input w-100" type="text" name="shop_name"
                                    :value="old('shop_name')" placeholder="Enter Your Shop Name" required />
                                <div id="shop-name-validation-message" class="mt-2"></div>
                                <x-input-error :messages="$errors->get('shop_name')" class="mt-2" />
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

                            <script>
                                // Shop name validation
                                document.addEventListener('DOMContentLoaded', function() {
                                    const shopNameInput = document.getElementById('shop_name');
                                    const validationMessage = document.getElementById('shop-name-validation-message');
                                    const submitButton = document.querySelector('button[type="submit"]');
                                    let validationTimeout;
                                    let isShopNameValid = false;

                                    // Get CSRF token
                                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                                     document.querySelector('input[name="_token"]')?.value;

                                    function showValidationMessage(message, status) {
                                        validationMessage.innerHTML = `<div class="shop-name-validation ${status}">${message}</div>`;
                                        
                                        // Update input styling
                                        shopNameInput.classList.remove('error', 'success');
                                        if (status === 'success') {
                                            shopNameInput.classList.add('success');
                                            isShopNameValid = true;
                                        } else if (status === 'error') {
                                            shopNameInput.classList.add('error');
                                            isShopNameValid = false;
                                        } else {
                                            isShopNameValid = false;
                                        }
                                        
                                        updateSubmitButton();
                                    }

                                    function updateSubmitButton() {
                                        // Don't disable submit button - let server-side validation handle it
                                        // This way the form can still be submitted for server-side validation
                                        if (submitButton) {
                                            if (shopNameInput.value.trim() === '') {
                                                submitButton.disabled = true;
                                                submitButton.style.opacity = '0.6';
                                            } else {
                                                submitButton.disabled = false;
                                                submitButton.style.opacity = '1';
                                            }
                                        }
                                    }

                                    function validateShopName(shopName) {
                                        if (!shopName.trim()) {
                                            showValidationMessage('Shop name is required.', 'error');
                                            return;
                                        }

                                        if (shopName.length < 3) {
                                            showValidationMessage('Shop name must be at least 3 characters long.', 'error');
                                            return;
                                        }

                                        // Show loading message
                                        showValidationMessage('Checking availability...', 'loading');

                                        fetch('{{ route("dealer.check.shop.name") }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken,
                                                'Accept': 'application/json'
                                            },
                                            body: JSON.stringify({
                                                shop_name: shopName
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            showValidationMessage(data.message, data.available ? 'success' : 'error');
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            showValidationMessage('Error checking shop name availability. Please try again.', 'error');
                                        });
                                    }

                                    // Real-time validation with debounce
                                    shopNameInput.addEventListener('input', function() {
                                        clearTimeout(validationTimeout);
                                        const shopName = this.value.trim();
                                        
                                        if (shopName === '') {
                                            showValidationMessage('Shop name is required.', 'error');
                                            return;
                                        }

                                        validationTimeout = setTimeout(() => {
                                            validateShopName(shopName);
                                        }, 800); // 800ms delay for better UX
                                    });

                                    // Validate on blur
                                    shopNameInput.addEventListener('blur', function() {
                                        clearTimeout(validationTimeout);
                                        const shopName = this.value.trim();
                                        if (shopName) {
                                            validateShopName(shopName);
                                        }
                                    });

                                    // Initial validation if there's already a value (for old input)
                                    if (shopNameInput.value.trim()) {
                                        validateShopName(shopNameInput.value.trim());
                                    } else {
                                        updateSubmitButton();
                                    }

                                    // Remove the form submission prevention - let server handle validation
                                    // This ensures the form can be submitted for server-side validation
                                });
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
