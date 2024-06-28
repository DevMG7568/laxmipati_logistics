<?php

include("config.php"); // Include the database connection file

// Extract data from the form
$user_name = $_POST['user_name'];
$country = $_POST['country'];
$documentType = $_POST['document_type_id'];
$nob = $_POST['nob'];
$weight = $_POST['weight'];
$orderDate = $_POST['order_currier_date'];
$shReference = $_POST['sh_referance'];
$note = $_POST['note'];

// Insert data into the 'dj' table
$sql_dj = "INSERT INTO get_start (user_name, country, document_type_id, nob, weight, order_currier_date, sh_referance, note)
           VALUES ('$user_name', '$country', '$documentType', '$nob', '$weight', '$orderDate', '$shReference', '$note')";

if ($conn->query($sql_dj) === TRUE) {
    // Get the generated 'id' from the 'dj' table
    $book_id = $conn->insert_id;
} else {
    echo "Error: " . $sql_dj . "<br>" . $conn->error;
}


// Extract arrays from the form (assuming these are arrays)
$heightArray = $_POST['height'];
$widthArray = $_POST['width'];
$lengthArray = $_POST['length'];
$weightvArray = $_POST['weightv'];
$weightbArray = $_POST['weightb'];

// Loop through the arrays and insert data into the 'dj_get_booking' table
for ($i = 0; $i < count($heightArray); $i++) {
    $height = $heightArray[$i];
    $width = $widthArray[$i];
    $length = $lengthArray[$i];
    $weightv = $weightvArray[$i];
    $weightb = $weightbArray[$i];

    // Insert data into the 'dj_get_booking' table using the correct 'book_id'
$sql_dj_get_booking = "INSERT INTO get_booking (book_id, height, width, length, weightv, weightb)
                       VALUES ('$book_id', '$height', '$width', '$length', '$weightv', '$weightb')";

if ($conn->query($sql_dj_get_booking) === TRUE) {
    // Successfully inserted into 'dj_get_booking' table
    header("Location: aspform.php");
        exit();
} else {
    echo "Error: " . $sql_dj_get_booking . "<br>" . $conn->error;
}

}




?>