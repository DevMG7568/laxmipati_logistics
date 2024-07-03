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
  $profilepicture = 'Profilepicture/' . $row["profilepicture"];
} else {
  // Handle error if the user is not found
  echo "User not found.";
  exit();
}

// Check if the user is logged in (i.e., the session variable is set)
/*if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

// Display the username on the dashboard
$username = $_SESSION['admin_username']; */

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch data from the "get_start" table using the provided ID
  $sql1 = "SELECT id, weight FROM get_start WHERE id = ?";
  $stmt1 = $conn->prepare($sql1);
  $stmt1->bind_param("i", $id);
  $stmt1->execute();
  $result1 = $stmt1->get_result();

  // Fetch data from the "order_details" table using the provided ID
  $sql2 = "SELECT sh_full_name, sh_ph_no FROM order_details WHERE id = ?";
  $stmt2 = $conn->prepare($sql2);
  $stmt2->bind_param("i", $id);
  $stmt2->execute();
  $result2 = $stmt2->get_result();

  if ($row1 = $result1->fetch_assoc()) {
    $weight = $row1['weight'];
    $id = $row1['id'];
  } else {
    echo "Data not found for the provided ID in the 'get_start' table.";
  }

  if ($row2 = $result2->fetch_assoc()) {
    $sh_full_name = $row2['sh_full_name'];
    $sh_ph_no = $row2['sh_ph_no'];
  } else {
    echo "Data not found for the provided ID in the 'order_details' table.";
  }
} else {
  echo "ID not provided in the URL.";
}



$conn->close();

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
        <h2><?php echo $username; ?></h2>
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

  <div class="container mt-3">

    <form action="payment_submit.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="user_name" value="<?php echo $admin_username ?>">
      <input type="hidden" name="billno" value="<?php echo $id ?>">
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
          <select class="form-select" name="gst" id="gst">
            <option value="18" selected>18%</option>
          </select>
        </div>
      </div>

      <div class="row">

        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Client Name</label>
            <input type="text" class="form-control" name="cname" value="<?php echo $sh_full_name ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Contact No</label>
            <input type="text" class="form-control" name="cnumber" value="<?php echo $sh_ph_no ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Select Extra Charge Product </label>
            <input type="text" name="product" class="form-control" id="gst"></input>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Total Weight</label>
            <input type="text" class="form-control" name="weight" id="weight" value="<?php echo ceil($weight) ?>" oninput="calculatePayment()">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Gross Amount</label>
            <input type="text" class="form-control" name="rate" oninput="calculatePayment()">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Extra Charge</label>
            <input type="text" class="form-control" name="extracharge" oninput="calculatePayment()" value="0">
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
            <input type="text" class="form-control" name="cnun">
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
            <input type="text" class="form-control" name="apayment" id="apayment">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Payment Due</label>
            <input type="text" class="form-control" name="dpayment" id="dpayment" readonly>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Payment Clear</label>
            <select class="form-select" name="cpayment">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Note</label>
        <textarea class="form-control" placeholder="Leave a comment here" style="height: 100px" name="note"></textarea>
      </div>
      <button type="submit" class="btn btn-info">Save Payments</button>
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
  <script>
    function calculatePayment() {
      // Get the values from weight, rate, and extra charge input fields
      var weight = parseFloat(document.getElementById("weight").value);
      var rate = parseFloat(document.getElementsByName("rate")[0].value);
      var extraCharge = parseFloat(document.getElementsByName("extracharge")[0].value);

      // Calculate the payment amount including the extra charge
      var amount = (rate + extraCharge) + ((rate + extraCharge) * 18 / 100)


      // Set the calculated amount to the amount input field
      document.getElementById("amount").value = amount;

    }
  </script>


</body>

</html>