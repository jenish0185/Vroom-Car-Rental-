<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Cars</title>
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

    <style>
    .delete-btn {
        width: 150px;
        height: 50px;
        background-color: red;
        color: white; /* Set text color to white */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 50px; /* Add margin to the left */
        }

        /* Apply styles to anchor tag within .update-btn */
        .delete-btn a {
        text-decoration: none; /* Remove underline */
        color: white; /* Set text color to white */
        }
    </style>
</head>
<styles>

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
<div class="car-panel-wrapper">
        <h1>Your Hosted Cars:</h1>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_rental";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch car data from the database
        $sql = "SELECT * FROM car_details";
        $result = $conn->query($sql);

        // Output car panels
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                include 'ManageCar.php'; // Include the car panel template
            }
        } else {
            echo "No cars available";
        }

        $conn->close();
        ?>
    </div>
</main>
</body>
</html>
