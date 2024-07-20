<?php
include("config.php");

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



// Fetch the latest ID from the order_details table and increment it by 1
$sql = "SELECT MAX(id) AS max_id FROM order_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latestId = $row['max_id'] + 1;
} else {
    // If no records exist, start from 1 or any other desired initial value
    $latestId = 1;
}


// Fetch data from get_start table based on the latestId
$sql_get_start = "SELECT * FROM get_start WHERE id = $latestId";
$result_get_start = $conn->query($sql_get_start);

if ($result_get_start->num_rows > 0) {
    $row_get_start = $result_get_start->fetch_assoc();
    echo "ID: " . $row_get_start['id'];
} else {
    // Handle case where no corresponding record is found in get_start table for the latestId
    echo "No corresponding record found in get_start table for ID: $latestId";
}


$conn->close();
?>






<!-- Rest of your HTML form -->


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

<div class="content ">
<div class=" container p-t-30   container-fixed-lg">

<ol class="breadcrumb">

</ol>
</div>
<div class="container-fluid container-fixed-lg">
<section class="basic-horizontal-layouts">
<form action="aspsubmit.php" id="invoice-form" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="row">
<div class="col-md-6">

<div class="card">
<div class="card-header  ">
<div class="card-title">Shipper</div>
<div class="card-controls">
    
<span class="badge me-1">
AWB No : LPIC5000<?php echo $latestId; ?></span>
</div>
</div>
<div class="card-body">
<div class="form-group  required ">
<div class="row">
<input type="hidden" name="user_name" value="<?php echo $admin_username ; ?>">
<input type="hidden" name="order_id" value="5000<?php echo $latestId; ?>">
<label class="col-sm-3 col-form-label">Full Name</label>
<div class="col-sm-7">
<input type="text" id="sh_full_name" name="sh_full_name" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required>
</div>
<div class="col-sm-2 center">
<a class="btn btn-complete form-control-sm" style="width: 100%;" href="#" onclick="clearShipper()">Clear</a>
</div>
</div>
</div>    
     
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">ZipCode</label>
<div class="col-sm-9">
<input type="text" id="sh_zip_code" name="sh_zip_code" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>     
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">Address 1</label>
<div class="col-sm-9">
<input type="text" id="sh_add1" name="sh_add1" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 2</label>
<div class="col-sm-9">
<input type="text" id="sh_add2" name="sh_add2" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 3</label>
<div class="col-sm-9">
<input type="text" id="sh_add3" name="sh_add3" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">City</label>
<div class="col-sm-9">
<input type="text" id="sh_city" name="sh_city" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">State</label>
<div class="col-sm-9">
<input type="text" id="sh_state" name="sh_state" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Country</label>
<div class="col-sm-9">
<input type="text" id="sh_country" name="sh_country" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="sh_ph_no"  name="sh_ph_no" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No (Alt)</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="sh_ph_no1" value="" name="sh_ph_no1">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control form-control-sm" minlength="5" id="sh_email" value="" name="sh_email" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Attention</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="sh_attention" value="" name="sh_attention">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Reference</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="sh_referance" value="<?php echo isset($row_get_start['sh_referance']) ? $row_get_start['sh_referance'] : ''; ?>" name="sh_referance">
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label"><span class="badge badge-light-dark">
Kyc-1 </span></label>
<div class="col-sm-5">
<select name="sh_document_type" id="sh_document_type" class="form-control form-control-sm" required>
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
<input type="text" class="form-control form-control-sm" id="sh_pan_no" value="" name="sh_pan_no" required>
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
<input type="text" class="form-control form-control-sm" id="sh_pan_no1" value="" name="sh_pan_no1">
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
<div class="col-sm-7">
<input type="text" id="co_full_name" name="co_full_name" value="" class="autocomplete form-control form-control-sm" autocomplete="off" required>
</div>
<div class="col-sm-2 center">
<a class="btn btn-complete form-control-sm" style="width: 100%;" href="#" onclick="clearShipper()">Clear</a>
</div>
</div>
</div>

<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">ZipCode</label>
<div class="col-sm-9">
<input type="text" id="co_zip_code" name="co_zip_code" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group  required ">
<div class="row">
<label class="col-sm-3 col-form-label">Address 1</label>
<div class="col-sm-9">
<input type="text" id="co_add1" name="co_add1" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 2</label>
<div class="col-sm-9">
<input type="text" id="co_add2" name="co_add2" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Address 3</label>
<div class="col-sm-9">
<input type="text" id="co_add3" name="co_add3" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">City</label>
<div class="col-sm-9">
<input type="text" id="co_city" name="co_city" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">State</label>
<div class="col-sm-9">
<input type="text" id="co_state" name="co_state" value="" class="form-control form-control-sm" required>
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Country</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="co_country" value="<?php echo isset($row_get_start['country']) ? $row_get_start['country'] : ''; ?>" name="co_country" readonly="" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="co_ph_no" value="" name="co_ph_no" required="">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Phone No (Alt)</label>
<div class="col-sm-9">
<input type="number" class="form-control form-control-sm" minlength="5" id="co_ph_no1" value="" name="co_ph_no1">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control form-control-sm" minlength="5" id="co_email" value="" name="co_email" required>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Attention</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" minlength="5" id="co_attention" value="" name="co_attention">
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Reference</label>
<div class="col-sm-9">
<input type="text" class="form-control form-control-sm" id="co_referance" value="" name="co_referance">
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
<div class="form-group" id="note_div" style="display: none;">
<div class="row">
<label class="col-sm-3 col-form-label">AWB SHOW</label>
<div class="col-sm-9">
<select name="awb_show" id="awb_show" class="form-control form-control-sm" value="yes" required>
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
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Status</label>
</div>
<div class="col-sm-9">
<select name="status" id="status" class="form-control form-control-sm" value="" required="">
<option value="">Select Status</option>
<option value="BOOKED">BOOKED</option>
<option value="IN TRANSIT">IN TRANSIT</option>
<option value="ON HOLD">ON HOLD</option>
<option value="OUT FOR DELIVERY">OUT FOR DELIVERY</option>
<option value="DELIVERED">DELIVERED</option>
</select>
</div>
</div>
<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Invoice No &amp; Date</label>
<div class="col-sm-9">
<input type="date" id="invoice_no_date" name="invoice_no_date" value="<?php echo isset($row_get_start['order_currier_date']) ? $row_get_start['order_currier_date'] : ''; ?>" class="form-control form-control-sm">
</div>
</div>
</div>

<div class="form-group">
<div class="row">
<label class="col-sm-3 col-form-label">Asking Delivery Date</label>
<div class="col-sm-9">
<input type="date" id="adate" name="adate" class="form-control form-control-sm" required>
</div>
</div>
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
<!--
<div class="col-lg-1">
<input type="text" name="total_price[]" placeholder="Weight" tabindex="-1" class="form-control form-control-sm" readonly="">
</div>--->
<div class="col-lg-1">
    <input type="text" name="total_price[]" placeholder="Total Price" class="form-control form-control-sm" readonly>
</div>
<div class="mb-md hidden-lg hidden-xl">
</div>
<div class="col-lg-1" style="text-align: center;">
<button class="remove-field btn btn-outline-danger btn-circle btn-sm" type="button" data-toggle="tooltip" data-placement="right" title="" data-original-title="Remove">
<i class="fa-solid fa-minus"></i>
</button>
</div>
</div>
</div>
<br>
<button type="button" class="add-field btn btn-success"><i class="fa-solid fa-plus"></i> Add
More</button>


<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-2">
  <input type="text" id="totalPrice" name="totalprice" placeholder="Total Price" class="form-control form-control-sm" readonly="">
</div>
<div class="col-lg-2">
  <input type="text" id="totalQuantity" name="totalquantity" placeholder="Total Quantity" class="form-control form-control-sm" readonly="">
</div>
    <div class="col-lg-4"></div>
</div>


</div>
</div>

</div>
</div>

</div>
<!---
<div class="row" id="totalrow">
<div class="col-md-12">
<table class="table mb-none">
<tbody><tr>
<td class="success" id="grandtotal" style="text-align:center">Total Price: <b>0</b> Total Qty: <b>0</b> WEIGHT PER QTY :<b>Infinity</b> WEIGHT TOTAL :<b>0.000</b></td>
</tr>
</tbody></table>
</div>
</div>--->
<br>
<div class="row">
<div class="col-md-6 text-right">
    <input type="submit" name="submit" value="Submit">
</div>
<br>
</div>
</div>
</div>
</div>

</form>
</section>
</div>
</div>

<script>
document.getElementById("invoice-form").addEventListener("submit", function(event) {
    // Get the phone number value
    var phoneNumber = document.getElementById("co_ph_no").value;

    // Validate if the phone number is not empty
    if (phoneNumber.trim() !== "") {
        // Create a WhatsApp link with the phone number
        var latestId = "LPIC5000<?php echo $latestId; ?>";
        var whatsappLink = "https://api.whatsapp.com/send?phone=" + phoneNumber + "&text=Hello,%20Tracking%20ID%20is%20" + latestId;

        // Open the WhatsApp link in a new tab
        var whatsappWindow = window.open(whatsappLink, '_blank');

        // Wait for a short time (adjust the delay if needed)
        setTimeout(function() {
            // Submit the form by triggering a click event on the submit button
            document.getElementById("submit-button-id").click(); // Replace "submit-button-id" with the actual ID of your submit button
        }, 1000); // Adjust the delay in milliseconds if needed
    } else {
        alert("Please enter a valid phone number.");
        event.preventDefault(); // Prevent the default form submission
    }
});

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Function to calculate the total price
  function calculateTotal() {
    var total = 0;
    $("input[name='price[]']").each(function(index) {
      var price = parseFloat($(this).val()) || 0;
      var quantity = parseFloat($("input[name='product_quantity[]']").eq(index).val()) || 0;
      var itemTotal = price * quantity;
      total += itemTotal;
    });
    $("#totalPrice").val(total.toFixed(2)); // Update the total price input field
  }

  // Function to calculate the total quantity
  function calculateTotalQuantity() {
    var totalQuantity = 0;
    $("input[name='product_quantity[]']").each(function() {
      var quantity = parseFloat($(this).val()) || 0;
      totalQuantity += quantity;
    });
    $("#totalQuantity").val(totalQuantity); // Update the total quantity input field
  }

  // Listen for changes in the price and quantity input fields
  $("input[name='price[]'], input[name='product_quantity[]']").on("input", function() {
    calculateTotal();
    calculateTotalQuantity();
  });

  // Initial calculations
  calculateTotal();
  calculateTotalQuantity();
});
</script>

<script>
    // Get all the input fields for price, quantity, and total price
    var priceInputs = document.querySelectorAll('input[name="price[]"]');
    var quantityInputs = document.querySelectorAll('input[name="product_quantity[]"]');
    var totalInputs = document.querySelectorAll('input[name="total_price[]"]');

    // Attach an event listener to each input for tracking changes
    for (var i = 0; i < priceInputs.length; i++) {
        priceInputs[i].addEventListener('input', updateTotal);
        quantityInputs[i].addEventListener('input', updateTotal);
    }

    function updateTotal(event) {
        // Find the index of the input that triggered the event
        var index = Array.from(priceInputs).indexOf(event.target);

        // Get the values of price and quantity
        var price = parseFloat(priceInputs[index].value) || 0;
        var quantity = parseFloat(quantityInputs[index].value) || 0;

        // Calculate the total price by multiplying price and quantity
        var total = price * quantity;

        // Update the "Total Price" input field
        totalInputs[index].value = total.toFixed(2); // You can format the result as needed
    }
</script>



<script>
$('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    
    // Function to calculate total price and update it
    function updateTotalPrice() {
        var total = 0;
        $('.multi-field', $wrapper).each(function() {
            var price = parseFloat($('input[name="price[]"]', this).val()) || 0;
            var quantity = parseFloat($('input[name="product_quantity[]"]', this).val()) || 0;
            var totalPrice = price * quantity;
            $('input[name="total_price[]"]', this).val(totalPrice.toFixed(2));
            total += totalPrice;
        });
        // Update the grand total if needed
        // $('#grandtotal').text('Total Price: ' + total.toFixed(2));
    }

    $(".add-field", $(this)).click(function(e) {
        var newElement = $('.multi-field:last-child', $wrapper).clone(true)
            .appendTo($wrapper);
        
        // Clear values in the new input fields
        newElement.find('input[name="product_name[]"]').val('');
        newElement.find('input[name="product_quantity[]"]').val('');
        newElement.find('input[name="price[]"]').val('');
        newElement.find('input[name="hsn_code[]"]').val('');
        newElement.find('input[name="total_price[]"]').val('');
        newElement.find('input[name="product_name[]"]').focus();

        // Attach event listeners to new input fields
        $('input[name="price[]"], input[name="product_quantity[]"], input[name="total_price[]"]').on('input', function() {
            updateTotalPrice();
        });
    });

    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1) {
            $(this).parent().parent('.multi-field').remove();
            updateTotalPrice();
        }
    });
});

    
    function grandTotal() {
    total = 0;
    qty = 0;
    pw_total = 0;
    var quantity = document.getElementsByName('product_quantity[]');
    var price = document.getElementsByName('price[]');
    var total_price = document.getElementsByName('total_price[]');
    for (var i = 0; i < quantity.length; i++) {
        var q = quantity[i].value;
        var p = price[i].value;
        var pw = total_price[i].value;
        total += q * p;
        qty += q * 1;

    }
    wq = <?php echo $weight; ?> / qty;
    wq_final = wq.toFixed(3);
    for (var i = 0; i < total_price.length; i++) {
        var q = quantity[i].value;
        var w = total_price[i].value;
        weight_per_product = q * wq_final;
        pw_total += w * q;
    }
    pw_total = pw_total.toFixed(3)
    $("#grandtotal").html("Total Price: <b>" + total + "</b> Total Qty: <b>" + qty +
        "</b> WEIGHT PER QTY :<b>" +
        wq_final + "</b>" + "</b> WEIGHT TOTAL :<b>" + pw_total + "</b>");
        
    $.ajax({
        url: 'submit.php', // Replace with the correct path to your PHP script
        type: 'POST',
        data: {
            total: total,
            qty: qty
        },
        success: function(response) {
            // Handle the response from the server if needed
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle errors if the AJAX request fails
            console.error(xhr.responseText);
        }
    });
}

    
function clearShipper() {
    $("#sh_id").val("");
    $("#sh_full_name").val("").prop('readonly', false);
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
    $("#sh_document_type").val("").change().prop('readonly', false);
    $("#sh_document_type1").val("").change().prop('readonly', false);
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
            $("#sh_full_name").val(ui.label).prop('readonly', true);
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
            $("#sh_document_type").val(ui.sh_document_type).change().prop('readonly', true);
            $("#sh_document_type1").val(ui.sh_document_type1).change().prop('readonly',
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
    $("#co_full_name").val("").prop('readonly', false);
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
            $("#co_full_name").val(ui.label).prop('readonly', true);
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
<span class="hint-text m-l-15">Laxmipati</span>
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