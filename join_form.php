<?php
include 'connection.php';
session_start();

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // फाइल अपलोड की जांच
    if(isset($_FILES['user_list']) && $_FILES['user_list']['error'] == 0) {
        $file_name = $_FILES['user_list']['name'];
        $file_tmp = $_FILES['user_list']['tmp_name'];
        $file_type = $_FILES['user_list']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // अनुमति प्राप्त फाइल प्रकार
        $allowed = array('pdf', 'doc', 'docx', 'txt');
        
        if(in_array($file_ext, $allowed)) {
            $upload_path = 'uploads/' . time() . '_' . $file_name;
            
            // अपलोड डायरेक्टरी बनाएं यदि मौजूद नहीं है
            if(!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }
            
            if(move_uploaded_file($file_tmp, $upload_path)) {
                // डेटाबेस में जानकारी सहेजें
                $insert = mysqli_query($conn, "INSERT INTO join_requests (name, email, phone, message, file_path) 
                    VALUES ('$name', '$email', '$phone', '$message', '$upload_path')") 
                    or die('Query failed: ' . mysqli_error($conn));
                
                if($insert) {
                    echo json_encode(['status' => 'success', 'message' => 'आपका फॉर्म सफलतापूर्वक जमा किया गया है!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'डेटाबेस में जोड़ने में त्रुटि हुई']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'फाइल अपलोड करने में त्रुटि हुई']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'केवल PDF, DOC, DOCX और TXT फाइलें स्वीकृत हैं']);
        }
    } else {
        // बिना फाइल के फॉर्म जमा करें
        $insert = mysqli_query($conn, "INSERT INTO join_requests (name, email, phone, message) 
            VALUES ('$name', '$email', '$phone', '$message')") 
            or die('Query failed: ' . mysqli_error($conn));
        
        if($insert) {
            echo json_encode(['status' => 'success', 'message' => 'आपका फॉर्म सफलतापूर्वक जमा किया गया है!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'डेटाबेस में जोड़ने में त्रुटि हुई']);
        }
    }
    exit;
}
?>