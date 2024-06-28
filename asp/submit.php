<?php
// booking.php

@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
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
$status = $_POST['status'];
$invoice_no_date = $_POST['invoice_no_date'];



// Handle file uploads for documentImage
$documentImage = $_FILES['documentImage']['name'];
$documentImageTmp = $_FILES['documentImage']['tmp_name'];
$documentImagePath = 'upload/' . $documentImage; // Specify the directory where you want to store the uploaded files

// Handle file uploads for documentImage_back
$documentImageBack = $_FILES['documentImage_back']['name'];
$documentImageBackTmp = $_FILES['documentImage_back']['tmp_name'];
$documentImageBackPath = 'upload/' . $documentImageBack;

// Handle file uploads for documentImage1
$documentImage1 = $_FILES['documentImage1']['name'];
$documentImage1Tmp = $_FILES['documentImage1']['tmp_name'];
$documentImage1Path = 'upload/' . $documentImage1;


    $nondg = $_POST['nondg'];
    $box_no = $_POST['box_no'];
    $product_name = $_POST['product_name'];
    $product_quantity = $_POST['product_quantity'];
    $price = $_POST['price'];
    $hsn_code = $_POST['hsn_code'];
    $p_weight = $_POST['p_weight'];




if (move_uploaded_file($documentImageTmp, $documentImagePath) &&
    move_uploaded_file($documentImageBackTmp, $documentImageBackPath) &&
    move_uploaded_file($documentImage1Tmp, $documentImage1Path)) {

   // ...

// File uploaded successfully, insert the file name into the database
$sql = "INSERT INTO order_details (sh_full_name, sh_zip_code, sh_add1, sh_add2, sh_add3, sh_city, sh_state, sh_country, sh_ph_no, sh_ph_no1, sh_email, sh_attention, sh_referance, sh_document_type, sh_pan_no, documentImage, documentImage_back, sh_document_type1, sh_pan_no1, documentImage1, co_full_name, co_zip_code, co_add1, co_add2, co_add3, co_city, co_state, co_country, co_ph_no, co_ph_no1, co_email, co_attention, co_referance, note, awb_show, gift_type, currency, status, invoice_no_date)
VALUES ('$sh_full_name', '$sh_zip_code', '$sh_add1', '$sh_add2', '$sh_add3', '$sh_city', '$sh_state', '$sh_country', '$sh_ph_no', '$sh_ph_no1', '$sh_email', '$sh_attention', '$sh_referance', '$sh_document_type', '$sh_pan_no', '$documentImage', '$documentImageBack', '$sh_document_type1', '$sh_pan_no1', '$documentImage1', '$co_full_name', '$co_zip_code', '$co_add1', '$co_add2', '$co_add3', '$co_city', '$co_state', '$co_country', '$co_ph_no', '$co_ph_no1', '$co_email', '$co_attention', '$co_referance', '$note', '$awb_show', '$gift_type', '$currency', '$status', '$invoice_no_date')";

  if ($conn->query($sql) === TRUE) {
                 $product_id = $conn->insert_id;

    // Loop through the submitted data and insert it into the database
    for ($i = 0; $i < count($nondg); $i++) {
        $sqlp = "INSERT INTO product_details (product_id, nondg, box_no, product_name, product_quantity, price, hsn_code, p_weight)
                VALUES ('$product_id', '$nondg[$i]', '$box_no[$i]', '$product_name[$i]', '$product_quantity[$i]', '$price[$i]', '$hsn_code[$i]', '$p_weight[$i]')";

        if (mysqli_query($conn, $sqlp)) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
             }


// ...

} else {
    echo "Error uploading file.";
}

// ...


}

// Retrieve total price and quantity from JavaScript
$totalPrice = $_POST['total'];
$totalQuantity = $_POST['qty'];

// Perform database insertion
$sqlt = "INSERT INTO total (total_price, total_quantity) VALUES ('$totalPrice', '$totalQuantity')";

if ($conn->query($sqlt) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$conn->close();
?>