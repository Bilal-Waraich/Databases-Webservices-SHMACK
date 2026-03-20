<?php
$server = '5.75.182.107';
$username = 'wbilal';
$mysql_password = 'hUoRPe';
$database = 'wbilal_db';

$mysqli = new mysqli($server, $username, $mysql_password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch subsidiaries
$subsidiary_query = "SELECT Subsidiary_ID FROM Subsidiaries";
$subsidiary_result = $mysqli->query($subsidiary_query);

$subsidiary_options = "";
if ($subsidiary_result->num_rows > 0) {
    while ($row = $subsidiary_result->fetch_assoc()) {
        $subsidiary_options .= "<option>" . htmlspecialchars($row['Subsidiary_ID']) . "</option>";
    }
} else {
    $subsidiary_options = "<option>No subsidiaries available</option>";
}

// Fetch cost centers
$costcenter_query = "SELECT CostCenter_ID FROM CostCenter";
$costcenter_result = $mysqli->query($costcenter_query);

$costcenter_options = "";
if ($costcenter_result->num_rows > 0) {
    while ($row = $costcenter_result->fetch_assoc()) {
        $costcenter_options .= "<option>" . htmlspecialchars($row['CostCenter_ID']) . "</option>";
    }
} else {
    $costcenter_options = "<option>No cost centers available</option>";
}

$mysqli->close();
?>
