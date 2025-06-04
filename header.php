<?php
// Only start session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'connection.php'; // Make sure this is included if not already 

// Check if user_id exists in session, otherwise set to empty
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Shri Shyam Pooja Store</title>
</head>

<body>
    <header class="header">
        <div class="flex">
            <!-- Logo Section -->
            <a href="home.php" class="logo">
                <img src="img/l.png" alt="Logo">
            </a>

            <!-- Navigation Bar -->
            <nav class="navbar">
                <a href="index.php">HOME</a>
                <a href="about.php">ABOUT US</a>
                <a href="shop.php">SHOP</a>
                <a href="order.php">ORDERS</a>
                <a href="contact.php">CONTACT</a>
            </nav>

            <!-- Icons -->
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <?php
                if($user_id != '') {
                    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
                    $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                } else {
                    $wishlist_num_rows = 0;
                }
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"></i><sup><?php echo $wishlist_num_rows; ?></sup></a>
                <?php
                if($user_id != '') {
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                    $cart_num_rows = mysqli_num_rows($select_cart);
                } else {
                    $cart_num_rows = 0;
                }
                ?>
                <a href="cart.php"><i class="bi bi-cart"></i><sup><?php echo $cart_num_rows; ?></sup></a>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>

            <!-- User Information -->
            <div class="user-box" id="user-box" style="display: none;">
                <?php if(isset($_SESSION['user_name'])): ?>
                <strong>
                    <p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
                </strong>
                <strong>
                    <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                </strong>
                <form method="post">
                  <button type="submit" name="logout" class="logout-btn">LOG OUT</button>
                </form>
                <?php else: ?>
                <p>Please <a href="login.php">login</a> or <a href="register.php">register</a></p>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <script>
        // Toggle user box display on icon click
        document.getElementById("user-btn").addEventListener("click", function() {
            const userBox = document.getElementById("user-box");
            userBox.style.display = (userBox.style.display === "none" || userBox.style.display === "") ? "block" : "none";
        });
    </script>
</body>

</html>