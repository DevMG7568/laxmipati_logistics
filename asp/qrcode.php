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
            product_details.price,
            product_details.hsn_code,
            total.total_price
        FROM order_details
        INNER JOIN get_booking ON order_details.id = get_booking.id
        INNER JOIN product_details ON order_details.id = product_details.product_id
        INNER JOIN total ON order_details.id = total.id
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
?>
<h3>Scan QR Code to download the contact details</h3>
	<img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=https://vfolo.in/LaxmipatiAdmin/asp/data.php?id=<?php echo $row['id']; ?>" id="qr_code_d">

