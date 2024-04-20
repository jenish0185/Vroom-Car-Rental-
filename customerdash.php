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
        <a href="customerdash.php" class="underline">Car rentals</a>
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
        <form action="" method="post">
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
          <input type="checkbox" id="airbags" name="specs[]" value="airbags">
          <label for="airbags">Airbags</label><br>
          <input type="checkbox" id="absBrakes" name="specs[]" value="absBrakes">
          <label for="absBrakes">ABS Brakes</label><br>
          <input type="checkbox" id="tractionControl" name="specs[]" value="tractionControl">
          <label for="tractionControl">Traction Control</label><br>
          <input type="checkbox" id="audioSystem" name="specs[]" value="audioSystem">
          <label for="audioSystem">Audio System</label><br>
          <input type="checkbox" id="bluetooth" name="specs[]" value="bluetooth">
          <label for="bluetooth">Bluetooth</label><br>
          <input type="checkbox" id="navigation" name="specs[]" value="navigation">
          <label for="navigation">Navigation</label><br>
          <input type="checkbox" id="parkingAssistance" name="specs[]" value="parkingAssistance">
          <label for="parkingAssistance">Parking Assistance</label><br>
          <input type="checkbox" id="airConditioning" name="specs[]" value="airConditioning">
          <label for="airConditioning">Air Conditioning</label><br>
          <input type="checkbox" id="heating" name="specs[]" value="heating">
          <label for="heating">Heating</label><br>
          <input type="submit" name="filter" value="Filter">
        </form>

      </div>
    </div>
    
    <div class="car-info-panel">
      <h1>Available Cars:</h1>
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

        // Fetch car data from the database based on filters 
        if (isset($_POST['filter'])) {
            $sql = "SELECT * FROM car_details WHERE ";

            $price = isset($_POST['price']) ? $_POST['price'] : '';
            if (!empty($price)) {
                $sql .= "carPrice BETWEEN $price";
            }

            $specs = isset($_POST['specs']) ? $_POST['specs'] : [];
            if (!empty($specs)) {
                if (!empty($price)) {
                    $sql .= " AND ";
                }
                foreach ($specs as $spec) {
                    if ($spec === 'air_conditioning') {
                        $sql .= "airConditioning = 1";
                    } elseif ($spec === 'absBrakes') {
                        $sql .= "absBrakes = 1";
                    } elseif ($spec === 'tractionControl') {
                        $sql .= "tractionControl = 1";
                    } elseif ($spec === 'audioSystem') {
                        $sql .= "audioSystem = 1";
                    } elseif ($spec === 'bluetooth') {
                        $sql .= "bluetooth = 1";
                    } elseif ($spec === 'navigation') {
                        $sql .= "navigation = 1";
                    } elseif ($spec === 'parkingAssistance') {
                        $sql .= "parkingAssistance = 1";
                    } elseif ($spec === 'airConditioning') {
                        $sql .= "airConditioning = 1";
                    } elseif ($spec === 'heating') {
                        $sql .= "heating = 1";
                    }
                }
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    include 'customerCarList.php'; 
                }
            } else {
                echo "No cars available";
            }
        } else {
            // If no filters applied, fetch all car data
            $sql = "SELECT * FROM car_details";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    include 'customerCarList.php'; // Include the car panel template
                }
            } else {
                echo "No cars available";
            }
        }

        $conn->close();
        ?>

    </div>
  </main>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="customerdash.js"></script>
</body>
</html>
