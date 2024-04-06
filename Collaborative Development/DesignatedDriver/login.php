<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // No password set
    $database = "car_rental";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role=?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Start session
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Redirect based on role
            if ($role == 'admin') {
                header("Location: admin.php");
            } elseif ($role == 'customer') {
                header("Location: customer.php");
            } elseif ($role == 'driver') {
                header("Location: driver.php");
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username or role.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
