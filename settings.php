<?php
// Check if the user ID is provided in the URL parameters
if(isset($_GET['user_id'])) {
    // Retrieve the user ID from the URL parameters and sanitize it
    $user_id = intval($_GET['user_id']); // Convert to integer to prevent SQL injection

    // Establish database connection
    $servername = "localhost";
    $username = "root"; // Replace with your actual database username
    $password = ""; // Replace with your actual database password
    $dbname = "user_login"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("SELECT username, profile_picture FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user_details = $result->fetch_assoc();

        // Close statement
        $stmt->close();

        // Close connection
        $conn->close();
    } else {
        // Handle the case where user details are not found
        echo "User details not found.";
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
     // Redirect back to the login page if user_id parameter is missing
     header("Location: login.php");
     exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vroom - Settings</title>
  <link rel="stylesheet" href="customerdash.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"/>

  <style>
    /* Add any additional styles specific to the Settings page */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
    }

    .profile-section {
      position: absolute;
      left: 20px;
      top: 180px;
    }

    .profile-box {
      background-color: transparent;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
    }

    .profile-box img {
      max-width: 100px; /* Adjust max width as needed */
      max-height: 100px; /* Adjust max height as needed */
    }

    .profile-section img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 20px; /* Increased margin */
    }

    .user-info {
      text-align: right;
    }

    .username {
      margin: 0;
      font-size: 24px; /* Increased font size */
      font-weight: bold;
      margin-bottom: 5px;
    }

    .edit-profile {
      text-decoration: none;
      color: #007bff;
    }

    .settings-content {
      margin: 0 auto;
      font-size: 20px; /* Increased font size */
    }

    .main-left {
      width: 500px;
      position: relative;
      font-size: 20px;
    }

    .settings-links {
      display: flex;
      flex-direction: column;
      margin-top: 50px;
    }

    .settings-links a {
      margin-bottom: 10px;
      padding: 12px;
      display: flex;
      align-items: center;
      color: #333;
      text-decoration: none;
    }

    .settings-links a i {
      margin-right: 15px; /* Increased the space between icon and text */
    }

    .logout-btn {
      margin-top: auto;
      width: 100%;
      text-align: center;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 20px;
      text-decoration: none;
    }

    .logout-btn:hover {
      background-color: #0056b3;
    }
  </style>
  
</head>
<body>

  <header>
    <!-- For header/logo  -->
    <div class="branding">
      <h1 class="vroom-text">Vroom</h1>
      <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
    <div class="nav-links">
        <a href="customerdash.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
        <a href="favorites.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('favorites.php', this)">Favorites</a>
        <a href="book-history.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('book-history.php', this)">Booking History</a>
        <a href="settings.php?user_id=<?php echo $_GET['user_id']; ?>" class="underline">Settings</a>
    </div>


    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageBookedCars.php?user_id=<?php echo htmlspecialchars($_GET['user_id']); ?>" class="manage-btn">Manage Booked Cars</a>
  </header>
  <main>
    <div class="main-left">
      <div class="profile-container">
      <div class="profile-box">
        <?php
        // Check if profile picture is available
        if (!empty($user_details['profile_picture'])) {
            // Output the image with CSS for center alignment
            echo '<img src="data:image/jpeg;base64,' . $user_details['profile_picture'] . '" alt="Profile">';
        } else {
            // Display default profile picture if profile picture is not available
            echo '<img src="default_profile_picture.jpg" alt="Profile">';
        }
        ?>
        <div class="user-info">
            <p class="username"><?php echo $user_details['username']; ?></p>
            <a href="account.php" class="edit-profile">Edit Profile</a>
        </div>
    </div>

      

      </div>
      <div class="settings-links">
      <a href="account.php?user_id=<?php echo $_GET['user_id']; ?>"><i class="fas fa-user"></i> Account</a>

        <a href="#"><i class="fas fa-question-circle"></i> How to use vroom</a>
        <a href="#"><i class="fas fa-shield-alt"></i> contact support</a>
        <a href="#"><i class="fas fa-lock"></i> terms and condition</a>
        <a href="#"><i class="fas fa-file-alt"></i> privacy policy</a> <!-- Changed icon -->
        <a href="#"><i class="fas fa-gem"></i> premium subscription</a> <!-- Changed icon -->
        <a href="#"><i class="fas fa-exclamation-triangle"></i> emergency roadside</a>
      </div>
      <div class="car-panel-wrapper">
        <!-- Your settings content goes here -->
      </div>
      <div class="logout-btn">
        <a href="index.html">Logout</a>
      </div>
    </div>
  </main>

  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  
  
</body>
</html>
