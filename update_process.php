<?php
// Database configuration
$servername = "localhost";  // Replace with your database server name
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "car_rental";     // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if car ID and car name are provided
    if (isset($_POST['car_id']) && isset($_POST['carName'])) {
        // Retrieve form data
        $car_id = $_POST['car_id'];
        $carName = $_POST['carName'];

        // Update car details in the database
        $sql = "UPDATE car_details SET carName = '$carName' WHERE id = $car_id";

        if ($conn->query($sql) === TRUE) {
            // Redirect back to admindash.php
            header("Location: admindash.php");
            exit;
        } else {
            echo "Error updating car details: " . $conn->error;
        }
    } else {
        echo "Car ID and Car Name are required!";
    }
} else {
    echo "Invalid request!";
}

// Close database connection
$conn->close();
?>
