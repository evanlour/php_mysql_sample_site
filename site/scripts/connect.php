<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Change Data here according to the database connections
$servername = "localhost";
$username = "evanlour";
$password = "fygas69";
$dbname = "resupply";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

$conn->set_charset("utf8");
?>