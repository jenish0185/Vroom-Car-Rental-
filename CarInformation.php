<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vroom - Favorites</title>
  <link rel="stylesheet" href="customerdash.css">
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
    /* Reset CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    header {
      height: 200px;
      background-color: #7B2CF8;
      color: white;
      padding: 20px;
      display: flex;
      flex-wrap: wrap; /* Allow items to wrap to the next line */
      justify-content: space-between;
      align-items: center;
      max-width: 1550px; /* Added max-width */
      margin: 0 auto; /* Center the header */
    }

    .branding {
      display: flex;
      align-items: center;
    }

    .branding img {
      width: 100px; /* Adjusted width of the logo */
      height: auto; /* Maintain aspect ratio */
      margin-right: 10px; /* Add some spacing between logo and text */
    }

    .vroom-text {
      font-family: 'meddon';
      font-size: 32px;
      margin-bottom: 5px;
    }

    .slogan-text {
      font-family: 'anek bangla';
      font-size: 15px;
    }

    .nav-links {
      flex-basis: 100%; /* Take up full width initially */
    }

    .nav-links a {
      font-size: 20px;
      font-weight: 500;
      font-family: "Anek Bangla";
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      margin-right: 50px; /* Add margin between each link */
    }

    .currency-selector,
    .manage-btn {
      margin-top: 20px; /* Add space between currency selector and manage button */
    }

    .currency-btn {
      background-color: white;
      color: #7B2CF8;
      border: none;
      padding: 15px 25px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 20px;
    }

    .profile-picture {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background-image: url('image.png'); /* Replace 'images.png' with your image path */
      background-size: cover;
      border: none; /* Remove the border */
    }

    .manage-btn {
      background-color: #ffffff;
      color: #7B2CF8;
      border: none;
      padding: 15px 25px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 20px;
    }

    main {
      display: flex;
      justify-content: space-between;
      padding: 20px;
      margin-top: 30px; /* Add a gap of 50px */
      max-width: 1550px; /* Added max-width */
      margin: 0 auto; /* Center the content */
    }

    .favorites-panel-wrapper {
      /* Add styles for favorites panel */
    }

    .car-panel {
      width: 700px; /* Adjusted width */
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .car-image {
      margin-bottom: 20px;
    }

    .car-details {
      font-size: 18px;
    }

    .booking-panel {
      width: 45%; /* Adjusted width */
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .price-panel {
      width: 45%; /* Adjusted width */
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .continue-booking {
      position: fixed;
      bottom: 20px;
      left: 20px;
    }

    .continue-booking button {
      background-color: #119F1F; /* Green color */
      color: white;
      border: none;
      padding: 20px 40px; /* Bigger padding */
      border-radius: 10px;
      font-size: 20px; /* Bigger font size */
      cursor: pointer;
    }

    @media screen and (max-width: 768px) {
      .car-panel,
      .booking-panel,
      .price-panel {
        width: 100%; /* Full width on smaller screens */
      }
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
        <a href="customerdash.php" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
        <a href="favorites.html" onclick="navigateTo('favorites.html', this)">Favorites</a>

        <a href="book-history.html" onclick="navigateTo('book-history.html', this)">Booking History</a>
        <a href="settings.html" onclick="navigateTo('settings.html', this)">Settings</a>
      </div>
    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <button class="manage-btn">Manage Bookings</button>
  </header>

  <main>

    <div class="favorites-panel-wrapper">
      <!-- Your Favorites content goes here -->
    </div>

    <?php
    // Retrieve the car ID from the URL parameter
    if(isset($_GET['car_id'])) {
        $car_id = $_GET['car_id'];
        
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there's no password
        $dbname = "car_rental";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL statement to fetch car details
        $sql = "SELECT * FROM car_details WHERE id = $car_id";
        $result = $conn->query($sql);

        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Fetch car details
            $row = $result->fetch_assoc();
    ?>

    <div class="car-panel">
        <div class="car-image">
            <?php
            // Decode the base64 encoded image retrieved from the database
            $imageData = base64_decode($row['carImage']);
            // Output the image data
            echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'">';
            ?>
        </div>
        
        <div class="car-details">
            <!-- Display car name -->
            <h3><?php echo $row['carName']; ?></h3>
            <!-- Display car brand -->
            <div class="car-spec">
                <img src="brand-image.png" alt="Brand Icon">
                <span><?php echo $row['carBrand']; ?></span>
            </div>
            <!-- Display car type -->
            <div class="car-spec">
                <img src="vehicles.png" alt="Type Icon">
                <span><?php echo $row['carType']; ?></span>
            </div>
            <!-- Display number of seats -->
            <div class="car-spec">
                <img src="car-chair.png" alt="Seats">
                <span><?php echo $row['carSeats']; ?> seats</span>
            </div>
            <!-- Display transmission type with color indicating automatic or manual -->
            <div class="car-spec">
                <img src="gear-shift.png" alt="Transmission">
                <span style="color: <?php echo ($row['carTransmission'] == 'Automatic') ? 'rgb(2, 255, 2)' : 'rgb(255, 0, 0)'; ?>"><?php echo $row['carTransmission']; ?></span>
            </div>
            <!-- Display car location with color indicating different locations -->
            <p class="location" style="color:<?php echo ($row['carLocation'] == 'Kathmandu') ? '#4285F4' : '#F4B400'; ?>"><?php echo $row['carLocation']; ?></p>
        </div>
    </div>

    <?php
        } else {
            echo "Car not found.";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Car ID not provided.";
    }
    ?>

    <!-- Booking Panel -->
    <div class="booking-panel">
        <h3>Booking Details</h3>
        <!-- Pickup and Drop Locations -->
        <div class="pickup-drop-locations">
            <h3>Pickup and Drop Locations</h3>
            <p>Mon, May 13, 10 AM, Kathmandu</p>
            <hr> <!-- Horizontal line -->
            <p>Tue, May 14, 10 AM, Kathmandu</p>
        </div>
    </div>

    <!-- Price Panel -->
    <div class="price-panel">
        <h3>Car Price and Booking Duration</h3>
        <p>Price: $<?php echo $row['carPrice']; ?></p>
        <?php
            // Calculate the number of days between pickup and drop dates
            $pickup_date = strtotime('2024-05-13');
            $drop_date = strtotime('2024-05-14');
            $days_diff = ceil(abs($drop_date - $pickup_date) / (60 * 60 * 24));
        ?>
        <p>Booking Duration: <?php echo $days_diff; ?> days</p>
    </div>

  </main>

  <!-- Continue Booking Button -->
  <div class="continue-booking">
    <button>Continue Booking</button>
  </div>

  <script src="favorites.js"></script>

</body>
</html>
