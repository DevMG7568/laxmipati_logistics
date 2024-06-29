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

// Fetch the maximum ID from the order_details table
$sql = "SELECT MAX(id) AS max_id FROM order_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $latestId = $row['max_id'] + 1;
} else {
  // If no records exist, start from 1 or any other desired initial value
  $latestId = 1;
}



?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Details | Laxmipati</title>
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

  .dj .rj .top img.logo {
    width: 200px;
    border-right: 1px solid white;
  }

  .dj .rj .top img.profile {
    width: 80px;
    height: 80px;
    border-radius: 50%;
  }

  .dj .rj .top h2 {
    font-size: 24px;
    font-weight: 500;
    color: white;
  }

  .dj .rj .bottom {}

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


  .container {
    position: relative;
  }

  ul {
    display: none;
    list-style: none;
    background: white;
    box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
    width: 250px;
    height: auto;
    right: 0px;
  }

  ul li {
    margin: 5px auto;
  }

  ul li a {
    text-decoration: none;
    color: black;
    font-size: 16px;
    margin-left: 10px;
  }

  .active {
    display: block;
    position: absolute;
  }

  .fa-solid {
    font-size: 20px;
    color: black;
  }

  .rtrtrt {
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: red;
  }

  .rtrtrt .booking {
    width: 100px;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: aliceblue;
    color: red;
    cursor: pointer;
    border-radius: 5px;
  }

  .rtrtrt span {
    color: white;
    display: block;
    font-weight: 500;
    font-size: 18px;
    margin: auto 10px;
  }

  .trtrtr {
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: green;
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


  <?php
  // Check if the latestId exists in the get_start table
  $sql = "SELECT * FROM get_start WHERE id = $latestId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // If the latestId exists in get_start, fetch and display the corresponding row
    $row = $result->fetch_assoc();
  ?>
    <div class="rtrtrt">
      <span><?php echo $row['id']; ?></span>
      <span><?php echo $row['country']; ?></span>
      <span><?php echo $row['weight']; ?></span>
      <a href="aspformbooking.php?id=<?php echo $row['id']; ?>" target="_blank" class="booking">Booking</a>
    </div>
  <?php
  } else {
    echo " ";
  }

  ?>


  <div class="container" style="margin-top:50px;">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>DATE</th>
          <th>AWB NO</th>
          <th>CONSIGNEE/SHIPPER</th>
          <th>COUNTRY</th>
          <th>NOB</th>
          <th>Status</th>
          <th>ACTION</th>
          <th>PRINT</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // $sql = "SELECT order_details.*, get_start.nob, get_start.weight
        //         FROM order_details
        //         LEFT JOIN get_start ON order_details.id = get_start.id
        //         WHERE get_start.user_name = '$admin_username'
        //         ORDER BY order_details.invoice_no_date DESC";
        $sql = "SELECT order_details.*, get_start.nob, get_start.weight
        FROM order_details
        LEFT JOIN get_start ON order_details.id = get_start.id
        WHERE get_start.user_name = '$admin_username'
        ORDER BY order_details.id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Access the data from each row
            $id = $row['id'];
            $invoice_no_date = $row['invoice_no_date'];
            $sh_full_name = $row['sh_full_name'];
            $co_country = $row['co_country'];
            $weight = $row['weight'];
            $nob = $row['nob'];
            $totalprice = $row['totalprice'];
        ?>
            <tr>
              <td><?php echo date('d/m/Y', strtotime($row['invoice_no_date'])); ?></td>
              <td>LPIC<?php echo $row['order_id']; ?></td>
              <td><?php echo $row['sh_full_name']; ?><br><?php echo $row['co_full_name']; ?></td>
              <td><?php echo $row['co_country']; ?></td>
              <td><?php echo $row['nob']; ?></td>
              <td><?php echo $row['status']; ?></td>
              <td>
                <a href="up.php?id=<?php echo $row['id']; ?>" target="_blank"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="productupdate.php?id=<?php echo $row['id']; ?>" target="_blank">Product</a>
                <a href="addpayment.php?id=<?php echo $row['id']; ?>" target="_blank"><i class="fa-solid fa-cart-shopping" style="margin-left:10px;"></i></a>
                <a href="track.php?id=5000<?php echo $row['id']; ?>" target="_blank"><i class="fa-solid fa-location-dot" style="margin-left:10px;"></i></a>
                <a class='btn btn-danger text-white mt-3' onclick='return confirmDelete()' href='delete.php?id=<?php echo $row["id"]; ?>'>Delete</a>
              </td>
              <td>
                <i class="fa-solid fa-print toggle-list"></i>
                <ul class="toggle-list">
                  <li><i class="fa-regular fa-file-image" style="font-size:18px;"></i><a href="kycpdf.php?id=<?php echo $row['id']; ?>" target="_blank">KYC PDF</a></li>
                  <li><i class="fa-regular fa-file-excel" style="font-size:18px;"></i><a href="box_label.php?id=<?php echo $row['id']; ?>" target="_blank">BOX LABEL</a></li>
                  <li><i class="fa-regular fa-file-image" style="font-size:18px;"></i><a href="performa_invoice.php?id=<?php echo $row['id']; ?>" target="_blank">Performa Invoice</a></li>
                  <li><i class="fa-solid fa-house" style="font-size:18px;"></i><a href="awb.php?id=<?php echo $row['id']; ?>" target="_blank">AWB</a></li>
                  <li><i class="fa-regular fa-file" style="font-size:18px;"></i><a href="non_dg.php?id=<?php echo $row['id']; ?>" target="_blank">NON DG</a></li>
                  <li><i class="fa-regular fa-file" style="font-size:18px;"></i><a href="authorization_latter.php?id=<?php echo $row['id']; ?>" target="_blank"> AUTHORIZATION LATTER</a></li>
                  <!--<li><i class="fa-solid fa-barcode" style="font-size:18px;"></i><a href="Barcode/index.php?id=<?php echo $row['id']; ?>" target="_blank">Barcode</a></li>-->
                </ul>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "No records found";
        }
        ?>


      </tbody>
    </table>
  </div>

  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this payment?");
    }
  </script>

  <script>
    // Get all elements with the class "toggle-list"
    var toggleIcons = document.querySelectorAll(".toggle-list");

    // Add a click event listener to each <i> element with class "toggle-list"
    toggleIcons.forEach(function(icon) {
      icon.addEventListener('click', function() {
        var list = icon.nextElementSibling; // Find the <ul> next to the clicked <i> icon
        list.classList.toggle("active");
      });
    });
  </script>
</body>

</html>
<?php
// Close the database connection
$conn->close();
?>