@extends('frontend.master')

@section('content')
<style>
 /* Privacy Policy Section Styling */

.privacy-policy {
    padding: 20px ;
    margin-bottom: 20px;
    margin-top: 20px;
    background: #fff;
   
}
.privacy-policy h1 {
    font-size: 32px;
    color: #333;
    text-align: center;
    font-weight: 700;
    margin-top: 20px;
    
}
.privacy-policy h2 {
    font-size: 24px;
    color: #444;
    margin-top: 30px;
    border-left: 4px solid #ffa500;
    padding-left: 15px;
}
.privacy-policy p {
    font-size: 16px;
    color: #555;
    line-height: 1.8;
    text-align: justify;
    margin: 15px 0;
}
.privacy-policy ul {
    margin: 20px 0;
    padding-left: 40px;
}
.privacy-policy ul li {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
    list-style-type: disc;
}
.privacy-policy ul li::marker {
    color: #ffa500;
}


/* Responsive Design */
@media (max-width: 768px) {
    .privacy-policy h1 {
        font-size: 28px;
    }
    .privacy-policy h2 {
        font-size: 20px;
    }
    .privacy-policy p, .privacy-policy ul li {
        font-size: 14px;
    }
}
 
</style>
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">Privacy Policy</h6>
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
                <li class="text-sm text-main-600"> Privacy Policy</li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->
<!-- ========================= Privacy Policy Content =============================== -->
<div class="container privacy-policy">
    <h1>Privacy Policy</h1>
    <p>
        Welcome to DK-Mart, your trusted online shopping destination. This Privacy Policy outlines how we collect, use, 
        and protect your personal information. By accessing our website, you agree to the terms outlined in this policy.
    </p>

    <h2>1. Information We Collect</h2>
    <p>
        We collect your personal details such as name, email, phone number, and address to enhance your shopping experience. 
        We also collect non-personal information like browser type and IP address for analytics.
    </p>

    <h2>2. How We Use Your Information</h2>
    <ul>
        <li>To process your orders and manage your account.</li>
        <li>To improve our website and personalize your shopping experience.</li>
        <li>To send promotional emails about new products and offers.</li>
    </ul>

    <h2>3. Information Sharing</h2>
    <p>
        We do not sell or rent your personal information to third parties. However, we may share it with trusted partners for 
        order delivery, payment processing, or legal obligations.
    </p>

    <h2>4. Data Security</h2>
    <p>
        We implement advanced security measures to protect your data. However, no method of transmission over the Internet 
        is 100% secure.
    </p>

    <h2>5. Your Rights</h2>
    <ul>
        <li>Access and update your personal information.</li>
        <li>Opt-out of promotional communications.</li>
        <li>Request data deletion under certain conditions.</li>
    </ul>

    <h2>6. Changes to This Policy</h2>
    <p>
        We reserve the right to update this policy at any time. Changes will be communicated on this page.
    </p>

    <h2>7. Contact Us</h2>
    <p>
        If you have any questions regarding this Privacy Policy, please contact us at:
    </p>
    <div class="contact-info">
        <ul>
            <li>
                <strong>Phone:</strong> 
                <a href="tel:0787004900" style="color: hsl(0, 92%, 36%); text-decoration: none;">
                    0787004900
                </a>
            </li>
            <li>
                <strong>Email:</strong> 
                <a href="mailto:admin@dkmart.lk" style="color:hsl(0, 92%, 36%); text-decoration: none;">
                    admin@dkmart.lk
                </a>
            </li>
            <li>
                <strong>Address:</strong> No.57, Horana Road, Moragahahena.
            </li>
        </ul>
    </div>
    
</div>

@endsection
