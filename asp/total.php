<?php
// Include your database connection file
@include 'config.php';

// Retrieve total price and quantity from JavaScript
$totalPrice = $_POST['total'];
$totalQuantity = $_POST['qty'];

// Perform database insertion
$sql = "INSERT INTO total (total_price, total_quantity) VALUES ('$totalPrice', '$totalQuantity')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
