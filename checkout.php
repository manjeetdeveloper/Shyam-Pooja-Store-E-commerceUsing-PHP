<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';
$user_name = $_SESSION['user_name'] ?? '';

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}

if (isset($_POST['order-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' .$_POST['flate'].', ' .$_POST['street'].', ' .$_POST['city'].', '.$_POST['state'].', '.$_POST['country'].', '.$_POST['pin']);
    $placed_on = date('d-M-Y');
    $cart_total = 0;
    $cart_product = array();
    $cart_query=mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

    if (mysqli_num_rows($cart_query)>0) {
        while($cart_item=mysqli_fetch_assoc($cart_query)){
        $cart_product[]=$cart_item['name'].' ('.$cart_item['quantity'].')';
        $sub_total= ($cart_item['price'] * $cart_item['quantity']);
        $cart_total+=$sub_total;
        
        }
    }   
    $total_products = implode(', ', $cart_product);
    mysqli_query($conn, "INSERT INTO `order` (`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`) VALUES('$user_id','$name', '$number', '$email', '$method','$address', '$total_products','$cart_total', '$placed_on')") or die('query failed');
    mysqli_query($conn,"DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');
    $message[] = 'order placed successfully';
    header('location:checkout.php');

}

// if (isset($_POST['submit-btn'])) {
//     $name = mysqli_real_escape_string($conn, $_POST['name']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $number = mysqli_real_escape_string($conn, $_POST['number']);
//     $message = mysqli_real_escape_string($conn, $_POST['message']);

//     $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name= '$name' AND email= '$email' AND $number = '$number' AND message='$message'") or die('query failed');
//     if (mysqli_num_rows($select_message) > 0) {
//         echo 'message already send';
//     } else {
//         mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES('$user_id', '$name','$email','$number','$message')") or die('query failed');
//     }
// }
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
            <h1>order</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id suscipit .</p>
            <a href="index.php">Home</a><span>/ order</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="checkout-form">
        <h1 class="title">Payment Process</h1>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
                <div class="message">
                <span>' . $message . '</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>

            ';
            }
        }

        ?>
        <div class="display-order">
            <div class="box-container">
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                $total = 0;
                $grand_total = 0;
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                        $grand_total = $total += $total_price;
                ?>
                        <div class="checkout-card">
                            <div class="checkout-card-image">
                                <img src="image/<?php echo $fetch_cart['image']; ?>" alt="<?= $fetch_cart['name']; ?>">
                            </div>
                            <div class="checkout-card-details">
                                <h3 class="product-name"><?= $fetch_cart['name']; ?></h3>
                                <p class="product-quantity">Quantity: <?= $fetch_cart['quantity']; ?></p>
                            </div>
                        </div>
                <?php
                    }
                }

                ?>
            </div>
            <span class="grand-total">Total Amount Payable : ₹ <?= $grand_total; ?></span>
        </div>
        <form method="post">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="name" placeholder="enter your name">
            </div>

            <div class="input-field">
                <label>your email</label>
                <input type="email" name="email" placeholder="enter your email">
            </div>


            <div class="input-field">
                <label>select payment method</label>
                <select name="method">
                    <option selected disabled>select payment method</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="cradit card">cradit card</option>
                    <option value="paytm">paytm</option>
                    <option value="paypal">paypal</option>
                </select>
            </div>


            <div class="input-field">
                <label>address line 1</label>
                <input type="text" name="flate" placeholder="e.g flate no.">
            </div>
            <div class="input-field">
                <label>address line 2</label>
                <input type="text" name="flate" placeholder="e.g street name">
            </div>
            <div class="input-field">
                <label>city</label>
                <input type="text" name="city" placeholder="e.g delhi">
            </div>
            <div class="input-field">
                <label>state</label>
                <input type="text" name="state" placeholder="e.g new delhi">
            </div>
            <div class="input-field">
                <label>country</label>
                <input type="text" name="country" placeholder="e.g India">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="text" name="flate" placeholder="e.g 144401">
            </div>
            <input type="submit" name="order-btn" class="btn" value="order now">
        </form>
    </div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>