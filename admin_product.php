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
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/';

    // Create image directory if it doesn't exist
    if (!file_exists($image_folder)) {
        mkdir($image_folder, 0777, true);
    }

    // Generate unique filename
    $image_name = uniqid() . '_' . $image;
    $image_path = $image_folder . $image_name;

    $select_product_name = mysqli_query($conn, "SELECT * FROM `products` WHERE name = '$product_name'") or die('Query failed:');
    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'product already exists!';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'image size is too large! Maximum size is 2MB';
        } else {
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_detail`, `image`) VALUES('$product_name', '$product_price', '$product_detail', '$image_name')") or die('Query failed:');
                if ($insert_product) {
                    $message[] = 'product added successfully!';
                    header('location:admin_product.php');
                } else {
                    $message[] = 'Failed to add product to database!';
                    unlink($image_path); // Remove uploaded image if database insert fails
                }
            } else {
                $message[] = 'Failed to upload image!';
            }
        }
    }
}


//delete products to database
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('Query failed:');

    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('/image/' . $fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('Query failed:');
    mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('Query failed:');
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('Query failed:');

    header('location:admin_product.php');
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
                    <span>' . $msg . '</span>
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

            <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>
    <div class="line3"></div>
    <div class="line4"></div>
    <section class="show-products">
        <div class="box-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed:');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <div class="image-container">
                            <?php
                            $img_path = "image/" . $fetch_products['image'];
                            if (file_exists($img_path) && is_file($img_path)) {
                                echo '<img src="' . $img_path . '" alt="' . $fetch_products['name'] . '">';
                            } else {
                                echo '<div class="no-image">No image available</div>';
                            }
                            ?>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?php echo $fetch_products['name']; ?></h3>
                            <p class="product-price">$<?php echo $fetch_products['price']; ?></p>
                            <details class="product-details">
                                <summary>Product Details</summary>
                                <p><?php echo $fetch_products['product_detail']; ?></p>
                            </details>
                            <div class="action-buttons">
                                <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">Edit</a>
                                <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="return confirm('are you sure you want to delete this product?');">Delete</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '
                    <div class="empty">
                        <p>no products added yet!</p>
                    </div>
                ';
            }
            ?>
        </div>
    </section>


    <script type="text/javascript" src="script.js"></script>

</body>

</html>