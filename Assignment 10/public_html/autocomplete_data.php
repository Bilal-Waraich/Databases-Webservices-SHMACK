<?php
require_once 'db_config.php'; // Include database configuration

if (isset($_GET['term'], $_GET['field'])) {
    $searchTerm = $_GET['term']; // Get the search term
    $field = $_GET['field']; // Determine which field to search (e.g., subsidiary, cost center)

    // Initialize SQL query based on the requested field
    $query = "";
    if ($field == 'subsidiary') {
        $query = "SELECT Subsidiary_Name FROM Subsidiaries WHERE Subsidiary_Name LIKE :term LIMIT 10";
    } elseif ($field == 'costcenter') {
        $query = "SELECT CostCenter_Name FROM CostCenter WHERE CostCenter_Name LIKE :term LIMIT 10";
    } elseif ($field == 'lease') {
        $query = "SELECT Lease_ID FROM Leases WHERE Lease_ID LIKE :term LIMIT 10";
    } else {
        echo json_encode([]); // Return an empty array for invalid fields
        exit;
    }

    try {
        // Execute the query
        $stmt = $pdo->prepare($query);
        $stmt->execute(['term' => '%' . $searchTerm . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Return results as JSON
        echo json_encode($results);
    } catch (PDOException $e) {
        // Handle query errors
        echo json_encode(["error" => $e->getMessage()]);
    }
}
?>
