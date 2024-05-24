<?php
// Start the session
session_start();

// Check if car ID is provided in the URL
if(isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming there's no password
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to check if the car is booked
    $sql = "SELECT * FROM booking WHERE car_id = $car_id";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Car is already booked
        echo "booked";
    } else {
        // Car is not booked
        echo "not_booked";
    }

    // Close the database connection
    $conn->close();
} else {
    // Car ID not provided
    echo "car_id_not_provided";
}
?>
