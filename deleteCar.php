<?php
// Check if car ID is provided via POST request
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    // Retrieve car ID from POST data
    $car_id = $_POST['car_id'];

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "car_rental";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement to delete the car
    $stmt = $conn->prepare("DELETE FROM car_details WHERE id = ?");
    $stmt->bind_param("i", $car_id);

    // Execute the delete statement
    if ($stmt->execute()) {
        // Deletion successful
        $stmt->close();
        $conn->close();
        // Redirect back to ManageCarList.php
        header("Location: ManageCarList.php");
        exit();
    } else {
        // Error occurred
        echo "Error deleting car: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid or missing car ID
    echo "Invalid car ID!";
}
?>
