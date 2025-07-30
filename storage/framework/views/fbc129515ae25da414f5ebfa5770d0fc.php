<?php $__env->startSection('content'); ?>
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
                <h6 class="mb-0">Terms And Conditions</h6>
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
                    <li class="text-sm text-main-600">Terms And Conditions</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="site-common-con">
        <div class="row">
            <div class="col-md-3 terms-nav">
                <div class="nav flex-column nav-pills" id="v-pills-tab">
                    <a class="nav-link  active " id="v-pills-one-tab" href="/terms-condition" role="tab">Terms and
                        Conditions</a>
                    <a class="nav-link " id="v-pills-two-tab" href="/privacy-policy">Privacy Policy</a>
                    <a class="nav-link " id="v-pills-three-tab" href="/return-refund">Return and Refund Policy</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content terms-tab" id="v-pills-tabContent">
                    <div class="tab-pane fade  show active " id="v-pills-one" role="tabpanel"
                        aria-labelledby="v-pills-one-tab">
                        <div id="accordion" role="tablist">
                            <h3 class="title-terms pt-0">Terms and Conditions</h3>

                            <p>Welcome to fairwaves.lk, the online purchasing platform for Abans PLC (Sri Lanka).
                                The fairwaves.lk website provides services to its valued customers under the following
                                conditions. Please read and accept the under-mentioned conditions and guidelines
                                carefully before using the services of this website.</p>

                            <h3 class="title-terms">Product information at fairwaves.lk website</h3>
                            <p>The fairwaves.lk website attempts to be as accurate as possible with the information
                                displayed on the site. However, fairwaves.lk does not guarantee that product
                                descriptions or other content on this site are 100% accurate, complete, reliable or
                                completely free of errors. If a product offered by fairwaves.lk is not as described on
                                the website, a customer’s sole remedy is to return it in an unused condition within two
                                days of delivery. If there is any external damage to the package, a customer is
                                responsible for checking the item when it is handed over. An item will not be exchanged
                                for a refund or replacement if there is external damage e.g. packaging damage or dents.
                                Refunds or replacements will only apply for items with confirmed technical in-built
                                faults and are subjected to a fine or penalty for the cost. </p>

                            <p>In case the item received is found defective, customers should immediately inform
                                fairwaves.lk within 24 hours to arrange a replacement with a brand-new unit or a full
                                refund will be provided if the stock is unavailable. </p>

                            <p>Regarding the items sold through fairwaves.lk, the price of an item cannot be confirmed
                                until the customer orders the item. Even though every effort is made to provide accurate
                                pricing, there may be a negligible probability that some items can be mispriced. If the
                                new price is higher than the mentioned price, we will not cancel or deliver the item
                                without your confirmation about the new price, and all cancellations of items will be
                                informed prior. If the new price is higher and you still wish to purchase, you can pay
                                the additional amount but if you decide to cancel, we will issue a refund. </p>

                            <p>Due to current international exchange laws and conventions, even if delivery of the
                                selected item is canceled, fairwaves.lk cannot refund your money. You will, however, be
                                provided with credit on the website to purchase another available product up to the
                                value of the previous item.</p>

                            <div class="content-section">
                                <h3 class="title-terms">Return and Refund Policy</h3>
                                <ul>
                                    <li><strong>Period :</strong> <?php echo e($companySettings->title ?? 'Fair Waves'); ?> must be informed within 3 days for
                                        Electronics &
                                        7
                                        days for Lifestyle brands (Skechers, Under Armour, Hugo Boss) of receiving the
                                        item
                                        to be eligible for return.</li>
                                    <li>Item must be in the original packaging with tags intact in the same condition it
                                        was
                                        delivered in.</li>
                                    <li>Items returned after the Return Period has lapsed will not be accepted. </li>
                                    <li>Our customers’ safety is of utmost importance, and we take hygiene very
                                        seriously.
                                        Therefore, items such as underwear, bras, briefs, and swimwear are not eligible
                                        for
                                        return.</li>
                                    <li>Items to be returned are the sole responsibility of the customer until they
                                        reach
                                        us, and customer needs to ensure items are properly packed to prevent any
                                        damages en
                                        route to us. Items damaged en route will not be accepted.</li>
                                    <li>It is the customer’s responsibility to ensure proof of postage for parcels that
                                        contain items to be returned.</li>
                                    <li><?php echo e($companySettings->title ?? 'Fair Waves'); ?> will require minimum 05-07 business days to process your return request
                                        and
                                        prepare the replacement unit. </li>
                                </ul>
                            </div>

                            <div class="content-section">
                                <h3 class="title-terms">Refund policy: </h3>
                                <ul>
                                    <li>If a replacement unit for the size/specific model is no longer available, the
                                        customer will be issued a full refund. The refund will not include any delivery
                                        charges borne by the customer for return of item. </li>
                                    <li>All refunds will be processed within 3-5 working days. Processing refunds back
                                        to
                                        your credit card/ bank account may require additional time depending on the bank
                                        due
                                        to its own operational time for which <?php echo e($companySettings->title ?? 'Fair Waves'); ?> will not be responsible.</li>
                                    <li>In the event of purchasing an AC unit with low capacity, the consumer is only
                                        eligible for a credit note for the amount of their purchase or they can switch
                                        to a
                                        unit with a higher capacity. fairwaves.lk will not be issuing refunds for these
                                        cases.</li>
                                    <li>Customers can use the BTU calculator when purchasing AC to calculate the exact
                                        capacity that best suits
                                        their needs by providing an exact measurement of the site, or they can call 0112
                                        222 888 for further assistance.</li>
                                    <li>The total warranty and the comprehensive warranty will not apply if an
                                        under-capacity air conditioner is purchased.</li>
                                    <li>All manufacturing and material defects that require repair or return must be
                                        informed and returned to Fair Waves within the warranty period of 30 days. Any
                                        repair or return that failed to be reported or returned within the specified
                                        time frame will not be accepted or refunded.</li>
                                    <li>• Refunds will not be provided for change of mind. All sales are final. Refunds
                                        will only be issued under specific circumstances as outlined in our policy.</li>
                                </ul>

                                <p class="pt-2 pb-2">The prices for all the items mentioned on fairwaves.lk are the
                                    final
                                    and last prices of
                                    sale via online means.</p>
                            </div>

                            <div class="content-section">
                                <h3 class="title-terms">Using fairwaves.lk accounts</h3>
                                <p>It is the responsibility of the users of this site to keep their passwords, other
                                    account
                                    information, and the computer used to log on to the site, secure. Website account
                                    holders are solely responsible for all activities conducted via through their
                                    fairwaves.lk account or their passwords and Fair Waves shall be indemnified from any
                                    such
                                    liability.</p>
                            </div>

                            <div class="content-section">
                                <h3 class="title-terms">Abans Duty Free purchase via www.fairwaves.lk</h3>
                                <p>The payment will be considered as conditional purchase as the transaction will
                                    complete
                                    once the passenger physically arrives to the BIA and fulfil the requirements of the
                                    custom regulations, therefore in case of cancellation or refund of payment we will
                                    follow up the refund/cancellation policy as stated. Please note that a full refund
                                    will
                                    be credited if the information provided in the portal does not tally with original
                                    documents upon arrival (subject to SL Customs approval). In addition, note that the
                                    payment will be consider only as a pre-payment and the legal right to claim the
                                    goods
                                    from the duty-free shop will only be processed upon the exchange of the items
                                    physically
                                    at our Duty-free shop. Fair Waves website has the legal right to process a refund in
                                    any
                                    case upon the approval of the Sri Lanka Customs officers based at Bandaranayake
                                    International Airport (BIA).</p>
                                <p>The total allowance applicable for an incoming passenger includes their accompanied
                                    passenger luggage and the dutiable goods in their unaccompanied passenger baggage
                                    (UPB).
                                </p>
                            </div>

                            <div class="content-section">
                                <h3 class="title-terms">Warranty:</h3>
                                <p>The warranty provided through the fairwaves.lk website is the same as the common
                                    warranty
                                    provided to all Abans PLC showrooms. For any warranty-related issues, please contact
                                    the
                                    Service Centre via the contact details on the warranty card.</p>
                                <p>We guarantee that all products sold by Abans PLC are of good quality and working
                                    order
                                    and tested for quality and handed over to the customer for normal and standard
                                    usage,
                                    subject to the following terms and conditions. Abans PLC agrees to repair the
                                    manufacturing defects in products on free-of-charge basis only within the 01-year
                                    standard warranty period except for products covered under different warranty
                                    periods.
                                </p>
                                <p>An Extended warranty will be provided subject to payments and for extended warranty
                                    terms and
                                    conditions refer the extended warranty card.</p>

                                <p>The warranty will not be effective for <strong>repairs/installations/services done by
                                        any
                                        03rd party other than Abans Electricals PLC/Abans PLC or its authorized service
                                        agents for damages caused by ancillary equipment and non-recommended
                                        accessories, normal
                                        wear, tear and corrosion, corrosion of copper tanks, promotional Items given
                                        free of
                                        charge with the main product, damages due to split and liquid, drop damages,
                                        seepage, secretion from insects, rodents or domestic pets, accident, fire,
                                        theft,
                                        act of god, power surges, electrical leakage, voltage fluctuations, negligence,
                                        misuse, abuse, incorrect installations, modifications, improper testing
                                        operation,
                                        maintenance installation, charging of batteries other than standard charges,
                                        defaced, obliterated or removed, substance damage to coil cards and connectors
                                        due
                                        to misuse, damage due to shock or external force, lightning, being operated in
                                        alkaline or unsuitable atmosphere, use of products outside specification, use
                                        for
                                        purpose not recommended, use beyond the guidelines, directions and user capacity
                                        of
                                        product, alterations, defaced or suspected warranty cards and serial number
                                        alteration, unclear rubber stamp of showroom managers and dealers, any damage or
                                        loss to any 03rd party or property, batteries, chargers, carrying cases, laptop
                                        bags, power adaptors, power cables, internet connection cables, printer cables,
                                        cartridges, toner, knobs, locks, bulbs, filters, racks, shelves, gas charging,
                                        switches, remote controllers, AV cables, antenna cables, inter connection
                                        cables,
                                        brushers, drive belts, pulleys, pads, plug tops, burner caps, trivet, tube,
                                        ignition
                                        plugs, telephone shower, plastic jug, blades, handles, lids, pouches, speaker
                                        cables, speakers, speaker boxes, water tap and any other consumable
                                        parts.</strong>
                                </p>

                                <p>Failure to install software, video, audio and file formats are not considered as
                                    manufacturing defects. No warranty is provided for the quality of the software and
                                    hardware used by the customer, hardware and software defects and corruption, virus
                                    attacks,spyware, firmware upgrades, defects due to the use of the third-party
                                    applications,
                                    unauthorized and illegal software, also the company will not be responsible for any
                                    data losses at the point of repair.</p>



                                <p>If the product delivered by the company is damaged during transit or handling, the
                                    customer shall be informed at the same time on date of delivery. If the product is
                                    delivered by the customer, the company shall not be liable for any damage occurring
                                    during transportation. Customer is advised to check before moving out the product
                                    from showroom premises/Duty Free showrooms.</p>


                                <p>Services shall not be provided if Hire Purchase Instalments are due.</p>

                                <p>If the product is beyond economical repair, product replacement with similar working
                                    condition and warranty shall be effective for remaining period.</p>

                                <p>It is recommended to use the product with power guard and stabilizers.</p>
                            </div>

                            <div class="content-section">
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
                            </div>





                            <div class="content-section">
                                <h3 class="title-terms">SPECIAL WARRANTY TERMS</h3>
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
                            </div>


                            <div class="content-section">
                                <h3 class="title-terms">Exchange of Goods: </h3>
                                <p>fairwaves.lk may exchange the purchased item on valid for another item requested by
                                    the
                                    customer. The said customer will have to pay for any difference in the price and
                                    that
                                    payment will also need to be completed within 48 hours from the time of purchase.
                                </p>
                                <p>fairwaves.lk is not allowed to exchange any goods purchased at the BIA Duty Free
                                    unless
                                    the products sold contain internal technical faults.fairwaves.lk can only provide
                                    like-for-like exchanges when stock is available at our showrooms outside the
                                    Duty-Free zones. </p>

                            </div>


                            <div class="content-section">
                                <h3 class="title-terms">Policy for information gathered by fairwaves.lk</h3>
                                <p>

                                    All information entered in to fairwaves.lk by site visitors will be collected and
                                    stored. If certain visitors decide not to provide certain information, they will not
                                    be
                                    able to acquire the valuable advantages and features of this website. This vital
                                    information is used for quick and fruitful responses to your requests, and for
                                    communicating with you in present and future instances. Information about customers
                                    is
                                    important to Fair Waves and will be treated with utmost confidentiality and will not
                                    be
                                    divulged to 03rd parties. Customer information is used only as described below and
                                    with
                                    affiliates of fairwaves.lk.</p>


                                <p><i>Note: Customer is responsible for informing the change of his/her phone no. and/or
                                        email address to
                                        Fair Waves.</i></p>
                            </div>

                            <div class="content-section">
                                <h3 class="title-terms">Copyrights</h3>
                                <p>

                                    The content of the fairwaves.lk site is the property of Abans PLC (Sri Lanka) and is
                                    protected under international copyright laws. The trademark of www.fairwaves.lk is a
                                    registered trademark and the sole rights of changing, modifying, assigning, or using
                                    this trademark is solely with Abans PLC (Sri Lanka). Anyone other than Abans PLC who
                                    is
                                    involved in changing, modifying, assigning, or using this trademark without prior
                                    written authorization of Abans PLC (Sri Lanka) will be violating international
                                    copyright
                                    laws.</p>
                            </div>

                            <div class="content-section">
                                <h3 class="title-terms">Communication between you and fairwaves.lk</h3>
                                <p>

                                    When you visit the fairwaves.lk website or communicate with fairwaves.lk via
                                    e-mails,
                                    you are considered as communicating with fairwaves.lk. This permits fairwaves.lk to
                                    send
                                    e-mails and to communicate with you and you are deemed as agreeing to all terms and
                                    conditions, notices and other means of communications that we provide to you
                                    electronically, satisfying all legal requirements.</p>
                            </div>


                            <div class="content-section">
                                <h3 class="title-terms">Contact Details:</h3>

                                <div class="border-box-table">
                                    <p><strong>www.fairwaves.lk</strong></p>
                                    <p>No. 498,<br>
                                        Galle Road, Colombo 03.<br>
                                        Sri Lanka.</p>
                                    <table>
                                        <tr>
                                            <td>Tel</td>
                                            <td> : +94 112 222 888</td>
                                        </tr>

                                        <tr>
                                            <td>Web </td>
                                            <td> : www.fairwaves.lk</td>
                                        </tr>


                                    </table>
                                </div>


                                <div class="border-box-table">
                                    <p><strong>Abans PLC</strong></p>
                                    <p>No. 498,<br>
                                        Galle Road, Colombo 03.<br>
                                        Sri Lanka.</p>
                                    <table>
                                        <tr>
                                            <td>Tel</td>
                                            <td> : +94 11 555 5888</td>
                                        </tr>

                                        <tr>
                                            <td>Fax</td>
                                            <td> : +94 11 461 7444</td>
                                        </tr>

                                        <tr>
                                            <td>Web </td>
                                            <td> : www.fairwaves.lk</td>
                                        </tr>


                                    </table>
                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-two" role="tabpanel" aria-labelledby="v-pills-two-tab">

                        <h3 class="title-terms" style="padding-top: 0px;">Privacy Policy</h3>
                        <p class="monial-graph">We, Abans PLC (PV 5301 PB/PQ), having its registered office at No. 498,
                            Galle Road, Colombo 03 are pleased to provide our policy on privacy for the users of our
                            website <a href="www.fairwaves.lk">www.fairwaves.lk</a>. We collect, use, maintain and
                            disclose
                            information collected from users of our website. We assure you that, we use our best and
                            reasonable
                            effort to protect the privacy of users of our website, <a
                                href="www.fairwaves.lk">www.fairwaves.lk</a>.</p>
                        <p class="monial-graph">We receive your personal information such as Name, Address, E-mail
                            address,
                            National Identity Card Number, Mobile Number, Credit Card details &amp; Transaction
                            information,
                            usage &amp; preference information, Log and device information, etc., and we only collect
                            and
                            store the information you submit voluntarily when you use our website, <a
                                href="www.fairwaves.lk">www.fairwaves.lk</a>. You can always refuse to provide personal
                            information, except that it may prevent you from engaging in certain site-related
                            activities.
                        </p>
                        <p class="monial-graph">We may use the information we collect about you to provide, maintain,
                            and improve our services, including, but not limited to facilitating payments, sending
                            receipts, providing products and services you request, sending related information,
                            developing new features, and providing customer support to users & vendors, develop safety
                            features, authenticate users, and send product updates and administrative messages; and we
                            may send our marketing and promotional information including discounts, information about
                            new products/services offerings, promotions, etc. </p>
                        <p class="monial-graph">We may share your information with our vendors, consultants, marketing
                            partners, and other service providers who need access to such information to carry out work
                            on
                            our behalf. We adopt authorized data collection, storage and processing practices, and
                            security
                            measures to protect against unauthorized access, alteration, disclosure or destruction of
                            your
                            personal information, username, password, transaction information and data stored on our
                            site.
                        </p>
                        <p class="monial-graph">We do not sell, trade or rent users’ personal identification information
                            to
                            others. We may share generic aggregated demographic information not linked to any personal
                            identification information regarding visitors and users with our business partners, trusted
                            affiliates and advertisers for the purposes outlined above. We may use third party service
                            providers to help us operate our business and the site or to administer activities on our
                            behalf, such as sending out newsletters or surveys. You acknowledge that we may share your
                            information with these third parties for those limited purposes.</p>
                        <p class="monial-graph">We do not disclose your personal information to any third party other
                            than
                            stated in this policy, except in response to a court order and/or as required by Law, rules
                            and
                            regulations of any government or statutory authority.</p>
                        <p class="monial-graph">We take good care of your personal information and make all reasonable
                            efforts to safeguard the information to entrusted to us. We use cookies for the following
                            purposes: to enable certain functions of the services; to provide analytics; and to enable
                            advertisement delivery, including behavioral advertising.</p>
                        <p class="monial-graph">We may offer links to sites that are not operated by us. If you visit
                            one of
                            these linked sites, you should review their privacy and other policies. We are not
                            responsible
                            for the policies and practices of other companies and any information you submit to those
                            sites
                            that are subject to their privacy policies.</p>
                        <p class="monial-graph">The information contained on <a
                                href="www.fairwaves.lk">www.fairwaves.lk</a>
                            website is for general information purposes only. The <a
                                href="www.fairwaves.lk">www.fairwaves.lk</a> website assumes no responsibility for
                            errors or
                            omissions in the content of the services. In no event shall <a
                                href="www.fairwaves.lk">www.fairwaves.lk</a> website be liable for any special, direct,
                            indirect, consequential, or incidental damages or any damages whatsoever, whether in an
                            action
                            of contract, negligence or other tort, arising out of or in connection with the use of the
                            services or the content of the service. We reserve the right to make additions, deletions or
                            modifications to the content on the services at any time without prior notice. The <a
                                href="www.fairwaves.lk">www.fairwaves.lk</a> website does not warrant that the website
                            is
                            free from viruses or other harmful components.</p>
                        <p class="monial-graph">We may change this privacy policy from time to time, as necessary. When
                            it may be
                            necessary. We will post the revised version of the privacy policy for your reference. By
                            using
                            this, you signify your acceptance of this policy. If you do not agree to this policy, please
                            do
                            not use this website. Your continued use of the site following the posting of changes to
                            this
                            policy will be deemed your acceptance of those changes.</p>
                        <p class="monial-graph">Although we attempt to keep all information in the WWW servers accurate
                            and
                            up to date, the accuracy and timeliness of the information provided cannot be guaranteed. We
                            hope that you will find the information helpful and easy to use, but we provide all content
                            for
                            informational purposes only and make no representations or warranties of any kind regarding
                            the
                            same. We disclaim all liability of any kind arising from the use of, or inability
                            to use, our WWW servers and the information contained on them. Our WWW servers were designed
                            to
                            provide information about the Company. Use of this system for any purpose other than that
                            for
                            which it was designed is unauthorized and prohibited.</p>
                        <p class="monial-graph">If you have any questions or concerns about this privacy policy and the
                            practices of this website, or if you are dealing any issues with this site, please contact
                            us at:</p>

                        <table style="margin-bottom: 1rem;">
                            <tr>
                                <td>Tel :</td>
                                <td><a href="tel:+94772222888">+94 112 222 888</a></td>
                            </tr>

                            <tr>
                                <td>Email :</td>
                                <td><a href="cdn-cgi/l/email-protection.html#ec85828a83ac8e99958d8e8d829fc28f8381"><span
                                            class="__cf_email__"
                                            data-cfemail="6d04030b022d0f18140c0f0c031e430e0200">[email&#160;protected]</span></a>
                                </td>
                            </tr>

                        </table>

                        <p class="monial-graph">All parties submitting materials to the WWW servers represent and
                            warrant
                            that the submission, installation, copying, distribution and use of such material in
                            connection
                            with the WWW servers will not violate any other party’s proprietary of legal rights.</p>
                        <p class="monial-graph">
                            The material and content provided on the site is strictly for your personal and
                            non-commercial use only. However, except where expressly provided, you agree not to
                            distribute, copy, extract, or commercially exploit such material or content, either
                            personally or with the assistance of any third party. Except as otherwise indicated, all
                            materials on this site, including, but not limited to text, information such as customer or
                            partner references, data, image and pictures, illustrations and written and other
                            intellectual property rights owned, or used with permission of their owners by us or our
                            partners, affiliates or associates. This site is protected by copyright and other
                            intellectual property rights owned, or used with permission of their owners by us, our
                            partners, affiliates or associates. All rights reserved.
                        </p>
                    </div>

                    <div class="tab-pane fade " id="v-pills-three" role="tabpanel"
                        aria-labelledby="v-pills-three-tab">

                        <div class="content-section">
                            <h3 class="title-terms">Return and Refund Policy</h3>
                            <ul>
                                <li><strong>Period :</strong> Fair Waves must be informed within 3 days for Electronics &
                                    7
                                    days for Lifestyle brands (Skechers, Under Armour, Hugo Boss) of receiving the item
                                    to be eligible for return.</li>
                                <li>Item must be in the original packaging with tags intact in the same condition it was
                                    delivered in.</li>
                                <li>Items returned after the Return Period has lapsed will not be accepted. </li>
                                <li>Our customers’ safety is of utmost importance, and we take hygiene very seriously.
                                    Therefore, items such as underwear, bras, briefs, and swimwear are not eligible for
                                    return.</li>
                                <li>Items to be returned are the sole responsibility of the customer until they reach
                                    us, and customer needs to ensure items are properly packed to prevent any damages en
                                    route to us. Items damaged en route will not be accepted.</li>
                                <li>It is the customer’s responsibility to ensure proof of postage for parcels that
                                    contain items to be returned.</li>
                                <li>Fair Waves will require minimum 05-07 business days to process your return request and
                                    prepare the replacement unit. </li>
                            </ul>
                        </div>

                        <div class="content-section">
                            <h3 class="title-terms">Refund policy: </h3>
                            <ul>
                                <li>If a replacement unit for the size/specific model is no longer available, the
                                    customer will be issued a full refund. The refund will not include any delivery
                                    charges borne by the customer for return of item. </li>
                                <li>All refunds will be processed within 3-5 working days. Processing refunds back to
                                    your credit card/ bank account may require additional time depending on the bank due
                                    to its own operational time for which Fair Waves will not be responsible.</li>
                                <li>In the event of purchasing an AC unit with low capacity, the consumer is only
                                    eligible for a credit note for the amount of their purchase or they can switch to a
                                    unit with a higher capacity. fairwaves.lk will not be issuing refunds for these
                                    cases.</li>
                                <li>Customers can use the BTU calculator when purchasing AC to calculate the exact
                                    capacity that best suits
                                    their needs by providing an exact measurement of the site, or they can call 0112 222
                                    888 for further assistance.</li>
                                <li>The total warranty and the comprehensive warranty will not apply if an
                                    under-capacity air conditioner is purchased.</li>
                                <li>All manufacturing and material defects that require repair or return must be
                                    informed and returned to Fair Waves within the warranty period of 30 days. Any repair
                                    or return that failed to be reported or returned within the specified time frame
                                    will not be accepted or refunded.</li>
                                <li>• Refunds will not be provided for change of mind. All sales are final. Refunds will
                                    only be issued under specific circumstances as outlined in our policy.</li>
                            </ul>

                            <p class="pt-2 pb-2">The prices for all the items mentioned on fairwaves.lk are the final
                                and last prices of
                                sale via online means.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>



</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/frontend/TermsCondition.blade.php ENDPATH**/ ?>