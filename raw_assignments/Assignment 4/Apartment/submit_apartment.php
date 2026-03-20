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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $Apartment_Name = isset($_POST['apartment_name']) ? $mysqli->real_escape_string($_POST['apartment_name']) : null;
    $Apartment_Location = isset($_POST['apartment_location']) ? $mysqli->real_escape_string($_POST['apartment_location']) : null;
    $Lease_ID = isset($_POST['lease_id']) ? intval($_POST['lease_id']) : null;

    // Validate required fields
    if (!empty($Apartment_Name) && !empty($Apartment_Location) && !empty($Lease_ID)) {
        // Prepare the SQL statement for inserting data into the Apartment table
        $query = "INSERT INTO Apartment (Apartment_Name, Apartment_Location, Lease_ID) VALUES (?, ?, ?)";
        
        $stmt = $mysqli->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $mysqli->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $Apartment_Name, $Apartment_Location, $Lease_ID);

        if ($stmt->execute()) {
            // Success message
            echo "Apartment record created successfully!";
        } else {
            // Error message
            echo "Error inserting apartment: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Validation error
        echo "Error: All required fields must be filled.";
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
