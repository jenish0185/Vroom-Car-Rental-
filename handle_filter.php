<?php
// Establish database connection 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Construct the SQL query dynamically based on selected checkboxes
$sql = "SELECT * FROM car_details WHERE ";

$specs = isset($_POST['specs']) ? $_POST['specs'] : [];
foreach ($specs as $spec) {
    // Add conditions for each selected specification
    $sql .= "$spec = 1 AND ";
}
// Remove the trailing "AND" from the SQL query
$sql = rtrim($sql, " AND ");

// Execute the SQL query
$result = $conn->query($sql);

// Process the query result and display car details
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display car details here
        echo "<p>" . $row['carName'] . "</p>";
    }
} else {
    echo "No cars available";
}

$conn->close();
?>
