<?php
// Include your database connection file (e.g., 'config.php')
@include 'config.php';

?>

<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <meta charset="utf-8">
  <title>Booking | Laxmipati</title>
</head>
<body>
  <form action="get_booking.php" role="form" autocomplete="off" enctype="multipart/form-data" method="post">
    <select name="country" style="width:100%;height:36px;">
      <option value="Afghanistan">AF - Afghanistan</option>
      <option value="Aland Island (Finland)">EUR - Aland Island (Finland)</option>
      <option value="Albania">AL - Albania</option>
      <!-- Add more options here -->
    </select>
    <input type="submit" value="Booking" name="submit" class="btn btn-primary">
  </form>
</body>
</html>
