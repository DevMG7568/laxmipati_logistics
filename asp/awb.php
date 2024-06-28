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
        WHERE order_details.id = $id");


    if (mysqli_num_rows($select_data) > 0) {
        $row = mysqli_fetch_assoc($select_data);
        
$id = $row['id'];
$order_id1 = $row['order_id'];
$user_name = $row['user_name'];
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

$imageBarcode = 'Barcode_img/' . $row['image_name'];

require("fpdf/fpdf.php");



$pdf = new FPDF();

// Retrieve order details using the provided order ID
// Retrieve order details using the provided order ID
$sql = "SELECT * FROM order_details WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Use $id (order ID) from $row['id'] for product details query
    $order_id = $row['id'];

    // Retrieve product details associated with this order ID
    $product_sql = "SELECT * FROM get_booking WHERE book_id = $order_id";

    $product_result = $conn->query($product_sql);

$counter = 1; 
$pdf->AddPage();
    while (($product_row = $product_result->fetch_assoc())) {
        $weightv = $product_row['weightv'];
        $weightb = $product_row['weightb'];
        $height = $product_row['height'];
        $width = $product_row['width'];
        $length = $product_row['length'];

   



        
$pdf->SetFont("Arial", "", 10);

/*$imagePath = "lp.png"; // Image ka path
$x = 6; // X-coordinate where you want to place the image (Left side)
$y = 5; // Y-coordinate where you want to place the image (Top of the page)

$pdf->Image($imagePath, $x, $y, 25, 20); // Set width and height as needed */


$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(190, 7, "AIRWAY BILL", 0, 1, 'C');

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(190, 7, "Contact No: +91 7567558310 Website: www.laxmipatiinternational.com Email : info@laxmipatiinternational.com", 0, 1, 'C');

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(30, 9, "SERVICE", "TLR", 0, 'C');
$pdf->Cell(20, 9, "ORIGIN", "T", 0, 'C');
$pdf->Cell(90, 9, "DESTINATION", "TLR", 0, 'C');

$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(50, 9, "AIRWAY BILL NO", "TR", 1, 'C');

 

/*if (file_exists($imageBarcode)) {
    $pdf->Cell(50, 9, '', "LTR", 1, 'C');
    $pdf->Image($imageBarcode, 156, $pdf->GetY() - 10, 42, 16); // Adjust the Y-coordinate (-10 in this example)
    $pdf->SetFont("Arial", "", 10);
} else {
    echo "Image not found";
}*/

        
$pdf->SetFont("Arial", "", 10);
$pdf->Cell(30, 5, "Laxmipati Express ", "TLR", 0, 'C');
$pdf->Cell(20, 5, strtoupper($sh_country), "T", 0, 'C');
$pdf->Cell(90, 5, strtoupper($co_country), "TLR", 0, 'C');

$pdf->SetFont("Arial", "", 16);
$pdf->Cell(50, 5, "LP".$order_id1, "", 0, 'C');

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(50, 5, "", "LR", 1, 'C');


$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(80, 5, "SHIPPER", "LRT", 0);
$pdf->Cell(80, 5, "CONSIGNEE", "T", 0);
$pdf->Cell(30, 5, "NO OF BOX", "LRT", 1);


$pdf->SetFont("Arial", "", 9);
$pdf->Cell(80, 5, strtoupper($sh_full_name), "LR", 0);
$pdf->Cell(80, 5, strtoupper($co_full_name), "", 0);
$pdf->Cell(30, 5, strtoupper($counter), "LRT", 1);

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(80, 5, "ATTN:NAME/DEPT", "LRT", 0);
$pdf->Cell(80, 5, "ATTN:NAME/DEPT", "T", 0);
$pdf->Cell(30, 5, "TYPE", "LRT", 1);


$pdf->SetFont("Arial", "", 9);
$pdf->Cell(80, 5, "", "LR", 0);
$pdf->Cell(80, 5, "", "", 0);
$pdf->Cell(30, 5, "NON DOC", "LRT", 1);

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(80, 5, "ADDRESS", "LRT", 0);
$pdf->Cell(80, 5, "ADDRESS", "T", 0);
$pdf->Cell(30, 5, "CHARGEABLE", "LRT", 1);


$pdf->SetFont("Arial", "", 9);
$pdf->Cell(80, 5, strtoupper($sh_add1), "LR", 0);
$pdf->Cell(80, 5, strtoupper($co_add1), "", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(30, 5, "WEIGHT", "BRL", 1);

$pdf->SetFont("Arial", "", 9);
$pdf->Cell(80, 5, strtoupper($sh_add2), "LR", 0);
$pdf->Cell(80, 5, strtoupper($co_add2), "", 0);
$pdf->Cell(30, 5, ceil($weightb)." KG", "LR", 1);


$pdf->SetFont("Arial", "", 10);
$pdf->Cell(80, 5, strtoupper($sh_add3), "LRT", 0);
$pdf->Cell(80, 5, strtoupper($co_add3), "T", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(30, 5, "ACTUAL WEIGHT", "LRT", 1);


$pdf->SetFont("Arial", "", 9);
$pdf->Cell(80, 5, strtoupper($sh_city), "LR", 0);
$pdf->Cell(80, 5, strtoupper($co_city), "", 0);
$pdf->Cell(30, 5, strtoupper($weightb)." KG", "LRT", 1);

$pdf->SetFont("Arial", "", 9);
$pdf->Cell(80, 5, strtoupper($sh_state), "LR", 0);
$pdf->Cell(80, 5, strtoupper($co_state), "", 0);
$pdf->Cell(30, 5, "", "LR", 1);



$pdf->SetFont("Arial", "", 10);
$pdf->Cell(50, 5, "ZIP CODE", "LRT", 0);
$pdf->Cell(30, 5, "TEL NO.", "RT", 0);
$pdf->Cell(30, 5, "ZIP CODE", "T", 0);
$pdf->Cell(30, 5, "TEL NO.", "LRT", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(50, 5, "VOLUMETRIC WEIGHT", "LRT", 1);



$pdf->SetFont("Arial", "", 10);
$pdf->Cell(50, 5, strtoupper($sh_zip_code), "LR", 0);
$pdf->Cell(30, 5, strtoupper($sh_ph_no), "R", 0);
$pdf->Cell(30, 5, strtoupper($co_zip_code), "", 0);
$pdf->Cell(30, 5, strtoupper($co_ph_no), "LR", 0);
$pdf->Cell(50, 5, strtoupper($weightv)." KG", "LR", 1);

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(80, 5, "DESCRIPTION AND VALUE OF GOODS :", "LRT", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(60, 5, strtoupper($user_name), "T", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(50, 5, "BOX DIMENTIONS", "LRT", 1);


$pdf->SetFont("Arial", "", 10);
$pdf->Cell(80, 5, "AS PER ATTACHED INVOICE", "LR", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(60, 5, "", "", 0);
$pdf->SetFont("Arial", "", 10);
$pdf->Cell(50, 5, "", "LR", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(80, 5, "The Shipper has read,understood and agree's to", "LRT", 0);
$pdf->Cell(60, 5, "RECEIVED IN GOOD ORDER AND", "T", 0);
$pdf->Cell(50, 5, "", "LRT", 1);


$pdf->SetFont("Arial", "", 10);
$pdf->Cell(80, 5, "the standard termsand conditions of carriage", "LR", 0);
$pdf->Cell(60, 5, "CONDITION", "", 0);
$pdf->Cell(50, 5, "", "LR", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(80, 5, "SHIPPER'S SIGN", "LR", 0);
$pdf->Cell(60, 5, "RECEVER'S SIGN", "", 0);
$pdf->Cell(50, 5, "", "LR", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(50, 5, "RECEIVED BY LAXMIPATI", "LRT", 0);
$pdf->Cell(30, 5, "REFERENCE NO.", "RT", 0);
$pdf->Cell(30, 5, "MANIFEST COPY ", "T", 0);
$pdf->Cell(30, 5, "DATE & TIME", "T", 0);
$pdf->Cell(50, 5, $height."x".$width."x".$length."( ".$weightv." KG )", "LR", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(50, 5, "DATE: " . date('d/m/Y', strtotime($invoice_no_date)), "LRB", 0);
$pdf->Cell(30, 5, "", "RB", 0);
$pdf->Cell(30, 5, "", "B", 0);
$pdf->Cell(30, 5, "", "B", 0);
$pdf->Cell(50, 5, "", "LRB", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(190, 7, "Brought To You By Laxmipati Exp. Pvt. Ltd. Address:Surat, Ahmedabad, Mumbai, Daman, Bardoli,", "B", 1, 'C');

$pdf->Ln(5); // Add a new line with 10 units of bottom margin

 $counter++;
 
}
}


    
$pdf->Output();

 

    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
