<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "user_login"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!<br>"; // Connected successfully message
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from signup form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    
    // Check if the user already exists in the database
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "User with this email already exists!<br>"; // Inform if user already exists
    } else {
        // Insert new user into the database
        $insert_sql = "INSERT INTO users (username, email, password, phone, is_admin) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $is_admin = 0; // Default value for new users
        $insert_stmt->bind_param("ssssi", $username, $email, $password, $phone, $is_admin);
        
        if ($insert_stmt->execute() === TRUE) {
            // Signup successful, redirect to login page
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $insert_stmt->error; // Inform if there's an error during signup
        }
    }

    // Close statement
    $check_stmt->close();
    $insert_stmt->close();
}

// Close connection
$conn->close();
?>
