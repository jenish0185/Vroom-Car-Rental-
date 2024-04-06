<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to insert data into the cars table
$sql = "INSERT INTO cars (car_name, image_url, description, price)
VALUES
    ('Kia e-Niro', 'C:/Users/jenis/OneDrive/Pictures/Vroom/car.png', 'Automatic transmission, 5 seats, 1 large bag, 2 small bags', 8000.00),
    ('Lamborghini', 'C:/Users/jenis/OneDrive/Pictures/Vroom/car.png', 'Manual transmission, 4 seats, 2 large bags, 1 small bag', 15000.00),
    ('Toyota Corolla', 'C:/Users/jenis/OneDrive/Pictures/Vroom/car.png', 'Automatic transmission, 5 seats, 1 large bag, 2 small bags', 7000.00)";

// Execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
