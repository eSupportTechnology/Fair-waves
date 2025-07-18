@extends ('frontend.master')

@section('content')

<style>
    /* Reset and Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    .site-common-con {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Navigation Styles */
    .nav-ash {
        background-color: #f1f1f1;
        padding: 10px 0;
    }

    .breadcrumb {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .breadcrumb-item {
        font-size: 14px;
    }

    .breadcrumb-item a {
        color: rgb(0, 0, 0);
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #777;
    }

    .breadcrumb-item+.breadcrumb-item:before {
        content: "/";
        padding: 0 8px;
        color: #777;
    }

    /* Content Styles */
    .mt-5 {
        margin-top: 3rem;
    }

    .mt-3 {
        margin-top: 2rem;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .col-12,
    .col-xl-6,
    .col-xl-12,
    .col-sm-12 {
        padding: 0 15px;
        width: 100%;
    }

    @media (min-width: 1200px) {
        .col-xl-6 {
            width: 50%;
        }
    }

    .page-title-wrap {
        color: rgb(0, 0, 0);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .text-center {
        text-align: center;
    }

    .about-sub-head {
        color: rgb(0, 0, 0);
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        line-height: 1.4;
    }

    .common-p {
        font-size: 1rem;
        margin-bottom: 1.5rem;
        color: #555;
    }

    .about-img {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Fact Check Section */
    .about-img-set {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 5rem;
    }

    .about-box {
        flex: 1;
        min-width: 300px;
        max-width: 100%;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .about-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }


    .about-box:hover {
        transform: translateY(-10px);
    }


    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .about-img-set {
            flex-direction: column;
            align-items: center;
        }

        .about-box {
            margin-bottom: 20px;
        }
    }
</style>

<div class="mb-0 breadcrumb py-26 bg-main-two-50" style="margin-top: 100px">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">About Us</h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="/" class="gap-8 text-gray-900 flex-align hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> About As </li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-5 site-common-con" style="
    padding-top: 50px;
">
    <div class="row" style="
    padding-top: 50px;
">
        <div class="col-12 col-xl-6">
            <h1 class="page-title-wrap">About Us</h1>
            <h3 class="about-sub-head">We, at CROWN ELECTRONICS, offer you the convenience of browsing, purchasing, and
                reserving products & services from across the Abans Group of Companies.</h3>
            <p class="common-p">Our virtual store boasts an endless array of globally recognizable brands and includes
                only authentic products. We guarantee that our discounts are genuine, and your payments are secured. Our
                delivery teams cover the entirety of Sri Lanka, and our friendly staff are always ready to provide you
                after-sales support through extensive network of over a hundred Abans service centers.</p>
            <!-- <p class="common-p">Established in March 2007, Buyabans.com operates from Abans headquarters in Colombo, Sri
                Lanka, and also serves customers purchasing from UK, Australia, USA, Italy, etc., for their loved ones
                in Sri Lanka. Echoing our parent company Abans PLC's values of reliability, value-for-money, and honesty
                in service, with the best online shopping experience with access to the best products at the best prices
                to suit all your needs.</p> -->
        </div>
        <div class="col-12 col-xl-6">
            <img class="about-img" src="http://images.unsplash.com/photo-1554469384-e58fac16e23a?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9"
                alt="Abans Building">
        </div>
    </div>

    <div class="mt-3 row" style="
    padding-top: 50px;
">
        <div class="col-xl-12">
            <h2 class="text-center page-title-wrap">CROWN ELECTRONICS Fact Check</h2>
        </div>
    </div>

    <div class="about-img-set">
        <div class="about-box">
            <img src="https://buyabans.com/themes/buyabans/assets/images/diverse-sectors.webp" alt="5 Diverse Sectors">
        </div>
        <div class="about-box">
            <img src="https://buyabans.com/themes/buyabans/assets/images/31.webp" alt="40+ Renowned Brands">
        </div>
        <div class="about-box">
            <img src="https://buyabans.com/themes/buyabans/assets/images/32.webp" alt="400+ Showrooms">
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <p class="text-center common-p">We continuously strive to innovate, improving the range of products and
                services
                available online for our customers and we ensure that product information is as up-to-date and accurate
                as possible. We continue to drive our efforts towards the goal of becoming the leading online platform
                in Sri Lanka for customers to purchase products and services from anywhere in the world.</p>
        </div>

    </div>
    <br>
</div>

</section>
<!-- End About Area -->
@endsection
