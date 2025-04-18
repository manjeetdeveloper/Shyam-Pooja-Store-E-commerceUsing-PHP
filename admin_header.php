<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <header class="header">
        <div class="flex">
            <!-- Logo Section -->
            <a href="admin_pannel.php" class="logo">
                <img src="img/l.png" alt="Logo">
            </a>

            <!-- Navigation Bar -->
            <nav class="navbar">
                <a href="admin_pannel.php">HOME</a>
                <a href="admin_product.php">PRODUCTS</a>
                <a href="admin_order.php">ORDERS</a>
                <a href="admin_user.php">USERS</a>
                <a href="admin_message.php">MESSAGES</a>
            </nav>

            <!-- Icons -->
            <div class="icons">
                <i class="bi bi-list" id="menu-btn"></i>
                <i class="bi bi-person" id="user-btn"></i>
            </div>

            <!-- User Information -->
            <div class="user-box">
                <p>Username: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post" action="">
                    <button type="submit" name="logout" class="delete-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Dashboard Banner -->
    <div class="banner">
        <div class="detail">
            <h1>Admin Dashboard</h1>
            <p>Welcome to the admin dashboard. Manage your site efficiently.</p>
        </div>
    </div>

    <div class="line"></div>

    <script src="script.js"></script>
    <script>
        // Handle header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Handle user box toggle
        const userBtn = document.querySelector('#user-btn');
        const userBox = document.querySelector('.user-box');
        
        userBtn.addEventListener('click', function() {
            userBox.classList.toggle('active');
        });

        // Close user box when clicking outside
        document.addEventListener('click', function(e) {
            if (!userBtn.contains(e.target) && !userBox.contains(e.target)) {
                userBox.classList.remove('active');
            }
        });

        // Handle mobile menu
        const menuBtn = document.querySelector('#menu-btn');
        const navbar = document.querySelector('.navbar');
        
        menuBtn.addEventListener('click', function() {
            navbar.classList.toggle('active');
        });
    </script>
</body>
</html>