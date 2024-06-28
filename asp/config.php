<?php 

$servername = "localhost";
$username = "u395256775_laxmipatibacke";
$password = "Laxmipati@123";
$dbname = "u395256775_laxmipatibacke";
    
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




?>