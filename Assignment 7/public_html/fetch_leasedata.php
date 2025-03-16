<?php
// Database connection parameters
$server = '5.75.182.107';
$dbname = 'wbilal_db';
$username = 'wbilal'; 
$password = 'hUoRPe'; 

function getLeaseOptions() {
    global $host, $dbname, $username, $password; // Use global variables for database connection

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

        // Return the generated options
        return $lease_options;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return ''; // Return an empty string in case of error
    }
}

// Call the function and store the result
$lease_options = getLeaseOptions();
?>
