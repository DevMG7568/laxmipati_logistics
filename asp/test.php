<?php
// Include your database connection file (e.g., 'config.php')
@include 'config.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<style>
    
    caption{
        font-size:24px;
        font-weight:500;
        margin:10px auto;
    }
    th,td{
        padding:5px 2px;
    }
    a{
    text-decoration: none;
    display: inline-block;
    padding: 5px;
    border: 1px solid black;
    border-radius: 3px;
    margin: auto 6px;
    }
</style>
<body>
    <center>
    <table border="1" cellspacing="0">
        <caption>Order Details</caption>
        <tr>
            <th>DATE</th>
            <th>AWB NO</th>
            <th>CONSIGNEE/SHIPPER</th>
            <th>COUNTRY</th>
            <th>WEIGHT</th>
            <th>NOB</th>
            <th>TOTAL</th>
            <th>ACTION</th>
            <th>PRINT</th>
        </tr>
        <?php
 $sql = "SELECT order_details.*, get_booking.nob, get_booking.weight, total.total_price
        FROM order_details
        LEFT JOIN get_booking ON order_details.id = get_booking.id
        LEFT JOIN total ON order_details.id = total.total_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while ($row = $result->fetch_assoc()) {

?>
                <tr>
                    <td><?php echo $row['invoice_no_date']; ?></td> 
                    <td>LP<?php echo $row['id']; ?></td>
                    <td><?php echo $row['sh_full_name']; ?><br><?php echo $row['co_full_name']; ?></td>
                    <td><?php echo $row['co_country']; ?></td>
                    <td><?php echo $row['weight']; ?></td>
                    <td><?php echo $row['nob']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>     
                    <td>
                        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        <a href="up.php?id=<?php echo $row['id']; ?>">Update</a>
                    </td>
                    <td> 
                        <a href="performa_invoice.php?id=<?php echo $row['id']; ?>">PERFORMA INVOICE </a>
                        <a href="kycpdf.php?id=<?php echo $row['id']; ?>">KYC PDF</a>
                        <a href="box_label.php?id=<?php echo $row['id']; ?>">BOX LABEL</a>
                        <a href="awb.php?id=<?php echo $row['id']; ?>">AWB</a>
                        <a href="non_dg.php?id=<?php echo $row['id']; ?>">NON DG</a>
                        <a href="authorization_latter.php?id=<?php echo $row['id']; ?>"> AUTHORIZATION LATTER</a>
                        <a href="data.php?id=<?php echo $row['id']; ?>">Data</a>
                        <a href="Barcode/index.php?id=<?php echo $row['id']; ?>">Barcode</a>
                        <a href="track.php?id=<?php echo $row['id']; ?>">Track</a>
                        <a href="courier_status.php?id=<?php echo $row['id']; ?>">Courier Status</a>
                    </td>
                </tr>
                <?php
  }
} else {
    echo "No records found";
}
        ?>
    </table>
</center>
    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
