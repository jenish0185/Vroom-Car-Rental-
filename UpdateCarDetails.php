<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Car Details</title>
  <link rel="stylesheet" href="admindash.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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
<header>
    <!-- For header/logo  -->
    <div class="branding">
      <h1 class="vroom-text">Vroom</h1>
      <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
      <div class="nav-links">
        <a href="admindash.php"class="underline">Car hostings</a>
        <a href="wallet.html" onclick="navigateTo('wallet.html', this)">Wallet</a>
        <a href="reviews.html" onclick="navigateTo('reviews.html', this)">Reviews</a>
        <a href="setting.html" onclick="navigateTo('setting.html', this)">Settings</a>

      </div>
    </nav>
    
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <button class="manage-btn">Manage Cars</button>
  </header>
  
<main>
    <h2>Update Car Details</h2>
    <!-- Form to update car details -->
    <?php
    // Retrieve car ID from URL parameter
    if (isset($_GET['car_id']) && is_numeric($_GET['car_id'])) {
        $car_id = $_GET['car_id'];
        
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_rental";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("SELECT * FROM car_details WHERE id = ?");
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if query was successful
        if ($result->num_rows > 0) {
            // Fetch car details as an associative array
            $row = $result->fetch_assoc();
    ?>
    <form action="update_process.php" method="post">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <label for="carName">Car Name:</label>
        <input type="text" id="carName" name="carName" value="<?php echo $row['carName']; ?>"><br><br>
        <!-- Add other form fields for updating car details -->
        <label for="carBrand">Car Brand:</label>
        <input type="text" id="carBrand" name="carBrand" value="<?php echo $row['carBrand']; ?>"><br><br>
        <!-- Add more input fields for other columns as needed -->
        <button type="submit">Confirm</button>
    </form>
    <?php
        } else {
            echo "No car found with ID: $car_id";
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid car ID!";
    }
    ?>
</main>
</body>
</html>
