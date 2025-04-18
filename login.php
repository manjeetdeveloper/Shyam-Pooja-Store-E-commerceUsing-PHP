<?php
// Database connection ko include karo
include 'connection.php';
// Session start karo
session_start();

// Agar form submit hua hai toh
if (isset($_POST['submit'])) {
    // Email aur password ko secure tarike se get karo
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Database se user ko search karo
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

    // Agar user mila toh
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);

        // Password ko verify karo
        if (password_verify($password, $row['password'])) {
            // Session ID ko regenerate karo security ke liye
            session_regenerate_id(true);
            
            // Agar user admin hai toh
            if ($row['user_type'] === 'admin') {
                // Admin ke session variables set karo
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                // Admin panel pe redirect karo
                header('location: admin_pannel.php');
                exit();
            } else {
                // Normal user ke session variables set karo
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email']; // ✅ Added missing session variable
                // Home page pe redirect karo
                header('location: index.php');
                exit();
            }
        } else {
            // Wrong password ka message dikhao
            $message[] = 'Incorrect email or password!';
        }
    } else {
        // User not found ka message dikhao
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic HTML meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap icons ko include karo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- CSS file ko include karo -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login Page</title>
</head>
<body>
    <!-- Login form container -->
    <section class="form-container">
        <?php if (isset($message)) {
            // Error messages ko dikhao
            foreach ($message as $msg) {
                echo '<div class="message"><span>' . $msg . '</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i></div>';
            }
        } ?>
        <!-- Login form -->
        <form action="" method="post">
            <h1>Login Now</h1>
            <!-- Email input field -->
            <div class="input-field">
                <label>Your Email</label><br>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Password input field -->
            <div class="input-field">
                <label>Your Password</label><br>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <!-- Submit button -->
            <input type="submit" name="submit" value="Login Now" class="btn">
            <!-- Register link -->
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </section>
</body>
</html>
