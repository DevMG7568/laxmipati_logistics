<?php
// Include your database connection file (e.g., 'config.php')
@include 'config.php';

session_start();

// Check if the user is logged in (i.e., the session variable is set)
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

// Display the username on the dashboard
$username = $_SESSION['admin_username'];

// Initialize variables
$id = 1; // Default ID

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $adminusername = $_POST['adminusername'];
    $usernumber = $_POST['usernumber'];
    $branchname = $_POST['branchname'];
    $userpassword = $_POST['userpassword'];

    // Use prepared statement to update the user's information
    $sql = "UPDATE admin_users SET adminusername = '$adminusername', usernumber = '$usernumber', branchname = '$branchname', userpassword = '$userpassword' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to addbranch.php after successful update
        header("Location: addbranch.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sqla = "SELECT * FROM admin_users WHERE id = $id";
$result = $conn->query($sqla);
$row = $result->fetch_assoc();

$conn->close();
?>

<!doctype html>
<html lang="en">
    
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payments | Laxmipati</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h2><?php echo $username; ?></h2>
        </div>
        <div class="bottom">
            <ul class="a">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="aspform.php">Booking</a></li>
                <li><a href="allorder.php">All Booking</a></li>
                <li><a href="payment.php">Payment</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container mt-5">
  <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="adminusername" value="<?php echo $row['adminusername'] ?>" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Contact No</label>
                    <input type="text" class="form-control" placeholder="Enter Your Contact No" value="<?php echo $row['usernumber'] ?>" name="usernumber">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Branch Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Branch Name" value="<?php echo $row['branchname'] ?>" name="branchname">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Your New Password" value="<?php echo $row['userpassword'] ?>" name="userpassword" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-info">Update User</button>
    </form>

</div>
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