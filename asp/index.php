<?php
session_start();
@include 'config.php';

// Check if the user is logged in (i.e., the session variable is set)
/*if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
} */

// Fetch username, branchname, usernumber, and address for the logged-in user
// $admin_id = $_SESSION['admin_id'];

// Query the database to get the user details
/*$query = "SELECT adminusername, branchname, usernumber, address FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $username = $row['adminusername'];
    $branchname = $row['branchname'];
    $usernumber = $row['usernumber'];
    $address = $row['address'];
} else {
    // Handle the case where the user details are not found
    $username = "N/A";
    $branchname = "N/A";
    $usernumber = "N/A";
    $address = "N/A";
} */



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the provided credentials match any in the database
    $query = "SELECT * FROM admin_users WHERE adminusername = '$username' AND userpassword = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Admin login successful
        // Create a session or set a cookie to maintain login status
        session_start();
        $_SESSION["admin_username"] = $username;
        header("Location: dashboard.php"); // Redirect to the dashboard page
    } else {
        echo "Invalid username or password. Please try again.";
    }
}


?>


<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laxmipati</title>
  <link rel="icon" href="lp.png">
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Open Sans", sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  width: 100%;
  padding: 0 10px;
}

body::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: #06033D;
  background-position: center;
  background-size: cover;
}

.wrapper {
  width: 400px;
  border-radius: 8px;
  padding: 30px;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(9px);
  -webkit-backdrop-filter: blur(9px);
}

form {
  display: flex;
  flex-direction: column;
}

h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  color: #fff;
}

.input-field {
  position: relative;
  border-bottom: 2px solid #ccc;
  margin: 25px 0;
}

.input-field label {
  position: absolute;
  top: -23px;
  color: #fff;
  font-size: 16px;
}

.input-field input {
  width: 100%;
  height: 40px;
  background: transparent;
  border: none;
  outline: none;
  font-size: 16px;
  color: #fff;
}

.input-field input:focus~label,
.input-field input:valid~label {
  font-size: 0.8rem;
  top: 10px;
  transform: translateY(-120%);
}

.forget {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 25px 0 35px 0;
  color: #fff;
}

#remember {
  accent-color: #fff;
}

.forget label {
  display: flex;
  align-items: center;
}

.forget label p {
  margin-left: 8px;
}

.wrapper a {
  color: #efefef;
  text-decoration: none;
}

.wrapper a:hover {
  text-decoration: underline;
}

button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}

button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}

.register {
  text-align: center;
  margin-top: 30px;
  color: #fff;
}
</style>
<body>
  <div class="wrapper">
      <center>
          <img src="logo.png" width="200">
      </center>
    <form action="#" method="post">
      <h2>Admin Login</h2>
        <div class="input-field">
        <label>Enter your User Name</label>
        <input type="text" name="username" required>
      </div>
      <div class="input-field">
        <label>Enter your password</label>
        <input type="password" name="password" required>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
      </div>
      <button type="submit">Log In</button>
    </form>
  </div>
</body>
</html>