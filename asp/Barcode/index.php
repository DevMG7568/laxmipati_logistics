<!DOCTYPE html>
<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select_data = mysqli_query($conn, "SELECT 
            order_details.*
        FROM order_details
        WHERE order_details.id = $id");

    if (mysqli_num_rows($select_data) > 0) {
        $row = mysqli_fetch_assoc($select_data);
        $id = $row['id'];
    } else {
        echo "Data not found";
    }
} else {
    echo "No ID provided";
}

// Function to generate and download the barcode as an image
function generateAndDownloadBarcode($text) {
    // Include the JsBarcode library
    require_once 'JsBarcode.all.min.js';

    // Generate the barcode
    JsBarcode("#barcode", $text);

    // Create a PNG image of the barcode
    $image = JsBarcode::getBarcodePNG($text);

    // Set the appropriate headers for download
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="barcode.png"');

    // Output the image to the browser
    echo $image;
    exit; // Exit to prevent further HTML output
}

// Check if a download request has been made
if (isset($_GET['download'])) {
    generateAndDownloadBarcode("LP" . $row['id']);
}
?>

<?php
include '../config.php';

if (isset($_POST['upload'])) {
    $uploadDir = '../Barcode_img/'; // Directory to store uploaded images
    $targetFile = $uploadDir . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image (you can add more checks here)
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo "Invalid file. Please upload an image.";
    } else {
        // Upload the image to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Insert the image file name into the database
            $imageName = basename($_FILES['image']['name']);
            $sql = "INSERT INTO barcode (image_name) VALUES ('$imageName')";
            if (mysqli_query($conn, $sql)) {
                echo "Image uploaded and saved to the database successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading the image.";
        }
    }
} else {
    echo "";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="JsBarcode.all.min.js"></script>
    <title>Laxmipati</title>
</head>
<style>
    .barcode{
        width:200px;
    }
</style>
<body>
    <div class="barcode">
    <input type="hidden" id="inp" placeholder="Give Name For Your Barcode" required value="LP<?php echo $row['id']; ?>"><br>
    <svg id="barcode"></svg>
    </div>
 
    <button id="download-card">Download Barcode</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script> 

    <script>
            const downloadButton = document.getElementById("download-card");

           downloadButton.addEventListener("click", () => {
    const card = document.querySelector(".barcode");
    
    html2canvas(card).then(canvas => {
        // Convert the canvas to a data URL
        const imageDataURL = canvas.toDataURL("image/png");
        
        // Create a temporary anchor element and trigger download
        const a = document.createElement("a");
        const fileName = "barcode_<?php echo $row['id']; ?>.png"; // Dynamically set the file name
        a.href = imageDataURL;
        a.download = fileName; // Set the file name
        document.body.appendChild(a); // Append to the document
        a.click();
        document.body.removeChild(a); // Clean up
    });
});

    </script>
    <script>
       // Call JsBarcode when the page loads
        window.onload = function() {
            let x = document.getElementById('inp').value;
            JsBarcode("#barcode", x);
        };
    </script>
    
     <h1>Upload an Image</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="image">Select an image:</label>
        <input type="file" name="image" id="image" required>
        <br>
        <input type="submit" name="upload" value="Upload">
    </form>
    
</body>
</html>
