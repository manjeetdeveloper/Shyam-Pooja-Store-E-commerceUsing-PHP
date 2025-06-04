<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'] ?? '';

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
if (isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name= '$name' AND email= '$email' AND $number = '$number' AND message='$message'") or die('query failed');
    if (mysqli_num_rows($select_message)>0) {
        echo 'message already send';
    }else{
        mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES('$user_id', '$name','$email','$number','$message')") or die('query failed');
    }
    
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- --- bootstrap icon link -- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title>Shree Shyam - our shop</title>
</head>

<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>contact</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id suscipit .</p>
            <a href="index.php">Home</a><span>/ contact</span>
        </div>
    </div>
    <div class="line"></div>
    <!----------------------about us  ----------------------------------------------------- -->

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
    <div class="line4"></div>
    <div class="form-container">
        <h1 class="title">leave a message</h1>
        <form method="post">
            <div class="input-field">
                <label>your name</label><br>
                <input type="text" name="name">
            </div>

            <div class="input-field">
                <label>your email</label><br>
                <input type="text" name="email">
            </div>

            <div class="input-field">
                <label>number</label><br>
                <input type="number" name="number">
            </div>

            <div class="input-field">
                <label>your message</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">send message</button>
        </form>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="address">
        <h1 class="title">our contact</h1>
        <div class="row">
            <div class="box">
                <i class="bi bi-map-fill"></i>
                <div>
                    <h4>address</h4>
                    <p>144401 Phagwara GT ROAD,
                         <br> Jalandhar,
                        Punjab, 144401
                    </p>

                </div>
            </div>

            <div class="box">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <h4>phone number</h4>
                    <p>9905350850</p>
                </div>
            </div>

            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <h4>email</h4>
                    <p>shyampoojastore@gmail.com</p>

                </div>
            </div>
        </div>
    </div>

    
    <div class="line3"></div>

    <div class="webyroot-section">
        <h1 class="webyroot-title">We are always ready to help you</h1>
        <p class="webyroot-desc">At Shri Shyam Pooja Store, we're always here to assist you with any sales inquiries, partnership opportunities, or career-related questions you may have. Our team of experts is dedicated to providing exceptional customer service and support, ensuring that you receive prompt and helpful responses to your inquiries.</p>
        
        <div class="webyroot-cards">
            <div class="webyroot-card">
                <i class="bi bi-briefcase-fill"></i>
                <h3>Sales Inquiry</h3>
                <p>Get in touch with Shri Shyam Pooja Store, for all your sales inquiries. Our expert team is ready to assist you with customized solutions to meet your business needs.</p>
            </div>

            <div class="webyroot-card">
                <i class="bi bi-people-fill"></i>
                <h3>Partnership</h3>
                <p>Explore partnership opportunities with WebyRoot and discover how we can help you expand your business. Our team is committed to building strong and lasting relationships.</p>
            </div>

            <div class="webyroot-card">
                <i class="bi bi-person-workspace"></i>
                <h3>Career</h3>
                <p>Join the Shri Shyam Pooja Store, team and take your career to the next level. We offer a supportive and dynamic work environment that fosters growth and creativity.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>