<?php
// Create a database and tables if they don't already exist

$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS chat_application";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Use the chat_app database
$conn->select_db('chat_application');

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS userstable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    unique_id VARCHAR(50) NOT NULL UNIQUE,  -- Unique identification number
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'userstable' created successfully.<br>";
} else {
    echo "Error creating table 'userstable': " . $conn->error;
}

// Create messages table
$sql = "CREATE TABLE IF NOT EXISTS messagestable (
    id INT AUTO_INCREMENT PRIMARY KEY,     -- Unique message ID
    sender_id INT NOT NULL,                 -- User ID of the sender (foreign key to the users table)
    receiver_id INT NOT NULL,               -- User ID of the receiver (foreign key to the users table)
    message TEXT NOT NULL,                  -- Message content
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the message was sent
    FOREIGN KEY (sender_id) REFERENCES userstable(id) ON DELETE CASCADE,  -- Foreign key linking to the users table
    FOREIGN KEY (receiver_id) REFERENCES userstable(id) ON DELETE CASCADE -- Foreign key linking to the users table
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'messagestable' created successfully.<br>";
} else {
    echo "Error creating table 'messagestable': " . $conn->error;
}

// Close the connection
$conn->close();
?>
