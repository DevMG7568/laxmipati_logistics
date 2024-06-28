
<!DOCTYPE html>
<?php

include '../config.php';


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

<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="https://sourcecodester.com">Sourcecodester</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP - Simple Barcode Generator</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form method="POST">
				<div class="form-group">
					<label>Enter a text</label>
					<input type="text" class="form-control" name="barcode" value="LP<?php echo $row['id']; ?>"/>
					<br />
					<center><button class="btn btn-primary" name="generate">Generate</button></center>
					<br />
					<?php include 'generate.php'?>
				</div>
			</form>
		</div>
	</div>
</body>
</html>