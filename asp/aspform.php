<?php
include("config.php"); // Include the database connection file

// Extract data from the form
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["asp_get_booking"])) {
//   $user_name = $_POST['user_name'];
//   $country = $_POST['country'];
//   $documentType = $_POST['document_type_id'];
//   $nob = $_POST['nob'];
//   $weight = $_POST['weight'];
//   $orderDate = $_POST['order_currier_date'];
//   $shReference = $_POST['sh_referance'];
//   $note = $_POST['note'];

//   // Insert data into the 'dj' table
//   $sql_dj = "INSERT INTO get_start (user_name, country, document_type_id, nob, weight, order_currier_date, sh_referance, note)
//           VALUES ('$user_name', '$country', '$documentType', '$nob', '$weight', '$orderDate', '$shReference', '$note')";

//   if ($conn->query($sql_dj) === TRUE) {
//     // Get the generated 'id' from the 'dj' table
//     $book_id = $conn->insert_id;
//   } else {
//     echo "Error: " . $sql_dj . "<br>" . $conn->error;
//   }


//   // Extract arrays from the form (assuming these are arrays)
//   $heightArray = $_POST['height'];
//   $widthArray = $_POST['width'];
//   $lengthArray = $_POST['length'];
//   $weightvArray = $_POST['weightv'];
//   $weightbArray = $_POST['weightb'];

//   // Loop through the arrays and insert data into the 'dj_get_booking' table
//   for ($i = 0; $i < count($heightArray); $i++) {
//     $height = $heightArray[$i];
//     $width = $widthArray[$i];
//     $length = $lengthArray[$i];
//     $weightv = $weightvArray[$i];
//     $weightb = $weightbArray[$i];

//     // Insert data into the 'dj_get_booking' table using the correct 'book_id'
//     $sql_dj_get_booking = "INSERT INTO get_booking (book_id, height, width, length, weightv, weightb)
//                       VALUES ('$book_id', '$height', '$width', '$length', '$weightv', '$weightb')";

//     if ($conn->query($sql_dj_get_booking) === TRUE) {
//       // Successfully inserted into 'dj_get_booking' table
//     } else {
//       echo "Error: " . $sql_dj_get_booking . "<br>" . $conn->error;
//     }
//   }
// }


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
  </style>
  <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/6/common.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/6/util.js"></script>
</head>

<body class="fixed-header horizontal-menu horizontal-app-menu dashboard  windows desktop js-focus-visible pace-done">
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
  <div class="page-container ">
    <div class="page-content-wrapper ">
      <div class="content ">
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
                          <input type="hidden" name="user_name" value="<?php echo $admin_username; ?>">
                          <input type="hidden" name="latestId" value="<?php echo $latestId; ?>">
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
                            <input type="text" id="sh_add3" name="sh_add3" value="" class="form-control form-control-sm">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" id="sh_city" name="sh_city" value="SURAT" class="autocomplete form-control form-control-sm" autocomplete="off" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" id="sh_state" name="sh_state" value="GUJARAT" class="form-control form-control-sm" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <input type="text" id="sh_country" name="sh_country" value="INDIA" class="form-control form-control-sm" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Phone No</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control form-control-sm" minlength="5" id="sh_ph_no" name="sh_ph_no" required>
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
                            <input type="email" class="form-control form-control-sm" minlength="5" id="sh_email" value="laxmipati.int123@gmail.com" name="sh_email" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">GST No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" minlength="5" id="sh_gst" value="" name="sh_gst">
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
                            <input type="text" class="form-control form-control-sm" id="sh_referance" name="sh_referance">
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
                            <input type="text" id="co_add3" name="co_add3" value="" class="form-control form-control-sm">
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
                            <select name="co_country" id="co_country" style="width:100%;height:36px;" required>
                              <option value="Afghanistan">AF - Afghanistan</option>
                              <option value="Aland Island (Finland)">EUR - Aland Island (Finland)</option>
                              <option value="Albania">AL - Albania</option>
                              <option value="Algeria">DZ - Algeria</option>
                              <option value="American Samoa">AS - American Samoa</option>
                              <option value="Andorra">AD - Andorra</option>
                              <option value="Angola">AO - Angola</option>
                              <option value="Anguilla">AI - Anguilla</option>
                              <option value="Antarctica">AQ - Antarctica</option>
                              <option value="Antigua">AG - Antigua</option>
                              <option value="Antigua and Barbuda">ANB - Antigua and Barbuda</option>
                              <option value="Argentina">AR - Argentina</option>
                              <option value="Armenia">AM - Armenia</option>
                              <option value="Armenia">AM - Armenia</option>
                              <option value="Aruba">AW - Aruba</option>
                              <option value="Australia">AU - Australia</option>
                              <option value="Australia BEYOND">AUB - Australia BEYOND</option>
                              <option value="Austria">AT - Austria</option>
                              <option value="Azerbaijan">AZ - Azerbaijan</option>
                              <option value="Bahamas">BS - Bahamas</option>
                              <option value="Bahrain">BH - Bahrain</option>
                              <option value="Bangladesh">BD - Bangladesh</option>
                              <option value="Bangladesh DDP (Duty Paid)">BDD - Bangladesh DDP (Duty Paid)</option>
                              <option value="Barbados">BB - Barbados</option>
                              <option value="Belarus">BY - Belarus</option>
                              <option value="Belgium">BE - Belgium</option>
                              <option value="Belize">BZ - Belize</option>
                              <option value="Benin">BJ - Benin</option>
                              <option value="Bermuda">BM - Bermuda</option>
                              <option value="Bhutan">BT - Bhutan</option>
                              <option value="Bolivia">BO - Bolivia</option>
                              <option value="Bonaire">BQ - Bonaire</option>
                              <option value="Bosnia">BX - Bosnia</option>
                              <option value="Bosnia and Herzegovina">BA - Bosnia and Herzegovina</option>
                              <option value="Botswana">BW - Botswana</option>
                              <option value="Botswana (Gaborone)">BWG - Botswana (Gaborone)</option>
                              <option value="Bouvet Island">BV - Bouvet Island</option>
                              <option value="Brazil">BR - Brazil</option>
                              <option value="British Indian Ocean Territory">IO - British Indian Ocean Territory</option>
                              <option value="Brunei">BN - Brunei</option>
                              <option value="Bulgaria">BG - Bulgaria</option>
                              <option value="Burkina Faso">BF - Burkina Faso</option>
                              <option value="Burundi">BI - Burundi</option>
                              <option value="Cambodia">KH - Cambodia</option>
                              <option value="Cameroon">CM - Cameroon</option>
                              <option value="CANADA">CA - CANADA</option>
                              <option value="Canary Islands">IC - Canary Islands</option>
                              <option value="Cape Verde">CV - Cape Verde</option>
                              <option value="Cayman Islands">KY - Cayman Islands</option>
                              <option value="Central African Republic">CF - Central African Republic</option>
                              <option value="Chad">TD - Chad</option>
                              <option value="Channel Island">CHI - Channel Island</option>
                              <option value="Chile">CL - Chile</option>
                              <option value="China">CN - China</option>
                              <option value="China SOUTH">ROC - China SOUTH</option>
                              <option value="Christmas Island">CX - Christmas Island</option>
                              <option value="Cocos (Keeling) Islands">CC - Cocos (Keeling) Islands</option>
                              <option value="Colombia">CO - Colombia</option>
                              <option value="Comoros">KM - Comoros</option>
                              <option value="Congo">CG - Congo</option>
                              <option value="Congo (Brazzaville)">COB - Congo (Brazzaville)</option>
                              <option value="Cook Islands">CK - Cook Islands</option>
                              <option value="Costa Rica">CR - Costa Rica</option>
                              <option value="Cote d'Ivoire">AFR - Cote d'Ivoire</option>
                              <option value="Croatia">HR - Croatia</option>
                              <option value="Cuba">CU - Cuba</option>
                              <option value="Curacao">CW - Curacao</option>
                              <option value="Cyprus">CY - Cyprus</option>
                              <option value="Czech Republic">CZ - Czech Republic</option>
                              <option value="Democratic Republic Of Congo">CD - Democratic Republic Of Congo</option>
                              <option value="Denmark">DK - Denmark</option>
                              <option value="Djibouti">DJ - Djibouti</option>
                              <option value="Dominica">DM - Dominica</option>
                              <option value="Dominican Republic">DO - Dominican Republic</option>
                              <option value="East Timor">TP - East Timor</option>
                              <option value="Ecuador">EC - Ecuador</option>
                              <option value="Egypt">EG - Egypt</option>
                              <option value="El Salvador">SV - El Salvador</option>
                              <option value="Eritrea">ER - Eritrea</option>
                              <option value="Estonia">EE - Estonia</option>
                              <option value="Ethiopia">ET - Ethiopia</option>
                              <option value="Faeroe Islands">- Faeroe Islands</option>
                              <option value="Falkland Islands">FK - Falkland Islands</option>
                              <option value="Faroe Islands">FO - Faroe Islands</option>
                              <option value="Fiji">FJ - Fiji</option>
                              <option value="Finland">FI - Finland</option>
                              <option value="France">FR - France</option>
                              <option value="French Guiana">GF - French Guiana</option>
                              <option value="French Polynesia">PF - French Polynesia</option>
                              <option value="French Southern Territories">TF - French Southern Territories</option>
                              <option value="Gabon">GA - Gabon</option>
                              <option value="Gambia">GM - Gambia</option>
                              <option value="Georgia">GE - Georgia</option>
                              <option value="Germany">DE - Germany</option>
                              <option value="Ghana">GH - Ghana</option>
                              <option value="Gibraltar">GI - Gibraltar</option>
                              <option value="Greece">GR - Greece</option>
                              <option value="Greenland">GL - Greenland</option>
                              <option value="Grenada">GD - Grenada</option>
                              <option value="Guadeloupe">GP - Guadeloupe</option>
                              <option value="Guam">GU - Guam</option>
                              <option value="Guatemala">GT - Guatemala</option>
                              <option value="Guernsey">GG - Guernsey</option>
                              <option value="Guinea">GN - Guinea</option>
                              <option value="Guinea Bissau">GW - Guinea Bissau</option>
                              <option value="Guinea Equatorial">GQ - Guinea Equatorial</option>
                              <option value="Guyana">GY - Guyana</option>
                              <option value="Haiti">HT - Haiti</option>
                              <option value="Heard and McDonald Islands">HM - Heard and McDonald Islands</option>
                              <option value="Honduras">HN - Honduras</option>
                              <option value="Hong Kong">HK - Hong Kong</option>
                              <option value="Hungary">HU - Hungary</option>
                              <option value="Iceland">IS - Iceland</option>
                              <option value="India">IN - India</option>
                              <option value="Indonesia">ID - Indonesia</option>
                              <option value="Iran">IR - Iran</option>
                              <option value="Iraq">IQ - Iraq</option>
                              <option value="Ireland">IE - Ireland</option>
                              <option value="Isle of Wight">Isl - Isle of Wight</option>
                              <option value="Israel">IL - Israel</option>
                              <option value="Italy">IT - Italy</option>
                              <option value="Ivory Coast">CI - Ivory Coast</option>
                              <option value="Jamaica">JM - Jamaica</option>
                              <option value="Japan">JP - Japan</option>
                              <option value="Jersey">XJ - Jersey</option>
                              <option value="Jordan">JO - Jordan</option>
                              <option value="Kazakhstan">KZ - Kazakhstan</option>
                              <option value="Kenya">KE - Kenya</option>
                              <option value="Kenya DDP (Duty Paid)">KED - Kenya DDP (Duty Paid)</option>
                              <option value="Kiribati">KI - Kiribati</option>
                              <option value="Kosovo">XK - Kosovo</option>
                              <option value="Kuwait">KW - Kuwait</option>
                              <option value="Kyrgyzstan">KG - Kyrgyzstan</option>
                              <option value="Lagos">NGL - Lagos</option>
                              <option value="Laos">LA - Laos</option>
                              <option value="Latvia">LV - Latvia</option>
                              <option value="Lebanon">LB - Lebanon</option>
                              <option value="Lesotho">LS - Lesotho</option>
                              <option value="Lesotho (Maseru)">LSM - Lesotho (Maseru)</option>
                              <option value="Liberia">LR - Liberia</option>
                              <option value="Libya">LY - Libya</option>
                              <option value="Liechtenstein">LI - Liechtenstein</option>
                              <option value="Lithuania">LT - Lithuania</option>
                              <option value="Luxembourg">LU - Luxembourg</option>
                              <option value="Macau">MO - Macau</option>
                              <option value="Macedonia">MK - Macedonia</option>
                              <option value="Madagascar">MG - Madagascar</option>
                              <option value="Malawi">MW - Malawi</option>
                              <option value="Malawi (Lilongwe)">MWL - Malawi (Lilongwe)</option>
                              <option value="Malaysia">MY - Malaysia</option>
                              <option value="Maldives">MV - Maldives</option>
                              <option value="Mali">ML - Mali</option>
                              <option value="Malta">MT - Malta</option>
                              <option value="Marshall Islands">MH - Marshall Islands</option>
                              <option value="Martinique">MQ - Martinique</option>
                              <option value="Mauritania">MR - Mauritania</option>
                              <option value="Mauritius">MU - Mauritius</option>
                              <option value="Mayotte">YT - Mayotte</option>
                              <option value="Melilla">- Melilla</option>
                              <option value="Mexico">MX - Mexico</option>
                              <option value="Micronesia">FM - Micronesia</option>
                              <option value="Moldova">MD - Moldova</option>
                              <option value="Monaco">MC - Monaco</option>
                              <option value="Mongolia">MN - Mongolia</option>
                              <option value="Montenegro, Republic of">ME - Montenegro, Republic of</option>
                              <option value="Montserrat">MS - Montserrat</option>
                              <option value="Morocco">MA - Morocco</option>
                              <option value="Mozambique">MZ - Mozambique</option>
                              <option value="Mozambique (Maputo)">MZM - Mozambique (Maputo)</option>
                              <option value="Myanmar">MM - Myanmar</option>
                              <option value="Namibia">NA - Namibia</option>
                              <option value="Namibia (Windhoek)">NAW - Namibia (Windhoek)</option>
                              <option value="Nauru">NR - Nauru</option>
                              <option value="Nepal">NP - Nepal</option>
                              <option value="Netherlands">NL - Netherlands</option>
                              <option value="Netherlands (Holland)">NEH - Netherlands (Holland)</option>
                              <option value="Netherlands Antilles">AN - Netherlands Antilles</option>
                              <option value="NEVIS">XN - NEVIS</option>
                              <option value="Nevis">KN - Nevis</option>
                              <option value="New Caledonia">NC - New Caledonia</option>
                              <option value="New Zealand">NZ - New Zealand</option>
                              <option value="Nicaragua">NI - Nicaragua</option>
                              <option value="Niger">NE - Niger</option>
                              <option value="Nigeria">NG - Nigeria</option>
                              <option value="Nigeria - Lagos">NGL - Nigeria - Lagos</option>
                              <option value="Nigeria - Lagos (Duty Paid)">NGD - Nigeria - Lagos (Duty Paid)</option>
                              <option value="Niue">NU - Niue</option>
                              <option value="Norfolk Island">NF - Norfolk Island</option>
                              <option value="North Korea">KP - North Korea</option>
                              <option value="Northern Ireland">NIR - Northern Ireland</option>
                              <option value="Norway">NO - Norway</option>
                              <option value="NY / NJ - United States Of America">USA - NY / NJ - United States Of America</option>
                              <option value="Oman">OM - Oman</option>
                              <option value="Pakistan">PK - Pakistan</option>
                              <option value="Palau">PW - Palau</option>
                              <option value="Palestine Authority">PS - Palestine Authority</option>
                              <option value="Panama">PA - Panama</option>
                              <option value="Papua new Guinea">PG - Papua new Guinea</option>
                              <option value="Paraguay">PY - Paraguay</option>
                              <option value="Peru">PE - Peru</option>
                              <option value="Philippines">PH - Philippines</option>
                              <option value="Pitcairn Island">PN - Pitcairn Island</option>
                              <option value="Poland">PL - Poland</option>
                              <option value="Portugal">PT - Portugal</option>
                              <option value="Puerto Rico">PR - Puerto Rico</option>
                              <option value="Qatar">QA - Qatar</option>
                              <option value="REST OF WORLD">ROW - REST OF WORLD</option>
                              <option value="Reunion Island">RE - Reunion Island</option>
                              <option value="Romania">RO - Romania</option>
                              <option value="Russia">RU - Russia</option>
                              <option value="RUWI">RUB - RUWI</option>
                              <option value="Rwanda">RW - Rwanda</option>
                              <option value="Saint Pierre and Miquelon">PM - Saint Pierre and Miquelon</option>
                              <option value="Saipan">MP - Saipan</option>
                              <option value="Samoa">WS - Samoa</option>
                              <option value="San Marino">SM - San Marino</option>
                              <option value="Sao Tome and Principe">ST - Sao Tome and Principe</option>
                              <option value="Saudi Arabia">SA - Saudi Arabia</option>
                              <option value="Scotland">SCT - Scotland</option>
                              <option value="Senegal">SN - Senegal</option>
                              <option value="Serbia">RS - Serbia</option>
                              <option value="Seychelles">SC - Seychelles</option>
                              <option value="Sierra Leone">SL - Sierra Leone</option>
                              <option value="Singapore">SG - Singapore</option>
                              <option value="Slovakia">SK - Slovakia</option>
                              <option value="Slovenia">SI - Slovenia</option>
                              <option value="Smaller Territories of the UK">XG - Smaller Territories of the UK</option>
                              <option value="Solomon Islands">SB - Solomon Islands</option>
                              <option value="Somalia">SO - Somalia</option>
                              <option value="Somaliland">SML - Somaliland</option>
                              <option value="South Africa">ZA - South Africa</option>
                              <option value="South Africa - DDP">ZAD - South Africa - DDP</option>
                              <option value="South Korea">KR - South Korea</option>
                              <option value="South Sudan">SS - South Sudan</option>
                              <option value="Spain">ES - Spain</option>
                              <option value="Sri Lanka">LK - Sri Lanka</option>
                              <option value="Sri Lanka DDP (Duty Paid)">LKD - Sri Lanka DDP (Duty Paid)</option>
                              <option value="St. Barthelemy">XY - St. Barthelemy</option>
                              <option value="St. Eustatius">XE - St. Eustatius</option>
                              <option value="St. Helena">SH - St. Helena</option>
                              <option value="St. Kitts And Nevis">KN - St. Kitts And Nevis</option>
                              <option value="St. Lucia">LC - St. Lucia</option>
                              <option value="St. Maarten">SX - St. Maarten</option>
                              <option value="St. Vincen">VC - St. Vincent</option>
                              <option value="Sudan">SD - Sudan</option>
                              <option value="Suriname">SR - Suriname</option>
                              <option value="Svalbard And Jan Mayen Islands">SJ - Svalbard And Jan Mayen Islands</option>
                              <option value="Swaziland">SZ - Swaziland</option>
                              <option value="Swaziland (Mbabane)">SZM - Swaziland (Mbabane)</option>
                              <option value="Sweden">SE - Sweden</option>
                              <option value="Switzerland">CH - Switzerland</option>
                              <option value="Syria">SY - Syria</option>
                              <option value="Tahiti">PF - Tahiti</option>
                              <option value="Taiwan">TW - Taiwan</option>
                              <option value="Tajikistan">TJ - Tajikistan</option>
                              <option value="Tanzania">TZ - Tanzania</option>
                              <option value="Tanzania (Dar es Salaam)">TZD - Tanzania (Dar es Salaam)</option>
                              <option value="Thailand">TH - Thailand</option>
                              <option value="Togo">TG - Togo</option>
                              <option value="Tokelau">TK - Tokelau</option>
                              <option value="Tonga">TO - Tonga</option>
                              <option value="Trinidad Tobago">TT - Trinidad &amp; Tobago</option>
                              <option value="Tunisia">TN - Tunisia</option>
                              <option value="Turkey">TR - Turkey</option>
                              <option value="Turkmenistan">TM - Turkmenistan</option>
                              <option value="Turks Caicos Islands">TC - Turks &amp; Caicos Islands</option>
                              <option value="Tuvalu">TV - Tuvalu</option>
                              <option value="Uganda">UG - Uganda</option>
                              <option value="Uganda - DDP">UGD - Uganda - DDP</option>
                              <option value="Ukraine">UA - Ukraine</option>
                              <option value="United Arab Emirates">AE - United Arab Emirates</option>
                              <option value="United Arab Emirates (DDP)">AE - United Arab Emirates (DDP)</option>
                              <option value="United Kingdom">GB - United Kingdom</option>
                              <option value="United Kingdom DDP (Duty Paid)">GBD - United Kingdom DDP (Duty Paid)</option>
                              <option value="United States Of America">US - United States Of America</option>
                              <option value="Uruguay">UY - Uruguay</option>
                              <option value="Uzbekistan">UZ - Uzbekistan</option>
                              <option value="Vanuatu">VU - Vanuatu</option>
                              <option value="Vatican City State (Holy See)">VA - Vatican City State (Holy See)</option>
                              <option value="Venezuela">VE - Venezuela</option>
                              <option value="Vietnam">VN - Vietnam</option>
                              <option value="Virgin Islands (British)">VG - Virgin Islands (British)</option>
                              <option value="Virgin Islands (United States)">VI - Virgin Islands (United States)</option>
                              <option value="Wallis And Futuna Islands">WF - Wallis And Futuna Islands</option>
                              <option value="Western Sahara">EH - Western Sahara</option>
                              <option value="Yemen">YE - Yemen</option>
                              <option value="Yugoslavia">YU - Yugoslavia</option>
                              <option value="Zambia">ZM - Zambia </option>
                              <option value="Zambia (Lusaka)">ZML - Zambia (Lusaka)</option>
                              <option value="Zimbabwe">ZW - Zimbabwe</option>
                            </select>
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
                            <input type="text" class="form-control form-control-sm" id="co_referance" name="co_referance" disabled>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-divider b-b b-dashed b-secondary"></div>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-sm-3 col-form-label">Note</label>
                          <div class="col-sm-9">
                            <input type="text" id="note" name="note" class="form-control form-control-sm">
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
                                  <!-- <option value="">Select Currency</option> -->
                                  <option value="INR" selected>INR</option>
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
                                  <!-- <option value="">Select Status</option> -->
                                  <option value="BOOKED" selected>BOOKED</option>
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
                                  <input type="date" id="dateInput" name="invoice_no_date" class="form-control form-control-sm">
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
                        Box Description
                      </h5>
                    </div>
                    <div class="multi-field-wrapper card-body">
                      <div class="multi-fields" id="boxDesc">
                        <div class="multi-field row form-group" data-id="0">
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
                            <input type="text" name="total_price[]" placeholder="Total Price" class="form-control form-control-sm" readonly tabindex="-1">
                          </div>
                          <div class="mb-md hidden-lg hidden-xl">
                          </div>
                          <div class="col-lg-1" style="text-align: center;">
                            <button class="remove-field btn btn-outline-danger btn-circle btn-sm" id="removeBtn" data-id="0" type="button" data-toggle="tooltip" data-placement="right" title="" data-original-title="Remove">
                              <i class="fa-solid fa-minus"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <br>
                      <button type="button" class="add-field btn btn-success" id="addBtn"><i class="fa-solid fa-plus"></i> Add More</button>
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
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header ">
                      <div class="card-title">Booking Information</div>
                    </div>
                    <div class="card-body">
                      <div class="form-group-attached">
                        <input type="hidden" name="user_name" value="<?php echo $admin_username; ?>">
                        <input type="hidden" name="booking_type" id="booking_type" value="0">
                        <div class="row clearfix">
                          <div class="col-sm-12">
                            <div class="form-group required">
                              <select name="co_country" style="width:100%;height:36px;" id="country_booking" required disabled>
                                <option value="Afghanistan">AF - Afghanistan</option>
                                <option value="Aland Island (Finland)">EUR - Aland Island (Finland)</option>
                                <option value="Albania">AL - Albania</option>
                                <option value="Algeria">DZ - Algeria</option>
                                <option value="American Samoa">AS - American Samoa</option>
                                <option value="Andorra">AD - Andorra</option>
                                <option value="Angola">AO - Angola</option>
                                <option value="Anguilla">AI - Anguilla</option>
                                <option value="Antarctica">AQ - Antarctica</option>
                                <option value="Antigua">AG - Antigua</option>
                                <option value="Antigua and Barbuda">ANB - Antigua and Barbuda</option>
                                <option value="Argentina">AR - Argentina</option>
                                <option value="Armenia">AM - Armenia</option>
                                <option value="Armenia">AM - Armenia</option>
                                <option value="Aruba">AW - Aruba</option>
                                <option value="Australia">AU - Australia</option>
                                <option value="Australia BEYOND">AUB - Australia BEYOND</option>
                                <option value="Austria">AT - Austria</option>
                                <option value="Azerbaijan">AZ - Azerbaijan</option>
                                <option value="Bahamas">BS - Bahamas</option>
                                <option value="Bahrain">BH - Bahrain</option>
                                <option value="Bangladesh">BD - Bangladesh</option>
                                <option value="Bangladesh DDP (Duty Paid)">BDD - Bangladesh DDP (Duty Paid)</option>
                                <option value="Barbados">BB - Barbados</option>
                                <option value="Belarus">BY - Belarus</option>
                                <option value="Belgium">BE - Belgium</option>
                                <option value="Belize">BZ - Belize</option>
                                <option value="Benin">BJ - Benin</option>
                                <option value="Bermuda">BM - Bermuda</option>
                                <option value="Bhutan">BT - Bhutan</option>
                                <option value="Bolivia">BO - Bolivia</option>
                                <option value="Bonaire">BQ - Bonaire</option>
                                <option value="Bosnia">BX - Bosnia</option>
                                <option value="Bosnia and Herzegovina">BA - Bosnia and Herzegovina</option>
                                <option value="Botswana">BW - Botswana</option>
                                <option value="Botswana (Gaborone)">BWG - Botswana (Gaborone)</option>
                                <option value="Bouvet Island">BV - Bouvet Island</option>
                                <option value="Brazil">BR - Brazil</option>
                                <option value="British Indian Ocean Territory">IO - British Indian Ocean Territory</option>
                                <option value="Brunei">BN - Brunei</option>
                                <option value="Bulgaria">BG - Bulgaria</option>
                                <option value="Burkina Faso">BF - Burkina Faso</option>
                                <option value="Burundi">BI - Burundi</option>
                                <option value="Cambodia">KH - Cambodia</option>
                                <option value="Cameroon">CM - Cameroon</option>
                                <option value="CANADA">CA - CANADA</option>
                                <option value="Canary Islands">IC - Canary Islands</option>
                                <option value="Cape Verde">CV - Cape Verde</option>
                                <option value="Cayman Islands">KY - Cayman Islands</option>
                                <option value="Central African Republic">CF - Central African Republic</option>
                                <option value="Chad">TD - Chad</option>
                                <option value="Channel Island">CHI - Channel Island</option>
                                <option value="Chile">CL - Chile</option>
                                <option value="China">CN - China</option>
                                <option value="China SOUTH">ROC - China SOUTH</option>
                                <option value="Christmas Island">CX - Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">CC - Cocos (Keeling) Islands</option>
                                <option value="Colombia">CO - Colombia</option>
                                <option value="Comoros">KM - Comoros</option>
                                <option value="Congo">CG - Congo</option>
                                <option value="Congo (Brazzaville)">COB - Congo (Brazzaville)</option>
                                <option value="Cook Islands">CK - Cook Islands</option>
                                <option value="Costa Rica">CR - Costa Rica</option>
                                <option value="Cote d'Ivoire">AFR - Cote d'Ivoire</option>
                                <option value="Croatia">HR - Croatia</option>
                                <option value="Cuba">CU - Cuba</option>
                                <option value="Curacao">CW - Curacao</option>
                                <option value="Cyprus">CY - Cyprus</option>
                                <option value="Czech Republic">CZ - Czech Republic</option>
                                <option value="Democratic Republic Of Congo">CD - Democratic Republic Of Congo</option>
                                <option value="Denmark">DK - Denmark</option>
                                <option value="Djibouti">DJ - Djibouti</option>
                                <option value="Dominica">DM - Dominica</option>
                                <option value="Dominican Republic">DO - Dominican Republic</option>
                                <option value="East Timor">TP - East Timor</option>
                                <option value="Ecuador">EC - Ecuador</option>
                                <option value="Egypt">EG - Egypt</option>
                                <option value="El Salvador">SV - El Salvador</option>
                                <option value="Eritrea">ER - Eritrea</option>
                                <option value="Estonia">EE - Estonia</option>
                                <option value="Ethiopia">ET - Ethiopia</option>
                                <option value="Faeroe Islands">- Faeroe Islands</option>
                                <option value="Falkland Islands">FK - Falkland Islands</option>
                                <option value="Faroe Islands">FO - Faroe Islands</option>
                                <option value="Fiji">FJ - Fiji</option>
                                <option value="Finland">FI - Finland</option>
                                <option value="France">FR - France</option>
                                <option value="French Guiana">GF - French Guiana</option>
                                <option value="French Polynesia">PF - French Polynesia</option>
                                <option value="French Southern Territories">TF - French Southern Territories</option>
                                <option value="Gabon">GA - Gabon</option>
                                <option value="Gambia">GM - Gambia</option>
                                <option value="Georgia">GE - Georgia</option>
                                <option value="Germany">DE - Germany</option>
                                <option value="Ghana">GH - Ghana</option>
                                <option value="Gibraltar">GI - Gibraltar</option>
                                <option value="Greece">GR - Greece</option>
                                <option value="Greenland">GL - Greenland</option>
                                <option value="Grenada">GD - Grenada</option>
                                <option value="Guadeloupe">GP - Guadeloupe</option>
                                <option value="Guam">GU - Guam</option>
                                <option value="Guatemala">GT - Guatemala</option>
                                <option value="Guernsey">GG - Guernsey</option>
                                <option value="Guinea">GN - Guinea</option>
                                <option value="Guinea Bissau">GW - Guinea Bissau</option>
                                <option value="Guinea Equatorial">GQ - Guinea Equatorial</option>
                                <option value="Guyana">GY - Guyana</option>
                                <option value="Haiti">HT - Haiti</option>
                                <option value="Heard and McDonald Islands">HM - Heard and McDonald Islands</option>
                                <option value="Honduras">HN - Honduras</option>
                                <option value="Hong Kong">HK - Hong Kong</option>
                                <option value="Hungary">HU - Hungary</option>
                                <option value="Iceland">IS - Iceland</option>
                                <option value="India">IN - India</option>
                                <option value="Indonesia">ID - Indonesia</option>
                                <option value="Iran">IR - Iran</option>
                                <option value="Iraq">IQ - Iraq</option>
                                <option value="Ireland">IE - Ireland</option>
                                <option value="Isle of Wight">Isl - Isle of Wight</option>
                                <option value="Israel">IL - Israel</option>
                                <option value="Italy">IT - Italy</option>
                                <option value="Ivory Coast">CI - Ivory Coast</option>
                                <option value="Jamaica">JM - Jamaica</option>
                                <option value="Japan">JP - Japan</option>
                                <option value="Jersey">XJ - Jersey</option>
                                <option value="Jordan">JO - Jordan</option>
                                <option value="Kazakhstan">KZ - Kazakhstan</option>
                                <option value="Kenya">KE - Kenya</option>
                                <option value="Kenya DDP (Duty Paid)">KED - Kenya DDP (Duty Paid)</option>
                                <option value="Kiribati">KI - Kiribati</option>
                                <option value="Kosovo">XK - Kosovo</option>
                                <option value="Kuwait">KW - Kuwait</option>
                                <option value="Kyrgyzstan">KG - Kyrgyzstan</option>
                                <option value="Lagos">NGL - Lagos</option>
                                <option value="Laos">LA - Laos</option>
                                <option value="Latvia">LV - Latvia</option>
                                <option value="Lebanon">LB - Lebanon</option>
                                <option value="Lesotho">LS - Lesotho</option>
                                <option value="Lesotho (Maseru)">LSM - Lesotho (Maseru)</option>
                                <option value="Liberia">LR - Liberia</option>
                                <option value="Libya">LY - Libya</option>
                                <option value="Liechtenstein">LI - Liechtenstein</option>
                                <option value="Lithuania">LT - Lithuania</option>
                                <option value="Luxembourg">LU - Luxembourg</option>
                                <option value="Macau">MO - Macau</option>
                                <option value="Macedonia">MK - Macedonia</option>
                                <option value="Madagascar">MG - Madagascar</option>
                                <option value="Malawi">MW - Malawi</option>
                                <option value="Malawi (Lilongwe)">MWL - Malawi (Lilongwe)</option>
                                <option value="Malaysia">MY - Malaysia</option>
                                <option value="Maldives">MV - Maldives</option>
                                <option value="Mali">ML - Mali</option>
                                <option value="Malta">MT - Malta</option>
                                <option value="Marshall Islands">MH - Marshall Islands</option>
                                <option value="Martinique">MQ - Martinique</option>
                                <option value="Mauritania">MR - Mauritania</option>
                                <option value="Mauritius">MU - Mauritius</option>
                                <option value="Mayotte">YT - Mayotte</option>
                                <option value="Melilla">- Melilla</option>
                                <option value="Mexico">MX - Mexico</option>
                                <option value="Micronesia">FM - Micronesia</option>
                                <option value="Moldova">MD - Moldova</option>
                                <option value="Monaco">MC - Monaco</option>
                                <option value="Mongolia">MN - Mongolia</option>
                                <option value="Montenegro, Republic of">ME - Montenegro, Republic of</option>
                                <option value="Montserrat">MS - Montserrat</option>
                                <option value="Morocco">MA - Morocco</option>
                                <option value="Mozambique">MZ - Mozambique</option>
                                <option value="Mozambique (Maputo)">MZM - Mozambique (Maputo)</option>
                                <option value="Myanmar">MM - Myanmar</option>
                                <option value="Namibia">NA - Namibia</option>
                                <option value="Namibia (Windhoek)">NAW - Namibia (Windhoek)</option>
                                <option value="Nauru">NR - Nauru</option>
                                <option value="Nepal">NP - Nepal</option>
                                <option value="Netherlands">NL - Netherlands</option>
                                <option value="Netherlands (Holland)">NEH - Netherlands (Holland)</option>
                                <option value="Netherlands Antilles">AN - Netherlands Antilles</option>
                                <option value="NEVIS">XN - NEVIS</option>
                                <option value="Nevis">KN - Nevis</option>
                                <option value="New Caledonia">NC - New Caledonia</option>
                                <option value="New Zealand">NZ - New Zealand</option>
                                <option value="Nicaragua">NI - Nicaragua</option>
                                <option value="Niger">NE - Niger</option>
                                <option value="Nigeria">NG - Nigeria</option>
                                <option value="Nigeria - Lagos">NGL - Nigeria - Lagos</option>
                                <option value="Nigeria - Lagos (Duty Paid)">NGD - Nigeria - Lagos (Duty Paid)</option>
                                <option value="Niue">NU - Niue</option>
                                <option value="Norfolk Island">NF - Norfolk Island</option>
                                <option value="North Korea">KP - North Korea</option>
                                <option value="Northern Ireland">NIR - Northern Ireland</option>
                                <option value="Norway">NO - Norway</option>
                                <option value="NY / NJ - United States Of America">USA - NY / NJ - United States Of America</option>
                                <option value="Oman">OM - Oman</option>
                                <option value="Pakistan">PK - Pakistan</option>
                                <option value="Palau">PW - Palau</option>
                                <option value="Palestine Authority">PS - Palestine Authority</option>
                                <option value="Panama">PA - Panama</option>
                                <option value="Papua new Guinea">PG - Papua new Guinea</option>
                                <option value="Paraguay">PY - Paraguay</option>
                                <option value="Peru">PE - Peru</option>
                                <option value="Philippines">PH - Philippines</option>
                                <option value="Pitcairn Island">PN - Pitcairn Island</option>
                                <option value="Poland">PL - Poland</option>
                                <option value="Portugal">PT - Portugal</option>
                                <option value="Puerto Rico">PR - Puerto Rico</option>
                                <option value="Qatar">QA - Qatar</option>
                                <option value="REST OF WORLD">ROW - REST OF WORLD</option>
                                <option value="Reunion Island">RE - Reunion Island</option>
                                <option value="Romania">RO - Romania</option>
                                <option value="Russia">RU - Russia</option>
                                <option value="RUWI">RUB - RUWI</option>
                                <option value="Rwanda">RW - Rwanda</option>
                                <option value="Saint Pierre and Miquelon">PM - Saint Pierre and Miquelon</option>
                                <option value="Saipan">MP - Saipan</option>
                                <option value="Samoa">WS - Samoa</option>
                                <option value="San Marino">SM - San Marino</option>
                                <option value="Sao Tome and Principe">ST - Sao Tome and Principe</option>
                                <option value="Saudi Arabia">SA - Saudi Arabia</option>
                                <option value="Scotland">SCT - Scotland</option>
                                <option value="Senegal">SN - Senegal</option>
                                <option value="Serbia">RS - Serbia</option>
                                <option value="Seychelles">SC - Seychelles</option>
                                <option value="Sierra Leone">SL - Sierra Leone</option>
                                <option value="Singapore">SG - Singapore</option>
                                <option value="Slovakia">SK - Slovakia</option>
                                <option value="Slovenia">SI - Slovenia</option>
                                <option value="Smaller Territories of the UK">XG - Smaller Territories of the UK</option>
                                <option value="Solomon Islands">SB - Solomon Islands</option>
                                <option value="Somalia">SO - Somalia</option>
                                <option value="Somaliland">SML - Somaliland</option>
                                <option value="South Africa">ZA - South Africa</option>
                                <option value="South Africa - DDP">ZAD - South Africa - DDP</option>
                                <option value="South Korea">KR - South Korea</option>
                                <option value="South Sudan">SS - South Sudan</option>
                                <option value="Spain">ES - Spain</option>
                                <option value="Sri Lanka">LK - Sri Lanka</option>
                                <option value="Sri Lanka DDP (Duty Paid)">LKD - Sri Lanka DDP (Duty Paid)</option>
                                <option value="St. Barthelemy">XY - St. Barthelemy</option>
                                <option value="St. Eustatius">XE - St. Eustatius</option>
                                <option value="St. Helena">SH - St. Helena</option>
                                <option value="St. Kitts And Nevis">KN - St. Kitts And Nevis</option>
                                <option value="St. Lucia">LC - St. Lucia</option>
                                <option value="St. Maarten">SX - St. Maarten</option>
                                <option value="St. Vincen">VC - St. Vincent</option>
                                <option value="Sudan">SD - Sudan</option>
                                <option value="Suriname">SR - Suriname</option>
                                <option value="Svalbard And Jan Mayen Islands">SJ - Svalbard And Jan Mayen Islands</option>
                                <option value="Swaziland">SZ - Swaziland</option>
                                <option value="Swaziland (Mbabane)">SZM - Swaziland (Mbabane)</option>
                                <option value="Sweden">SE - Sweden</option>
                                <option value="Switzerland">CH - Switzerland</option>
                                <option value="Syria">SY - Syria</option>
                                <option value="Tahiti">PF - Tahiti</option>
                                <option value="Taiwan">TW - Taiwan</option>
                                <option value="Tajikistan">TJ - Tajikistan</option>
                                <option value="Tanzania">TZ - Tanzania</option>
                                <option value="Tanzania (Dar es Salaam)">TZD - Tanzania (Dar es Salaam)</option>
                                <option value="Thailand">TH - Thailand</option>
                                <option value="Togo">TG - Togo</option>
                                <option value="Tokelau">TK - Tokelau</option>
                                <option value="Tonga">TO - Tonga</option>
                                <option value="Trinidad Tobago">TT - Trinidad &amp; Tobago</option>
                                <option value="Tunisia">TN - Tunisia</option>
                                <option value="Turkey">TR - Turkey</option>
                                <option value="Turkmenistan">TM - Turkmenistan</option>
                                <option value="Turks Caicos Islands">TC - Turks &amp; Caicos Islands</option>
                                <option value="Tuvalu">TV - Tuvalu</option>
                                <option value="Uganda">UG - Uganda</option>
                                <option value="Uganda - DDP">UGD - Uganda - DDP</option>
                                <option value="Ukraine">UA - Ukraine</option>
                                <option value="United Arab Emirates">AE - United Arab Emirates</option>
                                <option value="United Arab Emirates (DDP)">AE - United Arab Emirates (DDP)</option>
                                <option value="United Kingdom">GB - United Kingdom</option>
                                <option value="United Kingdom DDP (Duty Paid)">GBD - United Kingdom DDP (Duty Paid)</option>
                                <option value="United States Of America">US - United States Of America</option>
                                <option value="Uruguay">UY - Uruguay</option>
                                <option value="Uzbekistan">UZ - Uzbekistan</option>
                                <option value="Vanuatu">VU - Vanuatu</option>
                                <option value="Vatican City State (Holy See)">VA - Vatican City State (Holy See)</option>
                                <option value="Venezuela">VE - Venezuela</option>
                                <option value="Vietnam">VN - Vietnam</option>
                                <option value="Virgin Islands (British)">VG - Virgin Islands (British)</option>
                                <option value="Virgin Islands (United States)">VI - Virgin Islands (United States)</option>
                                <option value="Wallis And Futuna Islands">WF - Wallis And Futuna Islands</option>
                                <option value="Western Sahara">EH - Western Sahara</option>
                                <option value="Yemen">YE - Yemen</option>
                                <option value="Yugoslavia">YU - Yugoslavia</option>
                                <option value="Zambia">ZM - Zambia </option>
                                <option value="Zambia (Lusaka)">ZML - Zambia (Lusaka)</option>
                                <option value="Zimbabwe">ZW - Zimbabwe</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-3 col-form-label">Shipment Type</label>
                          <div class="col-3">
                            <div class="kt-radio-list">
                              <label class="kt-radio kt-radio--brand">
                                <!-- <input class="form-check-input" id="radio1" type="radio" name="document_type_id" value="1" data-bs-original-title="" title="">
                                <label class="form-check-label" for="radio1">Doc</label> -->
                                <br>
                                <input class="form-check-input" id="radio2" checked type="radio" name="document_type_id" value="2" data-bs-original-title="" title="">
                                <label class="form-check-label" for="radio2">Non Doc</label>
                              </label>
                            </div>
                          </div>
                          <div class="form-group  col-6" id="nobd">
                            <input type="text" placeholder="No Of Box" class="form-control form-control-sm" value="1" name="nob" id="nob">
                          </div>
                        </div>
                        <div class="form-group required" id="dimentiond">
                          <div id="ibox" class="row">
                            <div class="col-sm-3 pad-0">
                              <div class="form-group ">
                                <label style="font-size: 12px;">ACT.Weight(1)</label>
                                <input name="weightb[]" class="form-control form-control-sm" type="text" required="">
                              </div>
                            </div>
                            <div class="col-sm-2 pad-0">
                              <div class="form-group ">
                                <label>Height(1)</label>
                                <input name="height[]" class="form-control form-control-sm" type="text" required="">
                              </div>
                            </div>
                            <div class="col-sm-2 pad-0">
                              <div class="form-group ">
                                <label>Width(1)</label>
                                <input name="width[]" class="form-control form-control-sm" type="text" required="">
                              </div>
                            </div>
                            <div class="col-sm-2 pad-0">
                              <div class="form-group ">
                                <label>Length(1)</label>
                                <input name="length[]" class="form-control form-control-sm" type="text" required="">
                              </div>
                            </div>
                            <div class="col-sm-3 pad-0">
                              <div class="form-group ">
                                <label>VOL.WEIGHT(1)</label>
                                <input name="weightv[]" class="form-control form-control-sm" type="text" readonly="" tabindex="-1">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row clearfix">
                          <div class="col-sm-12">
                            <div class="form-group  required">
                              <input id="weight" tabindex="-1" type="text" placeholder="Shipment Weight" class="form-control form-control-sm" name="weight" required="" readonly="">
                            </div>
                          </div>
                          <!-- <div class="col-sm-6">
                            <div class="form-group ">
                              <input class="form-control form-control-sm" name="order_currier_date" id="dateInputBooking" type="date" disabled>
                            </div>
                          </div> -->
                        </div>
                        <div class="row clearfix">
                          <div class="col-sm-6">
                            <div class="form-group ">
                              <input id="referance_booking" type="text" placeholder="Shipment Referance No" class="form-control form-control-sm" name="sh_referance" disabled>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group  required">
                              <input id="note_booking" type="text" placeholder="Remarks" class="form-control form-control-sm" name="note" disabled>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 text-right">
                  <input type="button" name="submit" id="submit-button-id" value="Submit">
                </div>
                <input type="submit" name="submit" id="submit-button" value="Submit" hidden>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script>
    // Function to set today's date in the date input field
    function setTodayDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
      var yyyy = today.getFullYear();

      var todayString = yyyy + '-' + mm + '-' + dd;

      document.getElementById('dateInput').value = todayString;
      // document.getElementById('dateInputBooking').value = todayString;
    }

    // Call the function to set today's date when the page loads
    setTodayDate();
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
  <script>
    $(document).ready(function() {
      $("#sh_referance").keyup((val) => {
        $("#co_referance").val(val.target.value);
        $("#referance_booking").val(val.target.value);
      })
    })
  </script>
  <script>
    $(document).ready(function() {
      $("#note").keyup((val) => {
        $("#note_booking").val(val.target.value)
      })
    })
  </script>
  <script>
    $(document).ready(function() {
      $("#co_country").change((val) => {
        $("#country_booking").val(val.target.value)
      })
    })
  </script>
  <script>
    function addField(id) {
      for (i = 1; i <= id; ++i) {
        $("#ibox").append(
          '<div class="col-sm-3 pad-0"><div class="form-group "><label style="font-size: 12px;">ACT.Weight(' + i +
          ')</label><input name="weightb[]" class="form-control form-control-sm" type="text" required></div></div><div class="col-sm-2 pad-0"><div class="form-group "><label>Height(' +
          i +
          ')</label><input name="height[]" class="form-control form-control-sm" type="text"  required></div></div><div class="col-sm-2 pad-0"><div class="form-group "><label>Width(' +
          i +
          ')</label><input name="width[]" class="form-control form-control-sm" type="text" required></div></div><div class="col-sm-2 pad-0"><div class="form-group "><label>Length(' +
          i +
          ')</label><input name="length[]" class="form-control form-control-sm" type="text" required></div></div><div class="col-sm-3 pad-0"><div class="form-group "><label>VOL.WEIGHT(' +
          i +
          ')</label><input name="weightv[]" class="form-control form-control-sm" type="text"  readonly tabindex="-1"></div></div>'
        );
      }
    }

    function calculateWeightV(value) {
      var height = document.getElementsByName('height[]');
      var width = document.getElementsByName('width[]');
      var length = document.getElementsByName('length[]');
      var weightv = document.getElementsByName('weightv[]');
      var weightb = document.getElementsByName('weightb[]');
      var finalWeight = document.getElementsByName('weight');
      var final = finalWeight.value ?? 0;

      for (var i = 0; i < height.length; i++) {
        var h = height[i].value;
        var w = width[i].value;
        var l = length[i].value;
        var cweight = weightv[i].value;
        var aweight = weightb[i].value;

        if (!weightv[i].value) {
          weightv[i].value = 0;
        } else {
          weightv[i].value = Math.round((h * w * l / 5000) * 1000) / 1000;
          final = final + Math.ceil(Number(Math.round((h * w * l / 5000) * 1000) / 1000) > Number(weightb[i].value) ? Number(weightv[i].value) : Number(weightb[i].value))
        }
        $("#weight").val(final)
      }

    }

    $(document).ready(function() {
      $('#nob').on('changed keyup paste', function() {
        $("#ibox").html("");
        var v = $(this).val();
        if (v == "")
          v = 1;
        addField(v);
      });
    })
    $(document).ready(function() {
      $("#ibox").on('keyup', $('input[name="weightb[]"]'), function() {
        calculateWeightV();
      });
      $("#ibox").on('keyup', $('input[name="height[]"]'), function() {
        calculateWeightV();
      });
      $("#ibox").on('keyup', $('input[name="length[]"]'), function() {
        calculateWeightV();
      });
      $("#ibox").on('keyup', $('input[name="width[]"]'), function() {
        calculateWeightV();
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      function addField(latestId, lastBoxValue) {
        $("#boxDesc").append(
          `
            <div class="multi-field row form-group" data-id="${latestId}">
              <div class="col-lg-1">
                <select
                  name="nondg[]"
                  class="form-control form-control-sm"
                  value="0"
                  tabindex="-1"
                >
                  <option value="0">Normal</option>
                  <option value="1">NonDG</option>
                </select>
              </div>
              <div class="col-lg-1">
                <input
                  type="number"
                  name="box_no[]"
                  placeholder="Box No"
                  class="form-control form-control-sm"
                  value="${lastBoxValue}"
                  id="new_row"
                  required=""
                />
              </div>
              <div class="col-lg-3">
                <div class="form-group" id="the-basics">
                  <input
                    class="typeahead form-control form-control-sm"
                    type="text"
                    name="product_name[]"
                    placeholder="Product Name"
                    autocomplete="off"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-md hidden-lg hidden-xl"></div>
              <div class="col-lg-1">
                <input
                  type="number"
                  name="product_quantity[]"
                  placeholder="Quantity"
                  class="form-control form-control-sm"
                  required=""
                />
              </div>
              <div class="mb-md hidden-lg hidden-xl"></div>
              <div class="col-lg-2">
                <input
                  type="text"
                  name="price[]"
                  placeholder="Price"
                  class="form-control form-control-sm"
                  required=""
                />
              </div>
              <div class="col-lg-2">
                <input
                  type="number"
                  name="hsn_code[]"
                  placeholder="HSN Code"
                  tabindex="-1"
                  class="form-control form-control-sm"
                />
              </div>
              <div class="col-lg-1">
                <input
                  type="text"
                  name="total_price[]"
                  placeholder="Total Price"
                  tabindex="-1"
                  class="form-control form-control-sm"
                  readonly
                />
              </div>
              <div class="mb-md hidden-lg hidden-xl"></div>
              <div class="col-lg-1" style="text-align: center">
                <button
                  class="remove-field btn btn-outline-danger btn-circle btn-sm"
                  type="button"
                  data-toggle="tooltip"
                  data-placement="right"
                  title=""
                  data-original-title="Remove"
                  data-id="${latestId}"
                  id="removeBtn"
                >
                  <i class="fa-solid fa-minus"></i>
                </button>
              </div>
            </div>
          `
        );
      };

      function removeField(id) {
        if ($(`.multi-field`).length !== 1) {
          $(`.multi-field`).find(`[data-id="${id}"]`).parent().parent().remove();
          calculateTotal();
          calculateTotalQuantity();
        }
      }
      
      $("#addBtn").click(() => {
        const lastBoxValue = $(`#boxDesc`).find(`[data-id="${$(`.multi-field`).length - 1}"]`).find(`[name="box_no[]"]`).val()
        addField($(".multi-field").length, lastBoxValue);
      });

      $("#boxDesc").on("click", "#removeBtn", function() {
        const id = $(this).data("id");
        removeField(id);
      });
    })
    </script>
  <script>
    $(document).ready(function() {
      $("#addBtn").click(() => {
        $(`#boxDesc`).find(`[data-id="${$(`.multi-field`).length - 1}"]`).find(`#new_row`).focus()
      });
    })
  </script>
  <script>
    function calculateTotal() {
      var total = 0;
      $("input[name='price[]']").each(function(index) {
        var price = parseFloat($(this).val()) || 0;
        var quantity = parseFloat($("input[name='product_quantity[]']").eq(index).val()) || 0;
        var itemTotal = price * quantity;
        total += itemTotal;
      });
      $("#totalPrice").val(total.toFixed(2));
    }

    function calculateTotalQuantity() {
      var totalQuantity = 0;
      $("input[name='product_quantity[]']").each(function() {
        var quantity = parseFloat($(this).val()) || 0;
        totalQuantity += quantity;
      });
      $("#totalQuantity").val(totalQuantity);
    }

    function calculateInlineTotal() {
      var qty = document.getElementsByName('product_quantity[]');
      var price = document.getElementsByName('price[]');
      var total = document.getElementsByName('total_price[]');

      for (var i = 0; i < qty.length; i++) {
        var q = qty[i].value;
        var p = price[i].value;
        var t = total[i].value;

        if (!total[i].value) {
          total[i].value = 0;
        } else {
          total[i].value = Math.round(q * p);
        }
      }

      calculateTotal();
      calculateTotalQuantity();
    };

    $(document).ready(function() {
      $("#boxDesc").on("keyup", "input[name='product_quantity[]']", function() {
        calculateInlineTotal();
      });
      $("#boxDesc").on("keyup", "input[name='price[]']", function() {
        calculateInlineTotal();
      });
    })
  </script>

  <script>
    document.getElementById("submit-button-id").addEventListener("click", function(event) {
      if($("#invoice-form")[0].checkValidity()) {
        var phoneNumber = document.getElementById("sh_ph_no").value;
        if (phoneNumber.trim() !== "") {
          var latestId = "LPIC5000<?php echo $latestId; ?>";
          var whatsappLink = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=Hello,%20Tracking%20ID%20is%20${latestId}%20Track%20here,%20https://www.laxmipatiinternational.com/track.php?id=${latestId}`;
          var whatsappWindow = window.open(whatsappLink, '_blank');
          document.getElementById("submit-button").click(); // Re  place "submit-button-id" with the actual ID of your submit button
        } else {
          alert("Please enter a valid phone number.");
          event.preventDefault(); // Prevent the default form submission
        }
      } else {
        document.getElementById("submit-button").click(); // Re  place "submit-button-id" with the actual ID of your submit button
      }
    });
  </script>




  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://goexbox.com/assets/agent/js/custom/crud.js" type="text/javascript"></script>
  <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999; top: 330.6px; left: 218.65px; width: 402.85px;"></div>
  <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
  <div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
  <div id="pip-toast"></div>
</body>

</html>