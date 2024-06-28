<?php
include("config.php"); // Include the database connection file

// Get data from the form
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


// Upload Aadhar Card Image
$documentImage_path = "uploads/" . $_FILES['documentImage']['name'];
move_uploaded_file($_FILES['documentImage']['tmp_name'], $documentImage_path);

// Upload Aadhar Card Back Image
$documentImage_back_path = "uploads/" . $_FILES['documentImage_back']['name'];
move_uploaded_file($_FILES['documentImage_back']['tmp_name'], $documentImage_back_path);

// Upload PAN Card Image
$documentImage1_path = "uploads/" . $_FILES['documentImage1']['name'];
move_uploaded_file($_FILES['documentImage1']['tmp_name'], $documentImage1_path);

// Insert order information into the database
$sql = "INSERT INTO orders (sh_full_name, sh_zip_code, sh_add1, sh_add2, sh_add3, sh_city, sh_state, sh_country, sh_ph_no, sh_ph_no1, sh_email, sh_attention, sh_referance, sh_document_type, sh_pan_no, sh_document_type1, documentImage, documentImage_back, documentImage1) 
        VALUES ('$sh_full_name', '$sh_zip_code', '$sh_add1', '$sh_add2', '$sh_add3', '$sh_city', '$sh_state', '$sh_country', '$sh_ph_no', '$sh_ph_no1', '$sh_email', '$sh_attention', '$sh_referance', '$sh_document_type', '$sh_pan_no', '$sh_document_type1', '$documentImage_path', '$documentImage_back_path', '$documentImage1_path')";

if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id; // Get the inserted order's ID
    echo "Shipping information inserted successfully!";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Get product details
$nondgArray = $_POST['nondg'];
$box_noArray = $_POST['box_no'];
$product_nameArray = $_POST['product_name'];
$product_quantitieArray = $_POST['product_quantity'];
$priceArray = $_POST['price'];
$hsn_codeArray = $_POST['hsn_code'];

for ($i = 0; $i < count($product_nameArray); $i++) {
    $nondg = $nondgArray[$i];
    $box_no = $box_noArray[$i];
    $product_name = $product_nameArray[$i];
    $quantity = $product_quantitieArray[$i];
    $price = $priceArray[$i];
    $hsn_code = $hsn_codeArray[$i];

    // Insert product details into the database
    $sqlp = "INSERT INTO product (order_id, nondg, box_no, product_name, product_quantity, price, hsn_code) VALUES ('$order_id', '$nondg', '$box_no', '$product_name', '$quantity', '$price', '$hsn_code')";
    $conn->query($sql);
}
if ($conn->query($sqlp) === TRUE) {
    // Successfully inserted into 'dj_get_booking' table
} else {
    echo "Error: " . $sqlp . "<br>" . $conn->error;
}


// Close the database connection
$conn->close();

// Redirect to a thank you page or display a confirmation message
?>
