<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = '5.75.182.107';
$username = 'wbilal';
$mysql_password = 'hUoRPe';
$database = 'wbilal_db';

// Create a new MySQLi connection
$mysqli = new mysqli($server, $username, $mysql_password, $database);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$vehicleID = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $Vehicle_Model = isset($_POST['vehicle_model']) ? $mysqli->real_escape_string($_POST['vehicle_model']) : null;
    $Vehicle_Name = isset($_POST['vehicle_name']) ? $mysqli->real_escape_string($_POST['vehicle_name']) : null;
    $Lease_ID = isset($_POST['lease_id']) ? intval($_POST['lease_id']) : null;

    // Validate required fields
    if (!empty($Vehicle_Model) && !empty($Vehicle_Name) && !empty($Lease_ID)) {
        // Prepare the SQL statement for inserting data
        $query = "INSERT INTO Vehicle (Vehicle_Model, Vehicle_Name, Lease_ID) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($query);

        if ($stmt === false) {
            die("Prepare failed: " . $mysqli->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $Vehicle_Model, $Vehicle_Name, $Lease_ID);

        if ($stmt->execute()) {
            // Get the generated Vehicle_ID
            $vehicleID = $stmt->insert_id;
            echo "Vehicle created successfully. Your Vehicle_ID is: " . $vehicleID;
        } else {
            echo "Error inserting vehicle: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: All fields are required.";
    }
}

// Close the MySQL connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<body>
    <a href="maintenance.html">Go Back to Maintenance Page</a>
</body>
</html>
