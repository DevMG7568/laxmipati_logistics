<?php

@include 'config.php';

session_start();

if (!isset($_SESSION["admin_username"])) {
    header("Location: index.php");
    exit();
}
$admin_username = $_SESSION["admin_username"];

$query = "SELECT usernumber, branchname, address, aadharcardnumber, pancardnumber, profilepicture FROM admin_users WHERE adminusername = '$admin_username'";
$result = $conn->query($query);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $usernumber = $row["usernumber"];
    $branchname = $row["branchname"];
    $address = $row["address"];
    $aadharcardnumber = $row["aadharcardnumber"];
    $pancardnumber = $row["pancardnumber"];
    $profilepicture = 'Profilepicture/' .$row["profilepicture"];
} else {
    // Handle error if the user is not found
    echo "User not found.";
    exit();
}


?>

<!doctype html>
<html lang="en">
    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payments | Laxmipati</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
    }
    a{
        text-decoration: none;
    }
    .dj{
        background-color: #06033D;
        height:135px;
        width:100%;
    }
    .dj .rj{
        max-width: 1320px;
        margin: auto;
    }
    .dj .rj .top{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top:20px;
    }
    .dj .rj .top img.logo{
        width: 200px;
        border-right: 1px solid white;
    }
    .dj .rj .top img.profile{
        width: 80px;
        height:80px;
        border-radius:50%;
    }
    .dj .rj .top h2{
        font-size: 24px;
        font-weight: 500;
        color: white;
    }
    .dj .rj .bottom{

    }
    .dj .rj .bottom ul.a{
        list-style: none;
        display:block;
        background: transparent;
        box-shadow: none;
        width: auto;
        height: auto;
    }
    .dj .rj .bottom ul.a li{
        display: inline-block;
        margin: auto 10px;
    }
    .dj .rj .bottom ul.a li a{
        font-size: 20px;
        font-weight: 500;
        color: white;
    }
    
    dialog{
        width:700px;
        border: none;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        margin-top: 5px;
        border-radius: 8px;
        z-index:99;
    }
    .fa-solid{
       cursor: pointer;
    }
    table tr td img{
        width:100px;
        height:80px;
    }
</style>

<body>
    
      <div class="dj">
    <div class="rj">
        <div class="top">
            <img src="logo.png" alt="" class="logo">
            <h2><?php echo $admin_username; ?></h2>
            <img src="<?php echo $profilepicture; ?>" class="profile">
        </div>
        <div class="bottom">
            <ul class="a">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="aspform.php">Booking</a></li>
                <li><a href="allorder.php">All Booking</a></li>
                <li><a href="calculator.php">Rate Calculator</a></li>
                <li><a href="payment.php">Payment</a></li>
                <?php
                    if ($admin_username == 'ADMIN (M)') {
                        // Display the "All Branch" option for the admin user
                        echo '<li><a href="addbranch.php">All Branch</a></li>';
                        echo '<li><a href="allbranchbooking.php">All Branch Booking</a></li>';
                    }
                    ?>
            </ul>
        </div>
    </div>
</div>

	<div class="container" style="margin-top:50px;">

	
	 <?php
// Database connection file ko include karen
include 'config.php';

// Query to fetch data from the "payments" table
// $sql = "SELECT * FROM payments WHERE user_name = '$admin_username'";
$sql = "SELECT * FROM payments WHERE user_name = '$admin_username' ORDER BY id DESC";
// Query ko execute karen
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>PAYMENT IMAGE</th><th>DATE</th><th>Client Name</th><th>Contact No</th><th>AMOUNT</th><th>PAYMENT CLEAR</th><th>PAYMENT TYPE</th><th>CHEQUE NO</th><th>ADVANCE PAYMENT</th><th>DUE PAYMENT</th><th>NOTE</th><th>AUCTION</th></tr><thead>";

    while ($row = $result->fetch_assoc()) {
        echo "<tbody><tr>";
        echo "<td><img src='Payment/" . $row["paymentimage"] . "' height='100'></td>"; // Assuming the images are stored in the "uploads" directory
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>" . $row["cname"] . "</td>";
        echo "<td>" . $row["cnumber"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["cpayment"] . "</td>";
        echo "<td>" . $row["paymentmethod"] . "</td>";
        echo "<td>" . $row["cnun"] . "</td>";
        echo "<td>" . $row["apayment"] . "</td>";
        echo "<td>" . $row["dpayment"] . "</td>";
        echo "<td>" . $row["note"] . "</td>";
        echo "<td> <a class='btn btn-info text-white' href='paymentupdate.php?id=" . $row["id"] . " ' >Update</a><a class='btn btn-info text-white mt-3' target='_blank' href='payment_invoice.php?billno=" .$row["billno"] . " ' >Print</a><a class='btn btn-danger text-white mt-3' onclick='return confirm(\"Are you sure you want to delete this payment?\")' href='delete_payment.php?id=" . $row["id"] . "'>Delete</a>
     </td>";

        
        echo "</tr></tbody>";
    }

    echo "</table>";
} else {
    echo "No payments found in the database.";
}

// Database connection ko close karen
$conn->close();
?>

	  
   </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
  <script>
       function asp(){
            document.getElementById("test").removeAttribute("open");
            }
        function abc(){
            document.getElementById("test").setAttribute("open","");
        }
  </script>
  
  <script>
    // Get references to the input fields
    const amountInput = document.getElementById('amount');
    const advancePaymentInput = document.getElementById('apayment');
    const paymentDueInput = document.getElementById('dpayment');

    // Add an event listener to the amount and advance payment fields
    amountInput.addEventListener('input', updatePaymentDue);
    advancePaymentInput.addEventListener('input', updatePaymentDue);

    // Function to calculate and update the payment due
    function updatePaymentDue() {
        const amount = parseFloat(amountInput.value) || 0;
        const advancePayment = parseFloat(advancePaymentInput.value) || 0;
        const paymentDue = amount - advancePayment;
        paymentDueInput.value = paymentDue.toFixed(2); // Adjust the precision as needed
    }
</script>


</body>
</html>