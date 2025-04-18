<?php
// Database connection ko include karo
include 'connection.php';
// Session start karo
session_start();

// Agar form submit hua hai toh
if(isset($_POST['submit'])){
   // Form data ko secure tarike se get karo
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
   
   // Database mein check karo ki user already exists toh nahi hai
   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

   // Agar user already exists hai toh
   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   }else{
      // Password aur confirm password match karte hai ya nahi check karo
      if($password != $cpassword){
         $message[] = 'Passwords do not match!';
      }else{
         // Password ko hash karo secure storage ke liye
         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
         
         // User ko database mein insert karo
         $insert = mysqli_query($conn, "INSERT INTO `users` (name, email, password) 
            VALUES ('$name', '$email', '$hashed_password')") 
            or die('Insert failed: ' . mysqli_error($conn));

         // Agar insert successful hua toh
         if($insert){
            $message[] = "Registration successful! Please login.";
            // 3 seconds baad login page pe redirect karo
            header("refresh:3;url=login.php");
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Basic HTML meta tags -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <!-- CSS file ko include karo -->
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Error messages ko dikhao
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message">'.$msg.'</div>';
   }
}
?>

<!-- Registration form container -->
<div class="form-container">
   <!-- Registration form -->
   <form action="" method="post">
      <h3>Register Now</h3>
      <!-- Name input field -->
      <input type="text" name="name" required placeholder="Enter your name" class="box">
      <!-- Email input field -->
      <input type="email" name="email" required placeholder="Enter your email" class="box">
      <!-- Password input field -->
      <input type="password" name="password" required placeholder="Enter your password" class="box">
      <!-- Confirm password input field -->
      <input type="password" name="cpassword" required placeholder="Confirm your password" class="box">
      <!-- Submit button -->
      <input type="submit" name="submit" value="Register now" class="btn">
      <!-- Login link -->
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>
</div>

</body>
</html>
