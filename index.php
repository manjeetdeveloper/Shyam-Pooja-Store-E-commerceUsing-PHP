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
    <title>home page</title>
</head>

<body>

    <?php include 'header.php'; ?>
    <!-- --------------------Home slider link ----------------------------------------------------- -->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="img/download (3).jpeg" alt="slider image error">
                <div class="slider-caption">
                    <span>Test the Quality</span>
                    <h1>Organic Premium <br>Pooja</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Ad quo enim corrupti sit molestias inventore commodi optio
                        nesciunt rerum animi?
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
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
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
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

    <div class="line2"></div>
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
            <h1 class="title">Organic Honey Be Healthy</h1>
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
    <div class="line2"></div>

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
    </script>
</body>

</html>
<!----------------------slick slider link ----------------------------------------------------- -->