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
    class PDF extends FPDF
    {

      public function __construct($invoice_no_date, $id, $sh_full_name, $co_full_name, $sh_zip_code, $sh_add1, $sh_add2, $sh_add3, $sh_city, $sh_state, $sh_country, $co_zip_code, $co_add1, $co_add2, $co_add3, $co_city, $co_state, $co_country, $sh_ph_no, $co_ph_no, $co_email, $order_id1, $sh_gst, $sh_referance, $note)
      {
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

        $this->SetAutoPageBreak(true, 90);
      }

      function Header()
      {

        $rectWidth = $this->GetPageWidth();
        $rectHeight = $this->GetPageHeight();

        echo $rectHeight;
        echo $rectWidth;

        $this->SetLineWidth(0.4); // Set the border width
        $this->Rect(10, 22, $rectWidth - 20, $rectHeight - 35);

        $this->SetFont("Arial", "B", 22);
        $this->Cell(190, 12, "LAXMIPATI INTERNATIONAL COURIER", 0, 1, 'C');

        $this->SetFont("Arial", "B", 14);
        $this->Cell(190, 6, "2026 Momai Complex, nr.sahara Darwaja,Surat-395010", "T", 1, 'C');
        $this->Cell(190, 6, "Branch: Surat / Bardoli / Ahemdabad / Mumbai / Daman", "", 1, 'C');

        $this->SetFont("Arial", "B", 12);
        $this->Cell(190, 6, "Contact: 7567558310 / 7567558603", "", 1, 'C');
        $this->Cell(190, 6, "GST No.: 24AXBPV4894K2ZS", "", 1, 'C');

        $this->SetFont("Arial", "", 9);
        $this->Cell(16, 5, "DATE:", "TR", 0);
        $this->Cell(72, 5, date('d/m/Y', strtotime($this->invoice_no_date)), "T", 0);
        $this->Cell(72, 5, "INVOICE", "T", 0);
        $this->Cell(30, 5, "LP" . $this->order_id1, "LT", 1, 'C');

        $this->Cell(30, 5, "SHIPPERS", "T", 0);
        $this->Cell(130, 5, "", "T", 0);
        $this->Cell(30, 5, "CONSIGNEE", "T", 1);

        $this->Cell(25, 5, "NAME : ", "T", 0);
        $this->Cell(70, 5, $this->sh_full_name, "T", 0);
        $this->Cell(25, 5, "NAME : ", "LT", 0);
        $this->Cell(70, 5, $this->co_full_name, "T", 1);

        $this->Cell(25, 5, "ADD : ", "", 0);
        $this->Cell(70, 5, $this->sh_add1, "", 0);
        $this->Cell(25, 5, "ADD : ", "L", 0);
        $this->Cell(70, 5, $this->co_add1, "", 1);

        $this->Cell(25, 5, "", "", 0);
        $this->Cell(70, 5, $this->sh_add2, "", 0);
        $this->Cell(25, 5, "", "L", 0);
        $this->Cell(70, 5, $this->co_add2, "", 1);

        $this->Cell(25, 5, "", "", 0);
        $this->Cell(70, 5, $this->sh_add3, "", 0);
        $this->Cell(25, 5, "", "L", 0);
        $this->Cell(70, 5, $this->co_add3, "", 1);

        $this->Cell(25, 5, "", "", 0);
        $this->Cell(70, 5, $this->sh_city . ', ' . $this->sh_state . ', ' . $this->sh_zip_code, "", 0);
        $this->Cell(25, 5, "", "L", 0);
        $this->Cell(70, 5, $this->co_city . ', ' . $this->co_state . ', ' . $this->co_zip_code, "", 1);

        $this->Cell(25, 5, "", "", 0);
        $this->Cell(70, 5, $this->sh_country, "", 0);
        $this->Cell(25, 5, "", "L", 0);
        $this->Cell(70, 5, $this->co_country, "", 1);

        $this->Cell(25, 5, "CO.NO. : ", "", 0);
        $this->Cell(70, 5, $this->sh_ph_no, "", 0);
        $this->Cell(25, 5, "CO.NO. : ", "L", 0);
        $this->Cell(70, 5, $this->co_ph_no, "", 1);

        $this->Cell(25, 5, "ID NOMBER : ", "", 0);
        $this->Cell(70, 5, "LP" . $this->order_id1, "", 0);
        $this->Cell(25, 5, "EMAI ID : ", "L", 0);
        $this->Cell(70, 5, $this->co_email, "", 1);

        $this->Cell(25, 5, "GST NO. : ", "", 0);
        $this->Cell(70, 5, $this->sh_gst, "", 0);
        $this->Cell(25, 5, "", "L", 0);
        $this->Cell(70, 5, "", "", 1);

        $this->Cell(25, 5, "SERVICE: ", "TB", 0);
        $this->Cell(70, 5, $this->note, "TBR", 0);
        $this->Cell(25, 5, "REF. NO.: ", "TB", 0);
        $this->Cell(70, 5, $this->sh_referance, "TB", 1);
      }

      function Footer()
      {
        $this->SetY(-90); // Move Y to 60 units from the bottom of the page

        $this->SetFont("Arial", "B", 10);
        $this->Cell(190, 8, "TERMS AND CONDITIONS:", "", 1);

        $this->SetFont("Arial", "", 7);
        $this->MultiCell(190, 5, "1) PARCEL WILL BE FORWARDED AFTER RECEIVING 100% PAYMENT.\n" .
          "2) COMPANY SHALL HAVE NO RESPONSIBILITY IN CASE OF ITEMS DELAYED / BROKEN/LOST DUE TO COSTOMS PROCESS.\n" .
          "3) ADDRESS CORRECTION SURCHAGE 1500/-\n" .
          "4) 18% GST HAS TO BE PAID COMPULSORILY AS PER GOVERNMENT OF INDIA RULE.\n" .
          "5) DUTY/DESTINATION SURCHARGES AND LOCAL TAXES TO BE PAY THE RECEIVER.\n" .
          "6) FOR LOST PARCELS, THE COMPANY WILL REFUND 5000 RUPEES OR THE INVOICE VALUE, WHICHEVER IS LESS. (ALL INCLUSIVE)\n" .
          "7) THE COMPANY SHALL NOT BE LIABLE FOR ANY PROHIBITED ITEM PLACED IN THE PARCEL.\n" .
          "8) ONCE YOU BOOK SHIPMENT MEANS YOU AUTOMATICALLY AGREE TO OUR TERMS AND CONDITIONS. MENTIONED ON THIS SHEET AND TERMS SHEET.", "B");

        $this->SetFont("Arial", "", 10);
        $this->Cell(160, 6, "LAXMIPATI INTERNATIONAL COURIER", "", 0);
        $this->Cell(30, 6, "FOR.:", "", 1);

        $this->Cell(120, 6, "", "", 0);
        $this->Cell(70, 6, "SENDER'S SIGNATURE", "", 1, 'C');

        $this->Cell(120, 6, "", "", 0);
        $this->Cell(70, 6, "", "", 1, 'C');

        $this->Cell(120, 8, "AUTHORISED SIGNATORY", "", 0);
        $this->SetFont("Arial", "", 9);
        $this->Cell(70, 8, $this->sh_full_name, "", 1, 'C');
      }
    }

    $pdf = new PDF($invoice_no_date, $id, $sh_full_name, $co_full_name, $sh_zip_code, $sh_add1, $sh_add2, $sh_add3, $sh_city, $sh_state, $sh_country, $co_zip_code, $co_add1, $co_add2, $co_add3, $co_city, $co_state, $co_country, $sh_ph_no, $co_ph_no, $co_email, $order_id1, $sh_gst, $sh_referance, $note);
    $pdf->AddPage();

    
    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(190, 10, "UNSOLICITED GIFT FROM INDIVIDUAL TO INDIVIDUAL", "B", 1, 'C');

    $pdf->SetFont("Arial", "", 8);
    $pdf->Cell(20, 6, "BOX NO.", "B", 0);
    $pdf->Cell(25, 6, "VOLUME", "B", 0);
    $pdf->Cell(24, 6, "VOLUME.W.T", "B", 0);
    $pdf->Cell(24, 6, "EXCUAL.W.T", "B", 0);
    $pdf->Cell(25, 6, "CHARGABLE W.T", "B", 0);
    $pdf->Cell(24, 6, "RATE", "B", 0);
    $pdf->Cell(24, 6, "TOTAL", "B", 0);
    $pdf->Cell(24, 6, "EXTRA CH.", "B", 1);

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
        $pdf->Cell(20, 6, $counter, "RB", 0);
        $pdf->Cell(25, 6, $height . "x" . $width . "x" . $length, "BR", 0);
        $pdf->Cell(24, 6, $weightv, "BR", 0);
        $pdf->Cell(24, 6, $weightb, "BR", 0);
        // Choose the greater weight between $weightb and $weightv
        $greater_weight = ($weightb > $weightv) ? $weightb : $weightv;

        $pdf->Cell(25, 6, ceil($greater_weight), "BR", 0); // Print the greater weight

        $pdf->Cell(24, 6, $rate, "BR", 0);
        $weight_total = ceil($greater_weight) * $rate;
        $pdf->Cell(24, 6, $weight_total, "BR", 0);
        $pdf->Cell(24, 6, $extracharge, "B", 1);

        $weight_total1 += ceil($greater_weight) * $rate;
        $totalkg += ceil($greater_weight);
        $counter++;
      }
    }

    $pdf->SetFont("Arial", "", 8);
    $pdf->Cell(20, 6, "", "B", 0);
    $pdf->Cell(24, 6, "", "B", 0);
    $pdf->Cell(24, 6, "", "B", 0);
    $pdf->Cell(25, 6, "", "B", 0);
    $pdf->Cell(25, 6, "", "BR", 0);
    $pdf->Cell(24, 6, "TOTAL", "BR", 0);
    $pdf->Cell(24, 6, $weight_total1, "BR", 0);
    $pdf->Cell(24, 6, $extracharge, "B", 1);

    $pdf->SetFont("Arial", "B", 14);
    $pdf->Cell(190, 10, "TOTAL OUTSTANDING", "B", 1, 'C');

    $pdf->SetFont("Arial", "", 8);
    $pdf->Cell(18, 6, "TOTAL BOX", "BR", 0);
    $pdf->Cell(22, 6, "TOTAL K.G", "BR", 0);
    $pdf->Cell(21, 6, "RATE", "BR", 0);
    $pdf->Cell(27, 6, "EXTRA CHARGE", "BR", 0);
    $pdf->Cell(20, 6, "GST", "BR", 0);
    $pdf->Cell(27, 6, "GRAND TOTAL", "BR", 0);
    $pdf->Cell(27, 6, "PAID AMOUNT", "BR", 0);
    $pdf->Cell(28, 6, "PANDING AMOUNT", "B", 1);  

    $pdf->SetFont("Arial", "", 8);
    $pdf->Cell(18, 6, $box_no, "BR", 0);
    $pdf->Cell(22, 6, $totalkg, "BR", 0);
    $pdf->Cell(21, 6, $rate, "BR", 0);
    $pdf->Cell(27, 6, $extracharge, "BR", 0);
    $pdf->Cell(20, 6, $gst . "%", "BR", 0);
    $weight_total2 = $weight_total1 + $extracharge;
    $weight_total3 = (($extracharge) * $gst) / 100;
    $weight_total4 = $weight_total3 + $weight_total2;
    $pdf->Cell(27, 6, $weight_total4, "BR", 0);
    $pdf->Cell(27, 6, $apayment, "BR", 0);
    $weight_paydu = $weight_total4 - $apayment;
    $pdf->Cell(28, 6, $weight_paydu, "B", 1);

    // Output the PDF to the browser
    $pdf->Output();
  } else {
    echo "Data not found";
  }
} else {
  echo "No ID provided";
}
