<?php
// Establish database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "user_login"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Database connected successfully!";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from login form
    $email = $_POST['email'];
    $password = $_POST['password'];

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
        if ($user['is_admin'] == 1) {
            // If user is admin, redirect to admin dashboard
            header("Location: admindash.html");
            exit();
        } else {
            // If user is regular user, redirect to customer dashboard
            header("Location: customerdash.html");
            exit();
        }
    } else {
        // User does not exist or credentials are incorrect, show error message
        echo "Invalid email or password";
    }
}

// Close database connection
$conn->close();
?>
