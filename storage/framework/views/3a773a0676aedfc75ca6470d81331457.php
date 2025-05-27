<?php $__env->startSection('content'); ?>




    <style>

          .hero-section {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            margin-bottom: 40px;
            margin-top: 40px;
        }
        .hero-left {
            flex: 1;
            padding: 10px;
            text-align: left;
            animation: fadeIn 2s ease-in-out;
        }
        .hero-left h1, .hero-left h4 {
            margin: 0;
            color: #333;
            animation: slideIn 2s ease-out;
        }
        .hero-left h1 {
            font-size: 36px;
            margin-bottom: 10px;
            color: #bd0f0f;
        }
        .hero-left h4 {
            font-size: 24px;
            margin-bottom: 20px;
            color: orange;
        }
        .persistent-gif {
            display: block; 
            margin: 10px auto 0; 
            width: 250px;  
            height: auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateX(-50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }


        .hero-right {
            flex: 2;
            padding: 20px;
            text-align: justify;
            background-color: #f9fafb;
            font-weight: normal;
        }

        .hero-right strong {
    font-weight: normal;
        }

        .hero-right p {
            opacity: 0;

        }

        .mission-vision-section {
            display: flex;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
            justify-content: space-between;
            margin-bottom: 50px;
            margin-top: 50px;
            text-align: center;
        }
        .box {
            flex: 1;
            padding: 20px;
            background-color: #fdf2f2; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .box h2 {
            margin-top: 0;
            color:  #bd0f0f;
            align: center;
            margin-bottom: 20px;
            position: relative;
            font-size: 1.5rem;
        }
        .box p {
            color: #555;
            text-align: justify;
            line-height: 1.6;
            font-size: 0.9rem;
        }


    .story-section {

    max-width: 1200px;
    margin: 0 auto;
    padding: 40px;
    text-align: center;
    background-color: #fdfdea;

}
.story-title {
    font-size: 14px;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
    position: relative;
    font-size: 1.5rem;
}
.underline-curve {
    width: 80px;
    height: 4px;
    background-color: #bd0f0f;
    margin: 5px auto 10px;
    border-radius: 10px;
    position: relative;
}
.underline-curve::before{
    content: '';
    position: absolute;
    top: -3px;
    left: -10px;
    width: 100px;
    height: 10px;
    background-color:  #bd0f0f;
    border-radius: 20px;
    opacity: 0.5;
}
.story-content {
    display: flex;
    justify-content: center;
    text-align: left;
    max-width: 1200px;
}
.story-text {
    max-width: 1200px;
    column-width: 200px;
    column-count: 2;
    column-gap: 40px;
    font-size: 0.9rem;
    line-height: 1.6;
    color: #333;
    text-align: justify;
}
.team-section img {
    width: 100%;
    height: auto;
}

.values-section {
    text-align: center;
    padding: 40px;
    max-width: 1400px;
    height: auto;
    margin: 0 auto;   
}
.values-section h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
    position: relative;
    font-size: 1.5rem;
}
.values-container {
    display: flex;
    flex-wrap:wrap;
    justify-content: center;
    gap: 20px;   
}
.values-left {
    background-color: #2E1A4B;
    padding: 20px;
    color: white;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    
    
}
.values-item {
    display: flex;
    align-items: center;
    align-items: flex-start;
    text-align: justify;
    margin-bottom: 15px;
}
.values-item img {
    width: 40px;
    height: 40px;
    margin-right: 15px;
}
.values-item h3 {
    color: #c27803;
    font-size: 1.0rem;
    margin-bottom: 0;
    margin-top: 0;
}
.values-item p {
    margin-top: 0;
    margin-bottom: 0;
    color: white;
    text-align: justify;
    font-size: 0.8rem;
}
.values-right {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50%;
    height: auto;
    object-fit: cover;
    display: flex;
    align-items: stretch;
}
.values-right img {
    width: 100%;
    height: auto;
   }
         .promise-section {
            padding: 40px;
            text-align: center;
        }
        .promise-content {
            display: flex;
            align-items: stretch;
            justify-content: center;
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .promise-section h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            position: relative;
            font-size: 1.5rem;
           
        }
       .promise-content img {
            width: 100%;
            height: auto;
            object-fit: cover;
            flex: 1;
            display: flex;
            align-items: stretch;
        }
        .promise-text {
            background-color: #ff6700;
            color: white;
            padding: 20px;
            flex: 1;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .promise-item {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .promise-item i {
            font-size: 24px;
            margin-right: 10px;
        }

       
        .empowering-section {
            text-align: center;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .empowering-section h2 {
           font-size: 28px;
           color: #333;
           margin-bottom: 20px;
           font-weight: bold;
           position: relative;
           font-size: 1.5rem;
           
}

        
        .features-section {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .feature-item {
            text-align: center;
        }
        .feature-item p{
            color: black;
        }
        .feature-item i{
            font-size: 24px;
            margin-bottom: 10px;
        }

    

    @media (max-width: 1024px) {
        .hero-section h1 { font-size: 36px; }
        .hero-section p { font-size: 24px; }
        
    }
    @media (max-width: 768px) {
        .hero-section { padding: 80px 10px; }
        .hero-section h1 { font-size: 28px; }
        .hero-section p { font-size: 18px; }
    }

    </style>

    <!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">About Us</h6>
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
                <li class="text-sm text-main-600"> About Us </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->


<section class="hero-section">
        <div class="hero-left">
            <h1>Delivering happiness on the go!</h1>
            <h4>Happy Shopping</h4>
            <video autoplay loop muted class="persistent-gif">
                <source src="images/aboutgif.mp4" type="video/mp4" style="width:200px; height:auto;">
            </video>
        </div>
       
        <div class="hero-right">
            <p><strong>
                Welcome to DK-Mart, your trusted e-commerce platform where quality, convenience, and affordability meet.
                 We believe that shopping should be a straightforward, enjoyable experience, so we’ve crafted DK-Mart to 
                 bring you a world of products from diverse categories like electronics, fashion, home essentials, and 
                 more, all at your fingertips.
            </strong></p>
            <p><br>
                Founded with the customer in mind, DK-Mart aims to be more than just an online store. Our mission is to 
                redefine the shopping experience by offering a curated selection of high-quality items from top brands 
                and reliable suppliers. Every product in our catalog is carefully chosen to ensure that it meets our
                high standards for quality, durability, and value.
            </p>
           
            <p><br>Thank you for choosing DK-Mart. We’re excited to be your partner in fulfilling 
            your shopping needs, and we look forward to delivering an exceptional online experience every 
            time you visit!<br></p>
        </div>
    </section>

</section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const heroText = document.querySelectorAll(".hero-right p");
            heroText.forEach((p, index) => {
                setTimeout(() => {
                    p.style.opacity = "1";
                }, index * 1000);
            });
        });
    </script>


<section class="story-section">
        <h2 class="story-title">Our Story</h2>
        <div class="story-content">
            <div class="story-text">
                <p>At DK-Mart, we began with a simple vision: to create a marketplace where quality meets convenience.
                     Over the years, we have grown from a small, local store to a renowned online shopping platform, 
                     offering a wide range of products that cater to the diverse needs of our customers. 
                     Our commitment to delivering exceptional products at affordable prices is at the heart of everything we do.We believe in making shopping a hassle-free experience. With a user-friendly website, secure payment
                     options, and fast delivery, we ensure our customers enjoy a seamless shopping experience every time. 
                     
                     </p> 
               
              <p>Whether it's fashion, electronics, home appliances, or everyday essentials, DK-Mart provides a
                     one-stop shop for all your needs.As we continue to expand, we remain focused on our mission of providing high-quality products and 
                    outstanding customer service. Our story is one of growth, passion, and dedication to our customers,
                     and we are excited for the future ahead. Thank you for being a part of our journey!</p>
            </div>
        </div>
    </section>


<div class="container values-section">
    <h2>Our Values</h2>
    
    <div class="values-container">
        <div class="values-left">
            <div class="values-item">
                <img src="images/embrace-change.png" alt="images">
                <div>
                <h3>Embrace Change</h3>
                <p>We embrace and anticipate change. Change is growth, and growth is what drives us every day.</p>
                </div>
            </div>
            <div class="values-item">
                <img src="images/teamwork.png" alt="images">
                <div>
                <h3>Teamwork</h3>
                <p>We think as a team, work as a team, and grow as a team. The power of our team allows
                     ordinary people to achieve extraordinary things.</p></div>
            </div>
            <div class="values-item">
                <img src="images/customer.png" alt="images">
                <div>
                <h3>Customer Commitment</h3>
                <p>We believe in giving the best to our customers, sellers, and society.</p></div>
            </div>
            <div class="values-item">
                <img src="images/intergrity.png" alt="images">
                <div>
                <h3>Integrity</h3>
                <p>We treat our partners and each other with mutual respect and work with utmost honesty.</p></div>
            </div>
            <div class="values-item">
                <img src="images/ownership.png" alt="images">
                <div>
                <h3>Ownership</h3>
                <p>We know our priorities, and when we do something, we do it with focus and perseverance.</p></div>
            </div>
        </div>
        <div class="values-right">
        <img src="images/abt1.jpg" alt="images">
        </div>
    </div>
</div>

<section class="mission-vision-section">
        <div class="box">
            <h2>Our Mission</h2>
            
            <p>At DK-Mart, our mission is to empower our customers by providing an exceptional online shopping 
                experience through high-quality, affordable products and outstanding service. We are committed 
                to building a trusted platform where convenience, quality, and customer satisfaction come first,
                 ensuring that our customers can find everything they need in one place. We aim to foster
                 long-lasting relationships with our customers by continually improving our offerings and 
                 upholding our commitment to excellence.</p>
        </div>
        <div class="box">

            <h2>Our Vision</h2> 
            <p>Our vision is to become a leader in e-commerce by setting new standards in quality, affordability,
                 and customer experience. We aspire to be recognized not only for our wide range of products but 
                 also for our integrity, reliability, and innovation. Through continuous growth, expansion, and 
                 the adoption of cutting-edge technology, we aim to transform DK-Mart into a global destination 
                 for all online shopping needs, helping customers simplify their lives and make informed, 
                 satisfying choices.</p>
        </div>
    </section>

<section class="promise-section">
        <h2>Our Promise</h2>
        
        </div>
        <div class="promise-content">
            <img src="images/aboutus1.jpg" alt="images">
            <div class="promise-text">
                <div class="promise-item">
                    <i class="icon">📱</i>
                    <div>
                        <strong>Biggest Variety</strong><br>
                        We offer millions of products at a great value for our customers.
                    </div>
                </div>
                <div class="promise-item">
                    <i class="icon">💲</i>
                    <div>
                        <strong>Best Prices</strong><br>
                        We provide great value by offering competitive prices on all our products.
                    </div>
                </div>
                <div class="promise-item">
                    <i class="icon">⚡</i>
                    <div>
                        <strong>Ease & Speed</strong><br>
                        Download the app for a smooth shopping experience.
                    </div>
                </div>
                <div class="promise-item">
                    <i class="icon">🚚</i>
                    <div>
                        <strong>Fast Delivery</strong><br>
                        We aim to please our customers with fast delivery and easy tracking.
                    </div>
                </div>
                <div class="promise-item">
                    <i class="icon">🔒</i>
                    <div>
                        <strong>100% Protected</strong><br>
                        We provide 100% protection for your purchase from click to delivery.
                    </div>
                </div>
            </div>
        </div>
</section>

    
    <section class="empowering-section">
        <h2>Supporting Sellers at DK-Mart</h2>
        
        <p>At DK-Mart, we are dedicated to helping sellers grow their businesses with ease. Our platform offers a
            range of tools and services that make selling online simple and efficient. We provide seamless product
             management, secure payment options, and valuable customer support, ensuring our sellers succeed every 
             step of the way.</p>

        <p>We empower our sellers with advanced features like inventory tracking, promotional tools, and performance 
            insights, helping them reach more customers and boost sales. </p>

        <p>With a commitment to fast shipping and secure transactions, DK-Mart offers a reliable marketplace for both 
            new and experienced sellers to thrive. Join us at DK-Mart, where your business can flourish and achieve 
            lasting success.</p>
    </section>

    <section class="features-section">
        <div class="feature-item">
            <i>✅</i>
            <p>Genuine Products</p>
        </div>
        <div class="feature-item">
            <i>💳</i>
            <p>Safe & Secure Payments</p>
        </div>
        <div class="feature-item">
            <i>🔄</i>
            <p>Free & Easy Return</p>
        </div>
    </section>



    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const heroText = document.querySelector(".hero-section p");
        setTimeout(() => {
            heroText.style.opacity = "1";
        }, 4000); 
    });
</script>
<?php $__env->stopSection(); ?>
    
    
  

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/frontend/about.blade.php ENDPATH**/ ?>