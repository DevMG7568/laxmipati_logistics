<?php
// Database connection parameters
$db_host = "localhost"; // Change this if your database host is different
$db_user = "u395256775_laxmipatibacke"; // Change this to your database username
$db_pass = "Laxmipati@123"; // Change this to your database password
$db_name = "u395256775_laxmipatibacke"; // Change this to your database name

// Initialize variables
$id = 1; // Default ID

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

// Connect to your database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Prepare a SQL query to retrieve data from the product_details table
$sql = "SELECT * FROM product_details WHERE product_id = $id";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

// // Check if any rows were returned
// if (mysqli_num_rows($result) > 0) {
//     // Output data of each row
//     while ($row = mysqli_fetch_assoc($result)) {
//         // Display the fetched data
//         echo "Product ID: " . $row["product_id"] . "<br>";
//         echo "Product Name: " . $row["product_name"] . "<br>";
//         echo "Product Description: " . $row["product_description"] . "<br>";
//         // You can add more fields as per your table structure
//     }
// } else {
//     echo "No results found";
// }

// Close the database connection


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data
//     $box_no = $_POST['box_no'];
//     $product_name = $_POST['product_name'];
//     $product_quantity = $_POST['product_quantity'];
//     $price = $_POST['price'];
//     $total_price = $product_quantity * $price; // Calculate total price

//     // Prepare SQL statement to update data in the product_details table
//     $sql = "UPDATE product_details SET box_no='$box_no', product_name='$product_name', product_quantity=$product_quantity, price=$price, total_price=$total_price WHERE product_id = $_GET[id]";

//     // Execute the SQL statement
//     if (mysqli_query($conn, $sql)) {
//         echo "Record updated successfully";
//     } else {
//         echo "Error updating record: " . mysqli_error($conn);
//     }
// }


mysqli_close($conn);
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product | Laxmipati</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

  table tr td img {
    width: 100px;
    height: 80px;
  }
</style>

<body>

  <div class="dj">
    <div class="rj">
      <div class="top">
        <img src="logo.png" alt="" class="logo">
      </div>
      <div class="bottom">
        <ul class="a">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="aspform.php">Booking</a></li>
          <li><a href="allorder.php">All Booking</a></li>
          <li><a href="calculator.php">Rate Calculator</a></li>
          <li><a href="payment.php">Payment</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container my-5">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Product Id</th>
              <th>Box No</th>
              <th>Product Name</th>
              <th>Product Quantity</th>
              <th>Price</th>
              <th>Total Price</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {

                $id = $row["id"];
                $product_id = $row["product_id"];
                $box_no = $row["box_no"];
                $product_name = $row["product_name"];
                $product_quantity = $row["product_quantity"];
                $price = $row["price"];
                $total_price = $row["total_price"];
            ?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $product_id; ?></td>
                  <td><?php echo $box_no; ?></td>
                  <td><?php echo $product_name; ?></td>
                  <td><?php echo $product_quantity; ?></td>
                  <td><?php echo $price; ?></td>
                  <td><?php echo $total_price; ?></td>
                  <td>
                    <a href="subproductupdate.php?id=<?php echo $row['id']; ?>">Update</a>
                  </td>
                </tr>
            <?php
              }
            } else {
              echo "No results found";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>