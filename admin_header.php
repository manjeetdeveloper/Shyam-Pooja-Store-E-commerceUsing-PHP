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
                <strong><p>Username: <span><?php echo $_SESSION['admin_name']; ?></span></p></strong>
                <strong><p>Email: <span><?php 
                    include 'connection.php';
                    $admin_id = $_SESSION['admin_id'];
                    $select_admin = mysqli_query($conn, "SELECT email FROM users WHERE id = '$admin_id'") or die('Query failed');
                    if(mysqli_num_rows($select_admin) > 0) {
                        $row = mysqli_fetch_assoc($select_admin);
                        echo $row['email'];
                    }
                ?></span></p></strong>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">LOG OUT</button>
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
</body>
</html>