<?php
include 'connection.php';
session_start();

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
   
   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   }else{
      if($password != $cpassword){
         $message[] = 'Passwords do not match!';
      }else{
         // Store password in plain text (not recommended for security reasons)
         $insert = mysqli_query($conn, "INSERT INTO `users` (name, email, password) 
            VALUES ('$name', '$email', '$password')") 
            or die('Insert failed: ' . mysqli_error($conn));

         if($insert){
            $message[] = "Registration successful! Please login.";
            header("refresh:3;url=login.php");
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message">'.$msg.'</div>';
   }
}
?>

<div class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      <input type="text" name="name" required placeholder="Enter your name" class="box">
      <input type="email" name="email" required placeholder="Enter your email" class="box">
      <input type="password" name="password" required placeholder="Enter your password" class="box">
      <input type="password" name="cpassword" required placeholder="Confirm your password" class="box">
      <input type="submit" name="submit" value="Register now" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>
</div>

</body>
</html>
