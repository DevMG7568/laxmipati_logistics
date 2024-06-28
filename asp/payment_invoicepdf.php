<?php

include 'config.php';


if (isset($_GET['billno'])) {
    $id = $_GET['billno'];


    $select_data = mysqli_query($conn, "SELECT 
            order_details.*,
            get_start.weight,
            get_booking.height,
            get_booking.width,
            get_booking.length,
            product_details.product_name,
            product_details.box_no,
            product_details.product_quantity,
            product_details.price,
            product_details.hsn_code,
            product_details.total_price,
            payments.rate,
            payments.extracharge,
            payments.amount,
            payments.apayment,
            payments.dpayment
        FROM order_details
        INNER JOIN get_booking ON order_details.id = get_booking.book_id
        INNER JOIN payments ON order_details.id = payments.billno
        INNER JOIN get_start ON order_details.id = get_start.id
        INNER JOIN product_details ON order_details.id = product_details.product_id
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
$totalprice = $row['totalprice'];
$totalquantity = $row['totalquantity'];

    $rate = $row['rate'];
    $extracharge = $row['extracharge'];
    $amount = $row['amount'];
    $apayment = $row['apayment'];
    $dpayment = $row['dpayment'];
    $created_at = $row['created_at'];
    

        // Create a new PDF instance
        require("fpdf/fpdf.php");
        class PDF extends FPDF {
            
            public function __construct($invoice_no_date,$id,$sh_full_name,$co_full_name,$sh_add1,$sh_add2,$sh_add3,$co_add1,$co_add2,$co_add3,$sh_ph_no,$co_ph_no,$co_email) {
                parent::__construct('P', 'mm', 'A4');
                $this->invoice_no_date = $invoice_no_date;
                $this->id = $id;
                $this->sh_full_name = $sh_full_name;
                $this->co_full_name = $co_full_name;
                $this->sh_add1 = $sh_add1;
                $this->sh_add2 = $sh_add2;
                $this->sh_add3 = $sh_add3;
                $this->co_add1 = $co_add1;
                $this->co_add2 = $co_add2;
                $this->co_add3 = $co_add3;
                $this->sh_ph_no = $sh_ph_no;
                $this->co_ph_no = $co_ph_no;
                $this->co_email = $co_email;
                    }
            
            function Header() {
                
                    $this->SetFont("Arial", "B", 22);

                    // Output payment details
                    $this->Cell(190, 10, "LAXMIPATI INTERNATIONAL COURIER", 0, 1, 'C');
                    
                    $this->SetFont("Arial", "B", 14);
                    
                    $this->Cell(190,10,"2026 Momai Complex, nr.sahara Darwaja,Surat-395010","TLR",1, 'C');
                    $this->Cell(190,10,"Brance:Bardoli / Ahemdabad / Mumbai / Daman","LR",1, 'C');
                    
                    $this->SetFont("Arial", "B", 12);
                    
                    $this->Cell(190,10,"Contact: 7567558310 / 8758068136","LRB",1, 'C');
                    
                    $this->SetFont("Arial", "", 11);
        
                    $this->Cell(16,7,"DATE:",1,0);
                    $this->Cell(72, 7, date('d/m/Y', strtotime($this->invoice_no_date)), "TB", 0);
                    $this->Cell(72,7,"INVOICE","TB",0);
                    $this->Cell(30,7,"LP".$this->id,1,1,'C');
                    
                    $this->Cell(30,7,"SHIPPERS","LTB",0);
                    $this->Cell(130,7,"","TB",0);
                    $this->Cell(30,7,"CONSIGNEE","TBR",1);
                    
                    $this->Cell(25,7,"NAME : ","LT",0);
                    $this->Cell(70,7,$this->sh_full_name,"RT",0);
                    $this->Cell(25,7,"NAME : ","T",0);
                    $this->Cell(70,7,$this->co_full_name,"RT",1);
                    
                    $this->Cell(25,7,"ADD : ","L",0);
                    $this->Cell(70,7,$this->sh_add1,"R",0);
                    $this->Cell(25,7,"ADD : ","",0);
                    $this->Cell(70,7,$this->co_add1,"R",1);
                    
                    $this->Cell(25,7,"","L",0);
                    $this->Cell(70,7,$this->sh_add2,"R",0);
                    $this->Cell(25,7,"","",0);
                    $this->Cell(70,7,$this->co_add2,"R",1);
                    
                    $this->Cell(25,7,"","L",0);
                    $this->Cell(70,7,$this->sh_add3,"R",0);
                    $this->Cell(25,7,"","",0);
                    $this->Cell(70,7,$this->co_add3,"R",1);
                    
                    $this->Cell(25,7,"CO.NO. : ","L",0);
                    $this->Cell(70,7,$this->sh_ph_no,"R",0);
                    $this->Cell(25,7,"CO.NO. : ","",0);
                    $this->Cell(70,7,$this->co_ph_no,"R",1);
                    
                    $this->Cell(25,7,"ID NOMBER : ","L",0);
                    $this->Cell(70,7,"LP".$this->id,"R",0);
                    $this->Cell(25,7,"EMAI ID : ","",0);
                    $this->Cell(70,7,$this->co_email,"R",1);
                    
                    $this->Cell(190,7,"UNSOLICITED GIFT FROM INDIVIDUAL TO INDIVIDUAL","TLRB",1,'C');
                
            }
            
        }
        
       $pdf = new PDF($invoice_no_date,$id,$sh_full_name,$co_full_name,$sh_add1,$sh_add2,$sh_add3,$co_add1,$co_add2,$co_add3,$sh_ph_no,$co_ph_no,$co_email);
       $pdf->AddPage();
       $pdf->SetFont("Arial", "", 10);
        // Set font
        /*$pdf->SetFont("Arial", "B", 22);

        // Output payment details
        $pdf->Cell(190, 10, "LAXMIPATI INTERNATIONAL COURIER", 0, 1, 'C');
        
        $pdf->SetFont("Arial", "B", 14);
        
        $pdf->Cell(190,10,"2026 Momai Complex, nr.sahara Darwaja,Surat-395010","TLR",1, 'C');
        $pdf->Cell(190,10,"Brance:Bardoli / Ahemdabad / Mumbai / Daman","LR",1, 'C');
        
        $pdf->SetFont("Arial", "B", 12);
        
        $pdf->Cell(190,10,"Contact: 7567558310 / 8758068136","LRB",1, 'C');
        
        $pdf->SetFont("Arial", "", 11);
        
        $pdf->Cell(16,7,"DATE:",1,0);
        $pdf->Cell(72,7, date('d/m/Y', strtotime($invoice_no_date)),"TB",0);
        $pdf->Cell(72,7,"INVOICE","TB",0);
        $pdf->Cell(30,7,"LP".$id,1,1,'C');
        
        $pdf->Cell(30,7,"SHIPPERS","LTB",0);
        $pdf->Cell(130,7,"","TB",0);
        $pdf->Cell(30,7,"CONSIGNEE","TBR",1);
        
        $pdf->Cell(25,7,"NAME : ","LT",0);
        $pdf->Cell(70,7,$sh_full_name,"RT",0);
        $pdf->Cell(25,7,"NAME : ","T",0);
        $pdf->Cell(70,7,$co_full_name,"RT",1);
        
        $pdf->Cell(25,7,"ADD : ","L",0);
        $pdf->Cell(70,7,$sh_add1,"R",0);
        $pdf->Cell(25,7,"ADD : ","",0);
        $pdf->Cell(70,7,$co_add1,"R",1);
        
        $pdf->Cell(25,7,"","L",0);
        $pdf->Cell(70,7,$sh_add2,"R",0);
        $pdf->Cell(25,7,"","",0);
        $pdf->Cell(70,7,$co_add2,"R",1);
        
        $pdf->Cell(25,7,"","L",0);
        $pdf->Cell(70,7,$sh_add3,"R",0);
        $pdf->Cell(25,7,"","",0);
        $pdf->Cell(70,7,$co_add3,"R",1);
        
        $pdf->Cell(25,7,"CO.NO. : ","L",0);
        $pdf->Cell(70,7,$sh_ph_no,"R",0);
        $pdf->Cell(25,7,"CO.NO. : ","",0);
        $pdf->Cell(70,7,$co_ph_no,"R",1);
        
        $pdf->Cell(25,7,"ID NOMBER : ","L",0);
        $pdf->Cell(70,7,"LP".$id,"R",0);
        $pdf->Cell(25,7,"EMAI ID : ","",0);
        $pdf->Cell(70,7,$co_email,"R",1);
        
        $pdf->Cell(25,7,"","LB",0);
        $pdf->Cell(70,7,"","RB",0);
        $pdf->Cell(25,7,"","B",0);
        $pdf->Cell(70,7,"","RB",1);
        
        $pdf->Cell(190,7,"UNSOLICITED GIFT FROM INDIVIDUAL TO INDIVIDUAL","LRB",1,'C');*/
        
        $pdf->SetFont("Arial", "", 8);
        $pdf->Cell(20,7,"BOX NO.","LRB",0);
        $pdf->Cell(25,7,"VOLUME","LRB",0);
        $pdf->Cell(24,7,"VOLUME.W.T","LRB",0);
        $pdf->Cell(24,7,"EXCUAL.W.T","LRB",0);
        $pdf->Cell(25,7,"CHARGABLE W.T","LRB",0);
        $pdf->Cell(24,7,"RATE","LRB",0);
        $pdf->Cell(24,7,"TOTAL","LRB",0);
        $pdf->Cell(24,7,"EXTRA CH.","LRB",1);
        
        
        // Retrieve order details using the provided order ID
$sql = "SELECT * FROM order_details WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Use $id (order ID) from $row['id'] for product details query
    $order_id = $row['id'];

    // Retrieve product details associated with this order ID
    $product_sql1 = "SELECT * FROM product_details WHERE product_id = $order_id";
    $product_sql2 = "SELECT * FROM get_booking WHERE book_id = $order_id";

    $product_result1 = $conn->query($product_sql1);
    $product_result2 = $conn->query($product_sql2);

    $counter = 1;

    // Create an array to store product details grouped by box_no
    $productDetailsByBox = array();

    while ($product_row1 = $product_result1->fetch_assoc()) {
        $box_no = $product_row1['box_no'];

        if (!isset($productDetailsByBox[$box_no])) {
            $productDetailsByBox[$box_no] = array();
        }

        $productDetailsByBox[$box_no][] = $product_row1;
    }

    while (($product_row2 = $product_result2->fetch_assoc())) {
        $weightv = $product_row2['weightv'];
        $weightb = $product_row2['weightb'];
        $height = $product_row2['height'];
        $width = $product_row2['width'];
        $length = $product_row2['length'];

        $pdf->SetFont("Arial", "", 8);
        // Generate PDF cells for each box_no
        $pdf->Cell(20, 7, $counter, "LRB", 0);
        $pdf->Cell(25, 7, $height . "x" . $width . "x" . $length , "LRB", 0);
        $pdf->Cell(24, 7, $weightv, "LRB", 0);
        $pdf->Cell(24, 7, $weightb, "LRB", 0);
        $pdf->Cell(25, 7, ceil($weightv), "LRB", 0);
        $pdf->Cell(24, 7, $rate,"LRB",0);
        $weight_total = ceil($weightv) * $rate;
        $pdf->Cell(24, 7, $weight_total, "LRB", 0);
        $pdf->Cell(24, 7, $extracharge,"LRB",1);

     $weight_total1 += ceil($weightv) * $rate;
        $counter++;
    }
}

        $pdf->SetFont("Arial", "", 8);
        $pdf->Cell(20,7,"","LB",0);
        $pdf->Cell(24,7,"","B",0);
        $pdf->Cell(24,7,"","B",0);
        $pdf->Cell(25,7,"","B",0);
        $pdf->Cell(25,7,"","B",0);
        $pdf->Cell(24,7,"TOTAL","LRB",0);
        $pdf->Cell(24,7,$weight_total1,"LRB",0);
        $pdf->Cell(24,7,$extracharge,"LRB",1);
        
       $pdf->SetFont("Arial", "", 12);
       $pdf->Cell(190, 7, "TOTAL OUT STANDING", "LRB", 1, 'C');
       
       $pdf->SetFont("Arial", "", 8);
       $pdf->Cell(27, 7, "TOTAL BOX", "LRB",0);
       $pdf->Cell(27, 7, "TOTAL K.G", "LRB",0);
       $pdf->Cell(27, 7, "RATE", "LRB",0);
       $pdf->Cell(27, 7, "EXTRA CHARGE", "LRB",0);
       $pdf->Cell(27, 7, "GRAND TOTAL", "LRB",0);
       $pdf->Cell(27, 7, "PAID AMOUNT", "LRB",0);
       $pdf->Cell(28, 7, "PANDING AMOUNT", "LRB",1);
       
        $pdf->SetFont("Arial", "", 8);
       $pdf->Cell(27, 7, $box_no, "LRB",0);
       $pdf->Cell(27, 7, $weight, "LRB",0);
       $pdf->Cell(27, 7, $rate, "LRB",0);
       $pdf->Cell(27, 7, $extracharge, "LRB",0);
       $weight_total2 = $weight_total1 + $extracharge;
       $pdf->Cell(27, 7, $weight_total2, "LRB",0);
       $pdf->Cell(27, 7, $apayment, "LRB",0);
       $weight_paydu = $weight_total2 - $apayment;
       $pdf->Cell(28, 7, $weight_paydu, "LRB",1);
       
       $pdf->SetFont("Arial", "", 7);
       $pdf->Cell(190,5,"TERMS AND CONDTIONS:","LR",1);
       $pdf->Cell(190,5,"1) SHIPMENTS WILL BE INCREASED AFTER 100% ADVANCE PAYMENT IS RECEIVED","LR",1);
       $pdf->Cell(190,5,"2) NO CLAIMS FOR SHORT / MISSING ITEMS / LATE DELIVERY / DAMAGED PARCEL AT DESTINATION DUE TO HANDLING OR IMPROPER PACKING","LR",1);
       $pdf->Cell(190,5,"3) ADDRESS CORRECTION SURCHAGE 1500/-","LR",1);
       $pdf->Cell(190,5,"4) DUTY / DESTINATION SURCHARGES AND LOCAL TAXES TO BE PAID BY CONSIGNEE.","LR",1);
       $pdf->Cell(190,5,"5) INCASE OF DELAYS DUE TO NON-PAYMENT OF DUTY BY CONSIGNEE WE SHALL TAKE NO RESPONSIBILITY DUE TO SUCH DELAYS.","LR",1);
       $pdf->Cell(190,5,"6) LAXMIPATI MAX LIABILITY FOR LOST PARCEL PARCEL UPTO 10 KG - USD 50 AND THEREAFTER MAX USD 100 ONLY INCLUDING FREIGHT.","LR",1);
       $pdf->Cell(190,5,"7) IF THE PAYMENT IS DUE, THE DAYS RATE WILL BE CHARGED WHEN PAYMENT IS COMPLETED AND THE BOOKING IS MADE","LR",1);
       $pdf->Cell(190,5,"8) THERE WILL BE NO LIABILITY IF ANYTHING IN THE PARCEL IS DAMAGED OR BROKEN DUE TO OVERDUE PAYMENT.","LR",1);
       $pdf->Cell(190,5,"9) ONCE YOU BOOK SHIPMENT MEANS YOU AUTOMATICALLY AGREE TO OUR TERMS AND CONDITIONS. MENTIONED ON THIS SHEET AND TERMS SHEET.","LRB",1);
       
       
       $pdf->SetFont("Arial", "", 10);
       $pdf->Cell(160,7,"LAXMIPATI INTERNATIONAL COURIER", "L", 0);
       $pdf->Cell(30,7,"FOR.:","R",1);
       
       $pdf->Cell(140,7,"","L",0);
       $pdf->Cell(50,7,"SENDER'S SIGNATURE","R",1, 'C');
       
       $pdf->Cell(140,7,"","L",0);
       $pdf->Cell(50,7,$sh_full_name,"R",1, 'C');
       
        $pdf->Cell(140,10,"AUTHORISED SIGNATORY","LB",0);
       $pdf->Cell(50,10,"","RB",1);
       
       

        // Output the PDF to the browser
        $pdf->Output();
    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
