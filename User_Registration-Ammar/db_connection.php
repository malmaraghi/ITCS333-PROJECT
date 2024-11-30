<?php
// Database connection setup
$host = 'localhost';       // Database host
$db = 'project_cs333';     // Database name
$user = 'root';            // Database user
$pass = '';                // Database password (empty for localhost)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Error handling
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
