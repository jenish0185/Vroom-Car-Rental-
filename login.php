<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="styles.css">

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"
    />
</head>
<body>

<main>
    <div class="background-image-container"></div>
    <div class="logo-container">
        <div class="logo-circle">
            <img src="vroom-logo.png" alt="Logo">
        </div>
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="login.php"> <!-- Updated action attribute -->
            <input type="email" name="email" placeholder="Email"> <!-- Added name attribute -->
            <input type="password" name="password" placeholder="Password"> <!-- Added name attribute -->
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account already? <a href="signup.html">Sign Up</a></p>
    </div>
    <div class="login-others">
        <h2>Login with others</h2>
        <button class="google-btn"><img src="google.webp"> Login with Google</button>
        <button class="facebook-btn"><img src="facebook.webp"> Login with Facebook</button>
    </div>
</main>

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
            header("Location: admindash.php");
            exit();
        } else {
            // If user is regular user, redirect to customer dashboard
            $_SESSION['user_id'] = $user['user_id']; // Store user ID in session variable
            header("Location: customerdash.php?user_id=" . $user['id']);
            exit();
        }
    } else {
        // User does not exist or credentials are incorrect, show error message
        echo "Invalid email or password";
    }

    // Close database connection
    $conn->close();
}
?>


</body>
</html>
