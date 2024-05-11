<?php
if(isset($_POST['user_id']) && isset($_POST['car_id'])) {
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

    // Prepare and execute the SQL statement to insert into favorites table
    $sql = "INSERT INTO favorites (user_id, car_id) VALUES ('$user_id', '$car_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Car added to favorites successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User ID or Car ID not provided.";
}
?>
