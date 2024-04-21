<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connect to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert form data into database
    $sql = "INSERT INTO car_details (carName, carBrand, carType, carSeats, carSpace, carTransmission, carEngine, carMileage, electric, carPrice,
    airbags, absBrakes, tractionControl, audioSystem, bluetooth, navigation, parkingAssistance, airConditioning, heating, carImage)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssiiiiiiiiis", $carName, $carBrand, $carType, $carSeats, $carSpace, $carTransmission, $carEngine, $carMileage, $electric, $carPrice,
        $airbags, $absBrakes, $tractionControl, $audioSystem, $bluetooth, $navigation, $parkingAssistance, $airConditioning, $heating, $carImage);

    // Set parameters and execute the statement
    $carName = $_POST["carName"];
    $carBrand = $_POST["carBrand"];
    $carType = $_POST["carType"];
    $carSeats = $_POST["carSeats"];
    $carSpace = $_POST["carSpace"];
    $carTransmission = $_POST["carTransmission"];
    $carEngine = $_POST["carEngine"];
    $carMileage = $_POST["carMileage"];
    $electric = $_POST["electric"];
    $carPrice = $_POST["carPrice"];
    $airbags = isset($_POST["airbags"]) ? 1 : 0;
    $absBrakes = isset($_POST["absBrakes"]) ? 1 : 0;
    $tractionControl = isset($_POST["tractionControl"]) ? 1 : 0;
    $audioSystem = isset($_POST["audioSystem"]) ? 1 : 0;
    $bluetooth = isset($_POST["bluetooth"]) ? 1 : 0;
    $navigation = isset($_POST["navigation"]) ? 1 : 0;
    $parkingAssistance = isset($_POST["parkingAssistance"]) ? 1 : 0;
    $airConditioning = isset($_POST["airConditioning"]) ? 1 : 0;
    $heating = isset($_POST["heating"]) ? 1 : 0;
    $carImage = $_POST["carImage"]; // Assuming the image URL is sent through POST

    // Execute the statement
    if ($stmt->execute()) {
        // Close statement and database connection
        $stmt->close();
        $conn->close();

        // Redirect to the admin dashboard after successful submission
        header("Location: admindash.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect or display an error message
    echo "Form submission error: No data received.";
}
?>
