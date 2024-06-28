<?php
// Include your database configuration file
include 'config.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $user_id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM admin_users WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_user_id);

        // Set parameters
        $param_user_id = $user_id;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect back to the page where users are listed
            header("Location: addbranch.php");
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
    // If the user ID is not provided in the URL, redirect back to the page where users are listed
    header("Location: user_list.php");
    exit();
}
?>
