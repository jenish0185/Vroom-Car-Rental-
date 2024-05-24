<?php
// Start the session
session_start();

if(isset($_GET['user_id']) && isset($_GET['car_id'])) {
    $user_id = $_GET['user_id'];
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

    // Prepare and execute the SQL statement to remove the favorite car
    $sql = "DELETE FROM favorites WHERE user_id = $user_id AND car_id = $car_id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the favorites page
        header("Location: favorites.php?user_id=$user_id");
        exit();
    } else {
        echo "Error removing favorite: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect back to the login page if user_id or car_id parameters are missing
    header("Location: login.php");
    exit();
}
?>
