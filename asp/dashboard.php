<?php
session_start();
@include 'config.php';

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

?>

<html lang="en" class=" js no-touch csstransforms3d csstransitions js no-touch csstransforms3d csstransitions">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta charset="utf-8">
<title>Dashboard | Laxmipati</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
<link rel="apple-touch-icon" href="https://goexbox.com/assets/agent/pages/ico/60.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://goexbox.com/assets/user//img/master/logo.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://goexbox.com/assets/user//img/master/logo.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://goexbox.com/assets/user//img/master/logo.png">
<link rel="icon" type="image/x-icon" href="favicon.ico">
<link rel="icon" href="lp.png">
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
    }
    .dj .rj .top img.logo{
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
    .fa-solid{
        color:white;
    }
    .profile{
        width:80px;
        height:80px;
        border-radius:50%;
    }
</style>
<script src="https://goexbox.com/assets/agent/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/4/common.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/4/util.js"></script><style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/8/common.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/8/util.js"></script></head>
<body class="fixed-header horizontal-menu horizontal-app-menu dashboard windows desktop js-focus-visible  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<style>
      .horizontal-menu .header-navbar.navbar-brand-center .navbar-header .navbar-brand .brand-logo img {
        max-width: 140px;
      }
    </style>
    
     <div class="dj">
        <div class="rj">
            <div class="top">
                <img src="logo.png" alt="" class="logo">
                <h2><?php echo $admin_username; ?></h2>
                <img src="<?php echo $profilepicture ; ?>" class="profile" width="80" height="80">
            </div>
            <div class="bottom">
                <ul class="a">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="aspget_booking.php">Booking</a></li>
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



<div class="container sm-padding-10 no-padding" style="margin-top:50px;">
<div class="row md-m-b-10 pl-5 pr-5">
<div class="col-md-3">
<div class=" card   no-margin widget-loader-circle todolist-widget pending-projects-widget">
<div class="card-body">

<div class="p-t-15">
<div class="d-flex">
<span class="icon-thumbnail bg-warning-light pull-left " style="background-color:#34188d"><i class="fa-solid fa-tent-arrow-left-right"></i></span>
<div class="flex-1 full-width overflow-ellipsis">
<p class="hint-text all-caps font-montserrat fs-11 no-margin overflow-ellipsis ">Booked</p>

<?php
                              $sql = "SELECT COUNT(*) AS status_count 
                                FROM `order_details` 
                                WHERE `status` = 'BOOKED' AND `user_name` = '$admin_username'";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  $row = mysqli_fetch_assoc($result);
                                  $statusCount = $row['status_count'];

                                  echo "<h5 class='no-margin overflow-ellipsis '>$statusCount</h5>";
                              } else {
                                  echo "Error in fetching data: " . mysqli_error($conn);
                              }
                          ?>
</div>
</div>
<div class="m-t-15">


<div class="clearfix"></div>
</div>
<div class="progress progress-small m-b-15 m-t-10">
<div class="progress-bar progress-bar-success" style="width:<?php echo $statusCount; ?>%"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class=" card   no-margin widget-loader-circle todolist-widget pending-projects-widget">
<div class="card-body">

<div class="p-t-15">
<div class="d-flex">
<span class="icon-thumbnail bg-warning-light pull-left " style="background-color:#89c337"><i class="fa-solid fa-droplet"></i></span>
<div class="flex-1 full-width overflow-ellipsis">
<p class="hint-text all-caps font-montserrat fs-11 no-margin overflow-ellipsis ">In Transit</p>
<?php
                                $sql = "SELECT COUNT(*) AS status_count 
                                FROM `order_details` 
                                WHERE `status` = 'IN TRANSIT' AND `user_name` = '$admin_username'";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  $row = mysqli_fetch_assoc($result);
                                  $statusCount = $row['status_count'];

                                  echo "<h5 class='no-margin overflow-ellipsis '>$statusCount</h5>";
                              } else {
                                  echo "Error in fetching data: " . mysqli_error($conn);
                              }
                          ?>
</div>
</div>
<div class="m-t-15">


<div class="clearfix"></div>
</div>
<div class="progress progress-small m-b-15 m-t-10">
<div class="progress-bar progress-bar-success" style="width:<?php echo $statusCount; ?>%"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class=" card   no-margin widget-loader-circle todolist-widget pending-projects-widget">
<div class="card-body">

<div class="p-t-15">
<div class="d-flex">
<span class="icon-thumbnail bg-warning-light pull-left " style="background-color:#717171"><i class="fa-solid fa-paper-plane"></i></span>
<div class="flex-1 full-width overflow-ellipsis">
<p class="hint-text all-caps font-montserrat fs-11 no-margin overflow-ellipsis ">Out For Delivery</p>
<?php
                              $sql = "SELECT COUNT(*) AS status_count 
                                FROM `order_details` 
                                WHERE `status` = 'OUT FOR DELIVERY' AND `user_name` = '$admin_username'";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  $row = mysqli_fetch_assoc($result);
                                  $statusCount = $row['status_count'];

                                  echo "<h5 class='no-margin overflow-ellipsis '>$statusCount</h5>";
                              } else {
                                  echo "Error in fetching data: " . mysqli_error($conn);
                              }
                          ?>
</div>
</div>
<div class="m-t-15">


<div class="clearfix"></div>
</div>
<div class="progress progress-small m-b-15 m-t-10">
<div class="progress-bar progress-bar-success" style="width:<?php echo $statusCount; ?>%"></div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3">
<div class=" card   no-margin widget-loader-circle todolist-widget pending-projects-widget">
<div class="card-body">

<div class="p-t-15">
<div class="d-flex">
<span class="icon-thumbnail bg-success-light pull-left "><i class="fa-solid fa-right-long"></i></span>
<div class="flex-1 full-width overflow-ellipsis">
<p class="hint-text all-caps font-montserrat fs-11 no-margin overflow-ellipsis ">Delivered</p>
<?php
                              $sql = "SELECT COUNT(*) AS status_count 
                                FROM `order_details` 
                                WHERE `status` = 'DELIVERED' AND `user_name` = '$admin_username'";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  $row = mysqli_fetch_assoc($result);
                                  $statusCount = $row['status_count'];

                                  echo "<h5 class='no-margin overflow-ellipsis '>$statusCount</h5>";
                              } else {
                                  echo "Error in fetching data: " . mysqli_error($conn);
                              }
                          ?>
</div>
</div>
<div class="m-t-15">


<div class="clearfix"></div>
</div>
<div class="progress progress-small m-b-15 m-t-10">
<div class="progress-bar progress-bar-success" style="width:<?php echo $statusCount; ?>%"></div>
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

      
<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="fs-1">Welcome <?php echo $admin_username; ?></h1>
    <h5>Branch: <?php echo $branchname; ?></h5>
    <h5>Contact No: <?php echo $usernumber; ?></h5>
    <h5>Address: <?php echo $address; ?></h5>
    <h5>AadharCard Number: <?php echo $aadharcardnumber; ?></h5>
    <h5>PAN Card Number: <?php echo $pancardnumber; ?></h5>
        </div>
        <div class="col-lg-4">
            <div class=" card   no-margin widget-loader-circle todolist-widget pending-projects-widget">
<div class="card-body">

<div class="p-t-15">
<div class="d-flex">
    <span class="icon-thumbnail bg-success-light pull-left "><i class="fa-solid fa-money-check-dollar"></i></span>
<div class="flex-1 full-width overflow-ellipsis">
<p class="hint-text all-caps font-montserrat fs-11 no-margin overflow-ellipsis ">Total Due Payment</p>
            <?php
// Database connection code here

// SQL query to calculate the total dpayment
$query = "SELECT SUM(dpayment) AS total_dpayment FROM payments WHERE user_name = '$admin_username'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_dpayment = $row['total_dpayment'];

    // Display the total dpayment value
    echo "$total_dpayment";
} else {
    // Handle the query error
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
</div>
</div>
 </div>
 </div>
 </div>
        </div>
        
        
    </div>
</div>               
                          


<script src="https://goexbox.com/assets/agent/plugins/feather-icons/feather.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/pace/pace.min.js" type="text/javascript"></script>

<script src="https://goexbox.com/assets/agent/plugins/liga.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="https://goexbox.com/assets/agent/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="https://goexbox.com/assets/agent/plugins/classie/classie.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/lib/d3.v3.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/nv.d3.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/src/utils.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/src/tooltip.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/src/interactiveLayer.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/src/models/axis.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/src/models/line.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/nvd3/src/models/lineWithFocusChart.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/mapplic/js/hammer.min.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/mapplic/js/jquery.mousewheel.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/mapplic/js/mapplic.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/rickshaw/rickshaw.min.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/skycons/skycons.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/moment/moment.min.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="https://goexbox.com/assets/agent/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="https://goexbox.com/assets/agent/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="https://goexbox.com/assets/agent/plugins/datatables-responsive/js/lodash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>


<script src="https://goexbox.com/assets/agent/pages/js/pages.min.js"></script>



<script src="https://goexbox.com/assets/agent/js/scripts.js" type="text/javascript"></script>

<script>
  $('#financial_year').on('change', function() {
    // alert( this.value );
    $.post("agent//dashboard/setYear", {
            'year': this.value
        },
        function(data, status) {
            //alert("Data: " + data + "\nStatus: " + status);
            location.reload();
        });
  });
  $('#financial_year1').on('change', function() {
    // alert( this.value );
    $.post("agent//dashboard/setYear", {
            'year': this.value
        },
        function(data, status) {
            //alert("Data: " + data + "\nStatus: " + status);
            location.reload();
        });
  });
</script>

<script src="https://goexbox.com/assets/agent/js/custom/crud.js" type="text/javascript"></script>

<script>
		$(document).ready(function() {
			add_url = "agent/dashboard/ajax_add";
			edit_url = "agent/dashboard/ajax_edit";
			update_url = "agent/dashboard/ajax_update";
			delete_url = "agent/dashboard/ajax_delete";
			var list_url = "agent/dashboard/ajax_list";
			table = datatableCall(list_url);

			$("form").attr('autocomplete', 'off');
		});
	</script>

<div id="pip-toast"></div><div id="pip-toast"></div></body></html>