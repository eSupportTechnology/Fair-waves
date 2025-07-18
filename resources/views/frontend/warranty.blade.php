@extends('frontend.master')

@section('content')
<main class="content-container">

    <style>
        .spacing-top {
            height: 120px;
            /* Adjust based on desired spacing */
        }

        .monial-graph {
            list-style-type: circle;
        }

        @media (max-width: 768px) {
            .spacing-top {
                height: 60px;
            }
        }

        .table-container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .styled-table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .styled-table th,
        .styled-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #e0e0e0;
            vertical-align: top;
        }

        .styled-table th {
            background-color: rgba(170, 170, 170, 0.64);
            color: white;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            width: 30%;
        }

        .styled-table td {
            color: #333;
            font-size: 16px;
            line-height: 1.5;
        }

        .styled-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .styled-table tr:hover {
            background-color: #f1f1f1;
        }

        .styled-table ul {
            margin: 0;
            padding-left: 20px;
        }

        .styled-table ul li {
            margin-bottom: 10px;
        }

        @media (max-width: 600px) {

            .styled-table th,
            .styled-table td {
                font-size: 14px;
                padding: 10px;
            }

            .styled-table th {
                width: 40%;
            }
        }

        @media (max-width: 400px) {
            .styled-table {
                font-size: 12px;
            }

            .styled-table th,
            .styled-table td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .styled-table th {
                text-align: center;
            }
        }
    </style>

    <div class="spacing-top"></div>



    <div class="mb-0 breadcrumb py-26 bg-main-two-50">
        <div class="container container-lg">
            <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
                <h6 class="mb-0">Warranty Information</h6>
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
                    <li class="text-sm text-main-600"> Warranty Information </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="site-common-con">
        <div class="row">
            <div class="col-md-3 terms-nav">
                <div class="nav flex-column nav-pills" id="v-pills-tab" aria-orientation="vertical">
                    <a class="nav-link " id="v-pills-one-tab" href="faq">FAQ</a>

                    <a class="nav-link " id="v-pills-two-tab" href="buy">How To Buy</a>

                    <a class="nav-link " id="v-pills-three-tab" href="shipping-delivery">Shipping & Delivery</a>

                    <a class="nav-link  active " id="v-pills-three-tab" href="warranty">Warranty Information</a>

                    <a href="return-product" class="nav-link " id="v-pills-four-tab" href="return-product">Return
                        Products</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content terms-tab" id="v-pills-tabContent">
                    <div class="tab-pane fade " id="v-pills-one" role="tabpanel" aria-labelledby="v-pills-one-tab">
                        <div id="accordion" role="tablist">

                            <div class="content-section">
                                <h3 class="title-terms">Frequently Asked Questions</h3>

                                <ol>
                                    <li class="title-other">Do I need to create a user account to buy products on
                                        BuyAbans.com?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>No. You can browse and purchase what you want as a guest. However, by
                                                registering as a user, you can make your online shopping experience even
                                                better by earning & spending customer Loyalty points for special
                                                discounts, saving items to your Wish List to buy later, keeping track of
                                                past & current orders, and more. </li>
                                        </ol>
                                    </li>
                                    <li class="title-other">Are my online transactions safe?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>Yes. We utilize the latest in digital encryption &amp; web technology to
                                                ensure that your transactions are secure and your personal details are
                                                safe when
                                                you shop at BuyAbans.com. You can read our <a href="policy.html">Privacy
                                                    Policy</a> here for more details on how we keep your personal
                                                details
                                                safe.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">What payment methods can I use?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>We accept Visa/MasterCard/AMEX credit &amp; debit cards, FriMi &amp;
                                                Dialog
                                                genie digital wallets, bank transfers and cash on delivery payments.
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="title-other">Can I pay in installments?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>Yes. We offer Easy Payment Plans for up to 60 Months with Interest-Free
                                                Payments Plans available up to 48 Months for credit cardholders. You can
                                                view the available payment plans on the product page and select your
                                                preference during Check Out.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">How do I track/check the status of my order?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>Simply log in to your user account, go to My Orders and select the order
                                                to
                                                check the status.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">How long will it take to deliver my order?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>We can deliver your order within 4 to 5 working days anywhere in Sri
                                                Lanka.
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="title-other">What is Pickup ?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>If you don’t want to wait for your order to be delivered to your home,
                                                you can now pick it up yourself from one of our Abans Elite Showrooms.
                                                Simply select Pick up at checkout and choose your preferred store. When
                                                your order is ready to collect, we’ll let you know.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">There is something wrong with my order. What do I do?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>You can contact our customer care hotline at <a
                                                    href="tel:+94112222888">+94 112 222 888</a>, WhatsApp us at
                                                <a href="tel:+94772222888">+94 772 222 888</a>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="title-other">I received my order but there is something missing/product
                                        is
                                        damaged/wrong product. What should I do?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>You can contact our customer care hotline at <a
                                                    href="tel:+94112222888">+94 112 222 888</a>, WhatsApp us at
                                                <a href="tel:+94772222888">+94 772 222 888</a>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="title-other">How do I get my Air-Conditioner installed?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>Our team will complete the installation of your Air-Conditioner within
                                                03
                                                working days after delivery. Installation of up to 5 meters of piping
                                                from the
                                                indoor unit to the outdoor unit will be free of charge. Our team will
                                                provide you with an estimate of additional charges (if any) based on
                                                their
                                                site inspection prior to installation.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">I need help setting up my TV/Washing Machine/Refrigerator.
                                        Who
                                        do I call?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>Contact our customer care hotline at <a href="tel:+94112222888">+94 112
                                                    222 888</a>, WhatsApp us at <a href="tel:+94772222888">+94 772 222
                                                    888</a> and we will send a team within 03 to 04 working days to help
                                                set up your device.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">My device stopped working/is faulty (within 48 hours of
                                        delivery). Who do I call?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>You can try shutting down &amp; restarting the device which can
                                                sometimes
                                                resolve minor issues in electronic devices. If the problem persists,
                                                contact
                                                our customer care team, and closely follow their instructions. You can
                                                call
                                                them at <a href="tel:+94112222888">+94 112 222 888</a>, WhatsApp at <a
                                                    href="tel:+94772222888">+94 772 222 888</a>
                                                If the defective product is an electronic device, please shut
                                                down/switch off
                                                while the issue is being resolved and await further instructions from
                                                our
                                                customer care team.
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="title-other">The product I bought last week/month/year stopped working/is
                                        faulty. Who do I call?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>You can contact our service center at +94 115 555 888 and follow their
                                                instructions.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">How do I get a replacement/refund?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>Log in to your user account, go to Return Requests and make a
                                                replacement/refund request. Here you can give us details of the issue
                                                you experienced and share photos of the faulty product to help process
                                                your request. You can also contact our customer care hotline at<a
                                                    href="tel:+94112222888"> +94 112 222 888</a>, WhatsApp us at <a
                                                    href="tel:+94772222888">+94 772 222 888</a>.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">What is the BuyAbans.com return/refund policy?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>You can read our <a href="refundpolicy.html">Return and Refund
                                                    Policy</a> here.
                                            </li>
                                        </ol>
                                    </li>
                                    <li>What is the Warranty I can get for a product?
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>You can check the specific available warranty period &amp; details on
                                                the
                                                product page.</li>
                                        </ol>
                                    </li>
                                    <li class="title-other">Further Questions
                                        <ol style="list-style-type: lower-alpha;">
                                            <li>If you have any other questions, please feel free contact us at <a
                                                    href="tel:+94112222888">+94 112 222 888</a>or WhatsApp us at <a
                                                    href="tel:+94772222888">+94 772 222 888</a>.


                                        </ol>
                                    </li>
                                </ol>
                            </div>





                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-two" role="tabpanel" aria-labelledby="v-pills-two-tab">

                        <h3 class="title-terms mb-4" style="padding-top: 0px;">How To Buy</h3>
                        <ol>
                            <li class="monial-graph">You can browse by category, brand, or simply type what you’re
                                looking
                                for into the search bar.</li>
                            <li class="monial-graph">Select Buy Now to purchase an item immediately or Add to Cart and
                                continue shopping.</li>
                            <li class="monial-graph">When you’re ready to check out, click View Cart, edit your order,
                                apply
                                Promo Codes, and choose your preferred delivery method. Select Home Delivery to have
                                your
                                order delivered to your home address by our professional courier service or select Click
                                &amp; Collect to pick it up from an Abans Elite showroom of your choice.</li>
                            <li class="monial-graph">Login to automatically fill in your saved personal &amp; delivery
                                information or Continue as Guest and add your details manually.</li>
                            <li class="monial-graph">Choose your preferred Payment Method, fill in the requested payment
                                details and make your payment using our secure payment gateway.</li>
                            <li class="monial-graph">After the payment is made, you will receive an order confirmation
                                via
                                SMS and/or Email.</li>
                            <li class="monial-graph">After the order is confirmed, you can check the Order Status from
                                Track Your Order. You will also be notified when your order is ready for Delivery or
                                Pickup
                                for Click &amp; Collect orders.</li>
                        </ol>
                    </div>

                    <div class="tab-pane fade " id="v-pills-three" role="tabpanel"
                        aria-labelledby="v-pills-three-tab">

                        <h3 class="title-terms mb-4">Shipping &amp; Delivery</h3>

                        <ol>
                            <li class="monial-graph">Items ordered online on BuyAbans.com will be delivered in within 3
                                to 5 working days anywhere in Sri Lanka.</li>
                            <li class="monial-graph">Estimated delivery time may vary based on the availability of
                                items
                                ordered and the delivery
                                address.</li>
                            <li class="monial-graph">The following delivery charges will apply based on the total value
                                of
                                your order.</li>
                        </ol>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr style="height: 18px;">
                                        <td style="width: 50%; height: 18px;"><strong>Order Amount (Rs.)</strong></td>
                                        <td style="width: 50%; height: 18px;"><strong>Delivery Charge</strong></td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 50%; height: 18px;">Up to 10,000&nbsp;</td>
                                        <td style="width: 50%; height: 18px;">Rs. 490</td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 50%; height: 18px;">10,001 – 20,000</td>
                                        <td style="width: 50%; height: 18px;">Rs. 590</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">20,001 - 50,000</td>
                                        <td style="width: 50%;">Rs. 790</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">50,001 - 100,000</td>
                                        <td style="width: 50%;">Rs. 1090</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">100,001 - 200,000</td>
                                        <td style="width: 50%;">Rs. 1590</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">200,001 &amp; above</td>
                                        <td style="width: 50%;">Rs. 2090</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>




                    <div class="tab-pane fade  show active " id="v-pills-four" role="tabpanel"
                        aria-labelledby="v-pills-four-tab">

                        <h3 class="title-terms mb-4">Warranty</h3>
                        <ol style=" list-style-type: circle">
                            <li>
                                <p class="monial-graph">The warranty provided through the crown.esupportsystem.shop website is the same as
                                    the
                                    common warranty provided to all Abans PLC showrooms. For any warranty-related issues, please
                                    contact the Service Centre via the contact details on the warranty card.</p>
                            </li>
                            <li>
                                <p class="monial-graph">We guarantee that all products sold by Abans PLC are in good quality
                                    and
                                    working order and tested for quality and handed over to the customer for normal and standard
                                    usage, subject to the following terms and conditions. Abans PLC agrees to repair the
                                    manufacturing defects in products on free of charge basis only <strong
                                        class="warrenty-first-strong">within the 01-year standard warranty period except for
                                        products covered under different warranty periods.</strong></p>
                            </li>
                            <li>
                                <p class="monial-graph">Extended warranty will be provided subject to payments, for extended
                                    warranty terms and conditions refer the extended warranty card.</p>
                            </li>
                            <li>
                                <p class="monial-graph">The warranty will not be effective for <strong
                                        class="warrenty-second-strong">repairs/installations/services done by any 03rd party
                                        other
                                        than Crown Electronics or its authorized service agents, damage caused by
                                        ancillary equipment and non-recommended accessories, normal wear, tear and corrosion,
                                        corrosion of copper tanks, promotional Items given free of charge with the main product,
                                        damages due to split and liquid, drop damages, seepage, secretion from insects, rodents
                                        or
                                        domestic pets, accident, fire, theft, act of god, power surges, electrical leakage,
                                        voltage
                                        fluctuations, negligence, misuse, abuse, incorrect installations, modifications,
                                        improper
                                        testing operation, maintenance installation, charging of batteries other than standard
                                        charges, defaced, obliterated or removed, substance damage to coil cards and connectors
                                        due
                                        to misuse, damage due to shock or external force, lightning, being operated in alkaline
                                        or
                                        unsuitable atmosphere, use of products outside specification, use for purpose not
                                        recommended, use beyond the guidelines, directions and user capacity of product,
                                        alterations, defaced or suspected warranty cards and serial number alteration, unclear
                                        rubber stamp of showroom managers and dealers, any damage or loss to any 03rd party or
                                        property, batteries, chargers, carrying cases, laptop bags, power adaptors, power
                                        cables,
                                        internet connection cables, printer cables, cartridges, toner, knobs, locks, bulbs,
                                        filters,
                                        racks, shelves, gas charging, switches, remote controllers, AV cables, antenna cables,
                                        inter
                                        connection cables, brushers, drive belts, pulleys, pads, plug tops, burner caps, trivet,
                                        tube, ignition plugs, telephone shower, plastic jug, blades, handles, lids, pouches,
                                        speaker
                                        cables, speakers, speaker boxes, water tap and any other consumable parts.</strong></p>
                            </li>
                            <li>

                                <p class="monial-graph">Failure to install software, video, audio and file formats are not
                                    considered as manufacturing defects. No warranty is provided for the quality of the software
                                    and
                                    hardware used by the customer, hardware and software defects and corruption, virus attacks,
                                    spywares, firmware upgrades, defects due to use of third-party application and unauthorized
                                    and
                                    illegal software and company will not be responsible for any data losses at point of repair.
                                </p>
                            </li>
                            <li>

                                <p class="monial-graph">If the product delivered by the company contains any damage during
                                    transit
                                    or handling, customer shall be informed at the same time on date of delivery. If the product
                                    is
                                    delivered by the customer, company shall not be liable for any damage arising while
                                    transporting. Customer is advised to check before moving out product from showroom
                                    premises/Duty
                                    Free showrooms.</p>
                            </li>
                            <li>

                                <p class="monial-graph">Services shall not be provided if Hire Purchase Instalments are due.
                                </p>
                            </li>
                            <li>

                                <p class="monial-graph">If the product is beyond economical repair, product replacement with
                                    similar working condition and warranty shall be effective for remaining period.</p>
                            </li>
                            <li>

                                <p class="monial-graph">It is recommended to use the product with power guard and stabilizers.
                                </p>

                            </li>

                        </ol>




                        <div class="table-container">
                            <table class="styled-table">
                                <tbody>
                                    <tr>
                                        <th>Refrigerators, Bottle Coolers, Freezers</th>
                                        <td>
                                            <ul style="list-style-type: disc;">
                                                <li>5 years for compressor only. Customer shall bear any charges for labor or accessories in relation to the replacement of compressor.</li>
                                                <li>10-year warranty shall apply only on compressors of selected refrigerator models.</li>
                                                <li>Humidity on the surface shall not be considered a defect.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Televisions LCD/LED</th>
                                        <td>
                                            <ul style="list-style-type: disc;">
                                                <li>If it is a manufacturing fault within the warranty period, Abans PLC will repair it free of charge.</li>
                                                <li>1-year warranty for panel and 3-year warranty for other parts including Main and Power PCB.</li>
                                                <li>Color dots up to 7 on LCD/LED TV screens shall be considered a normal industrial cause due to pixel burnout and shall not warrant replacement.</li>
                                                <li>No warranty for Main/Power PCB damages due to signal wire connections, careless plugging/unplugging, or usage of multi-plugs.</li>
                                                <li>No replacements allowed for backlight replacements.</li>
                                                <li>No warranty for TV and AV accessories, remotes, speakers, mics, wires, HDMI ports, or cables.</li>
                                                <li>Televisions fixed on mobile vehicles shall not be covered under this warranty.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Audio</th>
                                        <td>
                                            <ul style="list-style-type: disc;">
                                                <li>No warranty for speaker body corrosion, color fading, or fungus.</li>
                                                <li>No warranty for remotes, audio speakers, mics, wires, or jacks.</li>
                                                <li>If a similar model is not available and the customer requests a refund:
                                                    <ul>
                                                        <li>Usage Period 0–6 months: Refund 85% of the invoiced value.</li>
                                                        <li>Usage Period 6–12 months: Refund 75% of the invoiced value.</li>
                                                    </ul>
                                                </li>
                                                <li>When customer requests an upgrade:
                                                    <ul>
                                                        <li>Usage Period 0–6 months: Get balance amount + remaining warranty.</li>
                                                        <li>Usage Period 6–12 months: Get balance amount + remaining warranty.</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Washing Machine</th>
                                        <td>
                                            <ul style="list-style-type: disc;">
                                                <li>5/10-year warranty on Stainless Steel Drum against rusting, Direct Drive, or Smart Inverter Motor for selected models only.</li>
                                                <li>5-year warranty on selected washing machines.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Water Purifier</th>
                                        <td>
                                            <ul style="list-style-type: disc;">
                                                <li>Refer to warranty instruction sheet for more details.</li>

                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Solar System</th>
                                        <td>
                                            <ul style="list-style-type: disc;">
                                                <li>Refer to warranty instruction sheet for more details.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table2 " style="margin-top:30px;">
                            <p class="title-terms mb-4">SPECIAL WARRANTY TERMS</p>
                            <div class="table-container">
                                <table class="styled-table">
                                    <!-- <thead>
                                        <tr>
                                            <th style="background-color:rgba(10, 10, 10, 0.37);">Product</th>
                                            <th style="background-color:rgb(10, 10, 10, 0.37);">Special Warranty Terms for Products / Parts / Accessories</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <tr>
                                            <td style="background-color:rgba(10, 10, 10, 0.37);">Product</th>
                                            <td style="background-color:rgba(10, 10, 10, 0.37);">Special Warranty Terms for Products / Parts / Accessories</th>
                                        </tr>
                                        <tr>
                                            <th>Air Conditioners</th>
                                            <td>
                                                <ul style="list-style-type: disc;">
                                                    <li>Within the standard one-year warranty period, 3 services will be provided free of charge.</li>
                                                    <li>10-year warranty for the compressor of LG Inverter Air Conditioner (residential, 9000–24000 BTU) and 5-year warranty for compressors of other inverter and non-inverter Air Conditioner brands (residential, 9000–36000 BTU) apply only if a 4-year service agreement is signed with Abans Electrical PLC at the end of the first year. Customer shall bear any charges for labor and accessories for compressor replacement.</li>
                                                    <li>Additional services will be provided subject to additional payments.</li>
                                                    <li>No warranty for corrosion on outdoor unit due to environmental conditions or sea breeze.</li>
                                                    <li>5-year warranty for compressors of all Air Conditioner brands (commercial, 12000–100000 BTU) applies only if a 4-year service agreement is signed with Abans Electrical PLC at the end of the first year. Customer shall bear any charges for labor and accessories for compressor replacement.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Computers, Laptops, Tablets</th>
                                            <td>
                                                <ul style="list-style-type: disc;">
                                                    <li>Color dots up to 7 on laptops, tablet screens, and monitors are considered a normal industrial cause due to pixel burnout and do not warrant replacement.</li>

                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mobile Phones</th>
                                            <td>
                                                <ul style="list-style-type: disc;">
                                                    <li>12-month warranty for the main unit.</li>
                                                    <li>6-month warranty for battery and charger.</li>
                                                    <li>1-month warranty for other accessories.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Apple Products</th>
                                            <td>
                                                <div><strong>The Apple One-Year Limited Warranty is a voluntary manufacturer’s warranty that can be claimed from any Apple store worldwide and only at Abans Apple Authorized Service Centres.</strong></div>
                                                <ul style="list-style-type: disc;">
                                                    <li>Apple warrants Apple-branded hardware products against defects in materials and workmanship under normal use for one (1) year from the date of retail purchase by the original end-user purchaser ("Warranty Period").</li>
                                                    <li>If a hardware defect arises and a valid receipt is provided within the warranty period, the following applies per Apple's diagnosis system report at the service centre:
                                                        <ol style="list-style-type: lower-roman;">
                                                            <li>For iPhones, iPads, Apple Watch, and Apple-branded accessories: Exchange the defective product with a product that is new or manufactured from new or serviceable used parts and is at least functionally equivalent to the original product.</li>
                                                            <li>For Macs: Repair the hardware defect at no charge using new spare parts. AppleCare can be enabled for Macs before the first-year warranty ends, extending an additional 2-year warranty (visit <a target="_blank" href="https://www.apple.com/legal/sales-support/applecare/appmacapacen.html">AppleCare Protection Plan for Mac</a> for more info).</li>
                                                            <li>If the product is dropped, water-damaged, or physically damaged due to customer negligence, there is no warranty.</li>
                                                            <li>No DOA policy for any Apple products; replacement will only be done through service.</li>
                                                            <li>A sufficient lead time is required to obtain spare parts for repair or replacement per Apple's guidance.</li>
                                                        </ol>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="txt-new" style="font-style: italic;">Please note that these are standard
                                warranty details therefore the warranty remarks/conditions printed on the invoice/
                                warranty card will be applicable.</p>
                        </div>

                    </div>


                    <div class="tab-pane fade " id="v-pills-five" role="tabpanel"
                        aria-labelledby="v-pills-five-tab">
                        <h3 class="title-terms">Return Products Request</h3>

                        <div class="row">
                            <p class="order-title">Order Information</p>
                            <div class="form-group col-sm-6">
                                <label class="fs-14">Order ID<span class="req">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label class="fs-14">Billing Last Name <span class="req">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>


                            <div class="form-group col-sm-6">
                                <label class="fs-14">Find Order By <span class="req">*</span></label>
                                <input type="text" class="form-control" name="orderby" id="orderby" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="fs-14">Email<span class="req">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>

                        </div>

                        <div class="form-group col-sm-12">
                            <div class="tacbox terms-conditions-container">
                                <input id="t_and_c_agree" type="checkbox" name="t_and_c_agree" required="required"
                                    data-parsley-error-message="Please agree to Terms &amp; Conditions."
                                    data-parsley-errors-container="#t_and_c_error_container"
                                    data-parsley-multiple="t_and_c_agree"> <label for="checkbox" class="fs-14">I
                                    agree
                                    to <a href="terms-and-conditions.html">Terms &amp;
                                        Conditions</a></label>
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <button class="btn btn-site-default btn-inq fl">Submit Inquiry</button>
                        </div>

                    </div>

                </div>
            </div>



</main>
@endsection
