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
            <div class="box">
                <div class="img-box">
                    <img src="img/manjeet.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Om Prakash Tiwari</h4>
                    <div class="icons">
                        <i .class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="img/manjeet.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Om Prakash Tiwari</h4>
                    <div class="icons">
                        <i .class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="img/manjeet.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Om Prakash Tiwari</h4>
                    <div class="icons">
                        <i .class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="img/manjeet.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Om Prakash Tiwari</h4>
                    <div class="icons">
                        <i .class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="img-box">
                    <img src="img/manjeet.jpg">
                </div>
                <div class="detail">
                    <span>Finace Manager</span>
                    <h4>Om Prakash Tiwari</h4>
                    <div class="icons">
                        <i .class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <div class="project">
        <div class="title">
            <h1>Our Best Project</h1>
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
    <div class="line2"></div>
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
    <div class="line"></div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>