<?php

// Include your database connection file (e.g., 'config.php')
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
  $profilepicture = 'Profilepicture/' . $row["profilepicture"];
} else {
  // Handle error if the user is not found
  echo "User not found.";
  exit();
}
// Initialize variables
$id = 1; // Default ID

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the form data
  $cname = $_POST['cname'];
  $cnumber = $_POST['cnumber'];
  $paymentmethod = $_POST['paymentmethod'];
  $gst = $_POST['gst'];
  $amount = $_POST['amount'];
  $cnun = $_POST['cnun'];
  $weight = $_POST['weight'];
  $rate = $_POST['rate'];
  $product = $_POST['product'];
  $extracharge = $_POST['extracharge'];
  $apayment = $_POST['apayment'];
  $dpayment = $_POST['dpayment'];
  $cpayment = $_POST['cpayment'];

  // Use prepared statement to update the payment record
  $sql = "UPDATE payments SET cname = '$cname', cnumber = '$cnumber', paymentmethod = '$paymentmethod', gst = '$gst', amount = '$amount', cnun = '$cnun', weight = '$weight', rate = '$rate', product = '$product', extracharge = '$extracharge', apayment = '$apayment', dpayment = '$dpayment', cpayment = '$cpayment' WHERE id = '$id' ";

  if ($conn->query($sql) === TRUE) {
    // echo "Record updated successfully";
    header("Location: payment.php");
    exit();
  } else {
    echo "Error updating record: " . $conn->error;
  }
}




$sqla = "SELECT * FROM payments WHERE id = $id";
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

  body {
    font-family: 'Poppins', sans-serif;
  }

  a {
    text-decoration: none;
  }

  .dj {
    background-color: #06033D;
    height: 135px;
    width: 100%;
  }

  .dj .rj {
    max-width: 1320px;
    margin: auto;
  }

  .dj .rj .top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
  }

  .dj .rj .top img {
    width: 200px;
    border-right: 1px solid white;
  }

  .dj .rj .top h2 {
    font-size: 24px;
    font-weight: 500;
    color: white;
  }

  .dj .rj .bottom ul.a {
    list-style: none;
    display: block;
    background: transparent;
    box-shadow: none;
    width: auto;
    height: auto;
  }

  .dj .rj .bottom ul.a li {
    display: inline-block;
    margin: auto 10px;
  }

  .dj .rj .bottom ul.a li a {
    font-size: 20px;
    font-weight: 500;
    color: white;
  }

  dialog {
    width: 700px;
    border: none;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);
    margin-top: 5px;
    border-radius: 8px;
    z-index: 99;
  }

  .fa-solid {
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
        <div class="col-lg-6 mb-3">
          <label class="form-label">Payment Type</label>
          <select class="form-select" name="paymentmethod">
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
            <option value="RTGS">RTGS</option>
            <option value="GPay">GPay</option>
            <option value="PayTm">PayTm</option>
          </select>
        </div>
        <div class="col-lg-6 mb-3">
          <label class="form-label">GST</label>
          <select class="form-select" name="gst" id="gst" onchange="calculatePayment()">
            <option value="18" <?php if ($row['gst'] == "18") {
                                echo 'selected';
                              } ?>>Yes</option>
            <option value="0" <?php if ($row['gst'] == "0") {
                                echo 'selected';
                              } ?>>No</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Client Name</label>
            <input type="text" class="form-control" name="cname" value="<?php echo $row['cname']; ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Contact No</label>
            <input type="text" class="form-control" name="cnumber" value="<?php echo $row['cnumber']; ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Select</label>
            <select name="product" class="form-control">
              <option value="option1">option1</option>
              <option value="option2">option2</option>
              <option value="option3">option3</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Total Weight</label>
            <input type="text" class="form-control" name="weight" id="weight" value="<?php echo $row['weight']; ?>" oninput="calculatePayment()">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Rate</label>
            <input type="text" class="form-control" name="rate" oninput="calculatePayment()" value="<?php echo $row['rate']; ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Extra Charge</label>
            <input type="text" class="form-control" name="extracharge" oninput="calculatePayment()" value="<?php echo $row['extracharge']; ?>">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Payment Amount</label>
            <input type="text" class="form-control" name="amount" id="amount" readonly>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Cheque No/UTR No</label>
            <input type="text" class="form-control" name="cnun" value="<?php echo $row['cnun']; ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Payment Image Upload</label>
            <input type="file" class="form-control" name="paymentimage">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Advance Payment</label>
            <input type="text" class="form-control" name="apayment" id="apayment" value="<?php echo $row['apayment']; ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Payment Due</label>
            <input type="text" class="form-control" name="dpayment" id="dpayment" readonly value="<?php echo $row['dpayment']; ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Payment Clear</label>
            <select class="form-select" name="cpayment">
              <option value="Yes" <?php if ($row['cpayment'] == "Yes") {
                                    echo 'selected';
                                  } ?>>Yes</option>
              <option value="No" <?php if ($row['cpayment'] == "No") {
                                    echo 'selected';
                                  } ?>>No</option>
            </select>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-info">Update Payments</button>
    </form>

  </div>
<!-- 
  <!-- <script>
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
  </script> -->
  <script>
    function calculatePayment() {
      // Get the values from weight, rate, and extra charge input fields
      var weight = parseFloat(document.getElementById("weight").value);
      var rate = parseFloat(document.getElementsByName("rate")[0].value);
      var extraCharge = parseFloat(document.getElementsByName("extracharge")[0].value) || 0;
      var gst = document.getElementById("gst").value;

      var amount = Math.round(((weight * rate) + extraCharge) + (gst === "18" ? extraCharge * Number(gst) / 100 : 0))

      // Set the calculated amount to the amount input field      
      document.getElementById("amount").value = amount;
    }

    $(document).ready(function() {
      calculatePayment()
    })
  </script>


</body>

</html>