<?php
@include 'config.php';

$sql = "SELECT * FROM order_details ORDER BY id DESC"; // Fetching data ordered by ID in descending order
$result = $conn->query($sql);

$data = array(); // Array to store fetched data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Store fetched data in array
    }

    // No need to reverse the array as data is already fetched in descending order

    foreach ($data as $row) { // Loop through the array normally
        ?>
        <div>
            <p><?php echo date('d/m/Y', strtotime($row['invoice_no_date'])); ?></p>
            <p>LPIC<?php echo $row['order_id']; ?></p>
            <p><?php echo $row['sh_full_name']; ?><br><?php echo $row['co_full_name']; ?></p>
            <p><?php echo $row['co_country']; ?></p>
            <p><?php echo $row['nob']; ?></p>
        </div>
        <?php
    }
} else {
    echo "No records found";
}

// Close the database connection
$conn->close();
?>
