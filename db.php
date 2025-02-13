<?php
// Database credentials
$servername = "localhost";   // Typically 'localhost' for XAMPP
$username = "root";          // Default username for XAMPP MySQL
$password = "";              // Default password for XAMPP MySQL (empty by default)
$dbname = "chat_app";        // Your database name

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // If there's an error in the connection, display it and terminate the script
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set the character set for the connection
$conn->set_charset("utf8");

// Connection is successful, you can now run queries on `$conn`
?>
