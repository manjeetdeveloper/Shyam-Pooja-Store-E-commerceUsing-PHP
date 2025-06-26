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

// adding product in wishlist

if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    // Make sure $user_id is defined
    $user_id = $_SESSION['user_id'] ?? '';

    if ($user_id == '') {
        $message[] = 'Please login first!';
    } else {
        $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');
        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');

        if (mysqli_num_rows($wishlist_number) > 0) {
            $message[] = 'Product already exists in wishlist';
        } else if (mysqli_num_rows($cart_num) > 0) {
            $message[] = 'Product already exists in cart';
        } else {
            mysqli_query($conn, "INSERT INTO `wishlist` (`user_id`, `pid`, `name`, `price`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
            $message[] = 'Product successfully added to your wishlist';
        }
    }
}

// adding product in cart

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];


    // Make sure $user_id is defined
    $user_id = $_SESSION['user_id'] ?? '';

    if ($user_id == '') {
        $message[] = 'Please login first!';
    } else {

        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');

        if (mysqli_num_rows($cart_num) > 0) {
            $message[] = 'Product already exists in cart';
        } else {
            mysqli_query($conn, "INSERT INTO `cart` (`user_id`, `pid`, `name`, `price`,`quantity`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price','$product_quantity', '$product_image')");
            $message[] = 'Product successfully added to your cart';
        }
    }
}

?>
<style type="text/css">
    <?php
    include 'main.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- --------------------slick slider link ----------------------------------------------------- -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
    <title>home page</title>
</head>

<body>

    <?php include 'header.php'; ?>
    <!-- --------------------Home slider link ----------------------------------------------------- -->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="img/Banneragar.webp" alt="slider image error">
                <!-- <div class="slider-caption">
                    <span>Test the Quality</span>
                    <h1>Organic Premium <br>Pooja</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Ad quo enim corrupti sit molestias inventore commodi optio
                        nesciunt rerum animi?
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div> -->
            </div>

            <div class="slider-item">
                <img src="img/Nature's.jpeg" alt="slider image errorsss">
                <div class="slider-caption">
                    <span>Test the Quality</span>
                    <h1>Organic Premium</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Ad quo enim corrupti sit molestias inventore commodi optio
                        nesciunt rerum animi?
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>

            <div class="slider-item">
                <img src="img/slider-h.webp" alt="slider image errorsss">
            </div>
            <div class="slider-item">
                <img src="img/slider-h.webp" alt="slider image errorsss">
            </div>



        </div>
        <!-- <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div> -->
    </div>
    <div class="line"></div>
    <div class="services">
        <div class="row">
            <div class="box">
                <div class="icon-circle">
                    <img src="img/free-delivery.png" alt="Free Delivery">
                </div>
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <div class="icon-circle">
                    <img src="img/save-money.png" alt="Money Back">
                </div>
                <div>
                    <h1>Money Back & Guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <div class="icon-circle">
                    <img src="img/call-center.png" alt="Support">
                </div>
                <div>
                    <h1>Online Support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Services end  -->
    <div class="story">
        <div class="row">
            <div class="box">
                <span>our story</span>
                <h1>Production of natural since 1990</h1>
                <p>Interdum Et Malesuada Fames Ac Ante Ipsum Primis In Faucibus. Vestibulum Laoreet Est Orci, Eu
                    Placerat Est Posuere In.
                    Sed Malesuada Magna Vitae Pulvinar Varius. Orci Varius Nato Que Penatibus Et Magnis Dis
                    Parturient
                    Montes, Ridiculus
                    Mus. Integer Vel Nisi Lorem. Donec Dignissim Commodo Rhon Cus. Nullam.k</p>
                <a href="shop.php" class="btn">shop now</a>
            </div>

            <div class="box">
                <img src="img/dhhop2.png" alt="">
            </div>
        </div>
    </div>

    <div class="line3"></div>
    <!-- -------------------------Testmonaial------------------------- -->

    <div class="line4"></div>
    <div class="testimonial-fluid">
        <h1 class="title">What Our Customers Say's</h1>
        <div class="testimonial-slider">
            <div class="testimonial-item">
                <img src="img/manjeet.jpg">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.k</p>
                </div>
            </div>

            <div class="testimonial-item">
                <img src="img/manjeet.jpg">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.k </p>
                </div>
            </div>



            <div class="testimonial-item">
                <img src="img/manjeet.jpg">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.k </p>
                </div>
            </div>
        </div>
        <div class="control">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------ -->
    <div class="line"></div>
    <!-- Discover section -->
    <div class="line2"></div>
    <div class="discover">
        <div class="detail">
            <h1 class="title">Organic Items Be Natural</h1>
            <span>Buy Now And Save 30% Off ! </span>
            <p>lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The
                Industry's
                Standard
                Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To
                Make
                A
                Type Specimen
                Book .
            </p>
            <a href="shop.php" class="btn">discover now</a>
        </div>
        <div class="img-box">
            <img src="img/dhhop2.png">
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'homeshop.php'; ?>

    <!-- VIDEO autoplay -->

    <div class="video-section">
        <h2>Hari Darshan : Fragrance of Peace</h2>
        <div class="video-box">
            <video playsinline autoplay loop muted controls preload="metadata">
                <source src="videos/vide.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <!-- END VIDEO AUTOPLAY -->

    <div class="line3"></div>
     <!-- video and niche ka content ke top-bottom me gap dene ke liye upper line comment ko uncomment kre  -->
    
    <div class="timing-info-container">
        <div class="hr"></div>
        <h2 class="timing-title">We are now available<br> <span>on Video Conference</span></h2>
        <div class="timing-cards">
            <div class="timing-card shop-timing">
                <div class="card-icon">
                <i class="bi bi-shop" style="font-size: 50px;"></i>
                </div>
                <h3>shop Open</h3>
                <div class="timing-details">
                    <p><i class="bi bi-calendar-check"></i> Monday to Friday</p>
                    <p><i class="bi bi-clock"></i> 09:00 PM to 08:30 PM</p>
                    <button onclick="openAppointmentForm()" class="join-btn">Join Now <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- Appointment Form Modal -->
            <div id="appointmentModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAppointmentForm()">&times;</span>
                    <h2>Book an Appointment</h2>
                    <form id="appointmentForm" method="post" action="save_appointment.php">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="appointment_time">Preferred Time:</label>
                            <input type="time" id="appointment_time" name="appointment_time" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message (Optional):</label>
                            <textarea id="message" name="message"></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Book Appointment</button>
                    </form>
                </div>
            </div>
            <div class="timing-card pandit-timing">
                <div class="card-icon">
                    <i class="bi bi-camera-video-fill" style="font-size: 50px; color: white;"></i>
                </div>
                <h3>Pandit Ji Video Conference</h3>
                <div class="timing-details">
                    <p><i class="bi bi-calendar-check"></i> Monday to Sunday</p>
                    <p><i class="bi bi-clock"></i> 06:15 PM to 07:15 PM</p>
                    <a href="https://meet.google.com/gdy-icpw-ekm" class="join-btn">Book VC <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="promo-container">
        <div class="promo-card">
            <div class="promo-image"></div>
            <div class="promo-content">
                <span>Fill your space with serenity and positivity</span>
                <h2>Explore Agarbattis</h2>
                <p><strong>Hari Darshan Agarbatti</strong> fills your space with a divine fragrance, ideal for <strong>meditation</strong>, <strong>prayers</strong>, and creating a peaceful, spiritual ambiance. Made with natural ingredients, it enhances <strong>positivity</strong>, tranquility, and serenity in your home or temple.</p>
                <button class="shop-btn">Shop Now</button>
            </div>
        </div>
    </div>


    <div class="quality-services">
        <h1 class="title hover-underline">Quality Services</h1>
        <div class="services-grid">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="img/Pure and Authentic Products.png" alt="Pure and Authentic Products" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                    </div>
                    <div class="flip-card-back">
                        <div class="service-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>Pure and Authentic Products</h3>
                        <ul>
                            <li>Certified and Lab-Tested Products</li>
                            <li>100% Natural Ingredients</li>
                            <li>Handpicked by Experts</li>
                            <li>Sourced from Trusted Vendors</li>
                            <li>No Artificial Fragrance or Colors</li>
                            <li>Fresh Stock Only</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="img/Affordable Pricing.png" alt="Affordable Pricing" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                    </div>
                    <div class="flip-card-back">
                        <div class="service-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>
                        <h3>Affordable Pricing</h3>
                        <ul>
                            <li>Best Price Guarantee</li>
                            <li>No Hidden Charges</li>
                            <li>Combo Offers & Discounts</li>
                            <li>Festival Sale Offers</li>
                            <li>Value for Money Products</li>
                            <li>Free Delivery on Minimum Order</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="img/undraw_order-delivered_puaw.png" alt="Fast and Safe Delivery" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                    </div>
                    <div class="flip-card-back">
                        <div class="service-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3>Fast and Safe Delivery</h3>
                        <ul>
                            <li>Pan-India Delivery Network</li>
                            <li>Same-Day or Next-Day Dispatch</li>
                            <li>Real-Time Order Tracking</li>
                            <li>Delivery Updates via SMS/Email</li>
                            <li>Free Delivery on Eligible Orders</li>
                            <li>Trusted Courier Partners</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="img/undraw_stripe-payments_g8qn.png" alt="Secure Online Payments" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                    </div>
                    <div class="flip-card-back">
                        <div class="service-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h3>Secure Online Payments</h3>
                        <ul>
                            <li>Multiple Payment Options(UPI,Net BAnking)</li>
                            <li>Razorpay / Paytm / Stripe Integration</li>
                            <li>One-Click Checkout Process</li>
                            <li>No Data Sharing with Third Parties</li>
                            <li>Cash on Delivery (COD) Available</li>
                            <li>100% Payment Protection Guarantee</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ------------------Newsletter -------------------->

    <div class="newslatter">
        <h1 class="title">Join Our To Newslatter</h1>
        <p>Get 15% off your next order. Be the first to learn about promotions special events, new arrivals and more.
        </p>
        <input type="text" name="" placeholder="your Email Address ... ">
        <button>subscribe now</button>
    </div>
    <div class="line3"></div>
    <div class="client">
        <div class="box">
            <img src="img/japmala.webp">
        </div>
        <div class="box">
            <img src="img/sangu.webp">
        </div>
        <div class="box">
            <img src="img/thalii.webp">
        </div>
        <div class="box">
            <img src="img/cloths.webp">
        </div>
        <div class="box">
            <img src="img/lamp.webp">
        </div>



    </div>

    </div>
    <?php include 'footer.php'; ?>
    <script src="jquary.js"></script>
    <script src="slick.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="script2.js"></script>

    <script type="text/javascript">
        <?php include 'script2.js' ?>

        // अपॉइंटमेंट फॉर्म के लिए जावास्क्रिप्ट
        function openAppointmentForm() {
            document.getElementById('appointmentModal').style.display = 'block';
        }

        function closeAppointmentForm() {
            document.getElementById('appointmentModal').style.display = 'none';
        }

        // फॉर्म सबमिशन हैंडलर
        document.getElementById('appointmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('save_appointment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    alert(data.message);
                    closeAppointmentForm();
                    this.reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('कुछ गड़बड़ हो गई, कृपया पुनः प्रयास करें');
            });
        });

        // बाहर क्लिक करने पर मॉडल को बंद करें
        window.onclick = function(event) {
            if (event.target == document.getElementById('appointmentModal')) {
                closeAppointmentForm();
            }
        }
    </script>
    <style>
        /* मॉडल स्टाइल */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-btn {
            background-color: var(--orange);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #d35400;
        }
    </style>
</body>

</html>
<!----------------------slick slider link ----------------------------------------------------- -->