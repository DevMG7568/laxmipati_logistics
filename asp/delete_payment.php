<?php
// Include your database configuration file
include 'config.php';

// Check if the payment ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $payment_id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM payments WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_payment_id);

        // Set parameters
        $param_payment_id = $payment_id;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect back to the page where payments are listed
            header("Location: payment.php");
            exit();
        } else {
            // If execution fails, display an error message
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // If the payment ID is not provided in the URL, redirect back to the page where payments are listed
    header("Location: payment.php");
    exit();
}
?>
