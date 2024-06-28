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

@include 'header.php';

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


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>Laxmipati</title>
        <meta name="description" content="We Offer Import & Export assistance foreign businesses in transporting and selling their products in China, India and USA. We connect domestic companies to the international shipping services most suited for their business.">
<!-- Stylesheets -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<!-- Responsive File -->
<link href="assets/css/responsive.css" rel="stylesheet">
<!-- Color File -->
<link href="assets/css/color.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&amp;family=Yantramanav:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">

<link rel="shortcut icon" href="assets/images/lp.png" type="image/x-icon">
<link rel="icon" href="assets/images/lp.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=601e75803d01430011c105c8&product=image-share-buttons' async='async'></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <style>

.asp{
    background-image:url("assets/images/main-slider/image-3.jpg"),linear-gradient(180deg, #ffffff, #ffffff);
    background-blend-mode: multiply;
    width:100%;
    height:100vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin-top:57px;
}
.track{
    max-width:1320px;
    height:100vh;
    margin:auto;
    display:flex;
    justify-content: center;
    align-items: center;
}
.track .row1{
    
}
.track .row1 h1{
    text-align:center;
    font-size:28px;
    font-weight:600;
    color:white;
}
.track .row1 h4{
    text-align:center;
    font-size:20px;
    font-weight:500;
    color:white;
}
.track .row1 form{
    margin-top:10px;
    display:flex;
    justify-content: space-between;
    width:700px;
}
.track .row1 form input{
    width:570px;
    height:50px;
    border-radius:8px 0px 0px 8px;
    border:none;
}
.track .row1 form input::placeholder{
    font-size:16px;   
    padding-left:10px;
    color:black;
}
.track .row1 form button{
    width:130px;
    height:50px;
    background-color: #ef7f1b;
    border:none;
    color:white;
    border-radius:0px 8px 8px 0px;
}
.track .row1 h2{
    text-align:center;
    font-size:32px;
    font-weight:500;
}
.track .row1 #progress-bar{
  display:flex;
  justify-content: center;
  align-items: center;
  background:white;
  margin-top:10px;
  border-radius:10px 10px 0px 0px;
}
.track .row1 #progress-bar .active{
   display:block;
}
.track .row1 #progress-bar ul{
    list-style:none;
    margin: 25px 25px auto 25px;
    padding: 0;
    display:none;
}
.track .row1 #progress-bar ul li.icon{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: green;
}
.track .row1 #progress-bar ul li.icon .fa-solid{
    font-size:25px;
    color:white;
}
.track .row1 #progress-bar ul li{
    
}
.track .row1 #progress-bar ul li h3{
    text-align:center;
    font-size:16px;
    font-weight:500;
    color:black;
    margin-top:10px;
}

.bar{
    background:white;
}
.bar center img{
    width:150px;
    height:100px;
    margin:10px;
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
    line-height: 24px;
}


@media (max-width:768px) {
    
    .track .row1 #progress-bar ul li.icon {
    width: 30px;
    height: 30px;
    }
    .track .row1 #progress-bar ul li.icon .fa-solid {
    font-size: 18px;
    }
    .track .row1 #progress-bar ul li h3 {
    font-size: 14px;
    }
    .bar center img {
    width: 130px;
    height: 85px;
    margin: 3px;
    }
    .details .box h2 {
    font-size: 13px;
    }
    .track {
    max-width: 768px;
    height: auto;
    }
    .track .row1 h1 {
    font-size: 28px;
    margin-top: 44px;
    }
}

@media (max-width:720px) {
    
    .asp{
    height:95vh;
    }
	.track{
    height:90vh;
	}
	.track .row1 form {
    width: 390px;
	}
	.track .row1 form input {
    width: 280px;
    height: 42px;
    border-radius:3px 0px 0px 3px;
    }
    .track .row1 form button {
    width: 110px;
    height: 42px;
    border-radius:0px 3px 3px 0px;
    }
    .track .row1 h1 {
    font-size: 28px;
    font-weight: 500;
    }
    .track .row1 h4 {
    font-size: 18px;
    font-weight: 400;
    }
    .track .row1 form input::placeholder{
    font-size:14px;   
    }
		
}

@media (max-width:650px) {
    html{
    overflow-x: hidden;
    }
	.track .row1 #progress-bar ul {
    margin: 5px 5px auto 5px;
	}
	.track .row1 #progress-bar ul li.icon {
    width: 40px;
    height: 40px;
	}
	.track .row1 #progress-bar ul li.icon .fa-solid {
    font-size: 18px;
	}
	.track .row1 #progress-bar ul li h3 {
    font-size: 13px;
    }
    
}

@media (max-width:500px) {
     .asp{
    height:85vh;
    }
	.track{
    height:80vh;
	}
.track .row1 h1 {
    font-size: 22px;
}
.track .row1 form {
    margin-top: 8px;
    width: 350px;
}
.track .row1 form button {
    font-size: 15px;
    width: 125px;
}
.track .row1 #progress-bar {
    margin: 10px 10px 0px 10px;
}
.bar {
    margin: 0px 10px;
}
.details {
    margin: 0px 10px;
}
.track .row1 #progress-bar ul {
    margin: 10px 5px auto 5px;
}

}

</style>

    <body>
        
   

<section class="asp">
    <div class="track">
        <div class="row1">
    <h1>FIND AN INSTANT ONLINE QUOTE</h1>
    <h4>Or Track Your Shipment</h4>
   <center> 
   <form method="GET" action="#">
        <input type="text" id="id" name="id" placeholder="Enter Your Tracking No Ex: LP123" required>
        <button type="submit"><i class="fa-solid fa-location-dot" style="font-size:18px;color:white;margin-right:10px;"></i>Track Order</button>
    </form> 
    </center>
    <div id="progress-bar">
        <ul>
            <center>
            <li class="icon"><i class="fa-solid fa-check"></i></li>
            <li><h3>BOOKED</h3></li>
            </center>
        </ul>
         <ul>
            <center>
            <li class="icon"><i class="fa-solid fa-check"></i></li>
            <li><h3>IN TRANSIT</h3></li>
            </center>
        </ul>
         <ul>
            <center>
            <li class="icon"><i class="fa-solid fa-check"></i></li>
            <li><h3>OUT FOR DELIVERY</h3></li>
            </center>
        </ul>
         <ul>
            <center>
            <li class="icon"><i class="fa-solid fa-check"></i></li>
            <li><h3>ON HOLD</h3></li>
            </center>
        </ul>
         <ul>
            <center>
            <li class="icon"><i class="fa-solid fa-check"></i></li>
            <li><h3>DELIVERED</h3></li>
            </center>
        </ul>
    </div>
    <div id="shipment-details">
    <?php if (!empty($invoice_no_date) && !empty($adate)) { ?>
    <div class="bar">
    <!---<center>
        <img src="<?php //echo $imageBarcode ; ?>">
    </center>--->
    </div>
    <div class="details">
        <div class="box">
            <h2>COURIER BOOKING DATE: <?php echo date('d/m/Y', strtotime($row['invoice_no_date'])); ?></h2>
            <h2>ORIGIN: <?php echo strtoupper ($sh_country); ?></h2>
            <h2>SHIPPER Information</h2><hr>
            <h2>NAME: <?php echo strtoupper ($sh_full_name); ?></h2>
            <h2>CONTACT NO: <?php echo strtoupper ($sh_ph_no); ?></h2>
            <h2>ADDRESS: <?php echo strtoupper ($sh_add1); ?> <br> <?php echo strtoupper ($sh_add2); ?> <br> <?php echo strtoupper ($sh_add3); ?></h2>
        </div>
        <div class="box">
            <h2>ASKING DELIVERY DATE: <?php echo date('d/m/Y', strtotime($row['adate'])); ?></h2>
            <h2>DESTINATION: <?php echo strtoupper ($co_country); ?></h2>
            <h2>RECEIVER INFORMATION</h2><hr>
            <h2>NAME: <?php echo strtoupper ($co_full_name); ?></h2>
            <h2>CONTACT NO: <?php echo strtoupper ($co_ph_no); ?></h2>
            <h2>ADDRESS: <?php echo strtoupper ($co_add1); ?> <br> <?php echo strtoupper ($co_add2); ?> <br> <?php echo strtoupper ($co_add3); ?></h2>
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

<?php 
@include 'footer.php';
?>

    
    