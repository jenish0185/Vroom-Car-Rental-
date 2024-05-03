<?php
// Check if form is submitted and car ID is provided
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
    
    // Retrieve form data
    $carName = $_POST['carName'];
    $carBrand = $_POST['carBrand']; // Add other form fields as needed
    
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
    
    // Prepare and bind the SQL statement to update car details
    $stmt = $conn->prepare("UPDATE car_details SET carName = ?, carBrand = ? WHERE id = ?");
    $stmt->bind_param("ssi", $carName, $carBrand, $car_id);
    
    // Execute the update statement
    if ($stmt->execute()) {
        // Redirect back to UpdateCarDetails.php with the updated car ID
        header("Location: UpdateCarDetails.php?car_id=$car_id");
        exit();
    } else {
        echo "Error updating car details: " . $conn->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid car ID!";
}
?>
