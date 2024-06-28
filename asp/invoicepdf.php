<?php

include 'config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $select_data = mysqli_query($conn, "SELECT * FROM order_details WHERE id = $id");


    if (mysqli_num_rows($select_data) > 0) {
        $row = mysqli_fetch_assoc($select_data);
        
$id = $row['id'];
$sh_full_name = $row['sh_full_name'];
$sh_zip_code = $row['sh_zip_code'];
$sh_add1 = $row['sh_add1'];
$sh_add2 = $row['sh_add2'];
$sh_add3 = $row['sh_add3'];
$sh_city = $row['sh_city'];
$sh_state = $row['sh_state'];
$sh_country = $row['sh_country'];
$sh_ph_no = $row['sh_ph_no'];
$sh_ph_no1 = $row['sh_ph_no1'];
$sh_email = $row['sh_email'];
$sh_attention = $row['sh_attention'];
$sh_referance = $row['sh_referance'];
$sh_document_type = $row['sh_document_type'];
$sh_pan_no = $row['sh_pan_no'];
$sh_document_type1 = $row['sh_document_type1'];
$sh_pan_no1 = $row['sh_pan_no1'];
$co_full_name = $row['co_full_name'];
$co_zip_code = $row['co_zip_code'];
$co_add1 = $row['co_add1'];
$co_add2 = $row['co_add2'];
$co_add3 = $row['co_add3'];
$co_city = $row['co_city'];
$co_state = $row['co_state'];
$co_country = $row['co_country'];
$co_ph_no = $row['co_ph_no'];
$co_ph_no1 = $row['co_ph_no1'];
$co_email = $row['co_email'];
$co_attention = $row['co_attention'];
$co_referance = $row['co_referance'];
$note = $row['note'];
$awb_show = $row['awb_show'];
$gift_type = $row['gift_type'];
$currency = $row['currency'];
$invoice_no_date = $row['invoice_no_date'];
require("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->AddPage();


$imagePath = "lp.png"; // Image ka path
$x = 70; // X-coordinate where you want to place the image (Left side)
$y = 40; // Y-coordinate where you want to place the image (Top of the page)

$pdf->Image($imagePath, $x, $y, 80, 40); // Set width and height as needed



$pdf->SetFont("Arial", "", 12);
$pdf->Cell(0, 10, "Registration Details", 1, 1, 'C');

$pdf->Cell(47, 10, "Name", 1, 0);
$pdf->Cell(47, 10, "Mobile", 1, 0);
$pdf->Cell(47, 10, "Email", 1, 0);
$pdf->Cell(49, 10, "Message", 1, 1);

$pdf->Cell(47, 10, $sh_full_name, 1, 0);
$pdf->Cell(47, 10, $sh_country, 1, 0);
$pdf->Cell(47, 10, $co_full_name, 1, 0);
$pdf->Cell(49, 10, $co_country, 1, 1);

$pdf->Output();


    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
