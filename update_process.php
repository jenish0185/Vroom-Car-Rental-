<?php
// Check if form is submitted and car ID is provided
if (isset($_POST['car_id']) && is_numeric($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
    
    // Retrieve form data
    $carName = $_POST['carName'];
    $carBrand = $_POST['carBrand'];
    $carType = $_POST['carType'];
    $carSeats = $_POST['carSeats'];
    $carSpace = $_POST['carSpace'];
    $carTransmission = $_POST['carTransmission'];
    $carEngine = $_POST['carEngine'];
    $carMileage = $_POST['carMileage'];
    $electric = $_POST['electric'];
    $carPrice = $_POST['carPrice'];
    
    // Check if an image file was uploaded
    if (isset($_FILES['carImage']) && $_FILES['carImage']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded image file
        $imageTmpName = $_FILES['carImage']['tmp_name'];
        
        // Read the image file content
        $imageData = file_get_contents($imageTmpName);
        
        // Encode the image data using base64
        $base64Image = base64_encode($imageData);
    } else {
        // If no image uploaded, set base64 data to null
        $base64Image = null;
    }
    
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
    $stmt = $conn->prepare("UPDATE car_details SET carName = ?, carBrand = ?, carType = ?, carSeats = ?, carSpace = ?, carTransmission = ?, carEngine = ?, carMileage = ?, electric = ?, carPrice = ?, carImage = ? WHERE id = ?");
    $stmt->bind_param("sssssssssssi", $carName, $carBrand, $carType, $carSeats, $carSpace, $carTransmission, $carEngine, $carMileage, $electric, $carPrice, $base64Image, $car_id);
    
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
