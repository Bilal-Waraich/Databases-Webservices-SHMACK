<?php
$server = '5.75.182.107';
$username = 'wbilal';
$mysql_password = 'hUoRPe';
$database = 'wbilal_db';

$mysqli = new mysqli($server, $username, $mysql_password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch Subsidiary Options
$subsidiary_options = '';
$subsidiary_query = "SELECT Subsidiary_ID, Subsidiary_Name FROM Subsidiary";
$subsidiary_result = $mysqli->query($subsidiary_query);
if ($subsidiary_result->num_rows > 0) {
    while ($row = $subsidiary_result->fetch_assoc()) {
        $subsidiary_options .= '<option value="' . $row['Subsidiary_ID'] . '">' . $row['Subsidiary_Name'] . '</option>';
    }
}

// Fetch Cost Center Options
$costcenter_options = '';
$costcenter_query = "SELECT CostCenter_ID, CostCenter_Name FROM CostCenter";
$costcenter_result = $mysqli->query($costcenter_query);
if ($costcenter_result->num_rows > 0) {
    while ($row = $costcenter_result->fetch_assoc()) {
        $costcenter_options .= '<option value="' . $row['CostCenter_ID'] . '">' . $row['CostCenter_Name'] . '</option>';
    }
}

// Close the connection
$mysqli->close();
?>
