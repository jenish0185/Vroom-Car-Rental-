<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "user_login"; // Change to your actual database name

// Check if the user ID is provided
if (isset($_POST['user_id'])) {
    // Check if the image file was uploaded without errors
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        // Read the image data from the uploaded file
        $imageData = file_get_contents($_FILES['profile_picture']['tmp_name']);
        
        // Encode the image data in base64
        $base64ImageData = base64_encode($imageData);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the database with the base64 encoded image data
        $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $base64ImageData, $_POST['user_id']);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "message" => "Failed to update profile picture.");
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        $response = array("success" => false, "message" => "Error uploading image.");
    }
} else {
    $response = array("success" => false, "message" => "User ID not provided.");
}

// Send JSON response
echo json_encode($response);
?>
