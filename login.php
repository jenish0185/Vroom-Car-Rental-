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
            header("Location: admindash.php?user_id=" . $user['id']);
            exit();
        } else {
            // If user is regular user, redirect to customer dashboard
            $_SESSION['user_id'] = $user['id']; // Store user ID in session variable
            header("Location: index.php?user_id=" . $user['id']);
            exit();
        }
    } else {
        // No matching user found, set error message in session variable
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: login.php"); // Redirect back to login page
        exit();
    }
    


    // Close database connection
    $conn->close();
}
?>


</body>
<script>
    // Check if the PHP session variable 'login_error' is set
    <?php if(isset($_SESSION['login_error'])): ?>
        // Display the error message in a panel
        var errorMessage = "<?php echo $_SESSION['login_error']; ?>";
        alert(errorMessage);
        // Clear the session variable
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>
</script>

</html>
