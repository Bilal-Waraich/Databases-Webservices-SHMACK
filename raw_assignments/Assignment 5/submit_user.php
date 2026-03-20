<?php
$server = '5.75.182.107';
$username = 'wbilal';
$mysql_password = 'hUoRPe';
$database = 'wbilal_db';

// Create a new connection
$mysqli = new mysqli($server, $username, $mysql_password, $database);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Collect the form data
$name = $mysqli->real_escape_string($_POST['name']);
$email = $mysqli->real_escape_string($_POST['email']);
$address = $mysqli->real_escape_string($_POST['address']);
$role = $mysqli->real_escape_string($_POST['role']);
$permissions_rights = $mysqli->real_escape_string($_POST['permissions_rights']);
$subsidiary_id = $mysqli->real_escape_string($_POST['subsidiary_id']);

// Check if the cost center is relevant
if (isset($_POST['costcenter_id']) && !empty($_POST['costcenter_id'])) {
    $costcenter_id = $mysqli->real_escape_string($_POST['costcenter_id']);
} else {
    $costcenter_id = null; // Set to null if not provided
}

// Prepare and execute the insert query
$query = "INSERT INTO Users (Name, Email, Address, Role, Permissions_Rights, Subsidiary_ID, CostCenter_ID) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare statement
$stmt = $mysqli->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

// Bind parameters
$stmt->bind_param("ssssssi", $name, $email, $address, $role, $permissions_rights, $subsidiary_id, $costcenter_id);

// Execute the statement
if ($stmt->execute()) {
    echo "New user created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
