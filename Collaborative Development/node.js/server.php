<?php
header("Access-Control-Allow-Origin: *"); // Allow cross-origin requests
header("Content-Type: application/json"); // Set response content type to JSON

require_once 'database.php';

// API endpoint to fetch car data
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getCars') {
    $query = "SELECT * FROM cars"; // Change 'cars' to your table name
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $cars = array();
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }
        echo json_encode($cars); // Encode fetched data as JSON and send response
    } else {
        echo json_encode(array('message' => 'No cars found')); // Send JSON response if no cars found
    }
} else {
    // Send error response if request method or action parameter is invalid
    http_response_code(400);
    echo json_encode(array('message' => 'Invalid request'));
}

$conn->close();
?>
