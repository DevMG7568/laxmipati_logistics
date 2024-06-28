<?php
// order_tracking.php

$servername = "localhost";
$username = "u395256775_laxmipatibacke";
$password = "Laxmipati@123";
$dbname = "u395256775_laxmipatibacke";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if an order ID is provided via the URL
if (isset($_GET['id'])) {
    $user_input = $_GET['id'];

    // Extract the numeric part from the user input (assuming LP followed by numbers)
    $numeric_part = preg_replace("/[^0-9]/", "", $user_input);

    if (!empty($numeric_part)) {
        // Query the database to retrieve the order status based on the numeric part
        $sql = "SELECT * FROM order_details WHERE order_id = $numeric_part";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $status = $row['status'];
            $invoice_no_date = $row['invoice_no_date'];
            $adate = $row['adate'];
            $sh_full_name = $row['sh_full_name'];
            $co_full_name = $row['co_full_name'];
            $sh_ph_no = $row['sh_ph_no'];
            $co_ph_no = $row['co_ph_no'];
            $sh_add1 = $row['sh_add1'];
            $sh_add2 = $row['sh_add2'];
            $sh_add3 = $row['sh_add3'];
            $co_add1 = $row['co_add1'];
            $co_add2 = $row['co_add2'];
            $co_add3 = $row['co_add3'];
            $sh_country = $row['sh_country'];
            $co_country = $row['co_country'];
            
            
 // echo "User Input: $user_input<br>Order ID: $numeric_part<br>status: $status";
        } else {
            echo "Order ID not found for User Input: $user_input";
        }
    } else {
        echo "Invalid User Input. Please provide a valid order ID in the format LP followed by numbers.";
    }
} else {
    echo "Please provide an order ID in the URL.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Tracking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

body{
    font-family: 'Poppins', sans-serif;
}
.asp{
    background-image:url("images/asp1.jpg");
    width:100%;
    height:100vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
.container{
    max-width:1320px;
    height:100vh;
    margin:auto;
    display:flex;
    justify-content: center;
    align-items: center;
}
.container .row{
    
}
.container .row h1{
    text-align:center;
    font-size:42px;
    font-weight:600;
}
.container .row form{
    display:flex;
    justify-content: space-between;
    width:700px;
    margin: auto;
}
.container .row form input{
    width:570px;
    height:50px;
}
.container .row form button{
    width:130px;
    height:55px;
}
.container .row h2{
    text-align:center;
    font-size:32px;
    font-weight:500;
}
.container .row #progress-bar{
  display:flex;
  justify-content: center;
  align-items: center;
  background: white;
  padding-top: 20px;
  border-radius: 10px 10px 0px 0px;
}
.container .row #progress-bar .active{
   display:block;
}
.container .row #progress-bar ul{
    list-style:none;
    margin: auto 25px;
    padding: 0;
    display:none;
}
.container .row #progress-bar ul li.icon{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: green;
}
.container .row #progress-bar ul li.icon .fa-solid{
    font-size:35px;
    color:white;
}
.container .row #progress-bar ul li{
    
}
.container .row #progress-bar ul li h3{
    text-align:center;
    font-size:22px;
    font-weight:500;
}
.bar{
    background:white;
}
.details{
    display:flex;
    background: white;
    border-radius:0px 0px 10px 10px;
    margin-top: -26px;
}
.details .box{
    margin:20px;
}
.details .box h2{
    font-size:15px;
    font-weight:500;
    text-align:left;
}
</style>
<body>
    <section class="asp">
    <div class="container">
        <div class="row">
    <h1>Order Tracking</h1>
    <form method="GET" action="#">
        <input type="text" id="id" name="id" placeholder="Enter Your Tracking No Ex: LP123" required>
        <button type="submit">Track Order</button>
    </form>
    <h2>SHIPMENT DETAILS</h2>
    <div id="progress-bar">
    <ul><center>
        <li class="icon"><i class="fa-solid fa-check"></i></li>
        <li><h3>BOOKED</h3></li>
    </ul>
     <ul><center>
        <li class="icon"><i class="fa-solid fa-check"></i></li>
        <li><h3>IN TRANSIT</h3></li>
    </ul>
     <ul><center>
        <li class="icon"><i class="fa-solid fa-check"></i></li>
        <li><h3>OUT FOR DELIVERY</h3></li>
    </ul>
     <ul><center>
        <li class="icon"><i class="fa-solid fa-check"></i></li>
        <li><h3>DELIVERED</h3></li>
    </ul>
  
</div>
<div id="shipment-details">
    <?php if (!empty($invoice_no_date) && !empty($adate)) { ?>
    <div class="details">
        <div class="box">
            <h2>Courier Booking Date: <?php echo date('d/m/Y', strtotime($row['invoice_no_date'])); ?></h2>
            <h2>Origin: <?php echo $sh_country; ?></h2>
            <h2>Shipper Information</h2><hr>
            <h2>NAME: <?php echo $sh_full_name; ?></h2>
            <h2>CONTACT NO: <?php echo $sh_ph_no; ?></h2>
            <h2>ADDRESS: <?php echo $sh_add1; ?> <br> <?php echo $sh_add2; ?> <br> <?php echo $sh_add3; ?></h2>
        </div>
        <div class="box">
            <h2>Asking Delivery Date: <?php echo date('d/m/Y', strtotime($row['adate'])); ?></h2>
            <h2>Destination: <?php echo $co_country; ?></h2>
            <h2>Receiver Information</h2><hr>
            <h2>NAME: <?php echo $co_full_name; ?></h2>
            <h2>CONTACT NO: <?php echo $co_ph_no; ?></h2>
            <h2>ADDRESS: <?php echo $co_add1; ?> <br> <?php echo $co_add2; ?> <br> <?php echo $co_add3; ?></h2>
        </div>
    </div>

    <?php } ?>
</div>
    </div>
    </div>
    </section>
  <script>
        var status = "<?php echo $status; ?>"; // Get the status from PHP
        
        var progressBar = document.getElementById("progress-bar");
        var boxes = progressBar.getElementsByTagName("ul");
        
        // Set the progress bar based on the status
        if (status === "BOOKED") {
            boxes[0].classList.add("active");
        } else if (status === "IN TRANSIT") {
            boxes[0].classList.add("active");
            boxes[1].classList.add("active");
        } else if (status === "OUT FOR DELIVERY") {
            boxes[0].classList.add("active");
            boxes[1].classList.add("active");
            boxes[2].classList.add("active");
        } else if (status === "DELIVERED") {
            boxes[0].classList.add("active");
            boxes[1].classList.add("active");
            boxes[2].classList.add("active");
            boxes[3].classList.add("active");
        }
    </script>

</body>
</html>

