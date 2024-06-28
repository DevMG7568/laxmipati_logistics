<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form se data retrieve karen
    $adminusername = $_POST['adminusername'];
    $usernumber = $_POST['usernumber'];
    $branchname = $_POST['branchname'];
    $userpassword = $_POST['userpassword'];
    $aadharcardnumber = $_POST['aadharcardnumber'];
    $pancardnumber = $_POST['pancardnumber'];
    $address = $_POST['address'];
    
    // Initialize default value for profile picture file
    $profilepicture = '';

    // Check if profile picture file was provided
    if (!empty($_FILES['profilepicture']['name'])) {
        // Payment image ka file name generate karen
        $profilepicture = $_FILES['profilepicture']['name'];
        $profilepicture_temp = $_FILES['profilepicture']['tmp_name'];
    
        // Image ko server par move karen
        $target_directory = "Profilepicture/"; // Directory jahan par image save hoga
        $target_path = $target_directory . $profilepicture;

        if (move_uploaded_file($profilepicture_temp, $target_path)) {
            // Image server par save ho gaya
        } else {
            echo "Error uploading image.";
        }
    }

    // Database connection ko include karen (make sure it's included before this point)
    include 'config.php';

    // Ab database me data insert karen
    $sql = "INSERT INTO admin_users (adminusername, usernumber, branchname, userpassword, aadharcardnumber, pancardnumber, address, profilepicture) VALUES ('$adminusername', '$usernumber', '$branchname', '$userpassword', '$aadharcardnumber', '$pancardnumber', '$address', '$profilepicture')";

    if ($conn->query($sql) === TRUE) {
        echo "User Added successfully!";
        
        // Redirect to addbranch.php
        header("Location: addbranch.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Database connection ko close karen
    $conn->close();
}

?>
