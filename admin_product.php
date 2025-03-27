<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}

    //add products to database
    if (isset($_POST['add_product'])) {
        $product_name = mysqli_real_escape_string($conn, $_POST['name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['price']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
        $image = $_FILES['image']['name'];
        $image = $_FILES['image']['name'];
        $image = $_FILES['image']['name'];


    }
?>

<style type="text/css">
    <?php 
        include 'style.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Panel</title>
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <?php 
    if (isset($message)) {
        foreach ($message as $msg) { // Changed variable name to avoid overwriting
            echo '
                <div class="message">
                    <span>'.$msg.'</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
            ';
        }
    }    
    ?>

    <div class="line2"></div>

    <section class="add-products form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="input-field">
                <label>Product Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-field">
                <label>Product Price</label>
                <input type="text" name="price" required>
            </div>

            <div class="input-field">
                <label>Product Detail</label>
                <textarea name="detail" required></textarea>
            </div>

            <div class="input-field">
                <label>Product Image</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>

            <input type="submit" name="add_product" value="Add Product" class="btn">
        </form>
    </section>
    
    <div class="line3"></div>

    <script type="text/javascript" src="script.js"></script>

</body>

</html>
 