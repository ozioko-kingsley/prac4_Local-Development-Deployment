<?php
// config.php - Database connection file with error logging

// Database configuration
$host = 'localhost';
$dbname = 'local_app_db';
$username = 'root'; // Change this if using a live server
$password = ''; // Leave empty for local development (XAMPP, WAMP)

// Enable error logging
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.log');

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Database Connection Failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}
?>
