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
            product_details.price,
            product_details.hsn_code,
            product_details.total_price
        FROM order_details
        INNER JOIN get_booking ON order_details.id = get_booking.book_id
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


$box_no = '';  // Initialize box_no variable

$product_sql = "SELECT * FROM product_details WHERE product_id = $id ORDER BY box_no DESC LIMIT 1";
$product_result = $conn->query($product_sql);

if ($product_result->num_rows > 0) {
    $product_row = $product_result->fetch_assoc();
    $box_no = $product_row['box_no'];
}


require("fpdf/fpdf.php");

    class PDF extends FPDF {
    private $sh_full_name; // Add private properties to store the values
    private $co_full_name;

    // Constructor that accepts the values as parameters
    public function __construct($sh_full_name, $co_full_name, $sh_zip_code, $co_zip_code, $sh_city, $sh_state, $co_city, $co_state, $sh_add1, $co_add1, $sh_add2, $co_add2, $sh_add3, $co_add3, $sh_country, $co_country, $sh_ph_no, $co_ph_no, $sh_pan_no, $invoice_no_date, $id, $box_no, $weight, $totalprice) {
        parent::__construct('P', 'mm', 'A4');
        $this->sh_full_name = $sh_full_name;
        $this->co_full_name = $co_full_name;
        $this->sh_add1 = $sh_add1;
        $this->co_add1 = $co_add1;
        $this->sh_add2 = $sh_add2;
        $this->co_add2 = $co_add2;
        $this->sh_add3 = $sh_add3;
        $this->co_add3 = $co_add3;
        $this->sh_country = $sh_country;
        $this->co_country = $co_country;
        $this->sh_ph_no = $sh_ph_no;
        $this->co_ph_no = $co_ph_no;
        $this->sh_pan_no = $sh_pan_no;
        $this->invoice_no_date = $invoice_no_date;
        $this->id = $id;
        $this->box_no = $box_no;
        $this->weight = $weight;
        $this->totalprice = $totalprice;
        $this->sh_zip_code = $sh_zip_code;
        $this->co_zip_code = $co_zip_code;
        $this->sh_city = $sh_city;
        $this->sh_state = $sh_state;
        $this->co_city = $co_city;
        $this->co_state = $co_state;
    }

    // Header function
    function Header() {
        // Add your header content here
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Contact No: +91 7567558310 Website: www.laxmipatiinternational.com Email : info@laxmipatiinternational.com", 0, 1, 'C');
        
        // Add the "PERFORMA INVOICE" and "PAGE" information
        $this->Cell(160, 10, "PERFORMA INVOICE", 1, 0, 'C');
        $this->Cell(30, 10, "PAGE: " . $this->PageNo(), 1, 1, 'C');
        
        $this->SetFont("Arial", '', 10);
        $this->Cell(95, 6, "SHIPPER:", "LRT", 0,);
        $this->Cell(95, 6, "CONSIGNEE:", "LRT", 1);
        
        // For SHIPPER
        $this->Cell(95, 5, strtoupper($this->sh_full_name), "LR", 0);
        $this->Cell(95, 5, strtoupper($this->co_full_name), "LR", 1);
        
        $this->Cell(95, 5, strtoupper($this->sh_add1), "LR", 0);
        $this->Cell(95, 5, strtoupper($this->co_add1), "LR", 1);
        
        $this->Cell(95, 5, strtoupper($this->sh_add2), "LR", 0);
        $this->Cell(95, 5, strtoupper($this->co_add2), "LR", 1);
        
        $this->Cell(95, 5, strtoupper($this->sh_add3), "LR", 0);
        $this->Cell(95, 5, strtoupper($this->co_add3), "LR", 1);
        
        $this->Cell(95, 5, strtoupper($this->sh_city . ', ' . $this->sh_state . ', ' . $this->sh_zip_code), "LR", 0);
        $this->Cell(95, 5, strtoupper($this->co_city . ', ' . $this->co_state . ', ' . $this->co_zip_code), "LR", 1);
        
        $this->SetFont("Arial", "", 10);
        $this->Cell(95, 5, strtoupper($this->sh_country), "LR", 0);
        $this->Cell(95, 5, strtoupper($this->co_country), "LR", 1);
        
        $this->Cell(95, 6, "PH NO : ". strtoupper($this->sh_ph_no), "LR", 0);
        $this->Cell(95, 6, "PH NO : ". strtoupper($this->co_ph_no), "LR", 1);
        
        $this->Cell(95, 6, "AADHAR NO : ". strtoupper($this->sh_pan_no), "LR", 0);
        $this->Cell(95, 6, "", "LR", 1);
        
        $this->SetFont("Arial", "", 10);
        $this->Cell(95, 6, "COUNTRY OF ORIGIN : " .strtoupper($this->sh_country), "LR", 0);
        $this->Cell(95, 6, "NO OF BOX : " . strtoupper($this->box_no), "LRT", 1);

        $this->SetFont("Arial", "B", 8);
        $this->Cell(95, 6, "FINAL DESTINATION : " .strtoupper($this->co_country), "LR", 0,);
        $this->SetFont("Arial", "", 10);
        $this->Cell(95, 6, "TOTAL WEIGHT : " .strtoupper($this->weight), "LR", 1,);
        
        $this->SetFont("Arial", "B", 10);
        $this->Cell(110, 8, "DESCRIPTION OF GOODS", "LRTB", 0,);
        $this->Cell(27, 8, "QTY", "LRTB", 0,);
        $this->Cell(26, 8, "PRICE", "LRTB", 0,);
        $this->Cell(27, 8, "TOTAL INR", "LRTB", 1,);
       
    }
     function generateProductDetails($conn, $id) {
         
        $this->SetLineWidth(0.2); // Set the border width
        $this->Rect(10, 90, 190, 182, 'D');
        
        $this->SetLineWidth(0.2); // Set the border width
        $this->Rect(120, 90, 27, 182, 'D');
        
        $this->SetLineWidth(0.2); // Set the border width
        $this->Rect(147, 90, 26, 182, 'D');
        
        
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
                $height = $product_row2['height'];
                $width = $product_row2['width'];
                $length = $product_row2['length'];

                $this->SetFont("Arial", "B", 10);
                // Generate PDF cells for each box_no
                $this->Cell(110, 6, "BOX NO : " . $counter . " [ " . $weightv . " ] [ " . $height . "x" . $width . "x" . $length . " ]", "LRTB", 0);
                $this->SetFont("Arial", "", 10);
                $this->Cell(27, 6, "", "TB", 0);
                $this->Cell(26, 6, "", "TB", 0);
                $this->Cell(27, 6, "", "TB", 1);

                if (isset($productDetailsByBox[$counter])) {
                    // Retrieve product details for the current box_no
                    foreach ($productDetailsByBox[$counter] as $product_row1) {
                        $product_name = $product_row1['product_name'];
                        $price = $product_row1['price'];
                        $product_quantity = $product_row1['product_quantity'];
                        $total_price = $product_row1['total_price'];

                        // Generate PDF cells for each product
                        $this->Cell(110, 6, strtoupper($product_name), 0, 0);
                        $this->Cell(26, 6, strtoupper($product_quantity), 0, 0);
                        $this->Cell(27, 6, strtoupper($price), 0, 0);
                        $this->Cell(27, 6, strtoupper($total_price), 0, 1);
                    }
                }

                $counter++;
            }
        }
    }
     // Footer function
    function Footer() {
        $this->SetY(-25); // Move to the bottom of the page
        
         $this->SetFont("Arial", "", 10);
        $this->Cell(120, 6, "INR SEVEN HUNDRED AND THIRTY FIVE ONLY", "LRT", 0,);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(34, 6, "TOTAL(INR)", "LRT", 0,);
        $this->Cell(36, 6, $this->totalprice, "LRT", 1);
        
        $this->SetFont("Arial", "", 8);
        $this->Cell(120, 6, "WE HERE BY CONFIRM THAT THE PARCEL DOES NOT INVOLVE ANY COMMERCIAL", "LRT", 0,);
        $this->SetFont("Arial", "B", 9);
        $this->Cell(70, 4, "For , " .$this->sh_full_name, "LRT", 1,);
        
        $this->SetFont("Arial", "", 8);
        $this->Cell(120, 6, "TRANSACTION. THE VALUE IS DECLARED FOR CUSTOMS PURPOSE ONLY.", "LR", 0,);
        $this->Cell(70, 4, "", "LR", 1,);
        
        $this->Cell(120, 4, "", "LRB", 0,);
        $this->SetFont("Arial", "B", 8);
        $this->Cell(70, 4, "PREPAID BY", "LRB", 1,);
        $this->SetFont("Arial", "", 9);

        $this->SetFont('Arial', '', 8);
        $this->Cell(190, 6, "THIS IS A COMPUTER GENERATED INVOICE", "", 1, 'C');
    }
    
    /*function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(190, 8, "THIS IS A COMPUTER GENERATED INVOICE", "T", 1, 'C');
    } */
}

// Pass the values when creating the PDF instance
$pdf = new PDF($sh_full_name, $co_full_name, $sh_zip_code, $co_zip_code, $sh_city, $sh_state, $co_city, $co_state, $sh_add1, $co_add1, $sh_add2, $co_add2, $sh_add3, $co_add3, $sh_country, $co_country, $sh_ph_no, $co_ph_no, $sh_pan_no, $invoice_no_date, $id, $box_no, $weight, $totalprice);
$pdf->AddPage();
$pdf->SetFont("Arial", "", 10);

// Call the function to generate product details
$pdf->generateProductDetails($conn, $id);

/*
$imagePath = "lp.png"; // Image ka path
$x = 70; // X-coordinate where you want to place the image (Left side)
$y = 40; // Y-coordinate where you want to place the image (Top of the page)

$pdf->Image($imagePath, $x, $y, 80, 40); // Set width and height as needed

*/




/*$pdf->SetFont("Arial", '', 10);
$pdf->Cell(95, 6, "SHIPPER:", "LRT", 0,);
$pdf->Cell(95, 6, "CONSIGNEE:", "LRT", 1); */

// For SHIPPER
/*$pdf->Cell(95, 6, $sh_full_name, "LR", 0);
$pdf->Cell(95, 6, $co_full_name, "LR", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(95, 6, $sh_add1, "LR", 0);
$pdf->Cell(95, 6, $co_add1, "LR", 1); */


/*$pdf->Cell(95, 6, $sh_add2, "LR", 0);
$pdf->Cell(95, 6, $co_add2, "LR", 1);

$pdf->Cell(95, 6, $sh_add3, "LR", 0);
$pdf->Cell(95, 6, $co_add3, "LR", 1);

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(95, 6, $sh_country, "LR", 0);
$pdf->Cell(95, 6, $co_country, "LR", 1);

$pdf->Cell(95, 6, "PH NO : ". $sh_ph_no, "LR", 0);
$pdf->Cell(95, 6, "PH NO : ". $co_ph_no, "LR", 1);

$pdf->Cell(95, 6, "AADHAR NO : ". $sh_pan_no, "LR", 0);
$pdf->Cell(95, 6, "", "LR", 1);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(95, 6, "DATE OF INVOICE: " . date('d/m/Y', strtotime($invoice_no_date)), "LRT", 0);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(95, 6, "UNSOLICITATED GIFT FOR PEROSNAL USE ONLY ", "LRT", 1, 'C');
$pdf->SetFont("Arial", "", 10);
$pdf->Cell(95, 6, "AIRWAYBILL  : LP".$id, "LR", 0);
$pdf->Cell(95, 6, "NOT FOR SALE", "LR", 1, 'C'); */

/*$pdf->SetFont("Arial", "", 10);
$pdf->Cell(95, 6, "COUNTRY OF ORIGIN : " .$sh_country, "LR", 0);
// Retrieve order details using the provided order ID */
$sql = "SELECT * FROM order_details WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through order details
    while ($row = $result->fetch_assoc()) {
        // Use $id (order ID) from $row['id'] for product details query
        $order_id = $row['id'];

        // Retrieve the last row with the given product_id for product details
        $product_sql = "SELECT * FROM product_details WHERE product_id = $order_id ORDER BY box_no DESC LIMIT 1";
        $product_result = $conn->query($product_sql);

        while ($product_row = $product_result->fetch_assoc()) {
            // Retrieve the box_no for the last row
            $box_no = $product_row['box_no'];

            // Generate PDF cells for the last box_no
            //$pdf->Cell(95, 6, "NO OF BOX : " . $box_no, "LRT", 1);
        }
    }
}


/*$pdf->Cell(95, 6, "FINAL DESTINATION : " .$co_country, "LR", 0,);
$pdf->Cell(95, 6, "TOTAL WEIGHT : " .$weight, "LR", 1,);

$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(110, 8, "DESCRIPTION OF GOODS", "LRTB", 0,);
$pdf->Cell(27, 8, "PRICE", "LRTB", 0,);
$pdf->Cell(26, 8, "QTY", "LRTB", 0,);
$pdf->Cell(27, 8, "TOTAL INR", "LRTB", 1,); */



// Retrieve order details using the provided order ID
/*$sql = "SELECT * FROM order_details WHERE id = $id";
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
        $height = $product_row2['height'];
        $width = $product_row2['width'];
        $length = $product_row2['length'];

        $pdf->SetFont("Arial", "B", 10);
        // Generate PDF cells for each box_no
        $pdf->Cell(110, 8, "BOX NO : " . $counter . " [ " . $weightv . " ] [ " . $height . "x" . $width . "x" . $length . " ]", "LRTB", 0);
        $pdf->SetFont("Arial", "", 10);
        $pdf->Cell(27, 8, "", "LRTB", 0);
        $pdf->Cell(26, 8, "", "LRTB", 0);
        $pdf->Cell(27, 8, "", "LRTB", 1);

        if (isset($productDetailsByBox[$counter])) {
            // Retrieve product details for the current box_no
            foreach ($productDetailsByBox[$counter] as $product_row1) {
                $product_name = $product_row1['product_name'];
                $price = $product_row1['price'];
                $product_quantity = $product_row1['product_quantity'];
                $total_price = $product_row1['total_price'];

                // Generate PDF cells for each product
                $pdf->Cell(110, 8, $product_name, "LR", 0);
                $pdf->Cell(27, 8, $price, "LR", 0);
                $pdf->Cell(26, 8, $product_quantity, "LR", 0);
                $pdf->Cell(27, 8, $total_price, "LR", 1);
            }
        }

        $counter++;
    }
    
}*/




/*$pdf->Cell(110,30,"","LR",0);
$pdf->Cell(27,30,"","LR",0);
$pdf->Cell(26,30,"","LR",0);
$pdf->Cell(27,30,"","LR",1); */





/*$pdf->Cell(126, 8, "INR SEVEN HUNDRED AND THIRTY FIVE ONLY", "LRT", 0,);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(31, 8, "TOTAL(INR)", "LRT", 0,);
$pdf->Cell(33, 8, "$totalprice", "LRT", 1,);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(126, 5, "WE HERE BY CONFIRM THAT THE PARCEL DOES NOT INVOLVE ANY", "LRT", 0,);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(64, 5, "For , " .$sh_full_name, "LRT", 1,);

$pdf->SetFont("Arial", "", 10);
$pdf->Cell(126, 5, " COMMERCIAL TRANSACTION. THE VALUE IS DECLARED FOR.", "LR", 0,);
$pdf->Cell(64, 5, "", "LR", 1,);

$pdf->Cell(126, 5, " CUSTOMS PURPOSE ONLY.", "LRB", 0,);
$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(64, 5, "PREPAID BY", "LRB", 1,);
$pdf->SetFont("Arial", "", 10);

$pdf->Cell(190, 8, "THIS IS A COMPUTER GENERATED INVOICE", "", 1, 'C');*/

$pdf->Output();


    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
