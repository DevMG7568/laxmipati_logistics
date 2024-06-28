<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
}
 else {
    echo "ID not provided.";
}


?>

<?php
$trackingNumber = $_POST['tracking_number'];
$status = $_POST['stat
us'];

$sql = "INSERT INTO courier_status (tracking_number, status) VALUES ('$trackingNumber', '$status')";


if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



?>





<!DOCTYPE html>
<html>
<head>
    <title>Courier Status Form</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
}

form {
    text-align: center;
}

label {
    font-weight: bold;
}

input {
    padding: 5px;
    margin: 5px;
}

button {
    padding: 10px 20px;
    background-color: #0074D9;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>
<body>
    
    <?php 
 // SQL query to fetch data based on the product ID
    $sql = "SELECT * FROM order_details WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        
        
    <h1>Courier Status</h1>
    <form id="courierForm" action="#" method="post">
        <label for="trackingNumber">Tracking Number:</label>
        <input type="text" id="trackingNumber" name="tracking_number" value="LP<?php echo $row['id']; ?>" required>
        <br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Collected">Collected</option>
            <option value="Shipped">Shipped</option>
            </select>
        <br><br>
        <button type="submit" onclick="addOrUpdateStatus()">Add/Update Status</button>
    </form>
    <div id="statusList">
        <!-- Status updates will be displayed here -->
    </div>


 <?php
    } else {
        echo "Id not found.";
    }
    ?>
    
    <script>
        let statusData = [];

function addOrUpdateStatus() {
    const trackingNumber = document.getElementById("trackingNumber").value;
    const status = document.getElementById("status").value;

    if (trackingNumber && status) {
        const existingStatusIndex = statusData.findIndex(item => item.trackingNumber === trackingNumber);

        if (existingStatusIndex !== -1) {
            // Update existing status
            statusData[existingStatusIndex].status = status;
        } else {
            // Add new status
            statusData.push({ trackingNumber, status });
        }

        displayStatusList();
        document.getElementById("courierForm").reset();
    } else {
        alert("Please fill in both Tracking Number and Status fields.");
    }
}

function displayStatusList() {
    const statusListDiv = document.getElementById("statusList");
    statusListDiv.innerHTML = "";

    statusData.forEach(item => {
        const statusItem = document.createElement("div");
        statusItem.innerHTML = `<strong>Tracking Number:</strong> ${item.trackingNumber}, <strong>Status:</strong> ${item.status}`;
        statusListDiv.appendChild(statusItem);
    });
}

    </script>
</body>
</html>
