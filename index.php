<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['user_name'];// yaha dekh lena galat hoga user_id tha palhe 

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}

?>
<style type="text/css">
    <?php
    include 'main.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php include 'header.php';?>
    
</body>
</html>
