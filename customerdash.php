<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vroom - Car Rentals</title>
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
        <a href="customerdash.html" class="underline">Car rentals</a>
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
    <div class="left-panel">
      <div id="map"></div>
      <div class="filter-panel">
        <h2>Filter</h2><br>
        <!-- Filtering options -->
        <label for="price">Price Per Day:</label><br>
        <input type="radio" id="price-0-5000" name="price" value="0-5000">
        <label for="price-0-5000">0-5000</label><br>
        <input type="radio" id="price-5000-10000" name="price" value="5000-10000">
        <label for="price-5000-10000">5000-10000</label><br>
        <input type="radio" id="price-10000-15000" name="price" value="10000-15000">
        <label for="price-10000-15000">10000-15000</label><br>
        <input type="radio" id="price-15000-20000" name="price" value="15000-20000">
        <label for="price-15000-20000">15000-20000</label><br>
        <br>
        <label for="car-specs">Car Specs:</label><br>
        <input type="checkbox" id="ac">
        <label for="ac">Air Conditioning</label><br>
        <input type="checkbox" id="seats">
        <label for="seats">4+ seatings</label>
      </div>
    </div>
    
    
    <div class="car-info-panel">
    <h1>Available Cars:</h1>
    <?php
        // Establish database connection (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_rental";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch car data from the database (replace with your actual database query)
        $sql = "SELECT * FROM car_details";
        $result = $conn->query($sql);

        // Output car panels
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                include 'customerCarList.php'; // Include the car panel template
            }
        } else {
            echo "No cars available";
        }

        $conn->close();
        ?>
  </div>
    
    </main>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="customerdash.js"></script>
</body>
</html>
