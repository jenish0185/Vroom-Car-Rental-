<?php
$servername = "localhost"; // Change to your MySQL server name
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "cars"; // Change to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

