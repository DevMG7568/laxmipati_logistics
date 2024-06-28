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

$sql = "SELECT MAX(id) AS max_id FROM order_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $latestId = $row['max_id'] + 1;
} else {
  // If no records exist, start from 1 or any other desired initial value
  $latestId = 1;
}

$sql = "SELECT MAX(id) AS max_id FROM get_start";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $latestId1 = $row['max_id'] + 1;
} else {
  // If no records exist, start from 1 or any other desired initial value
  $latestId1 = 1;
}

if ($latestId != $latestId1) {
  header("Location: allorder.php");
  exit();
}

?>



<html lang="en" class=" js no-touch csstransforms3d csstransitions">

<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <meta charset="utf-8">
  <title>Booking | Laxmipati</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta content="GoExBox" name="description">
  <meta content="Ace" name="author">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.29/sweetalert2.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <script src="https://goexbox.com/assets/agent/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/4/common.js"></script>
  <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/54/4/util.js"></script>
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

    .container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    a {
      text-decoration: none;
    }

    pre {
      text-align: center;
      font-size: 50px;
      font-weight: 900;
      color: red;
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
  </style>
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

  <div class="pace  pace-inactive">
    <div class="container" style="height:600px;">
      <!--<h3><?php //echo $latestId 
              ?> = <?php //echo $latestId1 
                    ?></h3>-->
      <form action="aspform.php" role="form" autocomplete="off" enctype="multipart/form-data" method="post" style="height:500px;">
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

                        <select name="country" style="width:100%;height:36px;" required>
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
                          <input class="form-check-input" id="radio1" type="radio" name="document_type_id" value="1" data-bs-original-title="" title="">
                          <label class="form-check-label" for="radio1">Doc</label>
                          <br>
                          <input class="form-check-input" id="radio2" type="radio" name="document_type_id" value="2" data-bs-original-title="" title="">
                          <label class="form-check-label" for="radio2">Non Doc</label>

                        </label>
                      </div>
                    </div>
                    <div class="form-group  col-6" id="nobd">

                      <input type="text" placeholder="No Of Box" class="form-control form-control-sm" name="nob" id="nob">
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
                    <div class="col-sm-6">
                      <div class="form-group  required">

                        <input id="weight" type="text" placeholder="Shipment Weight" class="form-control form-control-sm" name="weight" required="" readonly="">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group ">

                        <input class="form-control form-control-sm" placeholder="Courier Date" name="order_currier_date" id="dateInput" type="date">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-6">
                      <div class="form-group ">
                        <input id="sh_referance" type="text" placeholder="Shipment Referance No" class="form-control form-control-sm" name="sh_referance">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group  required">

                        <input id="note" type="text" placeholder="Remarks" class="form-control form-control-sm" name="note">
                      </div>
                    </div>
                  </div>



                </div>
              </div>
              <div class="card-footer">
                <div class="text-center">
                  <!-- <input type="submit" value="Booking" name="asp_get_booking" class="btn btn-primary"> -->

                </div>
              </div>
            </div>

          </div>

      </form>
    </div>

    <script>

    </script>
    <script>
      // Function to set today's date in the date input field
      function setTodayDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();

        var todayString = yyyy + '-' + mm + '-' + dd;

        document.getElementById('dateInput').value = todayString;
      }

      // Call the function to set today's date when the page loads
      setTodayDate();
    </script>

    <script type="text/javascript">
      function getFwdNo(id) {
        //Ajax Load data from ajax
        $.ajax({
          url: "https://vfolo.in/LaxmipatiAdmin/courierbooking.php/getfwdCharge/",
          type: "POST",
          dataType: "text",
          data: "company_id=" + id,
          success: function(data) {
            $('#company_extra_charge_forwarding_id').html(data);
            $('#forwarding_div').show();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
          }
        });
      }
      $(document).ready(function() {
        $('#forwarding_div').hide();
        $(function() {
          $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
          });
        });
        $('.multi-field-wrapper').each(function() {
          var $wrapper = $('.multi-fields', this);
          $(".add-field", $(this)).click(function(e) {
            var newElement = $('.multi-field:first-child', $wrapper).clone(true).appendTo(
              $wrapper);
            newElement.find('input:text').val('');
            newElement.find('input:select').first().focus();
            // $('#company_extra_charges_id').select2();
            // newElement1 = newElement.find('input[name="company_extra_charges_id[]"]');
          });
          $('.multi-field .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1) $(this).parent('.multi-field').remove();
          });
        });
        $("#error").hide();
        $("#user_id").select2();
        $("#user_id").focus();
        $("#branch_id").select2();
        $("#country_id").select2();
        $("#company_extra_charges_id").select2({
          placeholder: "Select Extra Charge Namre",
          allowClear: true
        });
        // $("#order_currier_date").datepicker({
        //     format: "dd-mm-yyyy",
        //     autoclose: true,
        //     minDate: 0
        // });

        //add dimentionss
        $("#ibox").html("");
        addField(1);
        $('input[name="weightb[]"]').keyup(function() {
          sumweight();
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
          addField(v);
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
            $("#dimentiond").hide();
            $("#hr1").hide();
            $("#hr2").hide();
            $("#ibox").html("");
            addField(1);
            $("input[name='height[]']").val('1');
            $("input[name='width[]']").val('1');
            $("input[name='length[]']").val('1');
            $("input[name='weightb[]']").val('0');
            $("#weight").prop('readonly', false);
          }
          if (radioValue == 2) {
            $("#nobd").show();
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
            addField(1);
            $('#nob').val(1);
          }
        });



        $('#formOrder').submit(function(event) {
          var radioValue1 = $("input:radio[name=booking_type]:checked").val();
          var ocd1 = $("#order_currier_date").val();
          if (ocd1 == null || ocd1 == "") {
            alert("Please enter Currier Date");
            return false;
          } else {
            jQuery.ajax({
              url: 'https://vfolo.in/LaxmipatiAdmin/courierbooking.php/getRateNew',
              type: 'POST',
              async: false,
              data: $(this).serialize(),
              dataType: "json",
              success: function(result) {
                //alert(result.rate_value);
                $("#user_rate").html(
                  "<p class='text-center'>FWD Charges are as per Rules & Regulation</p>"
                );
                // $("#user_rate_footer").html("");
                // $.each(result.extra_charges, function(k, v) {
                //     if (v != 0) {
                //         $("#user_rate").append("<tr><td>" + k + "</td><td style='text-align: right;'><i class='fa fa-inr'></i>&nbsp;" + v + "</td></tr>");
                //     }
                // });
                var txtap = "";
                if (result.auto_awb_no != "")
                  txtap = "";
                $("#user_rate").append(result.extra_charges);
                $("#user_rate_awb").html(
                  '<div class="m-form__group mt-1" id="nobd"><div class="form-group input-group transparent"><div class="input-group-prepend"><span class="input-group-text transparent"><i class="pg-icon">map</i></span></div><input id="awb_no" name="awb_no" class="form-control text-dark" type="text" placeholder="' +
                  result.auto_awb_no + '"  ' + txtap +
                  ' readonly><input type="submit" id="placeOrder" value="Book Courier" class="btn btn-primary waves-effect waves-float waves-light"></div></div>'
                );
                // $("#user_rate_awb").html('<div class="m-form__group mt-1" id="nobd"><div class="input-groupinput-group transparent"><div class="input-group-prepend"><span class="input-group-text transparent"><i class="pg-icon">map</i></span></div><input id="awb_no" name="awb_no" class="form-control " type="text" placeholder="' + result.auto_awb_no + '"  ' + txtap + ' readonly><input type="submit" id="placeOrder" value="Book Courier" class="btn btn-primary waves-effect waves-float waves-light"></div></div>');
                // $("#user_rate_footer").append('<input type="submit" id="placeOrder" value="Book Courier" class="btn btn-primary">');
                $("#awb_no").focus();
                $('input[type=radio][name=company_id]').change(function() {
                  getFwdNo(this.value);
                });
                $("#placeOrder").click(function(e) {
                  var ocd = $("#order_currier_date").val();
                  var cpny = $(
                      "input[type='radio'][name='company_id']:checked")
                    .val();
                  //var awb = document.getElementById("awb_no").value;
                  /*if (awb == null || awb == "") {
                      alert("Please enter AWB number");
                      return false;
                  } else */
                  if (ocd == null || ocd == "") {
                    alert("Please enter Currier Date");
                    return false;
                  } else if (cpny == null || cpny == "") {
                    alert("Please Select Service To Book Courier");
                    return false;
                  } else {
                    jQuery.ajax({
                      url: 'https://goexbox.com/agent/courierbooking/placeOrder',
                      type: 'POST',
                      async: false,
                      data: $("#formOrder").serialize(),
                      dataType: "json",
                      success: function(data) {
                        if (data.status == true) {
                          $("#error").hide();
                          $('#formOrder')[0].reset();
                          // $("input[name=booking_type][value=0]").prop('checked', true).trigger('change');
                          $("#user_rate").html("");
                          $("#user_rate_awb").html("");
                          $('#forwarding_div').hide();
                          $("#user_rate_footer").html("");
                          noticustom('Order Placed',
                            'success');
                          reload_table(table);
                          $("#user_id").val("").trigger(
                            "change");
                          $("#company_id").val("")
                            .trigger("change");
                          $("#country_id").val("")
                            .trigger("change");
                          $("#zipcode_id").val("")
                            .trigger("change");
                          $("#order_currier_date")
                            .datepicker('setDate',
                              null);
                          //$("#company_extra_charges_id").select2();
                          $("#ibox").html("");
                          addField(1);
                          $("input[name=document_type_id][value=1]")
                            .prop('checked', true)
                            .trigger('change');
                          //$('#nob').spinner('value',1);
                          $("#user_id").focus();
                          swal.fire({
                              title: "Order Placed",
                              text: "Do you want to add Parcel Details Now?",
                              type: "success",
                              showCancelButton: true,
                              confirmButtonText: 'Insert Parcel details',
                              cancelButtonText: 'No, cancel!',
                            })
                            .then((result) => {
                              if (result
                                .isConfirmed) {
                                var od = (data
                                    .order_id
                                  )
                                  .toString();
                                document
                                  .getElementById(
                                    "my_" +
                                    od)
                                  .submit();
                              }
                            });
                          // .then(function(result) {
                          //     var od=(data.order_id).toString();
                          //     document.getElementById("my_"+od).submit();
                          // });

                        } else {
                          alert(data.error);
                          //document.getElementById("error").innerHTML=data.error;
                          $("#error").show();
                        }
                      },
                      error: function(result) {
                        //console.log(result.responseText);
                        if (result.responseText != "" ||
                          result.responseText != "")
                          alert(result.responseText);
                        else
                          alert(
                            "Error Please Contact Devloper"
                          );
                      }
                    });

                  }
                  e.preventDefault();
                });
              },
              error: function(result) {
                alert(result.responseText);
              }
            });
          }
          /* } */
          event.preventDefault();
        });
        $("input[name=document_type_id][value=2]").prop('checked', true).trigger('change');
      });

      $('#user_id').change(function() {



      });
      var country_wise;
      var volumetric_weight_factor = 5000;
      var volumetric_weight_discount = 0;
      $('#company_id').change(function() {
        if ($(this).val() != "") {
          jQuery.ajax({
            url: 'https://goexbox.com/agent/rate/getCompanyCountry',
            type: 'POST',
            async: false,
            data: 'id=' + $(this).val(),
            dataType: "json",
            success: function(result) {
              $("#country_id").html(result.selectbox);
              $("#country_id").val("").change();
              country_wise = result.rate_upload_country_wise;
              volumetric_weight_factor = result.volumetric_weight_factor;
            },
            error: function(result) {
              alert(result + "error");
            }
          });
        }
      });
      $('#country_id').change(function() {
        country_wise = "yes";
        if (country_wise == "yes") {
          jQuery.ajax({
            url: 'https://goexbox.com/agent/rate/getCountryZipcode',
            type: 'POST',
            async: false,
            data: 'country_id=' + $(this).val() + '&company_id=' + $("#company_id").val(),
            dataType: "text",
            success: function(result) {
              if (result != "") {
                $('#zc').show();
                $("#zipcode_id").html(result);
              } else {
                $('#zc').hide();
              }
            },
            error: function(result) {
              alert(result + "error");
            }
          });
        } else {
          $('#zc').hide();
        }
      });



      var save_method; //for save method string
      var table;

      function set_id(id) {
        $('[name="order_id"]').val(id);
      }

      function delete_company(id) {
        //var id=document.getElementById("order_id").value;
        var result = confirm("Are you sure you want to delete?");
        if (result) {
          // ajax delete data to database
          $.ajax({
            url: "https://goexbox.com/agent/courierbooking/ajax_delete/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
              //if success reload ajax table
              //$.magnificPopup.close({items:{src: '#modalForm',type: 'inline',modal: true}});
              noticustom('Order Deleted', 'danger');
              reload_table();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Error adding / update data');
            }
          });
        }

      }

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
        }
        sumweight();

      }

      function volumeweightDiscount() {
        var sum = 0;
        //iterate through each textboxes and add the values
        var discount = 100 - parseFloat($('#vol_discount').val());
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
        $("#detailsRow").show();

        $('#order_currier_date').datepicker({
          format: "dd-mm-yyyy",
          language: 'en',
          autoclose: true,
          // defaultDate: new Date()
        });
      });
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

</body>

</html>