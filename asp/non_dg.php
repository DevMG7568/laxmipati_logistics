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

$pdf->SetFont("Arial", "B", 14);
$pdf->Cell(190, 10, "Shipper's Certification for Non - Hazardous Cargo", "LRT", 1, 'C');

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(63.33, 6, "AWB no.", "LRT", 0, 'C');
$pdf->Cell(63.33, 6, "Airport of Dep.", "LRT", 0, 'C');
$pdf->Cell(63.33, 6, "Airport of Dest.", "LRT", 1, 'C');

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(63.33, 6, "LP".$id, "LR", 0, 'C');
$pdf->Cell(63.33, 6, $sh_country, "LR", 0, 'C');
$pdf->Cell(63.33, 6, $co_country, "LR", 1, 'C');

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(63.33, 6, "MAWB No.", "LR", 0, 'C');
$pdf->Cell(63.33, 6, "", "LR", 0, 'C');
$pdf->Cell(63.33, 6, "", "LR", 1, 'C');

$pdf->Cell(190, 5, "This is to certify that the articles / substances of this shipment are properly described by name that they are not listed in", "LRT", 1,);

$pdf->Cell(190, 5, "the current edition of IATA / Dangerous Goods Regulations ( DGR ), Alphabetical List of Dangerous Goods, nor do they", "LR", 1,);

$pdf->Cell(190, 5, "correspond to any of the hazard classes appearing in the DGR, Section 3, classification of Dangerous goods and that", "LR", 1,);

$pdf->Cell(190, 5, "they are known not to be dangerous, I.e, not restricted. Furthermore the shipper confirms that the goods are in proper", "LR", 1,);

$pdf->Cell(190, 5, "condition for transportation on passenger carrying aircraft ( DGR, 8.1.23.) of International Air Transport Association", "LR", 1,);

$pdf->Cell(190, 5, "( I A T A )", "LR", 1,);

$pdf->Cell(40, 6, "MARKS AND NUMBERS", "LRT", 0, 'C');
$pdf->Cell(80, 6, "PROPER DESCRIPTION OF GOODS", "T", 0, 'C');
$pdf->Cell(70, 6, "NET QUANTITY", "LRT", 1, 'C');

$pdf->Cell(40, 6, "OF PACKAGES", "LR", 0, 'C');
$pdf->Cell(80, 6, "(Trade Names not permitted)", "", 0, 'C');
$pdf->Cell(70, 6, "PER PACKAGE", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "SPECIFY EACH ARTICLE SEPARATELY", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "Shipper", "LRT", 0, 'C');
$pdf->Cell(80, 6, "", "T", 0, 'C');
$pdf->Cell(70, 6, "NET WEIGHT", "LRT", 1, 'C');

$pdf->Cell(40, 6, "&", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "Consignee", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "Address", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "on Packages", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "TOTAL", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "NUMBER OF", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->SetFont("Arial", "B", 20);
$pdf->Cell(40, 10, $box_no, "LR", 0, 'C');
$pdf->Cell(80, 10, "", "", 0, 'C');
$pdf->Cell(70, 10, "", "LR", 1, 'C');

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(40, 6, "PACKAGES", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(40, 6, "", "LR", 0, 'C');
$pdf->Cell(80, 6, "", "", 0, 'C');
$pdf->Cell(70, 6, "", "LR", 1, 'C');

$pdf->Cell(95, 6, "Name & Address of Shipper", "LRT", 0);
$pdf->Cell(95, 6, "For,".$sh_full_name, "RT", 1);

$pdf->Cell(95, 6, $sh_full_name, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, $sh_add1, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, $sh_add2, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, $sh_add3, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, $co_city, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, $sh_state, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, $sh_country, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->Cell(95, 6, "PH#:".$sh_ph_no, "LR", 0);
$pdf->Cell(95, 6, "", "R", 1);

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(95, 6, "", "LRB", 0);
$pdf->Cell(95, 6, "AUTHORISED SIGNATORY", "RB", 1);


$pdf->Output();


    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
