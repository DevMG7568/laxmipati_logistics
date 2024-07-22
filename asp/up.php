<?php
// Include your database connection file (e.g., 'config.php')
@include 'config.php';

// Initialize variables
$id = 1; // Default ID

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $sh_full_name = $_POST['sh_full_name'];
  $sh_zip_code = $_POST['sh_zip_code'];
  $sh_add1 = $_POST['sh_add1'];
  $sh_add2 = $_POST['sh_add2'];
  $sh_add3 = $_POST['sh_add3'];
  $sh_city = $_POST['sh_city'];
  $sh_state = $_POST['sh_state'];
  $sh_country = $_POST['sh_country'];
  $sh_ph_no = $_POST['sh_ph_no'];
  $sh_ph_no1 = $_POST['sh_ph_no1'];
  $sh_email = $_POST['sh_email'];
  $sh_gst = $_POST['sh_gst'];
  $sh_attention = $_POST['sh_attention'];
  $sh_referance = $_POST['sh_referance'];
  $sh_document_type = $_POST['sh_document_type'];
  $sh_pan_no = $_POST['sh_pan_no'];
  $sh_document_type1 = $_POST['sh_document_type1'];
  $sh_pan_no1 = $_POST['sh_pan_no1'];

  $co_full_name = $_POST['co_full_name'];
  $co_zip_code = $_POST['co_zip_code'];
  $co_add1 = $_POST['co_add1'];
  $co_add2 = $_POST['co_add2'];
  $co_add3 = $_POST['co_add3'];
  $co_city = $_POST['co_city'];
  $co_state = $_POST['co_state'];
  $co_country = $_POST['co_country'];
  $co_ph_no = $_POST['co_ph_no'];
  $co_ph_no1 = $_POST['co_ph_no1'];
  $co_email = $_POST['co_email'];
  $co_attention = $_POST['co_attention'];
  $co_referance = $_POST['co_referance'];

  $note = isset($_POST['note']) ? $_POST['note'] : '';
  $awb_show = $_POST['awb_show'];
  $gift_type = $_POST['gift_type'];
  $currency = $_POST['currency'];
  $status = $_POST['status'];
  $invoice_no_date = $_POST['invoice_no_date'];
  $adate = $_POST['adate'];

  $documentImage = "";
  $documentImage_back = "";
  $documentImage1 = "";

  // Handle file uploads for documentImage
  if (!empty($_FILES['documentImage']['name'])) {
    $documentImage = $_FILES['documentImage']['name'];
    $documentImageTmp = $_FILES['documentImage']['tmp_name'];
    $documentImagePath = 'upload/' . $documentImage;

    if (move_uploaded_file($documentImageTmp, $documentImagePath)) {
      // Image uploaded successfully
    } else {
      echo "Error uploading documentImage.";
    }
  }

  // Handle file uploads for documentImage_back
  if (!empty($_FILES['documentImage_back']['name'])) {
    $documentImage_back = $_FILES['documentImage_back']['name'];
    $documentImage_backTmp = $_FILES['documentImage_back']['tmp_name'];
    $documentImage_backPath = 'upload/' . $documentImage_back;
    if (move_uploaded_file($documentImage_backTmp, $documentImage_backPath)) {
      // Image uploaded successfully
    } else {
      echo "Error uploading documentImage_back.";
    }
  }

  // Handle file uploads for documentImage1
  if (!empty($_FILES['documentImage1']['name'])) {
    $documentImage1 = $_FILES['documentImage1']['name'];
    $documentImage1Tmp = $_FILES['documentImage1']['tmp_name'];
    $documentImage1Path = 'upload/' . $documentImage1;
    if (move_uploaded_file($documentImage1Tmp, $documentImage1Path)) {
      // Image uploaded successfully
    } else {
      echo "Error uploading documentImage1.";
    }
  }

  // Update the data in the database
  $update_sql = "UPDATE order_details SET
                sh_full_name = '$sh_full_name',
                sh_zip_code = '$sh_zip_code',
                sh_add1 = '$sh_add1',
                sh_add2 = '$sh_add2',
                sh_add3 = '$sh_add3',
                sh_city = '$sh_city',
                sh_state = '$sh_state',
                sh_country = '$sh_country',
                sh_ph_no = '$sh_ph_no',
                sh_ph_no1 = '$sh_ph_no1',
                sh_email = '$sh_email',
                sh_gst = '$sh_gst',
                sh_attention = '$sh_attention',
                sh_referance = '$sh_referance',
                sh_document_type = '$sh_document_type',
                sh_pan_no = '$sh_pan_no',
                sh_document_type1 = '$sh_document_type1',
                sh_pan_no1 = '$sh_pan_no1',
                co_full_name = '$co_full_name',
                co_zip_code = '$co_zip_code',
                co_add1 = '$co_add1',
                co_add2 = '$co_add2',
                co_add3 = '$co_add3',
                co_city = '$co_city',
                co_state = '$co_state',
                co_country = '$co_country',
                co_ph_no = '$co_ph_no',
                co_ph_no1 = '$co_ph_no1',
                co_email = '$co_email',
                co_attention = '$co_attention',
                co_referance = '$co_referance',
                note = '$note',
                awb_show = '$awb_show',
                gift_type = '$gift_type',
                currency = '$currency',
                status = '$status',
                invoice_no_date = '$invoice_no_date',
                adate = '$adate'";

  // Append file fields if they exist
  if (!empty($documentImage)) {
    $update_sql .= ", documentImage = '$documentImage'";
  }
  if (!empty($documentImage_back)) {
    $update_sql .= ", documentImage_back = '$documentImage_back'";
  }
  if (!empty($documentImage1)) {
    $update_sql .= ", documentImage1 = '$documentImage1'";
  }

  // Finish the SQL statement
  $update_sql .= " WHERE id = $id";

  if ($conn->query($update_sql) === TRUE) {
    header("Location: allorder.php");
    exit();
  } else {
    echo "Error updating record: " . $conn->error;
  }
}

// Fetch the existing data for the given ID
$sql = "SELECT * FROM order_details WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// Close the database connection
$conn->close();
?>



<html lang="en" class=" js no-touch csstransforms3d csstransitions">

<head>
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
      margin-bottom: 0;
    }

    .table tbody tr td {
      padding: 10px;
    }

    .page-sidebar .sidebar-menu .menu-items li>a {
      width: 75%;
    }

    .datepicker {
      z-index: 1600 !important;
      /* has to be larger than 1050 */
    }

    input[type="text"] {
      text-transform: uppercase;
    }

    input[type="email"] {
      text-transform: uppercase;
    }
  </style>
  <script src="https://goexbox.com/assets/agent/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <style type="text/css">
    .jqstooltip {
      position: absolute;
      left: 0px;
      top: 0px;
      visibility: hidden;
      background: rgb(0, 0, 0) transparent;
      background-color: rgba(0, 0, 0, 0.6);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
      -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
      color: white;
      font: 10px arial, san serif;
      text-align: left;
      white-space: nowrap;
      padding: 5px;
      border: 1px solid white;
      z-index: 10000;
    }

    .jqsfield {
      color: white;
      font: 10px arial, san serif;
      text-align: left;
    }
  </style>
  <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/6/common.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/6/util.js"></script>
</head>

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
                        <span class="badge me-1">LPIC5000<?php echo $row['id']; ?>
                        </span>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group  required ">
                        <div class="row">
                          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                          <label class="col-sm-3 col-form-label">Full Name</label>
                          <input type="hidden" name="order_id" id="order_id" class="form-control form-control-sm" value="">
                          <input type="hidden" name="sh_id" id="sh_id" value="">
                          <input type="hidden" name="co_id" id="co_id" value="">
                          <input type="hidden" id="sh_latitude" name="sh_latitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off">
                          <input type="hidden" id="sh_longitude" name="sh_longitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off">
                          <div class="col-sm-7">
                            <input type="text" id="sh_full_name" name="sh_full_name" value="<?php echo $row['sh_full_name']; ?>" class="autocomplete form-control form-control-sm" autocomplete="off">
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
                            <input type="text" id="sh_zip_code" name="sh_zip_code" value="<?php echo $row['sh_zip_code']; ?>" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="form-group  required ">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" id="sh_add1" name="sh_add1" value="<?php echo $row['sh_add1']; ?>" class="form-control form-control-sm">
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
                            <input type="text" id="sh_city" name="sh_city" value="<?php echo $row['sh_city']; ?>" class="autocomplete form-control form-control-sm" autocomplete="off">
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
                            <input type="text" id="sh_country" name="sh_country" value="<?php echo $row['sh_country']; ?>" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Phone No</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control form-control-sm" minlength="5" id="sh_ph_no" value="<?php echo $row['sh_ph_no']; ?>" name="sh_ph_no">
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
                          <label class="col-sm-3 col-form-label">GST No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" minlength="5" id="sh_gst" value="<?php echo $row['sh_gst']; ?>" name="sh_gst">
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
                            <input type="text" class="form-control form-control-sm" id="sh_referance" value="<?php echo $row['sh_referance']; ?>" name="sh_referance">
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
                          <input type="hidden" id="co_latitude" name="co_latitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off">
                          <input type="hidden" id="co_longitude" name="co_longitude" value="" class="autocomplete form-control form-control-sm" autocomplete="off">
                          <div class="col-sm-7">
                            <input type="text" id="co_full_name" name="co_full_name" value="<?php echo $row['co_full_name']; ?>" class="autocomplete form-control form-control-sm" autocomplete="off">
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
                            <input type="text" id="co_zip_code" name="co_zip_code" value="<?php echo $row['co_zip_code']; ?>" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="form-group  required ">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" id="co_add1" name="co_add1" value="<?php echo $row['co_add1']; ?>" class="form-control form-control-sm">
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
                            <input type="text" id="co_city" name="co_city" value="<?php echo $row['co_city']; ?>" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" id="co_state" name="co_state" value="<?php echo $row['co_state']; ?>" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9" id="co_country_selection">
                            <input type="text" class="form-control form-control-sm" id="co_country" value="<?php echo $row['co_country']; ?>" name="co_country">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Phone No</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control form-control-sm" minlength="5" id="co_ph_no" value="<?php echo $row['co_ph_no']; ?>" name="co_ph_no">
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
                            <input type="text" class="form-control form-control-sm" id="co_referance" value="<?php echo $row['sh_referance']; ?>" name="co_referance">
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-divider b-b b-dashed b-secondary"></div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Note</label>
                          <div class="col-sm-9">
                            <input type="text" id="note" name="note" value="<?php echo $row['note']; ?>" class="form-control form-control-sm">
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
                              <select name="gift_type" id="gift_type" class="form-control form-control-sm" value="">
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
                              <select name="currency" class="form-control form-control-sm" value="<?php echo $row["currency"]; ?>">
                                <option value="USD" <?php echo $row["currency"] == 'USD' ? 'selected' : ''; ?>>USD</option>
                                <option value="GBP" <?php echo $row["currency"] == 'GBP' ? 'selected' : ''; ?>>GBP</option>
                                <option value="INR" <?php echo $row["currency"] == 'INR' ? 'selected' : ''; ?>>INR</option>
                                <option value="EUR" <?php echo $row["currency"] == 'EUR' ? 'selected' : ''; ?>>EUR</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                              <select name="status" id="status" class="form-control form-control-sm" value="">
                                <option value="BOOKED" <?php echo $row["status"] == 'BOOKED' ? 'selected' : ''; ?>>BOOKED</option>
                                <option value="IN TRANSIT" <?php echo $row["status"] == 'IN TRANSIT' ? 'selected' : ''; ?>>IN TRANSIT</option>
                                <option value="ON HOLD" <?php echo $row["status"] == 'ON HOLD' ? 'selected' : ''; ?>>ON HOLD</option>
                                <option value="OUT FOR DELIVERY" <?php echo $row["status"] == 'OUT FOR DELIVERY' ? 'selected' : ''; ?>>OUT FOR DELIVERY</option>
                                <option value="DELIVERED" <?php echo $row["status"] == 'DELIVERED' ? 'selected' : ''; ?>>DELIVERED</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 col-form-label">Invoice No &amp; Date</label>
                        <div class="col-sm-9">
                          <input type="date" id="invoice_no_date" name="invoice_no_date" value="<?php echo $row['invoice_no_date']; ?>" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 col-form-label">Asking Delivery Date</label>
                        <div class="col-sm-9">
                          <input type="date" id="adate" name="adate" value="<?php echo $row['adate']; ?>" class="form-control form-control-sm">
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

  </div>
  </div>

  <br>



  <div class="row">
    <div class="col-md-6 text-right">
      <input type="submit" value="Update">
    </div>
  </div>

  </form>
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

  <!-- <script>
    $(document).ready(function() {
      const countries = [{
          label: "AF - Afghanistan",
          value: "Afghanistan"
        },
        {
          label: "EUR - Aland Island (Finland)",
          value: "Aland Island (Finland)"
        },
        {
          label: "AL - Albania",
          value: "Albania"
        },
        {
          label: "DZ - Algeria",
          value: "Algeria"
        },
        {
          label: "AS - American Samoa",
          value: "American Samoa"
        },
        {
          label: "AD - Andorra",
          value: "Andorra"
        },
        {
          label: "AO - Angola",
          value: "Angola"
        },
        {
          label: "AI - Anguilla",
          value: "Anguilla"
        },
        {
          label: "AQ - Antarctica",
          value: "Antarctica"
        },
        {
          label: "AG - Antigua",
          value: "Antigua"
        },
        {
          label: "ANB - Antigua and Barbuda",
          value: "Antigua and Barbuda"
        },
        {
          label: "AR - Argentina",
          value: "Argentina"
        },
        {
          label: "AM - Armenia",
          value: "Armenia"
        },
        {
          label: "AM - Armenia",
          value: "Armenia"
        },
        {
          label: "AW - Aruba",
          value: "Aruba"
        },
        {
          label: "AU - Australia",
          value: "Australia"
        },
        {
          label: "AUB - Australia BEYOND",
          value: "Australia BEYOND"
        },
        {
          label: "AT - Austria",
          value: "Austria"
        },
        {
          label: "AZ - Azerbaijan",
          value: "Azerbaijan"
        },
        {
          label: "BS - Bahamas",
          value: "Bahamas"
        },
        {
          label: "BH - Bahrain",
          value: "Bahrain"
        },
        {
          label: "BD - Bangladesh",
          value: "Bangladesh"
        },
        {
          label: "BDD - Bangladesh DDP (Duty Paid)",
          value: "Bangladesh DDP (Duty Paid)"
        },
        {
          label: "BB - Barbados",
          value: "Barbados"
        },
        {
          label: "BY - Belarus",
          value: "Belarus"
        },
        {
          label: "BE - Belgium",
          value: "Belgium"
        },
        {
          label: "BZ - Belize",
          value: "Belize"
        },
        {
          label: "BJ - Benin",
          value: "Benin"
        },
        {
          label: "BM - Bermuda",
          value: "Bermuda"
        },
        {
          label: "BT - Bhutan",
          value: "Bhutan"
        },
        {
          label: "BO - Bolivia",
          value: "Bolivia"
        },
        {
          label: "BQ - Bonaire",
          value: "Bonaire"
        },
        {
          label: "BX - Bosnia",
          value: "Bosnia"
        },
        {
          label: "BA - Bosnia and Herzegovina",
          value: "Bosnia and Herzegovina"
        },
        {
          label: "BW - Botswana",
          value: "Botswana"
        },
        {
          label: "BWG - Botswana (Gaborone)",
          value: "Botswana (Gaborone)"
        },
        {
          label: "BV - Bouvet Island",
          value: "Bouvet Island"
        },
        {
          label: "BR - Brazil",
          value: "Brazil"
        },
        {
          label: "IO - British Indian Ocean Territory",
          value: "British Indian Ocean Territory"
        },
        {
          label: "BN - Brunei",
          value: "Brunei"
        },
        {
          label: "BG - Bulgaria",
          value: "Bulgaria"
        },
        {
          label: "BF - Burkina Faso",
          value: "Burkina Faso"
        },
        {
          label: "BI - Burundi",
          value: "Burundi"
        },
        {
          label: "KH - Cambodia",
          value: "Cambodia"
        },
        {
          label: "CM - Cameroon",
          value: "Cameroon"
        },
        {
          label: "CA - CANADA",
          value: "CANADA"
        },
        {
          label: "IC - Canary Islands",
          value: "Canary Islands"
        },
        {
          label: "CV - Cape Verde",
          value: "Cape Verde"
        },
        {
          label: "KY - Cayman Islands",
          value: "Cayman Islands"
        },
        {
          label: "CF - Central African Republic",
          value: "Central African Republic"
        },
        {
          label: "TD - Chad",
          value: "Chad"
        },
        {
          label: "CHI - Channel Island",
          value: "Channel Island"
        },
        {
          label: "CL - Chile",
          value: "Chile"
        },
        {
          label: "CN - China",
          value: "China"
        },
        {
          label: "ROC - China SOUTH",
          value: "China SOUTH"
        },
        {
          label: "CX - Christmas Island",
          value: "Christmas Island"
        },
        {
          label: "CC - Cocos (Keeling) Islands",
          value: "Cocos (Keeling) Islands"
        },
        {
          label: "CO - Colombia",
          value: "Colombia"
        },
        {
          label: "KM - Comoros",
          value: "Comoros"
        },
        {
          label: "CG - Congo",
          value: "Congo"
        },
        {
          label: "COB - Congo (Brazzaville)",
          value: "Congo (Brazzaville)"
        },
        {
          label: "CK - Cook Islands",
          value: "Cook Islands"
        },
        {
          label: "CR - Costa Rica",
          value: "Costa Rica"
        },
        {
          label: "AFR - Cote d'Ivoire",
          value: "Cote d'Ivoire"
        },
        {
          label: "HR - Croatia",
          value: "Croatia"
        },
        {
          label: "CU - Cuba",
          value: "Cuba"
        },
        {
          label: "CW - Curacao",
          value: "Curacao"
        },
        {
          label: "CY - Cyprus",
          value: "Cyprus"
        },
        {
          label: "CZ - Czech Republic",
          value: "Czech Republic"
        },
        {
          label: "CD - Democratic Republic Of Congo",
          value: "Democratic Republic Of Congo"
        },
        {
          label: "DK - Denmark",
          value: "Denmark"
        },
        {
          label: "DJ - Djibouti",
          value: "Djibouti"
        },
        {
          label: "DM - Dominica",
          value: "Dominica"
        },
        {
          label: "DO - Dominican Republic",
          value: "Dominican Republic"
        },
        {
          label: "TP - East Timor",
          value: "East Timor"
        },
        {
          label: "EC - Ecuador",
          value: "Ecuador"
        },
        {
          label: "EG - Egypt",
          value: "Egypt"
        },
        {
          label: "SV - El Salvador",
          value: "El Salvador"
        },
        {
          label: "ER - Eritrea",
          value: "Eritrea"
        },
        {
          label: "EE - Estonia",
          value: "Estonia"
        },
        {
          label: "ET - Ethiopia",
          value: "Ethiopia"
        },
        {
          label: "- Faeroe Islands",
          value: "Faeroe Islands"
        },
        {
          label: "FK - Falkland Islands",
          value: "Falkland Islands"
        },
        {
          label: "FO - Faroe Islands",
          value: "Faroe Islands"
        },
        {
          label: "FJ - Fiji",
          value: "Fiji"
        },
        {
          label: "FI - Finland",
          value: "Finland"
        },
        {
          label: "FR - France",
          value: "France"
        },
        {
          label: "GF - French Guiana",
          value: "French Guiana"
        },
        {
          label: "PF - French Polynesia",
          value: "French Polynesia"
        },
        {
          label: "TF - French Southern Territories",
          value: "French Southern Territories"
        },
        {
          label: "GA - Gabon",
          value: "Gabon"
        },
        {
          label: "GM - Gambia",
          value: "Gambia"
        },
        {
          label: "GE - Georgia",
          value: "Georgia"
        },
        {
          label: "DE - Germany",
          value: "Germany"
        },
        {
          label: "GH - Ghana",
          value: "Ghana"
        },
        {
          label: "GI - Gibraltar",
          value: "Gibraltar"
        },
        {
          label: "GR - Greece",
          value: "Greece"
        },
        {
          label: "GL - Greenland",
          value: "Greenland"
        },
        {
          label: "GD - Grenada",
          value: "Grenada"
        },
        {
          label: "GP - Guadeloupe",
          value: "Guadeloupe"
        },
        {
          label: "GU - Guam",
          value: "Guam"
        },
        {
          label: "GT - Guatemala",
          value: "Guatemala"
        },
        {
          label: "GG - Guernsey",
          value: "Guernsey"
        },
        {
          label: "GN - Guinea",
          value: "Guinea"
        },
        {
          label: "GW - Guinea Bissau",
          value: "Guinea Bissau"
        },
        {
          label: "GQ - Guinea Equatorial",
          value: "Guinea Equatorial"
        },
        {
          label: "GY - Guyana",
          value: "Guyana"
        },
        {
          label: "HT - Haiti",
          value: "Haiti"
        },
        {
          label: "HM - Heard and McDonald Islands",
          value: "Heard and McDonald Islands"
        },
        {
          label: "HN - Honduras",
          value: "Honduras"
        },
        {
          label: "HK - Hong Kong",
          value: "Hong Kong"
        },
        {
          label: "HU - Hungary",
          value: "Hungary"
        },
        {
          label: "IS - Iceland",
          value: "Iceland"
        },
        {
          label: "IN - India",
          value: "India"
        },
        {
          label: "ID - Indonesia",
          value: "Indonesia"
        },
        {
          label: "IR - Iran",
          value: "Iran"
        },
        {
          label: "IQ - Iraq",
          value: "Iraq"
        },
        {
          label: "IE - Ireland",
          value: "Ireland"
        },
        {
          label: "IM - Isle of Man",
          value: "Isle of Man"
        },
        {
          label: "IL - Israel",
          value: "Israel"
        },
        {
          label: "IT - Italy",
          value: "Italy"
        },
        {
          label: "CI - Ivory Coast",
          value: "Ivory Coast"
        },
        {
          label: "JM - Jamaica",
          value: "Jamaica"
        },
        {
          label: "JP - Japan",
          value: "Japan"
        },
        {
          label: "JE - Jersey",
          value: "Jersey"
        },
        {
          label: "JO - Jordan",
          value: "Jordan"
        },
        {
          label: "KZ - Kazakhstan",
          value: "Kazakhstan"
        },
        {
          label: "KE - Kenya",
          value: "Kenya"
        },
        {
          label: "KI - Kiribati",
          value: "Kiribati"
        },
        {
          label: "KP - Korea North",
          value: "Korea North"
        },
        {
          label: "KR - Korea South",
          value: "Korea South"
        },
        {
          label: "KW - Kuwait",
          value: "Kuwait"
        },
        {
          label: "KG - Kyrgyzstan",
          value: "Kyrgyzstan"
        },
        {
          label: "LA - Laos",
          value: "Laos"
        },
        {
          label: "LV - Latvia",
          value: "Latvia"
        },
        {
          label: "LB - Lebanon",
          value: "Lebanon"
        },
        {
          label: "LS - Lesotho",
          value: "Lesotho"
        },
        {
          label: "LR - Liberia",
          value: "Liberia"
        },
        {
          label: "LY - Libya",
          value: "Libya"
        },
        {
          label: "LI - Liechtenstein",
          value: "Liechtenstein"
        },
        {
          label: "LT - Lithuania",
          value: "Lithuania"
        },
        {
          label: "LU - Luxembourg",
          value: "Luxembourg"
        },
        {
          label: "MO - Macau",
          value: "Macau"
        },
        {
          label: "MK - Macedonia",
          value: "Macedonia"
        },
        {
          label: "MG - Madagascar",
          value: "Madagascar"
        },
        {
          label: "MW - Malawi",
          value: "Malawi"
        },
        {
          label: "MY - Malaysia",
          value: "Malaysia"
        },
        {
          label: "MV - Maldives",
          value: "Maldives"
        },
        {
          label: "ML - Mali",
          value: "Mali"
        },
        {
          label: "MT - Malta",
          value: "Malta"
        },
        {
          label: "MH - Marshall Islands",
          value: "Marshall Islands"
        },
        {
          label: "MQ - Martinique",
          value: "Martinique"
        },
        {
          label: "MR - Mauritania",
          value: "Mauritania"
        },
        {
          label: "MU - Mauritius",
          value: "Mauritius"
        },
        {
          label: "YT - Mayotte",
          value: "Mayotte"
        },
        {
          label: "MX - Mexico",
          value: "Mexico"
        },
        {
          label: "FM - Micronesia",
          value: "Micronesia"
        },
        {
          label: "MD - Moldova",
          value: "Moldova"
        },
        {
          label: "MC - Monaco",
          value: "Monaco"
        },
        {
          label: "MN - Mongolia",
          value: "Mongolia"
        },
        {
          label: "ME - Montenegro",
          value: "Montenegro"
        },
        {
          label: "MS - Montserrat",
          value: "Montserrat"
        },
        {
          label: "MA - Morocco",
          value: "Morocco"
        },
        {
          label: "MZ - Mozambique",
          value: "Mozambique"
        },
        {
          label: "MM - Myanmar",
          value: "Myanmar"
        },
        {
          label: "NA - Namibia",
          value: "Namibia"
        },
        {
          label: "NR - Nauru",
          value: "Nauru"
        },
        {
          label: "NP - Nepal",
          value: "Nepal"
        },
        {
          label: "NL - Netherlands",
          value: "Netherlands"
        },
        {
          label: "AN - Netherlands Antilles",
          value: "Netherlands Antilles"
        },
        {
          label: "NC - New Caledonia",
          value: "New Caledonia"
        },
        {
          label: "NZ - New Zealand",
          value: "New Zealand"
        },
        {
          label: "NI - Nicaragua",
          value: "Nicaragua"
        },
        {
          label: "NE - Niger",
          value: "Niger"
        },
        {
          label: "NG - Nigeria",
          value: "Nigeria"
        },
        {
          label: "NU - Niue",
          value: "Niue"
        },
        {
          label: "NF - Norfolk Island",
          value: "Norfolk Island"
        },
        {
          label: "NO - Norway",
          value: "Norway"
        },
        {
          label: "OM - Oman",
          value: "Oman"
        },
        {
          label: "PK - Pakistan",
          value: "Pakistan"
        },
        {
          label: "PW - Palau",
          value: "Palau"
        },
        {
          label: "PS - Palestine",
          value: "Palestine"
        },
        {
          label: "PA - Panama",
          value: "Panama"
        },
        {
          label: "PG - Papua New Guinea",
          value: "Papua New Guinea"
        },
        {
          label: "PY - Paraguay",
          value: "Paraguay"
        },
        {
          label: "PE - Peru",
          value: "Peru"
        },
        {
          label: "PH - Philippines",
          value: "Philippines"
        },
        {
          label: "PN - Pitcairn",
          value: "Pitcairn"
        },
        {
          label: "PL - Poland",
          value: "Poland"
        },
        {
          label: "PT - Portugal",
          value: "Portugal"
        },
        {
          label: "QA - Qatar",
          value: "Qatar"
        },
        {
          label: "RE - Reunion",
          value: "Reunion"
        },
        {
          label: "RO - Romania",
          value: "Romania"
        },
        {
          label: "RU - Russia",
          value: "Russia"
        },
        {
          label: "RW - Rwanda",
          value: "Rwanda"
        },
        {
          label: "SH - Saint Helena",
          value: "Saint Helena"
        },
        {
          label: "KN - Saint Kitts and Nevis",
          value: "Saint Kitts and Nevis"
        },
        {
          label: "LC - Saint Lucia",
          value: "Saint Lucia"
        },
        {
          label: "PM - Saint Pierre and Miquelon",
          value: "Saint Pierre and Miquelon"
        },
        {
          label: "VC - Saint Vincent and the Grenadines",
          value: "Saint Vincent and the Grenadines"
        },
        {
          label: "WS - Samoa",
          value: "Samoa"
        },
        {
          label: "SM - San Marino",
          value: "San Marino"
        },
        {
          label: "ST - Sao Tome and Principe",
          value: "Sao Tome and Principe"
        },
        {
          label: "SA - Saudi Arabia",
          value: "Saudi Arabia"
        },
        {
          label: "SN - Senegal",
          value: "Senegal"
        },
        {
          label: "RS - Serbia",
          value: "Serbia"
        },
        {
          label: "SC - Seychelles",
          value: "Seychelles"
        },
        {
          label: "SL - Sierra Leone",
          value: "Sierra Leone"
        },
        {
          label: "SG - Singapore",
          value: "Singapore"
        },
        {
          label: "SX - Sint Maarten",
          value: "Sint Maarten"
        },
        {
          label: "SK - Slovakia",
          value: "Slovakia"
        },
        {
          label: "SI - Slovenia",
          value: "Slovenia"
        },
        {
          label: "SB - Solomon Islands",
          value: "Solomon Islands"
        },
        {
          label: "SO - Somalia",
          value: "Somalia"
        },
        {
          label: "ZA - South Africa",
          value: "South Africa"
        },
        {
          label: "ES - Spain",
          value: "Spain"
        },
        {
          label: "LK - Sri Lanka",
          value: "Sri Lanka"
        },
        {
          label: "SD - Sudan",
          value: "Sudan"
        },
        {
          label: "SR - Suriname",
          value: "Suriname"
        },
        {
          label: "SJ - Svalbard and Jan Mayen",
          value: "Svalbard and Jan Mayen"
        },
        {
          label: "SZ - Swaziland",
          value: "Swaziland"
        },
        {
          label: "SE - Sweden",
          value: "Sweden"
        },
        {
          label: "CH - Switzerland",
          value: "Switzerland"
        },
        {
          label: "SY - Syria",
          value: "Syria"
        },
        {
          label: "PF - Tahiti",
          value: "Tahiti"
        },
        {
          label: "TW - Taiwan",
          value: "Taiwan"
        },
        {
          label: "TJ - Tajikistan",
          value: "Tajikistan"
        },
        {
          label: "TZ - Tanzania",
          value: "Tanzania"
        },
        {
          label: "TZD - Tanzania (Dar es Salaam)",
          value: "Tanzania (Dar es Salaam)"
        },
        {
          label: "TH - Thailand",
          value: "Thailand"
        },
        {
          label: "TG - Togo",
          value: "Togo"
        },
        {
          label: "TK - Tokelau",
          value: "Tokelau"
        },
        {
          label: "TO - Tonga",
          value: "Tonga"
        },
        {
          label: "TT - Trinidad & Tobago",
          value: "Trinidad Tobago"
        },
        {
          label: "TN - Tunisia",
          value: "Tunisia"
        },
        {
          label: "TR - Turkey",
          value: "Turkey"
        },
        {
          label: "TM - Turkmenistan",
          value: "Turkmenistan"
        },
        {
          label: "TC - Turks & Caicos Islands",
          value: "Turks Caicos Islands"
        },
        {
          label: "TV - Tuvalu",
          value: "Tuvalu"
        },
        {
          label: "UG - Uganda",
          value: "Uganda"
        },
        {
          label: "UGD - Uganda - DDP",
          value: "Uganda - DDP"
        },
        {
          label: "UA - Ukraine",
          value: "Ukraine"
        },
        {
          label: "AE - United Arab Emirates",
          value: "United Arab Emirates"
        },
        {
          label: "AE - United Arab Emirates (DDP)",
          value: "United Arab Emirates (DDP)"
        },
        {
          label: "GB - United Kingdom",
          value: "United Kingdom"
        },
        {
          label: "GBD - United Kingdom DDP (Duty Paid)",
          value: "United Kingdom DDP (Duty Paid)"
        },
        {
          label: "US - United States Of America",
          value: "United States Of America"
        },
        {
          label: "UY - Uruguay",
          value: "Uruguay"
        },
        {
          label: "UZ - Uzbekistan",
          value: "Uzbekistan"
        },
        {
          label: "VU - Vanuatu",
          value: "Vanuatu"
        },
        {
          label: "VA - Vatican City State (Holy See)",
          value: "Vatican City State (Holy See)"
        },
        {
          label: "VE - Venezuela",
          value: "Venezuela"
        },
        {
          label: "VN - Vietnam",
          value: "Vietnam"
        },
        {
          label: "VG - Virgin Islands (British)",
          value: "Virgin Islands (British)"
        },
        {
          label: "VI - Virgin Islands (United States)",
          value: "Virgin Islands (United States)"
        },
        {
          label: "WF - Wallis And Futuna Islands",
          value: "Wallis And Futuna Islands"
        },
        {
          label: "EH - Western Sahara",
          value: "Western Sahara"
        },
        {
          label: "YE - Yemen",
          value: "Yemen"
        },
        {
          label: "YU - Yugoslavia",
          value: "Yugoslavia"
        },
        {
          label: "ZM - Zambia",
          value: "Zambia"
        },
        {
          label: "ZML - Zambia (Lusaka)",
          value: "Zambia (Lusaka)"
        },
        {
          label: "ZW - Zimbabwe",
          value: "Zimbabwe"
        },
      ];
      const options = countries.map((country) => {
        return `<option value={country.value} ${'<?php echo $row["co_country"]; ?>' == country.value ? 'selected' : ''}>${country.label}</option>`
      });
      $("#co_country_selection").append(`<select name="co_country" id="co_country" style="width:100%;height:36px;" required>${options}</select>`)
    })
  </script> -->
  <script src="https://goexbox.com/assets/agent/js/custom/crud.js" type="text/javascript"></script>



  <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999; top: 330.6px; left: 218.65px; width: 402.85px;"></div>
  <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
  <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
  <div id="pip-toast"></div>
</body>

</html>