<?php
// Include your database connection file (e.g., 'config.php')
@include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Function to retrieve data by ID
    function getRow($conn, $id) {
        $sql = "SELECT * FROM order_details WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false; // No matching record found
        }
    }

    $row = getRow($conn, $id);

    if (!$row) {
        echo "No matching record found for ID $id.";
        exit;
    }
} else {
    echo "ID not provided.";
    exit;
}



// Close the database connection
$conn->close();
?>


<?php
// Assuming you have connected to the database ($conn) as shown before

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sh_full_name = $_POST["sh_full_name"];
    $sh_zip_code = $_POST["sh_zip_code"];
    // Get values for other columns as well

    $update_sql = "UPDATE order_details SET 
                   sh_full_name = '$sh_full_name', 
                   sh_zip_code = '$sh_zip_code'
                   -- Update other columns here
                   WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
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

.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.col,
.col-auto,
.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm,
.col-sm-auto,
.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md,
.col-md-auto,
.col-lg-1,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg,
.col-lg-auto,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl,
.col-xl-auto {
    position: relative;
    width: 100%;
    padding-right: 0.1rem;
    padding-left: 0rem;
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
    color: #ebebeb;
}

/* WebKit, Blink, Edge */
.form-control:-moz-placeholder {
    color: #ebebeb;
}

/* Mozilla Firefox 4 to 18 */
.form-control::-moz-placeholder {
    color: #ebebeb;
}

/* Mozilla Firefox 19+ */
.form-control:-ms-input-placeholder {
    color: #ebebeb;
}

/* Internet Explorer 10-11 */
.form-control::-ms-input-placeholder {
    color: #ebebeb;
}

/* Microsoft Edge */
input:focus:required:invalid {
    border: 1px solid red !important;
}

input:required:invalid {
    border: 1px solid #e1a9a9 !important;
}
</style>

<div class="content ">
<div class=" container p-t-30   container-fixed-lg">

<ol class="breadcrumb">

</ol>
</div>
<div class="container-fluid container-fixed-lg">
<section class="basic-horizontal-layouts">
<form action="#" id="invoice-form" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="row">
<div class="col-md-6">

<div class="card">
<div class="card-header  ">
<div class="card-title">Shipper</div>
<div class="card-controls">
<span class="badge me-1">
AWB No : LP<?php echo $row['id']; ?></span>
</div>
</div>
<div class="card-body">
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">Full Name</label>
<input type="hidden" name="order_id" id="order_id" class="form-control form-control-sm" value="<?php echo $row['id']; ?>">
<input type="hidden" name="sh_id" id="sh_id" value="">
<input type="hidden" name="co_id" id="co_id" value="">
<input type="hidden" id="sh_latitude" name="sh_latitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
<input type="hidden" id="sh_longitude" name="sh_longitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
<div class="col-sm-7">
<input type="text" id="sh_full_name" name="sh_full_name" value="<?php echo $row['sh_full_name']; ?>" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
</div>
<div class="col-sm-2 center">
<a class="btn btn-complete form-control-sm" style="width: 100%;" href="#" onclick="clearShipper()">Clear</a>
</div>
</div>
</div>

<input type="hidden" id="sh_location" name="sh_location" value="">
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">ZipCode</label>
<div class="col-sm-9">
<input type="text" id="sh_zip_code" name="sh_zip_code" value="<?php echo $row['sh_zip_code']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">Address 1</label>
<div class="col-sm-9">
<input type="text" id="sh_add1" name="sh_add1" value="<?php echo $row['sh_add1']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 2</label>
<div class="col-sm-9">
<input type="text" id="sh_add2" name="sh_add2" value="<?php echo $row['sh_add2']; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 3</label>
<div class="col-sm-9">
<input type="text" id="sh_add3" name="sh_add3" value="<?php echo $row['sh_add3']; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">City</label>
<div class="col-sm-9">
<input type="text" id="sh_city" name="sh_city" value="<?php echo $row['sh_city']; ?>" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">State</label>
<div class="col-sm-9">
<input type="text" id="sh_state" name="sh_state" value="<?php echo $row['sh_state']; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Country</label>
<div class="col-sm-9">
<input type="text" id="sh_country" name="sh_country" value="<?php echo $row['sh_country']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" vlaue="<?php echo $row['sh_ph_no']; ?>" id="sh_ph_no"  name="sh_ph_no">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No (Alt)</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="sh_ph_no1" value="<?php echo $row['sh_ph_no1']; ?>" name="sh_ph_no1">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control form-control-sm" minlength="5" id="sh_email" value="<?php echo $row['sh_email']; ?>" name="sh_email">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Attention</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="sh_attention" value="<?php echo $row['sh_attention']; ?>" name="sh_attention">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Reference</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="sh_referance" value="<?php echo $shReference; ?>" name="sh_referance">
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label"><span class="badge badge-light-dark">
Kyc-1 </span></label>
<div class="col-sm-5">
<select name="sh_document_type" id="sh_document_type" class="form-control form-control-sm">
<option value="aadhar no" selected="">
Aadhar Number</option>
<option value="iec code">
IEC CODE</option>
<option value="gst no">
GST Number</option>
<option value="passport no">
Passport Number</option>


</select>
</div>
<div class="col-sm-4">
<input type="text" class="form-control form-control-sm" id="sh_pan_no" value="<?php echo $row['sh_pan_no']; ?>" name="sh_pan_no">
</div>
</div>
</div>
<div class="row">
<label class="col-sm-3 col-form-label"></label>
<div class="col-sm-5">
<div class="form-group">
<label for="documentImage" class="form-label">Document Front</label>
<div class="custom-file">
<input class="form-control" type="file" id="documentImage" name="documentImage" title="">
</div>
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Document Back</label>
<div></div>
<div class="custom-file">
<input class="form-control" type="file" id="documentImage_back" name="documentImage_back" title="">
</div>
</div>
</div>

</div>
<div class="row">
<label class="col-sm-3 col-form-label"></label>
<label class="col-sm-2 col-form-label">Image Front</label>
<div class="col-sm-3">
<div class="form-group">
<div></div>
<div class="custom-file" id="documentLink">
</div>
</div>
</div>
<label class="col-sm-2 col-form-label">Image Back</label>
<div class="col-sm-2">
<div class="form-group">
<div class="custom-file" id="documentLink_back">
</div>
</div>
</div>
</div>


<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label"><span class="badge badge-light-dark">
Kyc-2 </span></label>
<div class="col-sm-5">
<select name="sh_document_type1" id="sh_document_type1" class="form-control form-control-sm">
<option value="pan no">
PAN Number</option>
<option value="gst no">
GST Number</option>


</select>
</div>
<div class="col-sm-4">
<input type="text" class="form-control form-control-sm" id="sh_pan_no1" value="<?php echo $row['sh_pan_no1']; ?>" name="sh_pan_no1">
</div>
</div>
</div>
<div class="row mt-1">
<label class="col-sm-3 col-form-label"></label>
<div class="col-sm-5">
<div class="form-group">

<div class="custom-file">
<input class="form-control" type="file" id="documentImage1" name="documentImage1">
</div>
</div>
</div>
<label class="col-sm-2 col-form-label">Image</label>
<div class="col-sm-2">
<div class="form-group">
<div class="custom-file" id="documentLink1">
</div>
</div>
</div>
</div>

</div>
</div>

</div>
<div class="col-md-6">

<div class="card">
<div class="card-header">
<h5 class="card-title">
Consignee
</h5>
</div>
<div class="card-body">
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">Full Name</label>
<input type="hidden" id="co_latitude" name="co_latitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
<input type="hidden" id="co_longitude" name="co_longitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
<div class="col-sm-7">
<input type="text" id="co_full_name" name="co_full_name" value="<?php echo $row['co_full_name']; ?>" class="autocomplete form-control form-control-sm" autocomplete="off" required="">
</div>
<div class="col-sm-2 center">
<a class="btn btn-complete form-control-sm" style="width: 100%;" href="#" onclick="clearShipper()">Clear</a>
</div>
</div>
</div>

<input type="hidden" id="co_location" name="co_location" value="">
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">ZipCode</label>
<div class="col-sm-9">
<input type="text" id="co_zip_code" name="co_zip_code" value="<?php echo $row['co_zip_code']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">Address 1</label>
<div class="col-sm-9">
<input type="text" id="co_add1" name="co_add1" value="<?php echo $row['co_add1']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 2</label>
<div class="col-sm-9">
<input type="text" id="co_add2" name="co_add2" value="<?php echo $row['co_add2']; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 3</label>
<div class="col-sm-9">
<input type="text" id="co_add3" name="co_add3" value="<?php echo $row['co_add3']; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">City</label>
<div class="col-sm-9">
<input type="text" id="co_city" name="co_city" value="<?php echo $row['co_city']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">State</label>
<div class="col-sm-9">
<input type="text" id="co_state" name="co_state" value="<?php echo $row['co_state']; ?>" class="form-control form-control-sm" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Country</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="co_country" value="<?php echo $country; ?>" name="co_country" readonly="" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="co_ph_no" value="<?php echo $row['co_ph_no']; ?>" name="co_ph_no" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No (Alt)</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="co_ph_no1" value="<?php echo $row['co_ph_no1']; ?>" name="co_ph_no1">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control form-control-sm" minlength="5" id="co_email" value="<?php echo $row['co_email']; ?>" name="co_email">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Attention</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" minlength="5" id="co_attention" value="<?php echo $row['co_attention']; ?>" name="co_attention">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Reference</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="co_referance" value="<?php echo $row['co_referance']; ?>" name="co_referance">
</div>
</div>
</div>
<div class="dropdown-divider b-b b-dashed b-secondary"></div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Note</label>
<div class="col-sm-9">
<input type="text" id="note" name="note" value="<?php echo $note; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
<div class="form-group" id="note_div" style="display: none;">
<div class="row">
<label class="col-sm-3 col-form-label">AWB SHOW</label>
<div class="col-sm-9">
<select name="awb_show" id="awb_show" class="form-control form-control-sm" value="yes">
<option value="yes" selected="selected">yes</option>
<option value="no">no</option>
</select>
</div>
</div>
</div>
<div id="boxgeneral">
<div class="dropdown-divider b-b b-dashed b-secondary"></div>
<div class="card-header">
<h4 class="card-title">Invoice Details</h4>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Invoice Type</label>
<div class="col-sm-9">
<select name="gift_type" id="gift_type" class="form-control form-control-sm" data-placeholder="Select Company" value="">
<option value="0">Courier Free Sample </option>
<option value="1" selected="">Courier Free Gift</option>
<option value="2">Commercial Invoice</option>
<option value="3">Household goods for family use</option>
</select>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Currency</label>
<div class="col-sm-9">
<select name="currency" id="currency" class="form-control form-control-sm" data-placeholder="Select Company" value="" required="">
<option value="">Select Currency</option>
<option value="INR">INR</option>
<option value="USD">USD</option>
<option value="GBP">GBP</option>
<option value="EUR">EUR</option>
</select>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Invoice No &amp; Date</label>
<div class="col-sm-9">
<input type="text" id="invoice_no_date" name="invoice_no_date" value="<?php echo $orderDate; ?>" class="form-control form-control-sm">
</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>

<div class="row" id="boxdescription">
<div class="col-md-12">

<div class="card">
<div class="card-header">
<h5 class="card-title">
Box Description - Shipment Weight : <b><?php echo $weight; ?></b>
</h5>
</div>
<div class="multi-field-wrapper card-body">
<div class="multi-fields ">
<div class="multi-field row form-group">
<div class="col-lg-1">
<select name="nondg[]" class="form-control form-control-sm" value="0" tabindex="-1">
<option value="0">Normal
</option>
<option value="1">NonDG
</option>
</select>
</div>
<div class="col-lg-1">
<input type="number" name="box_no[]" placeholder="Box No" class="form-control form-control-sm" value="1" required="">
</div>
<div class="col-lg-3">
<div class="form-group" id="the-basics">
<input class="typeahead form-control form-control-sm" type="text" name="product_name[]" placeholder="Product Name" autocomplete="off" required="">
</div>
</div>
<div class="mb-md hidden-lg hidden-xl">
</div>
<div class="col-lg-1">
<input type="number" name="product_quantity[]" placeholder="Quantity" class="form-control form-control-sm" required="">
</div>
<div class="mb-md hidden-lg hidden-xl">
</div>
<div class="col-lg-2">
<input type="text" name="price[]" placeholder="Price" class="form-control form-control-sm" required="">
</div>
<div class="col-lg-2">
<input type="number" name="hsn_code[]" placeholder="HSN Code" tabindex="-1" class="form-control form-control-sm">
</div>
<div class="col-lg-1">
<input type="text" name="p_weight[]" placeholder="Weight" tabindex="-1" class="form-control form-control-sm" readonly="">
</div>
<div class="mb-md hidden-lg hidden-xl">
</div>
<div class="col-lg-1" style="text-align: center;">
<button class="remove-field btn btn-outline-danger btn-circle btn-sm" type="button" data-toggle="tooltip" data-placement="right" title="" data-original-title="Remove">
<i class="pg-icon">minus</i>
</button>
</div>
</div>
</div>
<br>
<button type="button" class="add-field btn btn-success"><i class="pg-icon">plus</i> Add
More</button>

</div>
</div>

</div>
</div>
<div class="row" id="totalrow">
<div class="col-md-12">
<table class="table mb-none">
<tbody><tr>
<td class="success" id="grandtotal" style="text-align:center">Total Price: <b>0</b> Total Qty: <b>0</b> WEIGHT PER QTY :<b>Infinity</b> WEIGHT TOTAL :<b>0.000</b></td>
</tr>
</tbody></table>
</div>
</div>
<br>
<div class="row">
<div class="col-md-6 text-right">
    <input type="submit" name="submit" value="Submit">

</div>






<br>



</div>
</div>
</div>
</div></form></section>
</div>
</div>
<script src="https://goexbox.com/assets/agent/js/jquery.autocomplete.js"></script>
<script type="text/javascript">
$("#note_div").hide();
$("#dummy_div").hide();
$("#manifest_div").hide();

function deleteDocumentImage1(id) {
    swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            type: "question",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            buttons: true,
            dangerMode: true,
        })
        .then(function(result) {
            if (result.value) {

                $.ajax({
                    url: "https://goexbox.com/agent/invoice/deleteDocumentImage1",
                    type: "POST",
                    dataType: "JSON",
                    data: "id=" + id,
                    success: function(data) {
                        $("#documentLink1").html("");
                        noticustom('KYC-2 Image Deleted', 'success');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });
}

function deleteFront(id) {

    swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            type: "question",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            buttons: true,
            dangerMode: true,
        })
        .then(function(result) {
            if (result.value) {


                $.ajax({
                    url: "https://goexbox.com/agent/invoice/deleteFront",
                    type: "POST",
                    dataType: "JSON",
                    data: "id=" + id,
                    success: function(data) {
                        $("#documentLink").html("");
                        noticustom('Image Front Deleted', 'success');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });
}

function deleteBack(id) {
    swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            type: "question",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            buttons: true,
            dangerMode: true,
        })
        .then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "https://goexbox.com/agent/invoice/deleteBack",
                    type: "POST",
                    dataType: "JSON",
                    data: "id=" + id,
                    success: function(data) {
                        // $("#deleteImageBack").prop("onclick", null).off("click");
                        $("#documentLink_back").html("");
                        noticustom('Image Back Deleted', 'success');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });
}

function removecommreq() {
    $("#invoice_no_date").prop('required', false);
    $("#buyers_order_no_date").prop('required', false);
    $("#pre_carriage_by").prop('required', false);
    $("#place_of_recipt_by_pre_carrier").prop('required', false);
    $("#final_destination").prop('required', false);
    $("#vessel_flight_no").prop('required', false);
    $("#container_no").prop('required', false);
    $("#port_of_loading").prop('required', false);
    $("#port_of_discharge").prop('required', false);
}

function addcommreq() {
    $("#invoice_no_date").prop('required', true);
    $("#buyers_order_no_date").prop('required', true);
    $("#pre_carriage_by").prop('required', true);
    $("#place_of_recipt_by_pre_carrier").prop('required', true);
    $("#final_destination").prop('required', true);
    $("#vessel_flight_no").prop('required', true);
    $("#container_no").prop('required', true);
    $("#port_of_loading").prop('required', true);
    $("#port_of_discharge").prop('required', true);
}
$("#gift_type").change(function() {
    if ($("#gift_type").val() == 2) {
        $("#comm").show();
        addcommreq();
    } else {
        $("#comm").hide();
        removecommreq();
    }
});
$(document).ready(function() {
    $(function() {
        $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
            $("#awb_show").val('yes').change();
            $("#gift_type").val(1).change();

    $("#comm").hide();
    removecommreq();
            $("#comm").hide();
    removecommreq();
                grandTotal();
    $('input[name="price[]"]').keyup(function() {
        grandTotal();
    });
    $('input[name="product_quantity[]"]').keyup(function() {
        grandTotal();
    });
    $('input[name="p_weight[]"]').keyup(function() {
        grandTotal();
    });

    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            var newElement = $('.multi-field:last-child', $wrapper).clone(true)
                .appendTo(
                    $wrapper);
            newElement.find('input[name="product_name[]"]').val('');
            newElement.find('input[name="product_quantity[]"]').val('');
            newElement.find('input[name="price[]"]').val('');
            newElement.find('input[name="hsn_code[]"]').val('');
            newElement.find('input[name="p_weight[]"]').val('');
            newElement.find('input[name="product_name[]"]').focus();
            $('input[name="price[]"]').keyup(function() {
                grandTotal();
            });
            $('input[name="product_quantity[]"]').keyup(function() {
                grandTotal();
            });
            $('input[name="p_weight[]"]').keyup(function() {
                grandTotal();
            });
            // newElement1 = newElement.find('input[name="product_name[]"]');
            newElement.find('input[name="product_name[]"]').autocomplete({
                paramName: 'term',
                minChars: 3,
                maxHeight: 200,
                serviceUrl: 'https://goexbox.com/agent/invoice/getCustom_items',
                dataType: 'json',
                onSelect: function(ui) {
                    $(this).val(ui.data);
                    newElement.find('input[name="hsn_code[]"]').val(ui
                        .hsn_code);
                }
            });
            // typeHEadInvoiceIteam();
        });
        $('.multi-field .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1) $(this).parent().parent(
                '.multi-field').remove();
        });
    });
    $('.multi-field-wrapper').on('focus', '.autoc', function() {
        // alert("hiiiiii");
        if ($(this).autocomplete() === undefined) {
            $(this).autocomplete({
                minChars: 3,
                maxHeight: 300,
                // width:'auto',
                paramName: 'term',
                serviceUrl: 'https://goexbox.com/agent/invoice/getCustom_items',
                dataType: 'json',
                onSelect: function(ui) {
                    $(this).val(ui.data);
                    $(this).parent().parent().parent().find(
                            'input[name="hsn_code[]"]')
                        .val(ui.hsn_code);
                    // $('input[name="hsn_code[]"]').first().val( ui.hsn_code );
                }
            });
        }
    });
});

function grandTotal() {
    total = 0;
    qty = 0;
    pw_total = 0;
    var quantity = document.getElementsByName('product_quantity[]');
    var price = document.getElementsByName('price[]');
    var p_weight = document.getElementsByName('p_weight[]');
    for (var i = 0; i < quantity.length; i++) {
        var q = quantity[i].value;
        var p = price[i].value;
        var pw = p_weight[i].value;
        total += q * p;
        qty += q * 1;

    }
    wq = <?php echo $weight; ?> / qty;
    wq_final = wq.toFixed(3);
    for (var i = 0; i < p_weight.length; i++) {
        var q = quantity[i].value;
        var w = p_weight[i].value;
        weight_per_product = q * wq_final;
        pw_total += w * q;
    }
    pw_total = pw_total.toFixed(3)
    $("#grandtotal").html("Total Price: <b>" + total + "</b> Total Qty: <b>" + qty +
        "</b> WEIGHT PER QTY :<b>" +
        wq_final + "</b>" + "</b> WEIGHT TOTAL :<b>" + pw_total + "</b>");
}

function clearShipper() {
    $("#sh_id").val("");
    $("#sh_full_name").val("").prop('disabled', false);
    $("#sh_zip_code").val("").attr('readonly', false);
    $("#sh_add1").val("").attr('readonly', false);
    $("#sh_add2").val("").attr('readonly', false);
    $("#sh_add3").val("").attr('readonly', false);
    $("#sh_city").val("").attr('readonly', false);
    $("#sh_state").val("").attr('readonly', false);
    $("#sh_country").val("").attr('readonly', false);
    $("#sh_ph_no").val("").attr('readonly', false);
    $("#sh_ph_no1").val("").attr('readonly', false);
    $("#sh_attention").val("").attr('readonly', false);
    $("#sh_pan_no").val("").attr('readonly', false);
    $("#sh_pan_no1").val("").attr('readonly', false);
    $("#sh_email").val("").attr('readonly', false);
    $("#sh_document_type").val("").change().prop('disabled', false);
    $("#sh_document_type1").val("").change().prop('disabled', false);
    $("#documentLink").html("");
    $("#documentLink_back").html("");
    $("#documentLink1").html("");
}
$(function() {
    $("#sh_full_name").autocomplete({
        minChars: 3,
        maxHeight: 300,
        // width:'auto',
        paramName: 'term',
        serviceUrl: 'https://goexbox.com/agent/invoice/getShiiper',
        dataType: 'json',
        onSelect: function(ui) {
            $(this).val(ui.data);

            $("#sh_id").val(ui.sh_id);
            $("#sh_full_name").val(ui.label).prop('disabled', true);
            $("#sh_zip_code").val(ui.sh_zip_code).attr('readonly', true);
            $("#sh_add1").val(ui.sh_add1).attr('readonly', true);
            $("#sh_add2").val(ui.sh_add2).attr('readonly', true);
            $("#sh_add3").val(ui.sh_add3).attr('readonly', true);
            $("#sh_city").val(ui.sh_city).attr('readonly', true);
            $("#sh_state").val(ui.sh_state).attr('readonly', true);
            $("#sh_country").val(ui.sh_country).attr('readonly', true);
            $("#sh_ph_no").val(ui.sh_ph_no).attr('readonly', true);
            $("#sh_ph_no1").val(ui.sh_ph_no1).attr('readonly', true);
            $("#sh_attention").val(ui.sh_attention).attr('readonly', true);
            $("#sh_pan_no").val(ui.sh_pan_no).attr('readonly', true);
            $("#sh_pan_no1").val(ui.sh_pan_no1).attr('readonly', true);
            $("#sh_email").val(ui.sh_email).attr('readonly', false);
            $("#sh_document_type").val(ui.sh_document_type).change().prop('disabled', true);
            $("#sh_document_type1").val(ui.sh_document_type1).change().prop('disabled',
                true);

            if (ui.sh_document != "") {
                $("#documentLink").html("<a href=https://goexbox.com/uploads/documents/" + ui
                    .sh_document +
                    " class='btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light' target='_blank'><i class='pg-icon>image</i></a><a class='btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light' href='javascript:deleteFront(" +
                    ui.sh_id + ")'><i class='pg-icon>trash</i></a>");
                feather.replace();
            } else {
                $("#documentLink").html("");
            }

            if (ui.sh_document_back != "") {
                $("#documentLink_back").html("<a href=https://goexbox.com/uploads/documents/" + ui
                    .sh_document_back +
                    " class='btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light' target='_blank'><i class='pg-icon>image</i></a><a class='btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light' href='javascript:deleteBack(" +
                    ui.sh_id + ")' ><i class='pg-icon>trash</i></a>");
                feather.replace();
            } else {
                $("#documentLink_back").html("");
            }

            if (ui.sh_document1 != "") {
                $("#documentLink1").html("<a href=https://goexbox.com/uploads/documents/" + ui
                    .sh_document1 +
                    " class='btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light' target='_blank'><i class='pg-icon>image</i></a><a class='btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light' href='javascript:deleteDocumentImage1(" +
                    ui.sh_id + ")' ><i class='pg-icon>trash</i></a>");
                feather.replace();
            } else {
                $("#documentLink1").html("");
            }


            return false;
        }
    });

});

$(function() {
    $("#sh_city").autocomplete({
        minChars: 3,
        maxHeight: 300,
        // width:'auto',
        paramName: 'term',
        serviceUrl: 'https://goexbox.com/agent/invoice/getStateCountry',
        dataType: 'json',
        onSelect: function(ui) {
            $(this).val(ui.data);
            $("#sh_city").val(ui.label).attr('readonly', true);
            $("#sh_state").val(ui.state_name).attr('readonly', true);
            $("#sh_country").val(ui.country_name).attr('readonly', true);

            return false;
        }
    });

});


function clearConsignee() {
    $("#co_id").val("");
    $("#co_full_name").val("").prop('disabled', false);
    $("#co_zip_code").val("").attr('readonly', false);
    $("#co_add1").val("").attr('readonly', false);
    $("#co_add2").val("").attr('readonly', false);
    $("#co_add3").val("").attr('readonly', false);
    $("#co_city").val("").attr('readonly', false);
    $("#co_state").val("").attr('readonly', false);
    $("#co_ph_no").val("").attr('readonly', false);
    $("#co_ph_no1").val("").attr('readonly', false);
    $("#co_attention").val("").attr('readonly', false);
    $("#co_email").val("").attr('readonly', false);
}
$(function() {

    $("#co_full_name").autocomplete({
        minChars: 3,
        maxHeight: 300,
        // width:'auto',
        paramName: 'term',
        serviceUrl: 'https://goexbox.com/agent/invoice/getConsignee',
        dataType: 'json',
        onSelect: function(ui) {
            $(this).val(ui.data);
            // $('input[name="hsn_code[]"]').first().val( ui.hsn_code );
            $("#co_id").val(ui.co_id).attr('readonly', true);
            $("#co_full_name").val(ui.label).prop('disabled', true);
            $("#co_zip_code").val(ui.co_zip_code).attr('readonly', true);
            $("#co_add1").val(ui.co_add1).attr('readonly', true);
            $("#co_add2").val(ui.co_add2).attr('readonly', true);
            $("#co_add3").val(ui.co_add3).attr('readonly', true);
            $("#co_city").val(ui.co_city).attr('readonly', true);
            $("#co_state").val(ui.co_state).attr('readonly', true);
            $("#co_email").val(ui.co_email).attr('readonly', true);
            // $("#co_country").val(ui.co_country);
            $("#co_ph_no").val(ui.co_ph_no).attr('readonly', true);
            $("#co_ph_no1").val(ui.co_ph_no1).attr('readonly', true);
            $("#co_attention").val(ui.co_attention).attr('readonly', true);
            return false;
        }
    });

});
</script> 
<div class=" container   container-fixed-lg footer">
<div class="copyright sm-text-center">
<p class="small-text no-margin pull-left sm-pull-reset">
© 2022 All Rights Reserved. <a class="ml-25" href="https://laxmipatiinternational.com/" target="_blank">laxmipatiinternational</a>
<span class="hint-text m-l-15">GoExBox</span>
</p>
<p class="small no-margin pull-right sm-pull-reset">
Hand-crafted <span class="hint-text">&amp; made with Love</span>
</p>
<div class="clearfix"></div>
</div>
</div>

</div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>




<script src="https://goexbox.com/assets/agent/js/custom/crud.js" type="text/javascript"></script>



<div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999; top: 330.6px; left: 218.65px; width: 402.85px;"></div><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div><div id="pip-toast"></div></body></html>
