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
            payments.gst,
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
$order_id1 = $row['order_id'];
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
$sh_gst = $row['sh_gst'];
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
    $gst = $row['gst'];
    $extracharge = $row['extracharge'];
    $amount = $row['amount'];
    $apayment = $row['apayment'];
    $dpayment = $row['dpayment'];
    $created_at = $row['created_at'];
    

        // Create a new PDF instance
        require("fpdf/fpdf.php");
        class PDF extends FPDF {
            
            public function __construct($invoice_no_date,$id,$sh_full_name,$co_full_name,$sh_zip_code,$sh_add1,$sh_add2,$sh_add3,$sh_city,$sh_state,$sh_country,$co_zip_code,$co_add1,$co_add2,$co_add3,$co_city,$co_state,$co_country,$sh_ph_no,$co_ph_no,$co_email,$order_id1,$sh_gst,$sh_referance,$note) {
                parent::__construct('P', 'mm', 'A4');
                $this->invoice_no_date = $invoice_no_date;
                $this->id = $id;
                $this->sh_full_name = $sh_full_name;
                $this->co_full_name = $co_full_name;
                $this->sh_zip_code = $sh_zip_code;
                $this->sh_add1 = $sh_add1;
                $this->sh_add2 = $sh_add2;
                $this->sh_add3 = $sh_add3;
                $this->sh_city = $sh_city;
                $this->sh_state = $sh_state;
                $this->sh_country = $sh_country;
                $this->co_zip_code = $co_zip_code;
                $this->co_add1 = $co_add1;
                $this->co_add2 = $co_add2;
                $this->co_add3 = $co_add3;
                $this->co_city = $co_city;
                $this->co_state = $co_state;
                $this->co_country = $co_country;
                $this->sh_ph_no = $sh_ph_no;
                $this->co_ph_no = $co_ph_no;
                $this->co_email = $co_email;
                $this->order_id1 = $order_id1;
                $this->sh_gst = $sh_gst;
                $this->sh_referance = $sh_referance;
                $this->note = $note;
                    }
            
            function Header() {
                
                    $this->SetLineWidth(0.2); // Set the border width
                
                    $this->SetFont("Arial", "B", 22);
                    $this->Cell(190, 15, "LAXMIPATI INTERNATIONAL COURIER", 0, 1, 'C');
                    
                    $this->SetFont("Arial", "B", 14);
                    $this->Cell(190,8,"2026 Momai Complex, nr.sahara Darwaja,Surat-395010","TLR",1, 'C');
                    $this->Cell(190,8,"Brance:Bardoli / Ahemdabad / Mumbai / Daman","LR",1, 'C');
                    
                    $this->SetFont("Arial", "B", 12);
                    $this->Cell(190,8,"Contact: 7567558310 / 8758068136","LR",1, 'C');
                    $this->Cell(190,8,"GST No.: ","LR",1, 'C');
                    
                    $this->SetFont("Arial", "", 9);
                    $this->Cell(16,6,"DATE:","LTR",0);
                    $this->Cell(72, 6, date('d/m/Y', strtotime($this->invoice_no_date)), "T", 0);
                    $this->Cell(72,6,"INVOICE","T",0);
                    $this->Cell(30,6,"LP".$this->order_id1, "LTR",1,'C');
                    
                    $this->Cell(30,6,"SHIPPERS","LT",0);
                    $this->Cell(130,6,"","T",0);
                    $this->Cell(30,6,"CONSIGNEE","TR",1);
                    
                    $this->Cell(25,6,"NAME : ","LT",0);
                    $this->Cell(70,6,$this->sh_full_name,"T",0);
                    $this->Cell(25,6,"NAME : ","LT",0);
                    $this->Cell(70,6,$this->co_full_name,"TR",1);
                    
                    $this->Cell(25,6,"ADD : ","L",0);
                    $this->Cell(70,6,$this->sh_add1,"",0);
                    $this->Cell(25,6,"ADD : ","L",0);
                    $this->Cell(70,6,$this->co_add1,"R",1);
                    
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,$this->sh_add2,"",0);
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,$this->co_add2,"R",1);
                    
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,$this->sh_add3,"",0);
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,$this->co_add3,"R",1);
                    
                    $this->Cell(25, 6, "", "L", 0);
                    $this->Cell(70, 6, $this->sh_city . ', ' . $this->sh_state . ', ' . $this->sh_zip_code, "", 0);
                    $this->Cell(25, 6, "", "L", 0);
                    $this->Cell(70, 6, $this->co_city . ', ' . $this->co_state . ', ' . $this->co_zip_code, "R", 1);
                    
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,$this->sh_country,"",0);
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,$this->co_country,"R",1);
                    
                    $this->Cell(25,6,"CO.NO. : ","L",0);
                    $this->Cell(70,6,$this->sh_ph_no,"",0);
                    $this->Cell(25,6,"CO.NO. : ","L",0);
                    $this->Cell(70,6,$this->co_ph_no,"R",1);
                    
                    $this->Cell(25,6,"ID NOMBER : ","L",0);
                    $this->Cell(70,6,"LP".$this->order_id1,"",0);
                    $this->Cell(25,6,"EMAI ID : ","L",0);
                    $this->Cell(70,6,$this->co_email,"R",1);
                    
                    $this->Cell(25,6,"GST NO. : ","L",0);
                    $this->Cell(70,6,$this->sh_gst,"",0);
                    $this->Cell(25,6,"","L",0);
                    $this->Cell(70,6,"", "R",1);
                    
                    $this->Cell(25,6,"SERVICE: ","LT",0);
                    $this->Cell(70,6,$this->note,"T",0);
                    $this->Cell(25,6,"REF. NO.: ","T",0);
                    $this->Cell(70,6,$this->sh_referance,"TR",1);
                    
                    $this->SetFont("Arial", "B", 14);
                    $this->Cell(190,15,"UNSOLICITED GIFT FROM INDIVIDUAL TO INDIVIDUAL",1,1,'C');
            }
        }
        
       $pdf = new PDF($invoice_no_date,$id,$sh_full_name,$co_full_name,$sh_zip_code,$sh_add1,$sh_add2,$sh_add3,$sh_city,$sh_state,$sh_country,$co_zip_code,$co_add1,$co_add2,$co_add3,$co_city,$co_state,$co_country,$sh_ph_no,$co_ph_no,$co_email,$order_id1,$sh_gst,$sh_referance,$note);
       $pdf->AddPage();
        
        $pdf->SetFont("Arial", "", 8);
        $pdf->Cell(20,7,"BOX NO.","LRB",0);
        $pdf->Cell(25,7,"VOLUME","BR",0);
        $pdf->Cell(24,7,"VOLUME.W.T","BR",0);
        $pdf->Cell(24,7,"EXCUAL.W.T","BR",0);
        $pdf->Cell(25,7,"CHARGABLE W.T","BR",0);
        $pdf->Cell(24,7,"RATE","BR",0);
        $pdf->Cell(24,7,"TOTAL","BR",0);
        $pdf->Cell(24,7,"EXTRA CH.","BR",1);
        
        
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
        $pdf->Cell(25, 7, $height . "x" . $width . "x" . $length , "BR", 0);
        $pdf->Cell(24, 7, $weightv, "BR", 0);
        $pdf->Cell(24, 7, $weightb, "BR", 0);
        // Choose the greater weight between $weightb and $weightv
    $greater_weight = ($weightb > $weightv) ? $weightb : $weightv;
    
    $pdf->Cell(25, 7, ceil($greater_weight), "BR", 0); // Print the greater weight
   
        $pdf->Cell(24, 7, $rate,"BR",0);
        $weight_total = ceil($greater_weight) * $rate;
        $pdf->Cell(24, 7, $weight_total, "BR", 0);
        $pdf->Cell(24, 7, $extracharge,"BR",1);

     $weight_total1 += ceil($greater_weight) * $rate;
     $totalkg += ceil($greater_weight);
        $counter++;
    }
}

        $pdf->SetFont("Arial", "", 8);
        $pdf->Cell(20,7,"","LB",0);
        $pdf->Cell(24,7,"","B",0);
        $pdf->Cell(24,7,"","B",0);
        $pdf->Cell(25,7,"","B",0);
        $pdf->Cell(25,7,"","BR",0);
        $pdf->Cell(24,7,"TOTAL","BR",0);
        $pdf->Cell(24,7,$weight_total1,"BR",0);
        $pdf->Cell(24,7,$extracharge,"BR",1);
        
       $pdf->SetFont("Arial", "B", 14);
       $pdf->Cell(190, 15, "TOTAL OUTSTANDING", "LBR", 1, 'C');
       
       $pdf->SetFont("Arial", "", 8);
       $pdf->Cell(18, 7, "TOTAL BOX", "LBR",0);
       $pdf->Cell(22, 7, "TOTAL K.G", "BR",0);
       $pdf->Cell(21, 7, "RATE", "BR",0);
       $pdf->Cell(27, 7, "EXTRA CHARGE", "BR",0);
       $pdf->Cell(20, 7, "GST", "BR",0);
       $pdf->Cell(27, 7, "GRAND TOTAL", "BR",0);
       $pdf->Cell(27, 7, "PAID AMOUNT", "BR",0);
       $pdf->Cell(28, 7, "PANDING AMOUNT", "BR",1);
       
    $pdf->SetFont("Arial", "", 8);
       $pdf->Cell(18, 7, $box_no, "LBR",0);
       $pdf->Cell(22, 7, $totalkg, "BR",0);
       $pdf->Cell(21, 7, $rate, "BR",0);
       $pdf->Cell(27, 7, $extracharge, "BR",0);
       $pdf->Cell(20, 7, $gst ."%", "BR",0);
       $weight_total2 = $weight_total1 + $extracharge;
       $weight_total3 = ($weight_total2 * $gst) / 100;
       $weight_total4 = $weight_total3 + $weight_total2;
       $pdf->Cell(27, 7, $weight_total4, "BR",0);
       $pdf->Cell(27, 7, $apayment, "BR",0);
       $weight_paydu = $weight_total4 - $apayment;
       $pdf->Cell(28, 7, $weight_paydu, "BR",1);
       
      
       
       
                   $pdf->SetFont("Arial", "B", 10);
                   $pdf->Cell(190,10,"TERMS AND CONDTIONS:","LR",1);
                   $pdf->SetFont("Arial", "", 7);
                   $pdf->Cell(190,5,"1) PARCEL WILL BE FORWARDED AFTER RECEIVING 100% PAYMENT.","LR",1);
                   $pdf->Cell(190,5,"2) COMPANY SHALL HAVE NO RESPONSIBILITY IN CASE OF ITEMS DELAYED / BROKEN/LOST DUE TO COSTOMS PROCESER.","LR",1);
                   $pdf->Cell(190,5,"3) ADDRESS CORRECTION SURCHAGE 1500/-","LR",1);
                   $pdf->Cell(190,5,"4) 18% GST HAS TO BE PAID COMPULSORILY AS PER GOVERNMENT OF INDIA RULE.","LR",1);
                   $pdf->Cell(190,5,"5) DUTY/DESTINATION SURCHARGES AND LOCAL TAXES TO BE PAY THE RECEIVER.","LR",1);
                   $pdf->Cell(190,5,"6) FOR LOST PARCELS, THE COMPANY WILL REFUND 5000 RUPEES OR THE INVOICE VALUE, WHICHEVER IS LESS. (ALL INCLUSIVE)","LR",1);
                   $pdf->Cell(190,5,"7) THE COMPANY SHALL NOT BE LIABLE FOR ANY PROHIBITED ITEM PLACED IN THE PARCEL.","LR",1);
                   $pdf->Cell(190,5,"8) ONCE YOU BOOK SHIPMENT MEANS YOU AUTOMATICALLY AGREE TO OUR TERMS AND CONDITIONS. MENTIONED ON THIS SHEET AND TERMS SHEET.","LRB",1);
                   
                   
                   $pdf->SetFont("Arial", "", 10);
                   $pdf->Cell(160,7,"LAXMIPATI INTERNATIONAL COURIER", "L", 0);
                   $pdf->Cell(30,7,"FOR.:","R",1);
                   
                   $pdf->Cell(120,7,"","L",0);
                   $pdf->Cell(70,7,"SENDER'S SIGNATURE","R",1, 'C');
                   
                   $pdf->Cell(120,7,"","L",0);
                   $pdf->Cell(70,7,"","R",1, 'C');
                   
                   $pdf->Cell(120,10,"AUTHORISED SIGNATORY","LB",0);
                   $pdf->SetFont("Arial", "", 9);
                   $pdf->Cell(70,10,$sh_full_name,"BR",1,'C');

        // Output the PDF to the browser
        $pdf->Output();
    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>