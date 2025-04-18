<?php
session_start();
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
                <a href="home.php">HOME</a>
                <a href="about.php">ABOUT US</a>
                <a href="shop.php">SHOP</a>
                <a href="order.php">ORDERS</a>
                <a href="contact.php">CONTACT</a>
            </nav>

            <!-- Icons -->
            <div class="icons">
                <i class="bi bi-list" id="menu-btn"></i>
                <i class="bi bi-person" id="user-btn"></i>
                <a href="wishlist.php"><i class="bi bi-heart"></i></a>
                <a href="cart.php"><i class="bi bi-cart"></i></a>
            </div>

            <!-- User Information -->
            <div class="user-box" id="user-box" style="display: none;">
                <strong><p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p></strong>
                <strong><p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p></strong>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">LOG OUT</button>
                </form>
            </div>
        </div>
    </header>

    <script>
        // Toggle user box display on icon click
        document.getElementById("user-btn").addEventListener("click", function () {
            const userBox = document.getElementById("user-box");
            userBox.style.display = (userBox.style.display === "none" || userBox.style.display === "") ? "block" : "none";
        });
    </script>
</body>
</html>
