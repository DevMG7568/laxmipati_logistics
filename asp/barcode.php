<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select_data = mysqli_query($conn, "SELECT 
            order_details.*,
            get_booking.weight,
            get_booking.height,
            get_booking.width,
            get_booking.length,
            product_details.product_name,
            product_details.box_no,
            product_details.product_quantity,
            product_details.hsn_code,
            total.total_price
        FROM order_details
        INNER JOIN get_booking ON order_details.id = get_booking.id
        INNER JOIN product_details ON order_details.id = product_details.product_id
        INNER JOIN total ON order_details.id = total.id
        WHERE order_details.id = $id");

    if (mysqli_num_rows($select_data) > 0) {
        $row = mysqli_fetch_assoc($select_data);

        // Generate the barcode text
        $barcodeText = "LP" . $row['id'];

        // Create an HTML file with the barcode
        $htmlContent = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Barcode</title>
            <script src='Barcode/JsBarcode.all.min.js'></script>
        </head>
        <body>
            <svg id='barcode'></svg>
            <script>
                // Generate the barcode using JsBarcode
                JsBarcode('#barcode', '$barcodeText', {
                    format: 'CODE128', // You can specify the barcode format here
                });
            </script>
        </body>
        </html>
        ";

        // Create a temporary HTML file
        $tempFile = tempnam(sys_get_temp_dir(), 'barcode');
        file_put_contents($tempFile, $htmlContent);

        // Generate the PDF using wkhtmltopdf
        $pdfFile = tempnam(sys_get_temp_dir(), 'barcode') . '.pdf';
        $command = "wkhtmltopdf $tempFile $pdfFile 2>&1";
        $output = shell_exec($command);

        if (!empty($output)) {
            // Error occurred, display or log the error message
            echo "Error: $output";
        } else {
            // Output the PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="barcode.pdf"');
            readfile($pdfFile);
        }

        // Clean up temporary files
        unlink($tempFile);
        unlink($pdfFile);
    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}
?>
