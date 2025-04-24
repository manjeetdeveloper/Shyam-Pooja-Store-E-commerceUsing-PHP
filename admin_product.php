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
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('Query failed:'); // here id = pid

    header('location:admin_product.php');
}

//update product
if(isset($_POST['update_product'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $update_name = mysqli_real_escape_string($conn, $_POST['name']);
    $update_price = mysqli_real_escape_string($conn, $_POST['price']);
    $update_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $update_image = $_FILES['image']['name'];
    $update_image_tmp_name = $_FILES['image']['tmp_name'];
    $update_image_folder = 'image/';

    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', product_detail = '$update_detail' WHERE id = '$update_id'") or die('query failed');

    if($update_query) {
        if(!empty($update_image)) {
            if($_FILES['image']['size'] > 2000000) {
                $message[] = 'image size is too large! Maximum size is 2MB';
            } else {
                // Get old image to delete it
                $select_old_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$update_id'") or die('query failed');
                $fetch_old_image = mysqli_fetch_assoc($select_old_image);
                
                // Delete old image if it exists
                if($fetch_old_image['image'] != '') {
                    unlink('image/'.$fetch_old_image['image']);
                }

                // Generate unique filename for new image
                $update_image_name = uniqid() . '_' . $update_image;
                $update_image_path = $update_image_folder . $update_image_name;

                if(move_uploaded_file($update_image_tmp_name, $update_image_path)) {
                    mysqli_query($conn, "UPDATE `products` SET image = '$update_image_name' WHERE id = '$update_id'") or die('query failed');
                    $message[] = 'Product updated successfully with new image!';
                } else {
                    $message[] = 'Failed to update image!';
                }
            }
        } else {
            $message[] = 'Product updated successfully!';
        }
        header('location:admin_product.php');
    } else {
        $message[] = 'Failed to update product!';
    }
}

?>

<style type="text/css">
    <?php
    include 'style.css';
    ?>
    <style>
        :root {
            --orange: #ff6b35;
            --dark-orange: #e85a2c;
            --light-orange: rgba(255, 107, 53, 0.1);
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .show-products {
            padding: 2rem;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .box {
            background: white;
            border-radius: 15px;
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }

        .image-container {
            height: 250px;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .box:hover .image-container img {
            transform: scale(1.08);
        }

        .no-image {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.9rem;
            background: #f8f9fa;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--orange);
            margin-bottom: 1rem;
        }

        .product-price::before {
            content: '₹';
            font-size: 1.2rem;
            color: var(--orange);
            font-weight: 600;
        }

        .product-details {
            border: none;
            margin-bottom: 1.5rem;
        }

        .product-details summary {
            padding: 0.8rem 1.2rem;
            background: var(--light-orange);
            color: var(--orange);
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-details summary:hover {
            background: rgba(255, 107, 53, 0.2);
        }

        .product-details p {
            padding: 1rem;
            color: #666;
            line-height: 1.6;
            font-size: 0.95rem;
            background: rgba(248, 249, 250, 0.5);
            border-radius: 8px;
            margin-top: 0.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-start;
        }

        .action-buttons a {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .action-buttons .edit {
            background: var(--orange);
            color: white;
            border: 2px solid var(--orange);
        }

        .action-buttons .delete {
            background: white;
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .action-buttons .edit:hover {
            background: var(--dark-orange);
            border-color: var(--dark-orange);
        }

        .action-buttons .delete:hover {
            background: #dc3545;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 2rem;
            font-size: 1.2rem;
            color: #6c757d;
            background: white;
            border-radius: 15px;
            box-shadow: var(--box-shadow);
            margin: 2rem auto;
            max-width: 500px;
        }

        @media (max-width: 991px) {
            .box-container {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .show-products {
                padding: 1rem;
            }

            .box {
                max-width: 400px;
                margin: 0 auto;
            }

            .image-container {
                height: 220px;
            }

            .product-info {
                padding: 1.2rem;
            }

            .product-name {
                font-size: 1.1rem;
            }

            .product-price {
                font-size: 1.3rem;
            }

            .action-buttons a {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
    </style>
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
                <input type="number" name="price" placeholder="Enter price in INR" min="0" required>
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
                            <p class="product-price">₹<?php echo number_format($fetch_products['price']); ?></p>
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

    <div class="line"></div>
    <section class="update-container">
        <?php
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$edit_id'") or die('Query failed:');
            if (mysqli_num_rows($edit_query) > 0) {
                while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
        ?>
        <form method="POST" enctype="multipart/form-data">
            <img src="image/<?php echo $fetch_edit['image']; ?>" alt="error">
            <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" name="name" value="<?php echo $fetch_edit['name']; ?>" required>
            <input type="number" name="price" min="0" placeholder="Enter price in INR" value="<?php echo $fetch_edit['price']; ?>" required>
            <textarea name="detail" required><?php echo $fetch_edit['product_detail']; ?></textarea>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp">
            <input type="submit" name="update_product" value="update" class="edit">
            <input type="reset" value="cancel" class="option-btn btn" onclick="closeUpdateForm()">
        </form>
        <?php
                }
            }
            echo "<script>document.querySelector('.update-container').style.display = 'flex';</script>";
        }
        ?>
    </section>

    <script type="text/javascript">
        function closeUpdateForm() {
            document.querySelector('.update-container').style.display = 'none';
            window.location.href = 'admin_product.php';
        }
    </script>

    <script type="text/javascript" src="script.js"></script>

</body>

</html>