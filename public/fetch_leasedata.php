<?php
// Include the database configuration file
require 'db_config.php';

function getLeaseOptions() {
    try {
        // Use PDO to fetch lease data
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch Lease IDs
        $stmt = $pdo->prepare("SELECT Lease_ID FROM Leases");
        $stmt->execute();

        // Generate dropdown options
        $lease_options = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lease_options .= '<option value="' . htmlspecialchars($row['Lease_ID']) . '">' . htmlspecialchars($row['Lease_ID']) . '</option>';
        }

        return $lease_options;

    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return '<option value="">Error loading leases</option>';
    }
}

// Get lease options for use in forms
$lease_options = getLeaseOptions();
?>