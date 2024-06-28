<?php
@include 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Sabse pehle product_details se related data delete karein
    $sql_product = "DELETE FROM product_details WHERE product_id = $id";
    if(mysqli_query($conn, $sql_product)) {
        // Phir order_details se data delete karein
        $sql_order = "DELETE FROM order_details WHERE id = $id";
        if(mysqli_query($conn, $sql_order)) {
            echo "Data deleted successfully";
             header("Location: allorder.php");
        } else {
            echo "Error deleting data from order_details: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting data from product_details: " . mysqli_error($conn);
    }
} else {
    echo "ID not provided";
}
?>
