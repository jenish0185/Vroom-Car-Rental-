<?php
session_start(); // Start the session

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "user_login";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    } else {
        echo "Database connected successfully!";
    }

    // Get input values from login form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $redirect_url = $_POST['redirect_url'];

    // SQL query to check if user exists in the database
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // User exists, determine if admin or regular user
        $user = $result->fetch_assoc();
        if ($user['id'] == 1) {
            // If user ID is 1, display error message and refresh the page
            echo "Invalid user ID!";
            echo "<meta http-equiv='refresh' content='2;url=login.php'>";
            exit();
        } else {
            // If user is regular user, fetch car information
            // For example, let's assume the user's car information is stored in a separate table called "cars"
            $car_sql = "SELECT * FROM cars WHERE user_id = ?";
            $car_stmt = $conn->prepare($car_sql);
            $car_stmt->bind_param("i", $user['id']);
            $car_stmt->execute();
            $car_result = $car_stmt->get_result();

            if ($car_result->num_rows > 0) {
                // Fetch car information
                $car = $car_result->fetch_assoc();
                // Redirect to carInformation.php with user ID and car ID
                header("Location: carInformation.php?user_id=" . $user['id'] . "&car_id=" . $car['id']);
                exit();
            } else {
                // No car information found for the user
                echo "No car information found!";
                exit();
            }
        }
    } else {
        // No matching user found, refresh the page
        echo "<meta http-equiv='refresh' content='2'>";
        exit();
    }
    
    // Close database connection
    $conn->close();
}

?>