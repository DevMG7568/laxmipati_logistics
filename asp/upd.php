
<?php
// Include your database connection file (e.g., 'config.php')
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

// Get form field data
$sh_full_name = $_POST['sh_full_name'];
$sh_zip_code = $_POST['sh_zip_code'];
$sh_add1 = $_POST['sh_add1'];
$sh_add2 = $_POST['sh_add2'];
$sh_add3 = $_POST['sh_add3'];
$sh_city = $_POST['sh_city'];
$sh_state = $_POST['sh_state'];
$sh_country = $_POST['sh_country'];
$sh_ph_no = $_POST['sh_ph_no'];
$sh_ph_no1 = $_POST['sh_ph_no1'];
$sh_email = $_POST['sh_email'];
$sh_attention = $_POST['sh_attention'];
$sh_referance = $_POST['sh_referance'];
$sh_document_type = $_POST['sh_document_type'];
$sh_pan_no = $_POST['sh_pan_no'];
$sh_document_type1 = $_POST['sh_document_type1'];
$sh_pan_no1 = $_POST['sh_pan_no1'];

$co_full_name = $_POST['co_full_name'];
$co_zip_code = $_POST['co_zip_code'];
$co_add1 = $_POST['co_add1'];
$co_add2 = $_POST['co_add2'];
$co_add3 = $_POST['co_add3'];
$co_city = $_POST['co_city'];
$co_state = $_POST['co_state'];
$co_country = $_POST['co_country'];
$co_ph_no = $_POST['co_ph_no'];
$co_ph_no1 = $_POST['co_ph_no1'];
$co_email = $_POST['co_email'];
$co_attention = $_POST['co_attention'];
$co_referance = $_POST['co_referance'];

$note = $_POST['note'];
$awb_show = $_POST['awb_show'];
$gift_type = $_POST['gift_type'];
$currency = $_POST['currency'];
$invoice_no_date = $_POST['invoice_no_date'];

        // Perform the update query
        $sql = "UPDATE order_details SET sh_full_name = '$sh_full_name', sh_zip_code = '$sh_zip_code', sh_add1 = '$sh_add1', sh_add2 = '$sh_add2', sh_add3 = '$sh_add3', sh_city = '$sh_city', sh_state = '$sh_state', sh_country = '$sh_country', sh_ph_no = '$sh_ph_no', sh_ph_no1 = '$sh_ph_no1', sh_email = '$sh_email', sh_attention = '$sh_attention', sh_referance = '$sh_referance', sh_document_type = '$sh_document_type', sh_pan_no = '$sh_pan_no', sh_document_type1 = '$sh_document_type1', sh_pan_no1 = '$sh_pan_no1', co_full_name = '$co_full_name', co_zip_code = '$co_zip_code', co_add1 = '$co_add1', co_add2 = '$co_add2', co_add3 = '$co_add3', co_city = '$co_city', co_state = '$co_state', co_country = '$co_country', co_ph_no = '$co_ph_no', co_ph_no1 = '$co_ph_no1', co_email = '$co_email', co_attention = '$co_attention',co_referance = '$co_referance', note = '$note', awb_show = '$awb_show', gift_type = '$gift_type', currency = '$currency', invoice_no_date = '$invoice_no_date',  WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "ID not provided.";
    }

// Close the database connection
$conn->close();
?>