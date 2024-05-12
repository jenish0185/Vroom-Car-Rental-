<?php
// Start the session
session_start();

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
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
      .remove-btn {
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

      .remove-btn a {
        text-decoration: none; /* Remove underline */
        color: white; /* Set text color to white */
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
      <h1 class="vroom-text">Vroom</h1>
      <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
    <div class="nav-links">
        <a href="customerdash.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
        <a href="favorites.php?user_id=<?php echo $_GET['user_id']; ?>" class="underline">Favorites</a>
        <a href="book-history.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('book-history.php', this)">Booking History</a>
        <a href="settings.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
    </div>

    
    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageBookedCars.php?user_id=<?php echo htmlspecialchars($_GET['user_id']); ?>" class="manage-btn">Manage Booked Cars</a>
  </header>
  <main>

    <div class="favorites-panel-wrapper">
      <!-- Your Favorites content goes here -->
      <h1>Favorites List:</h1>

      <?php
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

      // Prepare and execute the SQL statement to fetch favorite cars
      $sql = "SELECT car_details.*
              FROM favorites
              INNER JOIN car_details ON favorites.car_id = car_details.id
              WHERE favorites.user_id = $user_id";
      $result = $conn->query($sql);

      // Check if there are favorite cars
      if ($result->num_rows > 0) {
          // Output each favorite car
          while ($row = $result->fetch_assoc()) {
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
                  
                  <!-- Price Section -->
                  <div class="price">
                      <!-- Price for a day -->
                      <h4>Price for a day:</h4>
                      <p class="number">Rs. <?php echo number_format($row['carPrice'], 2); ?></p>

                      <!-- Free cancellation -->
                      <p class="free-cancel">Free cancellation</p>
                      
                      <!-- Remove from Favorites Button -->
                      <div class="remove-btn">
                          <?php
                          // Display remove button
                          echo '<a href="favorites.php?user_id='.$user_id.'&car_id='.$row['id'].'">Remove from Favorites</a>';
                          ?>
                      </div>
                  </div>
              </div>
              <?php
          }
      } else {
          echo "<p>No favorite cars found.</p>";
      }

      // Close the database connection
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

  <script src="favorites.js"></script>
  <script>
     // Make the remove message disappear after 2-3 seconds
     setTimeout(function() {
        var message = document.getElementById('remove-message');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000); // Adjust the time as needed
  </script>

  
</body>
</html>
