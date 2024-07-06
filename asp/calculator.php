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
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/10/common.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/10/util.js"></script>
</head>

<body class="fixed-header horizontal-menu horizontal-app-menu dashboard  windows desktop js-focus-visible pace-done">
  <div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
  </div>
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
        <img src="<?php echo $profilepicture; ?>" class="profile">
      </div>
      <div class="bottom">
        <ul class="a">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="aspget_booking.php">Booking</a></li>
          <li><a href="allorder.php">All Booking</a></li>
          <li><a href="calculator.php">Rate Calculator</a></li>
          <li><a href="payment.php">Payment</a></li>
          <?php
          if ($admin_username == 'admin') {
            // Display the "All Branch" option for the admin user
            echo '<li><a href="addbranch.php">All Branch</a></li>';
            echo '<li><a href="allbranchbooking.php">All Branch Booking</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="page-container " data-select2-id="select2-data-12-n9m3">
    <div class="page-content-wrapper " data-select2-id="select2-data-11-qx8i">
      <div class="content " data-select2-id="select2-data-10-e7qf" style="margin-top:60px;">

        <div class=" container p-t-30   container-fixed-lg" data-select2-id="select2-data-9-z0h7">


          <form role="form" autocomplete="off" enctype="multipart/form-data" method="post" id="formOrder" data-select2-id="select2-data-formOrder">
            <div class="row" data-select2-id="select2-data-8-jd33">
              <div class="col-md-12 " data-select2-id="select2-data-7-x5xe">

                <div class="card" data-select2-id="select2-data-6-qzqr">
                  <div class="card-header ">
                    <div class="card-title">Search Information</div>
                  </div>
                  <div class="card-body" data-select2-id="select2-data-5-l0xj">
                    <div class="form-group-attached" data-select2-id="select2-data-4-p6xh">
                      <div class="row clearfix">
                        <!-- <label class="col-md-1 col-sm-3 col-form-label">Shipment Type</label> -->
                        <!-- <div class="col-md-1 col-sm-3">
    <div class="kt-radio-list"> -->
                        <!-- <label class="kt-radio kt-radio--brand">
    <input id="yes2" type="radio" name="document_type_id" value="1">
    Doc
    <span></span>
    </label> -->
                        <br>
                        <!-- <label class="kt-radio  kt-radio--brand">
    <input id="no2" type="radio" name="document_type_id" value="2" checked="checked"> Non Doc
    <span></span>
    </label> -->
                        <!-- </div>
    </div> -->

                        <div class="col-sm-4">
                          <div class="form-group required">

                            <select name="country" style="width:100%;height:36px;">
                              <option value="AF">AF - Afghanistan</option>
                              <option value="EUR">EUR - Aland Island (Finland)</option>
                              <option value="AL">AL - Albania</option>
                              <option value="DZ">DZ - Algeria</option>
                              <option value="AS">AS - American Samoa</option>
                              <option value="AD">AD - Andorra</option>
                              <option value="AO">AO - Angola</option>
                              <option value="AI">AI - Anguilla</option>
                              <option value="AQ">AQ - Antarctica</option>
                              <option value="AG">AG - Antigua</option>
                              <option value="ANB">ANB - Antigua and Barbuda</option>
                              <option value="AR">AR - Argentina</option>
                              <option value="AM">AM - Armenia</option>
                              <option value="AM">AM - Armenia</option>
                              <option value="AW">AW - Aruba</option>
                              <option value="AU">AU - Australia</option>
                              <option value="AUB">AUB - Australia BEYOND</option>
                              <option value="AT">AT - Austria</option>
                              <option value="AZ">AZ - Azerbaijan</option>
                              <option value="BS">BS - Bahamas</option>
                              <option value="BH">BH - Bahrain</option>
                              <option value="BD">BD - Bangladesh</option>
                              <option value="BDD">BDD - Bangladesh DDP (Duty Paid)</option>
                              <option value="BB">BB - Barbados</option>
                              <option value="BY">BY - Belarus</option>
                              <option value="BE">BE - Belgium</option>
                              <option value="BZ">BZ - Belize</option>
                              <option value="BJ">BJ - Benin</option>
                              <option value="BM">BM - Bermuda</option>
                              <option value="BT">BT - Bhutan</option>
                              <option value="BO">BO - Bolivia</option>
                              <option value="BQ">BQ - Bonaire</option>
                              <option value="BX">BX - Bosnia</option>
                              <option value="BA">BA - Bosnia and Herzegovina</option>
                              <option value="BW">BW - Botswana</option>
                              <option value="BWG">BWG - Botswana (Gaborone)</option>
                              <option value="BV">BV - Bouvet Island</option>
                              <option value="BR">BR - Brazil</option>
                              <option value="IO">IO - British Indian Ocean Territory</option>
                              <option value="BN">BN - Brunei</option>
                              <option value="BG">BG - Bulgaria</option>
                              <option value="BF">BF - Burkina Faso</option>
                              <option value="BI">BI - Burundi</option>
                              <option value="KH">KH - Cambodia</option>
                              <option value="CM">CM - Cameroon</option>
                              <option value="CA">CA - CANADA</option>
                              <option value="IC">IC - Canary Islands</option>
                              <option value="CV">CV - Cape Verde</option>
                              <option value="KY">KY - Cayman Islands</option>
                              <option value="CF">CF - Central African Republic</option>
                              <option value="TD">TD - Chad</option>
                              <option value="CHI">CHI - Channel Island</option>
                              <option value="CL">CL - Chile</option>
                              <option value="CN">CN - China</option>
                              <option value="ROC">ROC - China SOUTH</option>
                              <option value="CX">CX - Christmas Island</option>
                              <option value="CC">CC - Cocos (Keeling) Islands</option>
                              <option value="CO">CO - Colombia</option>
                              <option value="KM">KM - Comoros</option>
                              <option value="CG">CG - Congo</option>
                              <option value="COB">COB - Congo (Brazzaville)</option>
                              <option value="CK">CK - Cook Islands</option>
                              <option value="CR">CR - Costa Rica</option>
                              <option value="AFR">AFR - Cote d'Ivoire</option>
                              <option value="HR">HR - Croatia</option>
                              <option value="CU">CU - Cuba</option>
                              <option value="CW">CW - Curacao</option>
                              <option value="CY">CY - Cyprus</option>
                              <option value="CZ">CZ - Czech Republic</option>
                              <option value="CD">CD - Democratic Republic Of Congo</option>
                              <option value="DK">DK - Denmark</option>
                              <option value="DJ">DJ - Djibouti</option>
                              <option value="DM">DM - Dominica</option>
                              <option value="DO">DO - Dominican Republic</option>
                              <option value="TP">TP - East Timor</option>
                              <option value="EC">EC - Ecuador</option>
                              <option value="EG">EG - Egypt</option>
                              <option value="SV">SV - El Salvador</option>
                              <option value="ER">ER - Eritrea</option>
                              <option value="EE">EE - Estonia</option>
                              <option value="ET">ET - Ethiopia</option>
                              <!-- <option value="Faeroe Islands">- Faeroe Islands</option> -->
                              <option value="FK">FK - Falkland Islands</option>
                              <option value="FO">FO - Faroe Islands</option>
                              <option value="FJ">FJ - Fiji</option>
                              <option value="FI">FI - Finland</option>
                              <option value="FR">FR - France</option>
                              <option value="GF">GF - French Guiana</option>
                              <option value="PF">PF - French Polynesia</option>
                              <option value="TF">TF - French Southern Territories</option>
                              <option value="GA">GA - Gabon</option>
                              <option value="GM">GM - Gambia</option>
                              <option value="GE">GE - Georgia</option>
                              <option value="DE">DE - Germany</option>
                              <option value="GH">GH - Ghana</option>
                              <option value="GI">GI - Gibraltar</option>
                              <option value="GR">GR - Greece</option>
                              <option value="GL">GL - Greenland</option>
                              <option value="GD">GD - Grenada</option>
                              <option value="GP">GP - Guadeloupe</option>
                              <option value="GU">GU - Guam</option>
                              <option value="GT">GT - Guatemala</option>
                              <option value="GG">GG - Guernsey</option>
                              <option value="GN">GN - Guinea</option>
                              <option value="GW">GW - Guinea Bissau</option>
                              <option value="GQ">GQ - Guinea Equatorial</option>
                              <option value="GY">GY - Guyana</option>
                              <option value="HT">HT - Haiti</option>
                              <option value="HM">HM - Heard and McDonald Islands</option>
                              <option value="HN">HN - Honduras</option>
                              <option value="HK">HK - Hong Kong</option>
                              <option value="HU">HU - Hungary</option>
                              <option value="IS">IS - Iceland</option>
                              <option value="IN">IN - India</option>
                              <option value="ID">ID - Indonesia</option>
                              <option value="IR">IR - Iran</option>
                              <option value="IQ">IQ - Iraq</option>
                              <option value="IE">IE - Ireland</option>
                              <option value="Isl">Isl - Isle of Wight</option>
                              <option value="IL">IL - Israel</option>
                              <option value="IT">IT - Italy</option>
                              <option value="CI">CI - Ivory Coast</option>
                              <option value="JM">JM - Jamaica</option>
                              <option value="JP">JP - Japan</option>
                              <option value="XJ">XJ - Jersey</option>
                              <option value="JO">JO - Jordan</option>
                              <option value="KZ">KZ - Kazakhstan</option>
                              <option value="KE">KE - Kenya</option>
                              <option value="KED">KED - Kenya DDP (Duty Paid)</option>
                              <option value="KI">KI - Kiribati</option>
                              <option value="XK">XK - Kosovo</option>
                              <option value="KW">KW - Kuwait</option>
                              <option value="KG">KG - Kyrgyzstan</option>
                              <option value="NGL">NGL - Lagos</option>
                              <option value="LA">LA - Laos</option>
                              <option value="LV">LV - Latvia</option>
                              <option value="LB">LB - Lebanon</option>
                              <option value="LS">LS - Lesotho</option>
                              <option value="LSM">LSM - Lesotho (Maseru)</option>
                              <option value="LR">LR - Liberia</option>
                              <option value="LY">LY - Libya</option>
                              <option value="LI">LI - Liechtenstein</option>
                              <option value="LT">LT - Lithuania</option>
                              <option value="LU">LU - Luxembourg</option>
                              <option value="MO">MO - Macau</option>
                              <option value="MK">MK - Macedonia</option>
                              <option value="MG">MG - Madagascar</option>
                              <option value="MW">MW - Malawi</option>
                              <option value="MWL">MWL - Malawi (Lilongwe)</option>
                              <option value="MY">MY - Malaysia</option>
                              <option value="MV">MV - Maldives</option>
                              <option value="ML">ML - Mali</option>
                              <option value="MT">MT - Malta</option>
                              <option value="MH">MH - Marshall Islands</option>
                              <option value="MQ">MQ - Martinique</option>
                              <option value="MR">MR - Mauritania</option>
                              <option value="MU">MU - Mauritius</option>
                              <option value="YT">YT - Mayotte</option>
                              <!-- <option value="Melilla">- Melilla</option> -->
                              <option value="MX">MX - Mexico</option>
                              <option value="FM">FM - Micronesia</option>
                              <option value="MD">MD - Moldova</option>
                              <option value="MC">MC - Monaco</option>
                              <option value="MN">MN - Mongolia</option>
                              <option value="ME">ME - Montenegro, Republic of</option>
                              <option value="MS">MS - Montserrat</option>
                              <option value="MA">MA - Morocco</option>
                              <option value="MZ">MZ - Mozambique</option>
                              <option value="MZM">MZM - Mozambique (Maputo)</option>
                              <option value="MM">MM - Myanmar</option>
                              <option value="NA">NA - Namibia</option>
                              <option value="NAW">NAW - Namibia (Windhoek)</option>
                              <option value="NR">NR - Nauru</option>
                              <option value="NP">NP - Nepal</option>
                              <option value="NL">NL - Netherlands</option>
                              <option value="NEH">NEH - Netherlands (Holland)</option>
                              <option value="AN">AN - Netherlands Antilles</option>
                              <option value="XN">XN - NEVIS</option>
                              <option value="KN">KN - Nevis</option>
                              <option value="NC">NC - New Caledonia</option>
                              <option value="NZ">NZ - New Zealand</option>
                              <option value="NI">NI - Nicaragua</option>
                              <option value="NE">NE - Niger</option>
                              <option value="NG">NG - Nigeria</option>
                              <option value="NGL">NGL - Nigeria - Lagos</option>
                              <option value="NGD">NGD - Nigeria - Lagos (Duty Paid)</option>
                              <option value="NU">NU - Niue</option>
                              <option value="NF">NF - Norfolk Island</option>
                              <option value="KP">KP - North Korea</option>
                              <option value="NIR">NIR - Northern Ireland</option>
                              <option value="NO">NO - Norway</option>
                              <option value="US">USA - NY / NJ - United States Of America</option>
                              <option value="OM">OM - Oman</option>
                              <option value="PK">PK - Pakistan</option>
                              <option value="PW">PW - Palau</option>
                              <option value="PS">PS - Palestine Authority</option>
                              <option value="PA">PA - Panama</option>
                              <option value="PG">PG - Papua new Guinea</option>
                              <option value="PY">PY - Paraguay</option>
                              <option value="PE">PE - Peru</option>
                              <option value="PH">PH - Philippines</option>
                              <option value="PN">PN - Pitcairn Island</option>
                              <option value="PL">PL - Poland</option>
                              <option value="PT">PT - Portugal</option>
                              <option value="PR">PR - Puerto Rico</option>
                              <option value="QA">QA - Qatar</option>
                              <option value="ROW">ROW - REST OF WORLD</option>
                              <option value="RE">RE - Reunion Island</option>
                              <option value="RO">RO - Romania</option>
                              <option value="RU">RU - Russia</option>
                              <option value="RUB">RUB - RUWI</option>
                              <option value="RW">RW - Rwanda</option>
                              <option value="PM">PM - Saint Pierre and Miquelon</option>
                              <option value="MP">MP - Saipan</option>
                              <option value="WS">WS - Samoa</option>
                              <option value="SM">SM - San Marino</option>
                              <option value="ST">ST - Sao Tome and Principe</option>
                              <option value="SA">SA - Saudi Arabia</option>
                              <option value="SCT">SCT - Scotland</option>
                              <option value="SN">SN - Senegal</option>
                              <option value="RS">RS - Serbia</option>
                              <option value="SC">SC - Seychelles</option>
                              <option value="SL">SL - Sierra Leone</option>
                              <option value="SG">SG - Singapore</option>
                              <option value="SK">SK - Slovakia</option>
                              <option value="SI">SI - Slovenia</option>
                              <option value="XG">XG - Smaller Territories of the UK</option>
                              <option value="SB">SB - Solomon Islands</option>
                              <option value="SO">SO - Somalia</option>
                              <option value="SML">SML - Somaliland</option>
                              <option value="ZA">ZA - South Africa</option>
                              <option value="ZAD">ZAD - South Africa - DDP</option>
                              <option value="KR">KR - South Korea</option>
                              <option value="SS">SS - South Sudan</option>
                              <option value="ES">ES - Spain</option>
                              <option value="LK">LK - Sri Lanka</option>
                              <option value="LKD">LKD - Sri Lanka DDP (Duty Paid)</option>
                              <option value="XY">XY - St. Barthelemy</option>
                              <option value="XE">XE - St. Eustatius</option>
                              <option value="SH">SH - St. Helena</option>
                              <option value="KN">KN - St. Kitts And Nevis</option>
                              <option value="LC">LC - St. Lucia</option>
                              <option value="SX">SX - St. Maarten</option>
                              <option value="VC">VC - St. Vincent</option>
                              <option value="SD">SD - Sudan</option>
                              <option value="SR">SR - Suriname</option>
                              <option value="SJ">SJ - Svalbard And Jan Mayen Islands</option>
                              <option value="SZ">SZ - Swaziland</option>
                              <option value="SZM">SZM - Swaziland (Mbabane)</option>
                              <option value="SE">SE - Sweden</option>
                              <option value="CH">CH - Switzerland</option>
                              <option value="SY">SY - Syria</option>
                              <option value="PF">PF - Tahiti</option>
                              <option value="TW">TW - Taiwan</option>
                              <option value="TJ">TJ - Tajikistan</option>
                              <option value="TZ">TZ - Tanzania</option>
                              <option value="TZD">TZD - Tanzania (Dar es Salaam)</option>
                              <option value="TH">TH - Thailand</option>
                              <option value="TG">TG - Togo</option>
                              <option value="TK">TK - Tokelau</option>
                              <option value="TO">TO - Tonga</option>
                              <option value="TT">TT - Trinidad &amp; Tobago</option>
                              <option value="TN">TN - Tunisia</option>
                              <option value="TR">TR - Turkey</option>
                              <option value="TM">TM - Turkmenistan</option>
                              <option value="TC">TC - Turks &amp; Caicos Islands</option>
                              <option value="TV">TV - Tuvalu</option>
                              <option value="UG">UG - Uganda</option>
                              <option value="UGD">UGD - Uganda - DDP</option>
                              <option value="UA">UA - Ukraine</option>
                              <option value="AE">AE - United Arab Emirates</option>
                              <!-- <option value="AE">AE - United Arab Emirates (DDP)</option> -->
                              <option value="GB">GB - United Kingdom</option>
                              <option value="GBD">GBD - United Kingdom DDP (Duty Paid)</option>
                              <option value="US">US - United States Of America</option>
                              <option value="UY">UY - Uruguay</option>
                              <option value="UZ">UZ - Uzbekistan</option>
                              <option value="VU">VU - Vanuatu</option>
                              <option value="VA">VA - Vatican City State (Holy See)</option>
                              <option value="VE">VE - Venezuela</option>
                              <option value="VN">VN - Vietnam</option>
                              <option value="VG">VG - Virgin Islands (British)</option>
                              <option value="VI">VI - Virgin Islands (United States)</option>
                              <option value="WF">WF - Wallis And Futuna Islands</option>
                              <option value="EH">EH - Western Sahara</option>
                              <option value="YE">YE - Yemen</option>
                              <option value="YU">YU - Yugoslavia</option>
                              <option value="ZM">ZM - Zambia </option>
                              <option value="ZML">ZML - Zambia (Lusaka)</option>
                              <option value="ZW">ZW - Zimbabwe</option>
                            </select>

                          </div>
                        </div>

                        <!-- <div class="col-sm-3">
    <div class="form-group required">
    
    <input id="weight" type="text" placeholder="Shipment Weight" class="form-control" name="weight" readonly="" required="">
    </div>
    </div> -->
                        <div class="col-sm-3">
                          <div class="form-group ">
                            <!-- <input type="date" id="dateInput" name="order_currier_date" class="form-control form-control-sm"> -->
                            <input class="form-control" placeholder="Courier Date" name="order_currier_date" id="order_currier_date" type="date" required="">
                          </div>
                        </div>
                      </div>
                      <div class="row clearfix" id="nobd">
                        <div class="col-2">
                          <label>No of Pcs</label>
                          <div class="form-group">
                            <input type="text" placeholder="No Of Box" class="form-control" value="1" name="nob" id="nob">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label style="font-size: 12px;">Act.Weight(1)</label>
                            <input name="actual-weight" class="form-control" type="text">
                          </div>
                        </div>
                      </div>
                      <div class="row clearfix" id="nobd1">
                        <div class="col-10">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="">
                      <button type="submit" value="Submit" class="btn btn-primary btn-lg">Get
                        Rate</button>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-12">

                <div class="card height-equal" style="margin-top:20px">

                  <div class="card-body" style="padding:10px !important" id="user_rate">
                    <p class="text-center">Please Fill Booking Details</p>
                    <table class="table" id="result_table" class="display">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Code</th>
                          <th>Weight</th>
                          <!-- <th>Rate/kg</th> -->
                          <th>Rate (GST)</th>
                          <!-- <th>Amount</th> -->
                          <th>IGST</th>
                          <!-- <th>CGST</th>
                          <th>SGST</th> -->
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>

                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
      <script type="text/javascript">
        function volumeweight() {

          var height = document.getElementsByName('height[]');
          var width = document.getElementsByName('width[]');
          var length = document.getElementsByName('length[]');
          var weightv = document.getElementsByName('weightv[]');
          var weightb = document.getElementsByName('weightb[]');
          for (var i = 0; i < height.length; i++) {
            var h = height[i].value;
            var w = width[i].value;
            var l = length[i].value;
            weightv[i].value = Math.round((h * w * l / 5000) * 1000) / 1000;
            //alert("weight="+calc);
          }
          sumweight();

        }

        function volumeweightDiscount() {
          var sum = 0;
          //iterate through each textboxes and add the values
          var discount = 100 - volumetric_weight_discount;
          var weightb = document.getElementsByName('weightb[]');
          var weightv = document.getElementsByName('weightv[]');
          var weightbTotal = 0;
          var weightvTotal = 0;
          for (var i = 0; i < weightb.length; i++) {
            //add only if the value is number
            weightbTotal += parseFloat(weightb[i].value);
            weightvTotal += parseFloat(weightv[i].value);

          }
          if (weightbTotal < weightvTotal) {
            var weightcounting = weightvTotal - weightbTotal;
            var discountedweightcounting = (weightcounting * discount) / 100;
            var finalweight = discountedweightcounting + weightbTotal;
            //alert(finalweight);
            if (isNaN(finalweight))
              volumeweight();
            else
              $('input[name="weight"]').val(Math.round(finalweight * 10) / 10);
          } else {
            alert("Act. Weight is greater than Vol. Weight so discount is not applicable.");
            volumeweight();
            $('#vol_discount').val("");
          }
        }

        $(document).ready(function() {
          function setTodayDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            var todayString = yyyy + '-' + mm + '-' + dd;
            document.getElementById('order_currier_date').value = todayString;
          }
          setTodayDate();

          $("#error").hide();
          $("#user_id").select2();
          $("#user_id").focus();
          $("#country_id").select2();


          $('#formOrder').submit(function(event) {
            event.preventDefault();
            const actualWeight = $('input[name="actual-weight"]').val();
            var radioValue1 = $("input:radio[name=booking_type]:checked").val();
            var ocd1 = $("#order_currier_date").val();
            if (ocd1 == null || ocd1 == "") {
              alert("Please enter Currier Date");
              return false;
            } else {
              let data = {};
              $.each(this, function(i, v) {
                const input = $(v);
                data[input.attr("name")] = input.val();
                delete data["undefined"];
              });

              const formData = new FormData();
              formData.append('product_code', 'NONDOX');
              formData.append('destination_code', data?.country);
              formData.append('booking_date', data?.order_currier_date); // yyyy-mm-dd format
              formData.append('origin_code', 'IN');
              formData.append('pcs', data?.nob);
              formData.append('actual_weight', actualWeight);
              formData.append('customer_code', '1040');
              formData.append('username', 'bGF4bWlwYXRpLmludDEyM0BnbWFpbC5jb20=');
              formData.append('password', 'U0FJTlheI14zMzMyMQ==');

              jQuery.ajax({
                url: 'http://admin.sain.in/docket_api/customer_rate_cals?api_company_id=26',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                  const resultData = JSON.parse(result ?? "{}");
                  var tableBody = $("#result_table tbody");
                  if (resultData?.data) {
                    tableBody.empty();
                    $.each(resultData?.data, function(key, value) {
                      var row = $("<tr>");
                      const rateWoGST = value?.per_kg - (value?.per_kg * 18 / 118);
                      const finalRate = Math.round(rateWoGST + (rateWoGST * 15 / 100));
                      const finalRateWithGST = Math.round(finalRate + (finalRate * 18 / 100));
                      const totalAmt = Math.round(value?.weight * finalRate);
                      const igst = Math.round(totalAmt * (18 / 100));
                      row.append($("<td>").text(value?.id));
                      row.append($("<td>").text(value?.code));
                      row.append($("<td>").text(value?.weight));
                      // row.append($("<td>").text(finalRate));
                      row.append($("<td>").text(finalRateWithGST));
                      // row.append($("<td>").text(totalAmt));
                      row.append($("<td>").text(igst));
                      // row.append($("<td>").text(value?.cgst));
                      // row.append($("<td>").text(value?.sgst));
                      row.append($("<td>").text(Math.round(finalRateWithGST * value?.weight)));
                      tableBody.append(row);
                    });
                  } else {
                    tableBody.append("<tr><td colSpan='12' align='center'>No Rate Found</td></tr>");
                  }
                },
                error: function(result) {
                  alert(result.responseText);
                }
              });
            }
            /* } */
          });
          $("input[name=document_type_id][value=2]").prop('checked', true).trigger('change');


          $("#ibox").html("");
          // addField(1);
          $('input[name="weightb[]"]').keyup(function() {
            volumeweight();
          });
          $('input[name="height[]"]').keyup(function() {
            volumeweight();
          });
          $('input[name="length[]"]').keyup(function() {
            volumeweight();
          });
          $('input[name="width[]"]').keyup(function() {
            volumeweight();
          });
          $('input[name="vol_discount"]').keyup(function() {
            volumeweightDiscount();
          });
          $('#nob').on('changed keyup paste', function() {
            $("#ibox").html("");
            var v = $(this).val();
            if (v == "")
              v = 1;
            // addField(v);
            $('input[name="weightb[]"]').keyup(function() {
              volumeweight();
            });
            $('input[name="height[]"]').keyup(function() {
              volumeweight();
            });
            $('input[name="length[]"]').keyup(function() {
              volumeweight();
            });
            $('input[name="width[]"]').keyup(function() {
              volumeweight();
            });
          });
          $('input[name=document_type_id]').change(function() {
            var radioValue = $("input:radio[name=document_type_id]:checked").val();
            //alert(radioValue);
            if (radioValue == 1) {
              $("#nobd").hide();
              $("#nobd1").hide();
              $("#dimentiond").hide();
              $("#hr1").hide();
              $("#hr2").hide();
              $("#ibox").html("");
              // addField(1);
              $("input[name='height[]']").val('1');
              $("input[name='width[]']").val('1');
              $("input[name='length[]']").val('1');
              $("input[name='weightb[]']").val('0');
              $("#weight").prop('readonly', false);
            }
            if (radioValue == 2) {
              $("#nobd").show();
              $("#nobd1").show();
              $("#dimentiond").show();
              $("#hr1").show();
              $("#hr2").show();
              $("input[name='height[]']").val('');
              $("input[name='width[]']").val('');
              $("input[name='length[]']").val('');
              $("input[name='weightb[]']").val('');
              $("#weight").prop('readonly', true);
              $("#weight").val('');
              $("#ibox").html("");
              // addField(1);
              $('#nob').val(1);
            }
          });

          function addField(id) {
            for (i = 1; i <= id; ++i) {
              $("#ibox").append(
                '<div class="col-md-3"><div class="form-group"><label style="font-size: 12px;">Act.Weight(' +
                i +
                ')</label><input name="weightb[]" class="form-control form-control" type="text"></div></div><div class="col-md-2 "><div class="form-group ">')
              // <input name="length[]" class="form-control form-control" type="text"></div></div><div class="col-md-2 "><div class="form-group "><label>Width(' +
              // i +
              // ')</label><input name="width[]" class="form-control form-control" type="text"></div></div><div class="col-md-2 "><div class="form-group "><label>Height(' +
              // i +
              // ')</label><input name="height[]" class="form-control form-control" type="text"></div></div><div class="col-md-3"><div class="form-group "><label>Vol. Weight (' +
              // i +
              // ')</label><input name="weightv[]" class="form-control form-control" type="text"  readonly tabindex="-1"></div></div>'
              // );
            }
            $('input[name="weightb[]"]').keyup(function() {
              volumeweight();
            });
            $('input[name="height[]"]').keyup(function() {
              volumeweight();
            });
            $('input[name="length[]"]').keyup(function() {
              volumeweight();
            });
            $('input[name="width[]"]').keyup(function() {
              volumeweight();
            });
          }

        });

        function sumweight() {
          var sum = 0;
          //iterate through each textboxes and add the values
          var weightb = document.getElementsByName('weightb[]');
          var weightv = document.getElementsByName('weightv[]');
          for (var i = 0; i < weightb.length; i++) {
            //add only if the value is number
            if (parseFloat(weightb[i].value) > parseFloat(weightv[i].value)) {
              sum += parseFloat(weightb[i].value);
              //console.log(weightb[i].value+"-"+weightv[i].value);
            } else {
              sum += parseFloat(weightv[i].value);
              //console.log(weightv[i].value+"-"+weightb[i].value);
            }
          }

          $('input[name="weight"]').val(Math.round(sum * 1000) / 1000);
        }

        // $('#country_id').change(function() {
        //     if (country_wise == "yes") {
        //         jQuery.ajax({
        //             url: 'https://goexbox.com/agent/rate/getCountryZipcode',
        //             type: 'POST',
        //             async: false,
        //             data: 'country_id=' + $(this).val() + '&company_id=' + $("#company_id").val(),
        //             dataType: "text",
        //             success: function(result) {
        //                 $('#zc').show();
        //                 $("#zipcode_id").html(result);
        //             },
        //             error: function(result) {
        //                 alert(result + "error");
        //             }
        //         });
        //     } else {
        //         $('#zc').hide();
        //     }
        // });
      </script>

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
      $.post("https://goexbox.com/agent//dashboard/setYear", {
          'year': this.value
        },
        function(data, status) {
          //alert("Data: " + data + "\nStatus: " + status);
          location.reload();
        });
    });
    $('#financial_year1').on('change', function() {
      // alert( this.value );
      $.post("https://goexbox.com/agent//dashboard/setYear", {
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
      add_url = "https://goexbox.com/agent/calculator/ajax_add";
      edit_url = "https://goexbox.com/agent/calculator/ajax_edit";
      update_url = "https://goexbox.com/agent/calculator/ajax_update";
      delete_url = "https://goexbox.com/agent/calculator/ajax_delete";
      var list_url = "https://goexbox.com/agent/calculator/ajax_list";
      table = datatableCall(list_url);

      $("form").attr('autocomplete', 'off');
    });
  </script>

  <script type="text/javascript">
    function getRate() {
      $.ajax({
        url: "https://vfolo.in/LaxmipatiAdmin/courierbooking.php/getfwdCharge/",
        type: "POST",
        dataType: "form-data",
        data: {
          'company_id': $('#company_id').val(),
          'weight': $('#weight').val()
        },
        success: function(data) {
          $('#company_extra_charge_forwarding_id').html(data);
          $('#forwarding_div').show();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error get data from ajax');
        }
      });
    }
  </script>

  <div id="pip-toast"></div>
</body>

</html>