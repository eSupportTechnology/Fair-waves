
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/web-app-manifest-192x192.png') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="backend/assets1/css/main.css?v=6.0" />
    <style>
        
        /* Styling for the select dropdown to match input fields */
        select {
            border: 0.5px solid #ced4da;
            padding: 0.375rem 0.75rem;
            border-radius: 0.5rem;
            height:4em;
        }
    </style>

<body>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span> Register Page
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-10 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Affiliate Account</h1>
                                            <p class="mb-30">Already have an account? <a href="page-login.html">Login</a></p>
                                        </div>
                                        <form  method="POST" action="{{ route('affiliate.register') }}">
                                            @csrf
                                            <!-- Basic Information Section -->
                                            <h4>Basic Information</h4>
                                            <hr>

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="name" placeholder="Name" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" name="address" placeholder="Address" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="district">District</label>
                                                <input type="text" id="district" name="district" placeholder="District" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <div style="display:flex; gap:10px;">
                                                    <input type="number" name="dob_day" placeholder="Day" required />
                                                    <input type="number" name="dob_month" placeholder="Month" required />
                                                    <input type="number" name="dob_year" placeholder="Year" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" required>
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" id="email" name="email" placeholder="Email Address" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_num">Phone Number</label>
                                                <input type="text" id="phone_num" name="phone_num" placeholder="Phone Number" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="NIC">NIC</label>
                                                <input type="text" id="NIC" name="NIC" placeholder="NIC" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" placeholder="Password" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required />
                                            </div>

                                            <!-- Promotion Methods Section -->
                                            <h4>Promotion Methods</h4>
                                            <hr>

                                            <div class="form-group">
                                                <label>Promotion Method:</label><br>
                                                <label style="display: inline-block; margin-right: 15px;">
                                                    <input type="checkbox" name="promotion_method[]" value="Instagram" style="height: 1.2em; width: 1.2em;" /> Instagram
                                                </label>
                                                <label style="display: inline-block; margin-right: 15px;">
                                                    <input type="checkbox" name="promotion_method[]" value="Facebook" style="height: 1.2em; width: 1.2em;" /> Facebook
                                                </label>
                                                <label style="display: inline-block; margin-right: 15px;">
                                                    <input type="checkbox" name="promotion_method[]" value="TikTok" style="height: 1.2em; width: 1.2em;" /> TikTok
                                                </label>
                                                <label style="display: inline-block; margin-right: 15px;">
                                                    <input type="checkbox" name="promotion_method[]" value="YouTube" style="height: 1.2em; width: 1.2em;" /> YouTube
                                                </label>
                                                <label style="display: inline-block; margin-right: 15px;">
                                                    <input type="checkbox" name="promotion_method[]" value="Content website/blog" style="height: 1.2em; width: 1.2em;" /> Content website/blog
                                                </label>
                                                <label style="display: inline-block; margin-right: 15px;">
                                                    <input type="checkbox" name="promotion_method[]" value="WhatsApp" style="height: 1.2em; width: 1.2em;" /> Through WhatsApp groups and status
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram_url">Instagram Profile URL</label>
                                                <input type="url" id="instagram_url" name="instagram_url" placeholder="Instagram Profile URL" />
                                            </div>
                                            <div class="form-group">
                                                <label for="facebook_url">Facebook Page URL</label>
                                                <input type="url" id="facebook_url" name="facebook_url" placeholder="Facebook Page URL" />
                                            </div>
                                            <div class="form-group">
                                                <label for="tiktok_url">TikTok Profile URL</label>
                                                <input type="url" id="tiktok_url" name="tiktok_url" placeholder="TikTok Profile URL" />
                                            </div>
                                            <div class="form-group">
                                                <label for="youtube_url">YouTube Channel URL</label>
                                                <input type="url" id="youtube_url" name="youtube_url" placeholder="YouTube Channel URL" />
                                            </div>
                                            <div class="form-group">
                                                <label for="content_website_url">Content Website/Blog URL</label>
                                                <input type="url" id="content_website_url" name="content_website_url" placeholder="Content Website/Blog URL" />
                                            </div>
                                            <div class="form-group">
                                                <label for="content_whatsapp_url">Content WhatsApp Group URL</label>
                                                <input type="url" id="content_whatsapp_url" name="content_whatsapp_url" placeholder="Content WhatsApp Group URL" />
                                            </div>

                                            <!-- Payment Information Section -->
                                            <h4>Payment Information</h4>
                                            <hr>

                                            <div class="form-group">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" id="bank_name" name="bank_name" placeholder="Bank Name" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="branch">Branch</label>
                                                <input type="text" id="branch" name="branch" placeholder="Branch" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="account_name">Account Name</label>
                                                <input type="text" id="account_name" name="account_name" placeholder="Account Name" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="account_number">Account Number</label>
                                                <input type="text" id="account_number" name="account_number" placeholder="Account Number" required />
                                            </div>

                                            <!-- Terms of Service and Privacy Policy Agreement -->
                                            <div class="form-group">
                                                <input type="checkbox" id="terms" name="terms" required style="height: 1.2em; width: 1.2em;" />
                                                <label for="terms">I agree to the <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>.</label>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold">Submit &amp; Register</button>
                                            </div>

                                            <p class="font-xs text-muted"><strong>Note:</strong> Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Vendor JS-->
    <script src="backend/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="backend/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="backend/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="backend/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="backend/js/plugins/slick.js"></script>
    <script src="backend/js/plugins/jquery.syotimer.min.js"></script>
    <script src="backend/js/plugins/wow.js"></script>
    <script src="backend/js/plugins/perfect-scrollbar.js"></script>
    <script src="backend/js/plugins/magnific-popup.js"></script>
    <script src="backend/js/plugins/select2.min.js"></script>
    <script src="backend/js/plugins/waypoints.js"></script>
    <script src="backend/js/plugins/counterup.js"></script>
    <script src="backend/js/plugins/jquery.countdown.min.js"></script>
    <script src="backend/js/plugins/images-loaded.js"></script>
    <script src="backend/js/plugins/isotope.js"></script>
    <script src="backend/js/plugins/scrollup.js"></script>
    <script src="backend/js/plugins/jquery.vticker-min.js"></script>
    <script src="backend/js/plugins/jquery.theia.sticky.js"></script>
    <script src="backend/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="backend/assets1/js/main.js?v=6.0"></script>
    <script src="backend/assets1/js/shop.js?v=6.0"></script>
</body>
</html>
