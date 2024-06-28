<?php


@include 'config.php';

// Form se data retrieve karen
$user_name = $_POST['user_name'];
$billno = $_POST['billno'];
$cname = $_POST['cname'];
$cnumber = $_POST['cnumber'];
$paymentmethod = $_POST['paymentmethod'];
$gst = $_POST['gst'];
$amount = $_POST['amount'];
$cnun = $_POST['cnun'];
$weight = $_POST['weight'];
$rate = $_POST['rate'];
$product = $_POST['product'];
$extracharge = $_POST['extracharge'];
$note = $_POST['note'];
$apayment = $_POST['apayment'];
$dpayment = $_POST['dpayment'];
$cpayment = $_POST['cpayment'];

// Initialize default value for payment image file
$paymentimage = '';

// Check if payment image file was provided
if (!empty($_FILES['paymentimage']['name'])) {
    // Payment image ka file name generate karen
    $paymentimage = $_FILES['paymentimage']['name'];
    $paymentimage_temp = $_FILES['paymentimage']['tmp_name'];

    // Image ko server par move karen
    $target_directory = "Payment/"; // Directory jahan par image save hoga
    $target_path = $target_directory . $paymentimage;

    if (move_uploaded_file($paymentimage_temp, $target_path)) {
        // Image server par save ho gaya
    } else {
        echo "Error uploading image.";
    }
}

// Ab database me data insert karen
$sql = "INSERT INTO payments (user_name, billno, cname, cnumber, paymentmethod, gst, amount, cnun, weight, rate, product, extracharge, paymentimage, note, apayment, dpayment, cpayment) VALUES ('$user_name', '$billno', '$cname', '$cnumber', '$paymentmethod', '$gst', '$amount', '$cnun', '$weight', '$rate', '$product', '$extracharge', '$paymentimage', '$note', '$apayment', '$dpayment', '$cpayment')";

if ($conn->query($sql) === TRUE) {
    //echo "Payment recorded successfully!";
    header("Location: payment.php");
        exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>