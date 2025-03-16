<?php
define('DB_SERVER', 'localhost'); // Docker service name
define('DB_USERNAME', 'wbilal');
define('DB_PASSWORD', 'hUoRPe');
define('DB_DATABASE', 'wbilal_db');
$charset = 'utf8mb4';

// PDO configuration (optional for reuse)
$dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE . ";charset=" . $charset;
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>