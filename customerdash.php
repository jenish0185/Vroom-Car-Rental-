<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
}
?>

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
      }
    </style>
</head>
<body>
 
  <header>
    <!-- For header/logo  -->
    <div class="branding">
    <a href="index.php" class="vroom-text">
        <h1>Vroom</h1>
    </a>
    <p class="slogan-text"><a href="index.php">Drive, Explore, and Repeat</a></p>
    </div>
    
      <nav>
        <div class="nav-links">
            <a href="<?php echo isset($_GET['user_id']) ? 'customerdash.php?user_id='.$_GET['user_id'] : 'customerdash.php'; ?>" class="underline">Car rentals</a>
            <a href="<?php echo isset($_GET['user_id']) ? 'favorites.php?user_id='.$_GET['user_id'] : 'favorites.php'; ?>" onclick="navigateTo('favorites.php', this)">Favorites</a>
            <a href="<?php echo isset($_GET['user_id']) ? 'book-history.php?user_id='.$_GET['user_id'] : 'book-history.php'; ?>" onclick="navigateTo('book-history.php', this)">Booking History</a>
            <a href="<?php echo isset($_GET['user_id']) ? 'settings.php?user_id='.$_GET['user_id'] : 'settings.php'; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
        </div>
    </nav>


  

    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>

    
    <a href="<?php echo isset($_GET['user_id']) ? 'ManageBookedCars.php?user_id='.htmlspecialchars($_GET['user_id']) : 'ManageBookedCars.php'; ?>" class="manage-btn">Manage Booked Cars</a>

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
          <input type="checkbox" id="airbags" name="specs[]" value="airbags" <?php if(isset($_POST['specs']) && in_array('airbags', $_POST['specs'])) echo 'checked'; ?>>
          <label for="airbags">Airbags</label><br>
          <input type="checkbox" id="absBrakes" name="specs[]" value="absBrakes" <?php if(isset($_POST['specs']) && in_array('absBrakes', $_POST['specs'])) echo 'checked'; ?>>
          <label for="absBrakes">ABS Brakes</label><br>
          <input type="checkbox" id="tractionControl" name="specs[]" value="tractionControl" <?php if(isset($_POST['specs']) && in_array('tractionControl', $_POST['specs'])) echo 'checked'; ?>>
          <label for="tractionControl">Traction Control</label><br>
          <input type="checkbox" id="audioSystem" name="specs[]" value="audioSystem" <?php if(isset($_POST['specs']) && in_array('audioSystem', $_POST['specs'])) echo 'checked'; ?>>
          <label for="audioSystem">Audio System</label><br>
          <input type="checkbox" id="bluetooth" name="specs[]" value="bluetooth" <?php if(isset($_POST['specs']) && in_array('bluetooth', $_POST['specs'])) echo 'checked'; ?>>
          <label for="bluetooth">Bluetooth</label><br>
          <input type="checkbox" id="navigation" name="specs[]" value="navigation" <?php if(isset($_POST['specs']) && in_array('navigation', $_POST['specs'])) echo 'checked'; ?>>
          <label for="navigation">Navigation</label><br>
          <input type="checkbox" id="parkingAssistance" name="specs[]" value="parkingAssistance" <?php if(isset($_POST['specs']) && in_array('parkingAssistance', $_POST['specs'])) echo 'checked'; ?>>
          <label for="parkingAssistance">Parking Assistance</label><br>
          <input type="checkbox" id="airConditioning" name="specs[]" value="airConditioning" <?php if(isset($_POST['specs']) && in_array('airConditioning', $_POST['specs'])) echo 'checked'; ?>>
          <label for="airConditioning">Air Conditioning</label><br>
          <input type="checkbox" id="heating" name="specs[]" value="heating" <?php if(isset($_POST['specs']) && in_array('heating', $_POST['specs'])) echo 'checked'; ?>>
          <label for="heating">Heating</label><br>

          <input type="submit" name="filter" value="Filter">
        </form>

      </div>
    </div>
    
    <div class="car-info-panel">
      <h1>Available Cars:</h1>
      <?php
     
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
        $sql = "SELECT * FROM car_details";

        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $specs = isset($_POST['specs']) ? $_POST['specs'] : [];

        if (!empty($price) || !empty($specs)) {
            $sql .= " WHERE";

            if (!empty($price)) {
                $sql .= " carPrice BETWEEN $price";
            }

            if (!empty($specs)) {
                if (!empty($price)) {
                    $sql .= " AND";
                }

                $sql .= " (";

                // Iterate through each selected spec
                $specConditions = []; // Array to hold individual spec conditions

                foreach ($specs as $spec) {
                    switch ($spec) {
                        case 'airConditioning':
                            $specConditions[] = "airConditioning = 1";
                            break;
                        case 'airbags':
                            $specConditions[] = "airbags = 1";
                            break;
                        case 'absBrakes':
                            $specConditions[] = "absBrakes = 1";
                            break;
                        case 'tractionControl':
                            $specConditions[] = "tractionControl = 1";
                            break;
                        case 'audioSystem':
                            $specConditions[] = "audioSystem = 1";
                            break;
                        case 'bluetooth':
                            $specConditions[] = "bluetooth = 1";
                            break;
                        case 'navigation':
                            $specConditions[] = "navigation = 1";
                            break;
                        case 'parkingAssistance':
                            $specConditions[] = "parkingAssistance = 1";
                            break;
                        case 'heating':
                            $specConditions[] = "heating = 1";
                            break;
                        default:
                            // Handle unsupported specs or ignore them
                            break;
                    }
                }

                // Combine individual spec conditions with AND
                $sql .= implode(" AND ", $specConditions);

                $sql .= ")";
            }
        }


        
      } else {
          // If no filters applied, fetch all car data
          $sql = "SELECT * FROM car_details";
      }

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              include 'customerCarList.php'; 
          }
      } else {
          echo "No cars available";
      }

      $conn->close();
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

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <script src="customerdash.js"></script>
  
</body>
</html>