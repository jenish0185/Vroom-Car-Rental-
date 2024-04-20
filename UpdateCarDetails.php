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

// Check if car ID is provided
if (!isset($_GET['car_id'])) {
    echo "Car ID not provided!";
} else {
    // Retrieve car ID from the URL parameter
    $car_id = $_GET['car_id'];

    // Retrieve car details from the database based on the provided car ID
    $sql = "SELECT * FROM car_details WHERE id = $car_id";
    $result = $conn->query($sql);

    // Check if query was successful
    if ($result) {
        // Check if car details exist
        if ($result->num_rows > 0) {
            // Fetch car details as an associative array
            $row = $result->fetch_assoc();
            // Display car details form with values pre-filled for editing
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update Car Details</title>
                <!-- Add your CSS styles here -->
            </head>
            <body>
                <h2>Update Car Details</h2>
                <!-- Form to update car details -->
                <form action="process_update.php" method="post">
                    <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
                    <label for="carName">Car Name:</label>
                    <input type="text" id="carName" name="carName" value="<?php echo $row['carName']; ?>"><br><br>
                    <!-- Add other form fields for updating car details -->
                    <button type="submit">Confirm</button>
                </form>
            </body>
            </html>
<?php
        } else {
            echo "No car found with ID: $car_id";
        }
    } else {
        echo "Error retrieving car details: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
