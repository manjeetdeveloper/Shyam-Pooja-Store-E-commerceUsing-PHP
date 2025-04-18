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

// delete message from database
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('Query failed:');
    header('location:admin_message.php');
    exit();
}
?>

<style type="text/css">
    <?php include 'style.css'; ?>
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
        foreach ($message as $msg) {
            echo '
                <div class="message">
                    <span>' . $msg . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
            ';
        }
    }
    ?>

    <div class="line4"></div>
    <section class="message-container">
        <h1 class="title">Unread Messages</h1>
        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('Query Failed');

            if (mysqli_num_rows($select_message) > 0) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {
            ?>
                    <div class="box">
                        <p>User ID: <span><?php echo $fetch_message['id']; ?></span></p>
                        <p>Name: <span><?php echo $fetch_message['name']; ?></span></p>
                        <p>Email: <span><?php echo $fetch_message['email']; ?></span></p>
                        <p><?php echo $fetch_message['message']; ?></p>
                        <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
                    </div>
            <?php
                }
            } else {
                echo '
                    <div class="empty">
                        <p>No messages found!</p>
                    </div>
                ';
            }
            ?>
        </div>
    </section>
    <div class="line4"></div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>
