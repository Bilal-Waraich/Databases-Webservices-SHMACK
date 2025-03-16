<?php
// Database connection parameters
$host = '5.75.182.107'; // e.g., 'localhost'
$dbname = 'wbilal_db'; // Your database name
$username = 'wbilal'; // Your database username
$password = 'hUoRPe'; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare("SELECT Lease_ID FROM Leases");
    $stmt->execute();

    // Fetch all lease data
    $leases = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate options for the dropdown
    $lease_options = '';
    foreach ($leases as $lease) {
        // Create an option with lease_id as value
        $lease_options .= '<option value="' . htmlspecialchars($lease['Lease_ID']) . '">' . htmlspecialchars($lease['Lease_ID']) . '</option>';
    }

    // Close the database connection
    $pdo = null;

    // Output the dropdown
    echo '<select name="lease_id" id="lease_id">';
    echo $lease_options;
    echo '</select>';

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
