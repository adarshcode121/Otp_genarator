<?php
// Database configuration
$servername = "localhost"; // Database host
$username = "root";        // Database username
$password = "";            // Database password (leave blank for XAMPP/MAMP default)
$dbname = "login2";       // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
