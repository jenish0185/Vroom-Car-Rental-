<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Car Details</title>
  <link rel="stylesheet" href="UpdateCarDetails.css">
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
      }</style>
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
        <a href="admindash.php" class="underline">Car hostings</a>
        <a href="wallet.php" onclick="navigateTo('wallet.php', this)">Wallet</a>
        <a href="inbox.php" onclick="navigateTo('inbox.php', this)">Inbox</a>
        <a href="setting.php" onclick="navigateTo('setting.php', this)">Settings</a>

      </div>
    </nav>
    
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageCarList.php" class="manage-btn">Manage Cars</a>
</header>
  
<main>
    <h2>Update Car Details</h2><br>
    <!-- Form to update car details -->
    <div class="form-container">
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

        <form id="carForm" method="post" enctype="multipart/form-data" action="update_process.php">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        
        <!-- Car Name -->
        <label for="carName">Car Name:</label>
        <input type="text" id="carName" name="carName" value="<?php echo $row['carName']; ?>"><br><br>
        
        <!-- Car Brand Selector -->
        <label for="carBrand">Car Brand:</label>
        <select id="carBrand" name="carBrand" style="color: rgba(0, 0, 0, 0.5);">
            <option value="" disabled selected>-----Car Brand-------</option>
            <option value="Toyota">Toyota</option>
            <option value="Honda">Honda</option>
            <option value="Ford">Ford</option>
            <option value="Chevrolet">Chevrolet</option>
            <option value="BMW">BMW</option>
            <option value="Mercedes-Benz">Mercedes-Benz</option>
            <option value="Audi">Audi</option>
            <option value="Volkswagen">Volkswagen</option>
            <option value="Nissan">Nissan</option>
            <option value="Hyundai">Hyundai</option>
            <option value="Kia">Kia</option>
            <option value="Subaru">Subaru</option>
            <option value="Porsche">Porsche</option>
            <option value="Ferrari">Ferrari</option>
            <option value="Lamborghini">Lamborghini</option>
            <option value="Aston Martin">Aston Martin</option>
            <option value="Tesla">Tesla</option>
            <option value="Jaguar">Jaguar</option>
            <option value="Land Rover">Land Rover</option>
            <option value="Jeep">Jeep</option>
            <!-- Add more options here -->
        </select><br><br>
        
        <!-- Car Type Selector -->
        <label for="carType">Car Type:</label>
        <select id="carType" name="carType" style="color: rgba(0, 0, 0, 0.5);">
            <option value="" disabled selected>-----Car Type-------</option>
            <option value="SUV">SUV</option>
            <option value="Offroad">Offroad</option>
            <option value="Sports">Sports</option>
            <option value="Sedan">Sedan</option>
            <option value="Hatchback">Hatchback</option>
            <option value="Coupe">Coupe</option>
            <option value="Convertible">Convertible</option>
            <option value="Electric">Electric</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Luxury">Luxury</option>
            <option value="Compact">Compact</option>
            <option value="Microcar">Microcar</option>
            <!-- Add more options here -->
        </select><br><br>
        
        <!-- Car Seats Selector -->
        <label for="carSeats">Number of Seats:</label>
        <select id="carSeats" name="carSeats" style="color: rgba(0, 0, 0, 0.5);">
            <option value="" disabled selected>-----Number of Seats-------</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5+</option>
            <!-- Add more options here -->
        </select><br><br>
        
        <!-- Car Space Selector -->
        <label for="carSpace">Space (e.g. for luggage):</label>
        <select id="carSpace" name="carSpace" style="color: rgba(0, 0, 0, 0.5);">
            <option value="" disabled selected>-----Space (e.g. for luggage)-------</option>
            <option value="1 Small bag">1 Small bag</option>
            <option value="1 Large bag">1 Large bag</option>
            <option value="2 Large bags">2 Large bags</option>
            <!-- Add more options here -->
        </select><br><br>
        
        <!-- Car Transmission Selector -->
        <label for="carTransmission">Transmission Type:</label>
        <select id="carTransmission" name="carTransmission" style="color: rgba(0, 0, 0, 0.5);">
              <option value="" disabled selected>-----Transmission Type-------</option>
              <option value="Automatic">Automatic</option>
              <option value="Manual">Manual</option>
              <option value="Continuously Variable Transmission (CVT)">Continuously Variable Transmission (CVT)</option>
              <option value="Automated Manual Transmission (AMT)">Automated Manual Transmission (AMT)</option>
              <option value="Dual-Clutch Transmission (DCT)">Dual-Clutch Transmission (DCT)</option>
              <option value="Sequential Manual Transmission (SMT)">Sequential Manual Transmission (SMT)</option>
              <option value="Tiptronic Transmission">Tiptronic Transmission</option>
              <!-- Add more options as needed -->
        </select><br><br>
        
        <!-- Car Engine Selector -->
        <label for="carEngine">Engine Type:</label>
        <select id="carEngine" name="carEngine" style="color: rgba(0, 0, 0, 0.5);">
              <option value="" disabled selected>-----Engine Type-------</option>
              <option value="Petrol">Petrol</option>
              <option value="Diesel">Diesel</option>
              <option value="Hybrid">Hybrid</option>
              <option value="Electric">Electric</option>
              <option value="Plug-in Hybrid">Plug-in Hybrid</option>
              <!-- Add more options as needed -->
          </select><br><br>

        
        <!-- Car Mileage Selector -->
        <label for="carMileage">Mileage:</label>
        <select id="carMileage" name="carMileage" style="color: rgba(0, 0, 0, 0.5);">
              <option value="" disabled selected>-----Mileage-------</option>
              <option value="Less than 10,000 miles">Less than 10,000 miles</option>
              <option value="10,000 - 20,000 miles">10,000 - 20,000 miles</option>
              <option value="20,000 - 30,000 miles">20,000 - 30,000 miles</option>
              <option value="30,000 - 40,000 miles">30,000 - 40,000 miles</option>
              <option value="40,000 - 50,000 miles">40,000 - 50,000 miles</option>
              <option value="50,000 - 60,000 miles">50,000 - 60,000 miles</option>
              <option value="60,000 - 70,000 miles">60,000 - 70,000 miles</option>
              <option value="70,000 - 80,000 miles">70,000 - 80,000 miles</option>
              <option value="80,000 - 90,000 miles">80,000 - 90,000 miles</option>
              <option value="90,000 - 100,000 miles">90,000 - 100,000 miles</option>
              <option value="Over 100,000 miles">Over 100,000 miles</option>
              <option value="Unlimited">Unlimited</option>
              <!-- Add more options as needed -->
        </select><br><br>
        
        
        
        <!-- Car Price -->
        <label for="carPrice">Price:</label>
        <input type="text" id="carPrice" name="carPrice" value="<?php echo $row['carPrice']; ?>"><br><br>

        <!-- Image Upload -->
        <label for="carImage">Upload Image:</label><br>
        <input type="file" id="carImage" name="carImage"><br><br>

        <!-- Back and Submit buttons -->
        <button id="submitButton" class="button" type="submit">Confirm</button>
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
</body>
</html>
