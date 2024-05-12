<?php
// Start the session
session_start();

// Check if user ID and car ID are provided
if (isset($_POST['user_id']) && isset($_POST['car_id'])) {
    $user_id = $_POST['user_id'];
    $car_id = $_POST['car_id'];

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

    // Check if the car is already in favorites for the user
    $check_query = "SELECT * FROM favorites WHERE user_id = $user_id AND car_id = $car_id";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Car is already in favorites, show message
        echo "Car is already in favorites.";
    } else {
        // Car is not in favorites, add it
        $add_query = "INSERT INTO favorites (user_id, car_id) VALUES ($user_id, $car_id)";
        if ($conn->query($add_query) === TRUE) {
            echo "Car added to favorites successfully.";
        } else {
            echo "Error: " . $add_query . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // If user ID or car ID is not provided, show error message
    echo "User ID or Car ID not provided.";
}
?>
