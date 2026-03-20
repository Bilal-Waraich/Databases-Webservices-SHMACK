<?php
// fetch_data.php

// Database connection parameters
$host = '5.75.182.107'; // e.g., 'localhost'
$dbname = 'wbilal_db'; // Your database name
$username = 'wbilal'; // Your database username
$password = 'hUoRPe'; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query for subsidiaries
    $subsidiary_stmt = $pdo->prepare("SELECT Subsidiary_ID, Subsidiary_Name FROM Subsidiaries");
    $subsidiary_stmt->execute();
    $subsidiaries = $subsidiary_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate options for the subsidiary dropdown
    $subsidiary_options = '';
    foreach ($subsidiaries as $subsidiary) {
        $subsidiary_options .= '<option value="' . htmlspecialchars($subsidiary['Subsidiary_ID']) . '">' . htmlspecialchars($subsidiary['Subsidiary_Name']) . '</option>';
    }

    // Prepare and execute the SQL query for cost centers
    $costcenter_stmt = $pdo->prepare("SELECT CostCenter_ID, CostCenter_Name FROM CostCenter");
    $costcenter_stmt->execute();
    $costcenters = $costcenter_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate options for the cost center dropdown
    $costcenter_options = '';
    foreach ($costcenters as $costcenter) {
        $costcenter_options .= '<option value="' . htmlspecialchars($costcenter['CostCenter_ID']) . '">' . htmlspecialchars($costcenter['CostCenter_Name']) . '</option>';
    }

    // Close the database connection
    $pdo = null;

    // Output the dropdowns
    echo $subsidiary_options; // For subsidiary dropdown
    echo $costcenter_options; // For cost center dropdown

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
