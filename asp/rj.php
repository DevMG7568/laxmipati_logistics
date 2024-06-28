
<?php

@include 'config.php';

session_start();

// Check if the user is logged in (i.e., the session variable is set)
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

// Display the username on the dashboard
$username = $_SESSION['admin_username'];

// Form se data retrieve karen
$cname = $_POST['cname'];
$cnumber = $_POST['cnumber'];
$paymentmethod = $_POST['paymentmethod'];
$amount = $_POST['amount'];
$cnun = $_POST['cnun'];
$weight = $_POST['weight'];
$rate = $_POST['rate'];
$extracharge = $_POST['extracharge'];
$note = $_POST['note'];
$apayment = $_POST['apayment'];
$dpayment = $_POST['dpayment'];
$cpayment = $_POST['cpayment'];

// Payment image ka file name generate karen
$paymentimage = $_FILES['paymentimage']['name'];
$paymentimage_temp = $_FILES['paymentimage']['tmp_name'];

// Image ko server par move karen
$target_directory = "Payment/"; // Directory jahan par image save hoga
$target_path = $target_directory . $paymentimage;

if (move_uploaded_file($paymentimage_temp, $target_path)) {
    // Image server par save ho gaya
    // Ab database me data insert karen
    $sql = "INSERT INTO payments (cname, cnumber, paymentmethod, amount, cnun, weight, rate, extracharge, paymentimage, note, apayment, dpayment, cpayment) VALUES ('$cname', '$cnumber', '$paymentmethod', '$amount', '$cnun', '$weight', '$rate', '$extracharge', '$paymentimage', '$note', '$apayment', '$dpayment', '$cpayment')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    //echo "Error uploading image.";
}

?>