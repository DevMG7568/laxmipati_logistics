<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database query to retrieve data including image paths
    $query = "SELECT * FROM order_details WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        require("fpdf/fpdf.php");

// Initialize PDF
$pdf = new FPDF();
$pdf->AddPage('P', 'A4');

$imageCount = 0; // Track the number of images added

while ($row = mysqli_fetch_assoc($result)) {

    // Dynamically fetch the image paths from the database
    $imagePaths = array();
    if (!empty($row['documentImage'])) {
        $imagePaths[] = "upload/" . $row['documentImage'];
    }
    if (!empty($row['documentImage_back'])) {
        $imagePaths[] = "upload/" . $row['documentImage_back'];
    }
    if (!empty($row['documentImage1'])) {
        $imagePaths[] = "upload/" . $row['documentImage1'];
    }

    // Loop through image paths
    foreach ($imagePaths as $imagePath) {
        // Check if the image file exists before trying to display it
        if (file_exists($imagePath)) {
            // Set X and Y coordinates for the image
            $pdf->SetXY(10, 10);
            // Embed image
            $pdf->Image($imagePath, 10, 10, 190, 0, 'JPEG');
            $imageCount++;

            // If it's not the last image, add a new page
            if ($imageCount < count($imagePaths)) {
                $pdf->AddPage('P', 'A4');
            }
        } else {
            echo "Image not found: $imagePath";
        }
    }
}

// Output PDF
$pdf->Output();


    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
