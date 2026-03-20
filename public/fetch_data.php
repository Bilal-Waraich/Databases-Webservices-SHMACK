<?php
// Include the database configuration file
require 'db_config.php';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch subsidiaries
    $subsidiary_stmt = $pdo->prepare("SELECT Subsidiary_ID, Subsidiary_Name FROM Subsidiaries");
    $subsidiary_stmt->execute();
    $subsidiaries = $subsidiary_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate subsidiary options
    $subsidiary_options = '';
    foreach ($subsidiaries as $subsidiary) {
        $subsidiary_options .= '<option value="' . htmlspecialchars($subsidiary['Subsidiary_ID']) . '">' . htmlspecialchars($subsidiary['Subsidiary_Name']) . '</option>';
    }

    // Fetch cost centers
    $costcenter_stmt = $pdo->prepare("SELECT CostCenter_ID, CostCenter_Name FROM CostCenter");
    $costcenter_stmt->execute();
    $costcenters = $costcenter_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate cost center options
    $costcenter_options = '';
    foreach ($costcenters as $costcenter) {
        $costcenter_options .= '<option value="' . htmlspecialchars($costcenter['CostCenter_ID']) . '">' . htmlspecialchars($costcenter['CostCenter_Name']) . '</option>';
    }

} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Error: Could not fetch data.");
}
?>