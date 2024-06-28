<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database query to retrieve the image path
    $query = "SELECT image_name FROM barcode WHERE id = $id"; // Replace your_table with your actual table name
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $imagePath = 'Barcode_img/' . $row['image_name']; // Assuming your column name is 'image_path'

        require("fpdf/fpdf.php");

        $pdf = new FPDF();
        $pdf->AddPage();

        $x = 70; // X-coordinate where you want to place the image (Left side)
        $y = 40; // Y-coordinate where you want to place the image (Top of the page)

        // Check if the image file exists before trying to display it
        if (file_exists($imagePath)) {
            // Set the cell size and position (50x50, starting at x=10, y=10)
            $pdf->Cell(50, 10, '', 0, 1, 'C');
            // Place the image within the cell
            $pdf->Image($imagePath, 156, 30, 42, 20);

            $pdf->SetFont("Arial", "", 10);

            $pdf->Output();
        } else {
            echo "Image not found";
        }
    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
