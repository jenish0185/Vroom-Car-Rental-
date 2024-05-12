<?php
// Set the user ID to 1 by default
$user_id = 1;



// Output the user ID to the browser console
echo "<script>console.log('User ID:', $user_id);</script>";


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

    /* New styles for the contact panel */
    #contact {
        margin-top: 250px;
        margin-bottom: 0;
        height: 60vh; /* Adjust height as needed */
        background-color: #12042a; /* Set background color to black */
        color: #fff; /* Set text color to white */
        padding: 50px; /* Add padding */
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }

      /* Style for the headers */
      .contact-header {
        font-size: 24px;
        margin-bottom: 10px;
      }

      /* Adjust margins for the headers */
      .vroom-header {
        margin-right: 20px;
      }

      .about-vroom-header {
        margin-right: 20px;
      }

      .top-brands-header {
        margin-right: 20px;
      }

      /* Style for the list items */
      .contact-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
      }

      .contact-list-item {
        margin-bottom: 8px;
      }

      .contact-list-item:last-child {
        margin-bottom: 0;
      }

      /* Style for socials header */
      .socials-header {
        margin-bottom: 10px; /* Add margin to create space between the header and icons */
      }

      /* Style for social icons */
      .socials {
        display: flex;
        flex-direction: column;
      }

      .social {
        display: flex;
        align-items: center; /* Align items vertically */
        margin-bottom: 10px; /* Add margin to create space between each social icon and name */
      }

      .social a {
        text-decoration: none;
        color: inherit; /* Inherit color from parent */
      }

      .social a:hover,
      .social a:focus {
        color: #800080; /* Change color to purple/blue on hover or focus */
      }

      .social img {
        width: 48px; /* Double the width of the image */
        height: 48px; /* Double the height of the image */
        margin-right: 10px;
      }

      .social span {
        color: #fff;
        font-size: 18px; /* Adjust font size for the name */
        font-weight: bold; /* Make the name bold */
      }
  </style>
  
</head>
<body>

<header>
    <!-- For header/logo  -->
    <div class="branding">
      <h1 href="Index.html" class="vroom-text" >Vroom</h1>
      <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
      <div class="nav-links">
        <a href="admindash.php" onclick="navigateTo('admindash.php', this)">Car hostings</a>
        <a href="wallet.php" onclick="navigateTo('wallet.php', this)">Wallet</a>
        <a href="inbox.php" onclick="navigateTo('inbox.php', this)">Inbox</a>
        <a href="setting.php" class="underline">Settings</a>
      </div>
    </nav>
    
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageCarList.php" class="manage-btn">Manage Cars</a>

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
      <a href="admin_account.php"><i class="fas fa-user"></i> Account</a>

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
        <a href="index.php">Logout</a>
      </div>
    </div>
  </main>

  <section id="contact" class="panel">
    <div class="vroom-info">
        <h2 class="contact-header vroom-header">Vroom</h2>
        <p>Email: vroom@gmail.com</p>
        <p>Phone: +977 1234567890</p>
    </div>
    <div class="about-vroom">
        <h3 class="contact-header about-vroom-header">About Vroom</h3>
        <ul class="contact-list">
            <li class="contact-list-item">About Us</li>
            <li class="contact-list-item">Career</li>
            <li class="contact-list-item">Terms of Service</li>
            <li class="contact-list-item">Privacy Policy</li>
        </ul>
    </div>
    <div class="top-affiliated-brands">
        <h3 class="contact-header top-brands-header">Top Affiliated Brands</h3>
        <ul class="contact-list">
            <li class="contact-list-item">BMW</li>
            <li class="contact-list-item">Lamborghini</li>
            <li class="contact-list-item">Ferrari</li>
            <li class="contact-list-item">Audi</li>
            <li class="contact-list-item">Honda</li>
            <li class="contact-list-item">Ford</li>
            <li class="contact-list-item">Mercedes</li>
            <li class="contact-list-item">Nissan</li>
            <li class="contact-list-item">Bentley</li>
            <li class="contact-list-item">Porsche</li>
            <!-- Add more brands as needed -->
        </ul>
    </div>
    <div class="socials">
        <h3 class="contact-header socials-header">Socials</h3>
        <div class="social">
            <a href="https://www.facebook.com">
                <img src="facebook.webp" alt="Facebook">
                <span>Facebook</span>
            </a>
        </div>
        <div class="social">
            <a href="https://www.instagram.com/">
                <img src="instagram-logo.png" alt="Instagram">
                <span>Instagram</span>
            </a>
        </div>
        <div class="social">
            <a href="https://twitter.com/">
                <img src="x-logo.png" alt="Twitter">
                <span>Twitter</span>
            </a>
        </div>
    </div>
    
    
</section>

  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  
  
</body>
</html>
