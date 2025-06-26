<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['user_name'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}




?>
<style type="text/css">
    <?php
    include 'main.css';
    ?>
    /* --- Team Card Sliding Animation Fix --- */
    .team .card {
        position: relative;
        width: 300px;
        height: 400px;
        margin: 0 auto;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* keep everything inside the card */
        transition: all 0.3s ease;
    }

    .team .card .slide {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0; top: 0;
        transition: 0.5s;
        border-radius: 15px;
        box-sizing: border-box;
    }

    .team .card .slide.slide1 {
        z-index: 2;
        transform: translateY(0);
    }

    .team .card:hover .slide.slide1 {
        transform: translateY(-100%);
    }

    .team .card .slide.slide2 {
        z-index: 1;
        background: #fff;
        transform: translateY(100%);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .team .card:hover .slide.slide2 {
        transform: translateY(0);
    }

    .team .card .slide.slide2 .content {
        width: 100%;
        text-align: center;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- --------------------slick slider link ----------------------------------------------------- -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>home page</title>
</head>

<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>about Us</h1>
            <p>Welcome to the admin dashboard. Manage your site efficiently.</p>
            <a href="index.php">Home</a><span>/ about us</span>
        </div>
    </div>
    <div class="line"></div>
    <!----------------------about us  ----------------------------------------------------- -->
    <div class="line2"></div>
    </div>
    </div>
    </div>

    <div class="about-us">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE STORE</span>
                    <h1>Hello, With 25 years of experience</h1>
                </div>
                <p>Over 25 years Ecommerce helping companies reach their financial and branding goals.

                    The perfect way to enjoy brewing tea on low hanging fruit to identify. Duis autem vel eum iriure
                    dolor in hendrerit in
                    vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. For me,
                    the most important part of
                    improving at photography.k</p>
            </div>
            <div class="img-box">
                <img src="img/about.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <!-- -------------------------features------------------------ -->
    <div class="line4"></div>
    <div class="features">
        <div class="title">
            <h1>Complete Customer Ideas</h1>
            <span>best features</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="img/call-center.png">
                <h4>24 X 7</h4>
                <p>Online Support 27/7</p>
            </div>
            <div class="box">
                <img src="img/save-money.png">
                <h4>Money Back Guarantee</h4>
                <p>100% Secure Payment</p>
            </div>
            <div class="box">
                <img src="img/giftbox.png">
                <h4>Special Gift Card</h4>
                <p>Give The Perfect Gift</p>
            </div>
            <div class="box">
                <img src="img/free-shipping.png">
                <h4>Worldwide Shipping</h4>
                <p>On Order Over $99/p>
            </div>
        </div>
    </div>

    <div class="line"></div>
    <!-- --------------------team section----------------- -->
    <div class="line2"></div>
    <div class="team">
        <div class="title">
            <h1>𝗢𝘂𝗿 𝗪𝗼𝗿𝗸𝗮𝗯𝗹𝗲 𝗧𝗲𝗮𝗺</h1>
            <span>best team</span>
        </div>
        <div class="row">

        <div class="card">
                <div class="slide slide1">
                    <div class="content">
                        <div class="icon">
                            <img src="img/Pandit ji.jpg" alt="Team Member">
                        </div>
                    </div>
                </div>
                <div class="slide slide2">
                    <div class="content">
                        <h3>Mahraj Ji Sukhwinder Baba</h3>
                        <p>Pooja</p>
                        <div class="icons">
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-youtube"></i>
                            <i class="bi bi-twitter"></i>
                            <i class="bi bi-behance"></i>
                            <i class="bi bi-whatsapp"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="slide slide1">
                    <div class="content">
                        <div class="icon">
                            <img src="img/Idols and Statues.jpg" alt="Team Member">
                        </div>
                    </div>
                </div>
                <div class="slide slide2">
                    <div class="content">
                        <h3>Sabina Maurya</h3>
                        <p>Idols and Statues</p>
                        <div class="icons">
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-youtube"></i>
                            <i class="bi bi-twitter"></i>
                            <i class="bi bi-behance"></i>
                            <i class="bi bi-whatsapp"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="slide slide1">
                    <div class="content">
                        <div class="icon">
                            <img src="img/Cotton Wicks and Diyas.jpg" alt="Team Member">
                        </div>
                    </div>
                </div>
                <div class="slide slide2">
                    <div class="content">
                        <h3>Virandra Singh</h3>
                        <p>Cotton Wicks and Diyas</p>
                        <div class="icons">
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-youtube"></i>
                            <i class="bi bi-twitter"></i>
                            <i class="bi bi-behance"></i>
                            <i class="bi bi-whatsapp"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="slide slide1">
                    <div class="content">
                        <div class="icon">
                            <img src="img/Camphor and Other Ritual Items.jpg" alt="Team Member">
                        </div>
                    </div>
                </div>
                <div class="slide slide2">
                    <div class="content">
                        <h3>Somnath Tiwari</h3>
                        <p>Camphor and Other Ritual Items</p>
                        <div class="icons">
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-youtube"></i>
                            <i class="bi bi-twitter"></i>
                            <i class="bi bi-behance"></i>
                            <i class="bi bi-whatsapp"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="line4"></div>
    <div class="project">
        <div class="title">
        <h1 class="title hover-underline">Our Best Project</h1> <br>
            <span>how it works</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="img/a.jpg">
            </div>
            <div class="box">
                <img src="img/b.jpg">
            </div>
        </div>
    </div>
    <div class="ideas">
        <div class="title">
            <h1>We And Our Clients Are Happy To Cooperate With Our Company</h1>
            <span>our features</span>
        </div>
        <div class="row">
            <div class="box">
                <i class="bi bi-stack"></i>
                <div class="detail">
                    <h2>What We Really Do</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                        ullamcorper
                        mattis, pulvinar dapibus
                        leo.
                    </p>

                </div>
            </div>

            <div class="box">
                <i class="bi bi-grid-1x2-fill"></i>
                <div class="detail">
                    <h2>History of Beggiing</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                        ullamcorper
                        mattis, pulvinar dapibus
                        leo.
                    </p>

                </div>
            </div>

            <div class="box">
                <i class="bi bi-tropical-storm"></i>
                <div class="detail">
                    <h2>Our Vision</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                        ullamcorper
                        mattis, pulvinar dapibus
                        leo.
                    </p>

                </div>
            </div>
        </div>
    </div>


    <div class="Poshanheader">
        <div class="slanted-section">
            <h1>Frequently Asked Questions</h1>
        </div>

        <div class="faq-container">
            <div class="sidebarr">
                <ul>
                    <li data-category="beneficiary" class="active"><strong>Basic Q&A</strong></li>
                    <li data-category="awc">Step-by-Step Format</li>
                    <li data-category="officials">Troubleshooting Format</li>
                    <li data-category="poshan">Yes/No Format</li>
                    <li data-category="misc">Do's and Don'ts Format</li>
                </ul>
            </div>

            <div class="faq-content">
                <!-- Beneficiary Questions -->
                <div class="faq-category active" id="beneficiary">
                    <details>
                        <summary>What is the Pooja Store app?</summary>
                        <p>Pooja Store is an online platform where you can easily buy pooja items, spiritual products, idols, and more from the comfort of your home.</p>
                    </details>
                    <details>
                        <summary>Do I need to create an account to place an order?</summary>
                        <p>Yes, creating an account helps you track orders, save addresses, and access your wishlist. It's quick and simple to sign up.</p>
                    </details>
                    <details>
                        <summary>Is the Pooja Store app free to use?</summary>
                        <p>Yes, the app is completely free to download and use. You only pay for the products you purchase.</p>
                    </details>
                    <details>
                        <summary>How can I contact customer support?</summary>
                        <p>You can reach our support team via the “Contact Us” section in the app or email us at support@poojastore.com.</p>
                    </details>
                    <details>
                        <summary>Are my payment details safe on the app?</summary>
                        <p>Absolutely. We use secure payment gateways and encryption to protect your payment and personal information.</p>
                    </details>
                </div>

                <!-- AWC Users Questions -->
                <div class="faq-category" id="awc">
                    <details>
                        <summary>How to place an order on the Pooja Store app?</summary>
                        <p>
                        <ul>
                            <li>Step 1: Open the Pooja Store app and log in.</li>
                            <li>Step 2: Browse products by category or search directly.</li>
                            <li>Step 3: Click on a product to view details.</li>
                            <li>Step 4: Tap “Add to Cart.”</li>
                            <li>Step 5: Go to Cart → Proceed to Checkout → Choose payment method → Confirm order.</li>
                        </ul>
                        You’ll receive an order confirmation via email/SMS.</p>
                    </details>
                    <details>
                        <summary>How to track my order?</summary>
                        <p>
                        <ul>
                            <li>Step 1: Open the app and go to the menu.</li>
                            <li>Step 2: Click on “My Orders.”</li>
                            <li>Step 3: Select the recent order you want to track</li>
                            <li>Step 4: View real-time status (Packed, Shipped, Delivered).</li>
                            <li>Step 5: You will also get tracking updates via SMS/email.</li>
                        </ul>
                        Stay updated at every step until delivery.</p>
                    </details>
                    <details>
                        <summary>How to cancel or modify an order?</summary>
                        <p>
                        <ul>
                            <li>Step 1: Open “My Orders” in your profile.</li>
                            <li>Step 2: Select the order you want to cancel or change.</li>
                            <li>Step 3: If it is not yet shipped, click “Cancel” or “Edit.”</li>
                            <li>Step 4: Confirm your request.</li>
                            <li>Step 5: Refund (if any) will be processed as per policy.</li>
                        </ul>
                        Cancellation is only possible before dispatch.</p>
                    </details>
                    <details>
                        <summary>What to do when the message "Invalid login MPIN" shows up?</summary>
                        <p>Double-check the MPIN or use the "Forgot MPIN" option to reset it.</p>
                    </details>
                </div>

                <!-- Officials Questions -->
                <div class="faq-category" id="officials">
                    <details>
                        <summary>I can’t log into my account. What should I do?</summary>
                        <p> <strong>Possible Causes</strong>
                        <ul>
                            <li>Incorrect email or password-Double :- check your login credentials</li>
                            <li>Network issues :- Try resetting your password using “Forgot Password”</li>
                            <li>Account not registered :- Ensure your internet connection is stable</li>
                        </ul>
                        </p>
                    </details>
                    <details>
                        <summary>My payment failed but money was deducted. What now?</summary>
                        <p>
                        <ul>
                            <li>emporary server issue-> Wait for 24 hours – the amount is usually auto-refunded</li>
                            <li>Bank-side delay-> Check your bank statement for refund confirmation</li>
                            <li>Order not confirmed due to session timeout-> If not refunded, email us your transaction ID at: billing@poojastore.com</li>
                            <li></li>
                        </ul>
                        </p>
                    </details>
                    <details>
                        <summary> I didn’t receive my order. What should I do?</summary>
                        <p>
                        <ul>
                            <li>Delivery delay -> Check your order status under “My Orders”</li>
                            <li>Wrong address entered-> Confirm the delivery address is correct</li>
                            <li>Courier issue-> Contact our delivery support at: delivery@poojastore.com with your Order ID</li>
                            <li></li>
                        </ul>
                        </p>
                    </details>
                    <details>
                        <summary>Product image is not loading properly.</summary>
                        <p>
                        <ul>
                            <li>
                                <strong>Possible Causes:</strong>
                                <ul>
                                    <li>Slow internet connection</li>
                                    <li>App cache issue</li>
                                    <li>Temporary server glitch</li>
                                </ul>
                            </li>
                            <li>
                                <strong>Solution:</strong>
                                <ul>
                                    <li>Refresh the app</li>
                                    <li>Clear cache from app settings</li>
                                    <li>Restart the app or reinstall if needed</li>
                                    <li>Still not loading? Report the issue via “Help & Support” section</li>
                                </ul>
                            </li>
                        </ul>

                        </p>
                    </details>
                    <details>
                        <summary>Why does data on the dashboard not match with the Beneficiary list?</summary>
                        <p>Data mismatches can occur due to synchronization delays or pending updates in the system.</p>
                    </details>
                </div>

                <!-- Poshan Tracker Application Questions -->
                <div class="faq-category" id="poshan">
                    <details>
                        <summary>What can be marked in Daily tracking?</summary>
                        <p>
                        <p><strong>Q1: Can I buy products without signing up?</strong><br>
                            A: No.</p>

                        <p><strong>Q2: Do you deliver nationwide?</strong><br>
                            A: Yes.</p>

                        <p><strong>Q3: Can I return a product?</strong><br>
                            A: Yes.</p>

                        <p><strong>Q4: Is cash on delivery available?</strong><br>
                            A: No.</p>

                        <p><strong>Q5: Do you offer discounts?</strong><br>
                            A: Yes.</p>

                        </p>
                    </details>
                    <details>
                        <summary>Can I buy products without signing up?</summary>
                        <p>No, you need to create an account to place an order.</p>
                    </details>
                    <details>
                        <summary>Do you deliver products across India?</summary>
                        <p>Yes, we deliver to most locations across India.</p>
                    </details>
                    <details>
                        <summary>Can I return a product if I’m not satisfied?</summary>
                        <p>Yes, you can return products within 7 days of delivery..</p>
                    </details>
                </div>

                <!-- Miscellaneous Questions -->
                <div class="faq-category" id="misc">
                    <details>
                        <summary>Is cash on delivery available?</summary>
                        <p>No, currently we accept only online payments.</p>
                    </details>
                    <details>
                        <summary>Do you offer discounts or promo codes?</summary>
                        <p>Yes, we regularly offer discounts and promo codes.</p>
                    </details>
                    <details>
                        <summary>Where can we download the Store Application?</summary>
                        <p>The application can be downloaded from the Google Play Store for Android devices.</p>
                    </details>
                    <details>
                        <summary>Can the Application be used by everyone?</summary>
                        <p>The application is specifically designed for authorized all mandir/Gurudwara/Mashid  padari and officials.</p>
                    </details>
                </div>

                <div class="faq-button">
                    <a href="#">View All FAQs →</a>
                </div>
            </div>
        </div>
    </div>


    <div class="Poshanheader">
        <div class="slanted-section">
            <h1>Frequently Asked Questions</h1>
        </div>

        <div class="faq-container">
            <div class="sidebarr">
                <ul>
                    <li data-category="beneficiary" class="active"><strong>Basic Q&A</strong></li>
                    <li data-category="awc">Step-by-Step Format</li>
                    <li data-category="officials">Troubleshooting Format</li>
                    <li data-category="poshan">Yes/No Format</li>
                    <li data-category="misc">Do's and Don'ts Format</li>
                </ul>
            </div>

            <div class="faq-content">
                <!-- Beneficiary Questions -->
                <div class="faq-category active" id="beneficiary">
                    <details>
                        <summary>What is the Pooja Store app?</summary>
                        <p>Pooja Store is an online platform where you can easily buy pooja items, spiritual products, idols, and more from the comfort of your home.</p>
                    </details>
                    <details>
                        <summary>Do I need to create an account to place an order?</summary>
                        <p>Yes, creating an account helps you track orders, save addresses, and access your wishlist. It's quick and simple to sign up.</p>
                    </details>
                    <details>
                        <summary>Is the Pooja Store app free to use?</summary>
                        <p>Yes, the app is completely free to download and use. You only pay for the products you purchase.</p>
                    </details>
                    <details>
                        <summary>How can I contact customer support?</summary>
                        <p>You can reach our support team via the "Contact Us" section in the app or email us at support@poojastore.com.</p>
                    </details>
                    <details>
                        <summary>Are my payment details safe on the app?</summary>
                        <p>Absolutely. We use secure payment gateways and encryption to protect your payment and personal information.</p>
                    </details>
                </div>

                <!-- AWC Users Questions -->
                <div class="faq-category" id="awc">
                    <details>
                        <summary>How to place an order on the Pooja Store app?</summary>
                        <p>
                        <ul>
                            <li>Step 1: Open the Pooja Store app and log in.</li>
                            <li>Step 2: Browse products by category or search directly.</li>
                            <li>Step 3: Click on a product to view details.</li>
                            <li>Step 4: Tap "Add to Cart."</li>
                            <li>Step 5: Go to Cart → Proceed to Checkout → Choose payment method → Confirm order.</li>
                        </ul>
                        You'll receive an order confirmation via email/SMS.</p>
                    </details>
                    <details>
                        <summary>How to track my order?</summary>
                        <p>
                        <ul>
                            <li>Step 1: Open the app and go to the menu.</li>
                            <li>Step 2: Click on "My Orders."</li>
                            <li>Step 3: Select the recent order you want to track</li>
                            <li>Step 4: View real-time status (Packed, Shipped, Delivered).</li>
                            <li>Step 5: You will also get tracking updates via SMS/email.</li>
                        </ul>
                        Stay updated at every step until delivery.</p>
                    </details>
                    <details>
                        <summary>How to cancel or modify an order?</summary>
                        <p>
                        <ul>
                            <li>Step 1: Open "My Orders" in your profile.</li>
                            <li>Step 2: Select the order you want to cancel or change.</li>
                            <li>Step 3: If it is not yet shipped, click "Cancel" or "Edit."</li>
                            <li>Step 4: Confirm your request.</li>
                            <li>Step 5: Refund (if any) will be processed as per policy.</li>
                        </ul>
                        Cancellation is only possible before dispatch.</p>
                    </details>
                    <details>
                        <summary>What to do when the message "Invalid login MPIN" shows up?</summary>
                        <p>Double-check the MPIN or use the "Forgot MPIN" option to reset it.</p>
                    </details>
                </div>

                <!-- Officials Questions -->
                <div class="faq-category" id="officials">
                    <details>
                        <summary>I can't log into my account. What should I do?</summary>
                        <p> <strong>Possible Causes</strong>
                        <ul>
                            <li>Incorrect email or password-Double :- check your login credentials</li>
                            <li>Network issues :- Try resetting your password using "Forgot Password"</li>
                            <li>Account not registered :- Ensure your internet connection is stable</li>
                        </ul>
                        </p>
                    </details>
                    <details>
                        <summary>My payment failed but money was deducted. What now?</summary>
                        <p>
                        <ul>
                            <li>emporary server issue-> Wait for 24 hours – the amount is usually auto-refunded</li>
                            <li>Bank-side delay-> Check your bank statement for refund confirmation</li>
                            <li>Order not confirmed due to session timeout-> If not refunded, email us your transaction ID at: billing@poojastore.com</li>
                            <li></li>
                        </ul>
                        </p>
                    </details>
                    <details>
                        <summary> I didn't receive my order. What should I do?</summary>
                        <p>
                        <ul>
                            <li>Delivery delay -> Check your order status under "My Orders"</li>
                            <li>Wrong address entered-> Confirm the delivery address is correct</li>
                            <li>Courier issue-> Contact our delivery support at: delivery@poojastore.com with your Order ID</li>
                            <li></li>
                        </ul>
                        </p>
                    </details>
                    <details>
                        <summary>Product image is not loading properly.</summary>
                        <p>
                        <ul>
                            <li>
                                <strong>Possible Causes:</strong>
                                <ul>
                                    <li>Slow internet connection</li>
                                    <li>App cache issue</li>
                                    <li>Temporary server glitch</li>
                                </ul>
                            </li>
                            <li>
                                <strong>Solution:</strong>
                                <ul>
                                    <li>Refresh the app</li>
                                    <li>Clear cache from app settings</li>
                                    <li>Restart the app or reinstall if needed</li>
                                    <li>Still not loading? Report the issue via "Help & Support" section</li>
                                </ul>
                            </li>
                        </ul>

                        </p>
                    </details>
                    <details>
                        <summary>Why does data on the dashboard not match with the Beneficiary list?</summary>
                        <p>Data mismatches can occur due to synchronization delays or pending updates in the system.</p>
                    </details>
                </div>

                <!-- Poshan Tracker Application Questions -->
                <div class="faq-category" id="poshan">
                    <details>
                        <summary>What can be marked in Daily tracking?</summary>
                        <p>
                        <p><strong>Q1: Can I buy products without signing up?</strong><br>
                            A: No.</p>

                        <p><strong>Q2: Do you deliver nationwide?</strong><br>
                            A: Yes.</p>

                        <p><strong>Q3: Can I return a product?</strong><br>
                            A: Yes.</p>

                        <p><strong>Q4: Is cash on delivery available?</strong><br>
                            A: No.</p>

                        <p><strong>Q5: Do you offer discounts?</strong><br>
                            A: Yes.</p>

                        </p>
                    </details>
                    <details>
                        <summary>Can I buy products without signing up?</summary>
                        <p>No, you need to create an account to place an order.</p>
                    </details>
                    <details>
                        <summary>Do you deliver products across India?</summary>
                        <p>Yes, we deliver to most locations across India.</p>
                    </details>
                    <details>
                        <summary>Can I return a product if I'm not satisfied?</summary>
                        <p>Yes, you can return products within 7 days of delivery..</p>
                    </details>
                </div>

                <!-- Miscellaneous Questions -->
                <div class="faq-category" id="misc">
                    <details>
                        <summary>Is cash on delivery available?</summary>
                        <p>No, currently we accept only online payments.</p>
                    </details>
                    <details>
                        <summary>Do you offer discounts or promo codes?</summary>
                        <p>Yes, we regularly offer discounts and promo codes.</p>
                    </details>
                    <details>
                        <summary>Where can we download the Store Application?</summary>
                        <p>The application can be downloaded from the Google Play Store for Android devices.</p>
                    </details>
                    <details>
                        <summary>Can the Application be used by everyone?</summary>
                        <p>The application is specifically designed for authorized all mandir/Gurudwara/Mashid  padari and officials.</p>
                    </details>
                </div>

                <div class="faq-button">
                    <a href="#">View All FAQs →</a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="faq.js"></script>
    <script type="text/javascript" src="faq.js"></script>
</body>

</html>