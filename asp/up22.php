<?php

@include 'config.php';


?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assuming you have a database connection object named $conn
    // Update the product details based on the submitted data

    // Assuming product_id is obtained from the URL as in your code
    $product_id = $_GET['id'];

    // Get the last set of values from the form
    $lastIndex = count($_POST['nondg']) - 1;

    $nondg = $_POST['nondg'][$lastIndex];
    $boxNo = $_POST['box_no'][$lastIndex];
    $productName = $_POST['product_name'][$lastIndex];
    $productQuantity = $_POST['product_quantity'][$lastIndex];
    $price = $_POST['price'][$lastIndex];
    $hsnCode = $_POST['hsn_code'][$lastIndex];
    $totalPrice = $_POST['total_price'][$lastIndex];

    // Update query
    $update_sql = "UPDATE product_details SET
        nondg = '$nondg',
        box_no = '$boxNo',
        product_name = '$productName',
        product_quantity = '$productQuantity',
        price = '$price',
        hsn_code = '$hsnCode',
        total_price = '$totalPrice'
        WHERE product_id = $product_id";

    // Execute the update query
    $update_result = $conn->query($update_sql);

    // Check if the update was successful
    if (!$update_result) {
        echo "Error updating record: " . $conn->error;
    }

    // After updating the record, you can redirect the user or perform other actions
    // For example, redirect to the same page
    header("Location: ".$_SERVER['PHP_SELF']."?id=".$product_id);
    exit();
}
?>







<html lang="en" class=" js no-touch csstransforms3d csstransitions"><head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta charset="utf-8">
<title>Performa Invoice | Laxmipati</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
<link rel="apple-touch-icon" href="https://goexbox.com/assets/agent/pages/ico/60.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://goexbox.com/assets/user//img/master/logo.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://goexbox.com/assets/user//img/master/logo.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://goexbox.com/assets/user//img/master/logo.png">
<link rel="icon" type="image/x-icon" href="favicon.ico">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta content="GoExBox" name="description">
<meta content="Ace" name="author">
<link href="https://goexbox.com/assets/agent/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css">
<link href="https://goexbox.com/assets/agent/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://goexbox.com/assets/agent/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen">
<link href="https://goexbox.com/assets/agent/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="https://goexbox.com/assets/agent/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="https://goexbox.com/assets/agent/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css">
<link href="https://goexbox.com/assets/agent/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css">
<link href="https://goexbox.com/assets/agent/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
<link href="https://goexbox.com/assets/agent/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen">
<link href="https://goexbox.com/assets/agent/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://goexbox.com/assets/agent/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css">
<link href="https://goexbox.com/assets/agent/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen">
<link href="https://goexbox.com/assets/agent/css/dashboard.widgets.css" rel="stylesheet" type="text/css" media="screen">
<link class="main-stylesheet" href="https://goexbox.com/assets/agent/pages/css/pages.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link class="main-stylesheet" href="https://goexbox.com/assets/agent/css/style.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    .modal .modal-body {
        padding: 10px;
        padding-top: 0;
    }
    .card {
        margin-bottom:0;
    }
    .table tbody tr td {
        padding: 10px;
    }
    .page-sidebar .sidebar-menu .menu-items li > a {
        width: 75%;
    }
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>
<script src="https://goexbox.com/assets/agent/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/6/common.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/6/util.js"></script></head>
<body class="fixed-header horizontal-menu horizontal-app-menu dashboard  windows desktop js-focus-visible pace-done">
    
 


<div class="page-container ">
<div class="page-content-wrapper ">
<style>
.autocomplete-suggestions {
    border: 1px solid #999 !important;
    background: #FFF !important;
    overflow: auto !important;
    padding: 0.5rem
}

.row {
    margin-bottom: 0.1rem;
}

.ui-autocomplete {
    position: absolute;
    z-index: 1000;
    cursor: default;
    padding: 0;
    margin-top: 2px;
    list-style: none;
    background-color: #ffffff;
    border: 1px solid #ccc;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.ui-autocomplete>li {
    padding: 3px 20px;
}

.ui-autocomplete>li.ui-state-focus {
    background-color: #DDD;
}

.ui-helper-hidden-accessible {
    display: none;
}

.panel .panel-heading+.panel-body {
    height: auto !important;
}


.form-control:focus {
    border-color: #000 !important;
}

.form-control {
    border-color: #0000005e !important;
    font-weight: 500;
}

label {
    color: #000 !important;
}

.form-group {
    margin-bottom: 0rem;
}

.col-sm-9 {
    padding-right: 0 !important;
}

.card .card-header {
    padding: 0.8rem !important;
}

.col-form-label {
    padding-bottom: calc(0.1rem + 1px) !important;
}
.btn-circle.btn-sm {
    width: 33px;
    height: 33px;
    padding: 4px 0px;
    border-radius: 15px;
    font-size: 8px;
    text-align: center;
}

.card-body {
    padding: 1rem !important;
}

.card {
    margin-bottom: 1rem;
    margin-right: 1rem;
}

.form-control {
    color: #000 !important;
}

.form-control::-webkit-input-placeholder {
    color: #4b4b4b;
}

/* WebKit, Blink, Edge */
.form-control:-moz-placeholder {
    color: #4b4b4b;
}

/* Mozilla Firefox 4 to 18 */
.form-control::-moz-placeholder {
    color: #4b4b4b;
}

/* Mozilla Firefox 19+ */
.form-control:-ms-input-placeholder {
    color: #4b4b4b;
}

/* Internet Explorer 10-11 */
.form-control::-ms-input-placeholder {
    color: #4b4b4b;
}

/* Microsoft Edge */
input:focus:required:invalid {
    border: 1px solid red !important;
}

input:required:invalid {
    border: 1px solid #e1a9a9 !important;
}
input[type="text"] {
    text-transform: uppercase;
}
input[type="email"] {
    text-transform: uppercase;
}
</style>


<form action="#" method="POST">

<div class="container">
<div class="row">
<div class="col-md-12">


<div class="card">
<div class="multi-field-wrapper card-body">
<div class="multi-fields ">
    <?php
// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch all data from the product_details table where product_id is obtained from GET
    $product_sql = "SELECT * FROM product_details WHERE product_id = $product_id";
    $product_result = $conn->query($product_sql);

    // Check if there is a result
    if ($product_result) {
        // Loop through the results and print each record
        while ($product_row = $product_result->fetch_assoc()) {
            $nondg = $product_row['nondg'];
            $box_no = $product_row['box_no'];
            $product_name = $product_row['product_name'];
            $product_quantity = $product_row['product_quantity'];
            $price = $product_row['price'];
            $hsn_code = $product_row['hsn_code'];
            $total_price = $product_row['total_price'];
            // Add other fields as needed

            ?>
<div class="multi-field row form-group">
<div class="col-lg-1">
<select name="nondg[]" class="form-control form-control-sm" value="<?php echo $nondg; ?>" tabindex="-1">
<option value="0">Normal
</option>
<option value="1">NonDG
</option>
</select>
</div>
<div class="col-lg-1">
<input type="number" name="box_no[]" placeholder="Box No" class="form-control form-control-sm" value="<?php echo $box_no; ?>" required="">
</div>
<div class="col-lg-3">
<div class="form-group" id="the-basics">
<input class="typeahead form-control form-control-sm" type="text" name="product_name[]" value="<?php echo $product_name; ?>" placeholder="Product Name" autocomplete="off" required="">
</div>
</div>
<div class="mb-md hidden-lg hidden-xl">
</div>
<div class="col-lg-1">
<input type="number" name="product_quantity[]" placeholder="Quantity" class="form-control form-control-sm" value="<?php echo $product_quantity; ?>" required="">
</div>
<div class="mb-md hidden-lg hidden-xl">
</div>
<div class="col-lg-2">
<input type="text" name="price[]" placeholder="Price" class="form-control form-control-sm" value="<?php echo $price; ?>" required="">
</div>
<div class="col-lg-2">
<input type="number" name="hsn_code[]" placeholder="HSN Code" tabindex="-1" value="<?php echo $hsn_code; ?>" class="form-control form-control-sm">
</div>
<div class="col-lg-1">
    <input type="text" name="total_price[]" placeholder="Total Price" value="<?php echo $total_price; ?>" class="form-control form-control-sm" readonly>
</div>
<!--
<div class="col-lg-1">
<input type="text" name="total_price[]" placeholder="Weight" tabindex="-1" class="form-control form-control-sm" readonly="">
</div>--->
</div>
 <?php
                            }

                            // Free the result set
                            $product_result->free_result();
                        } else {
                            echo "Error fetching product records: " . $conn->error;
                        }
                    } else {
                        echo "No 'id' parameter provided in the URL.";
                    }
                    ?>


<div class="mb-md hidden-lg hidden-xl">
</div>


</div>


<div class="row mt-3">
    <div class="col-lg-4"></div>
    <div class="col-lg-2">
  <input type="text" id="totalPrice" name="totalprice" placeholder="Total Price"  class="form-control form-control-sm" readonly="">
</div>
<div class="col-lg-2">
  <input type="text" id="totalQuantity" name="totalquantity" placeholder="Total Quantity" class="form-control form-control-sm" readonly="">
</div>
    <div class="col-lg-4"></div>
</div>



</div>

</div>
<input type="submit" value="Update data">
</div>
</div>
</div>
</form>

</body>
</html>