<?php

include 'config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $select_data = mysqli_query($conn, "SELECT 
            order_details.*,
            get_start.weight,
            get_booking.height,
            get_booking.width,
            get_booking.length,
            product_details.product_name,
            product_details.box_no,
            product_details.product_quantity,
            product_details.hsn_code
        FROM order_details
        INNER JOIN get_booking ON order_details.id = get_booking.book_id
        INNER JOIN get_start ON order_details.id = get_start.id
        INNER JOIN product_details ON order_details.id = product_details.product_id
        INNER JOIN total ON order_details.id = total.id
        WHERE order_details.id = $id");


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

$weight = $row['weight'];
$height = $row['height'];
$width = $row['width'];
$length = $row['length'];
$product_name = $row['product_name'];
$box_no = $row['box_no'];
$product_quantity = $row['product_quantity'];
$hsn_code = $row['hsn_code'];
$total_price = $row['total_price'];



require("fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->AddPage();


$pdf->SetFont("Arial", "", 10);

// Set the Y-coordinate to create a margin-top
$marginTop = 50; // You can adjust this value as needed
$pdf->SetY($marginTop);


$pdf->SetFont("Arial", "U", 10);
$pdf->Cell(190, 6, "Authorization for Export shipment - AWB No LP".$id, 0, 1, 'C');
$pdf->SetFont("Arial", "", 10);
$pdf->Cell(190, 6, "To whomsoever it may concern", 0, 1, 'C');



$pdf->Output();


    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
