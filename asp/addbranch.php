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

<!-- Rest of your HTML code -->


<!doctype html>
<html lang="en">
    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    .dj .rj .top img{
        width: 200px;
        border-right: 1px solid white;
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
</style>

<body>
    
      <div class="dj">
    <div class="rj">
        <div class="top">
            <img src="logo.png" alt="">
            <h2><?php echo $admin_username; ?></h2>
        </div>
        <div class="bottom">
            <ul class="a">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="aspget_booking.php">Booking</a></li>
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

<dialog id="test">
    <div class="row">
        <div class="col-lg-11">

        </div>
        <div class="col-lg-1">
            <i class="fa-solid fa-xmark" onclick="asp()"></i>
        </div>
    </div>
    <form action="usersubmit.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="adminusername" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Contact No</label>
                    <input type="text" class="form-control" placeholder="Enter Your Contact No" name="usernumber">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Branch Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Branch Name" name="branchname">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Your New Password" name="userpassword" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">Aadhar Card Number</label>
                    <input type="text" class="form-control" placeholder="Aadhar Card Number" name="aadharcardnumber" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">PAN Card Number</label>
                    <input type="text" class="form-control" placeholder="PAN Card Number" name="pancardnumber">
                </div>
            </div>
             <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" placeholder="Profile Picture" name="profilepicture">
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea class="form-control" placeholder="Enter Your Address" style="height: 100px" name="address"></textarea>
        </div>
        <button type="submit" class="btn btn-info">Add User</button>
    </form>
</dialog>
	<div class="container" style="margin-top:50px;">
	<div class="row">
	    <div class="col-lg-2">
	        <button class="btn btn-info" onclick="abc()">Add User</button>
	    </div>
	    <div class="col-lg-2">
	        
	    </div>
	    <div class="col-lg-8">
	        
	    </div>
	</div>
	
	 <?php
// Database connection file ko include karen
include 'config.php';

// Query to fetch data from the "payments" table
$sql = "SELECT * FROM admin_users";

// Query ko execute karen
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>User Name</th><th>Contact No</th><th>Branch Name</th><th>Password</th><th>Address</th><th>Action</th></tr><thead>";

    while ($row = $result->fetch_assoc()) {
        echo "<tbody><tr>";
        echo "<td>" . $row["adminusername"] . "</td>";
        echo "<td>" . $row["usernumber"] . "</td>";
        echo "<td>" . $row["branchname"] . "</td>";
        echo "<td>" . $row["userpassword"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td> 
        <a class='btn btn-info text-white' href='userupdate.php?id=" . $row["id"] . " ' >Update</a>
        <a class='btn btn-danger text-white' href='delete_user.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
        </td>";
        echo "</tr></tbody>";
    }

    echo "</table>";
} else {
    echo "No User found in the database.";
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