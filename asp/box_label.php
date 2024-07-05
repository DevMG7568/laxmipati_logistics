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

    // Initialize box label count
    $box_label_count = 0;

    // Start PDF generation
    require("fpdf/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial", "", 10);

    // Retrieve order details using the provided order ID
    $sql = "SELECT * FROM order_details WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      // Use $id (order ID) from $row['id'] for product details query
      $order_id = $row['id'];

      // Retrieve product details associated with this order ID
      $product_sql = "SELECT * FROM get_start WHERE id = $order_id";
      $product_result = $conn->query($product_sql);

      while ($product_row = $product_result->fetch_assoc()) {
        $nob = $product_row['nob'];

        // Loop 'nob' times to repeat the data printing
        for ($i = 1; $i <= $nob; $i++) {
          $box_label_count++;

          // If box label count is 3, add a new page
          if ($box_label_count % 3 == 0) {
            $pdf->AddPage();
          }
          $pdf->SetFont("Arial", "B", 15);
          $pdf->Cell(155, 8, "BOX NO: " . $i . "/" . $nob, "LT", 0);
          $pdf->Cell(35, 8, "LP" . $order_id1, "RT", 1);
          $pdf->SetFont("Arial", "", 10);
          $pdf->Cell(190, 10, "TO,", "LR", 1);

          $pdf->SetFont("Arial", "B", 15);
          $pdf->Cell(190, 8, strtoupper($co_full_name), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_add1), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_add2), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_add3), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_city), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_state), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_zip_code), "LR", 1);
          $pdf->Cell(190, 8, strtoupper($co_country), "LR", 1);
          $pdf->Cell(190, 8, "PH : " . strtoupper($co_ph_no), "LRB", 1);
          $pdf->Ln(8); // Add a new line with 10 units of bottom margin

        }
      }
    }

    $pdf->Output();
  } else {
    echo "Data not found";
  }
} else {
  echo "No ID provided";
}
