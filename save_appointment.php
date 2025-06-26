<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // फॉर्म डेटा को सुरक्षित तरीके से प्राप्त करें
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $user_id = $_SESSION['user_id'] ?? '';

    // डेटाबेस में अपॉइंटमेंट को सेव करें
    $sql = "INSERT INTO appointments (user_id, name, email, phone, appointment_time, message) 
            VALUES ('$user_id', '$name', '$email', '$phone', '$appointment_time', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'आपका अपॉइंटमेंट सफलतापूर्वक बुक हो गया है']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'कुछ गड़बड़ हो गई, कृपया पुनः प्रयास करें']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'अमान्य अनुरोध']);
}