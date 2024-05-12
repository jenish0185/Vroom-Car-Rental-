<?php
session_start();

// Check if user_id parameter exists in the URL
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Database configurations
    $car_rental_db_host = 'localhost';
    $car_rental_db_username = 'root';
    $car_rental_db_password = '';
    $car_rental_db_name = 'car_rental'; // Database name for car_rental

    // Create connection to car_rental database
    $car_rental_conn = mysqli_connect($car_rental_db_host, $car_rental_db_username, $car_rental_db_password, $car_rental_db_name);

    // Check connection
    if (!$car_rental_conn) {
        die("Connection to car_rental database failed: " . mysqli_connect_error());
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
  <title>Car Information</title>
  <link rel="stylesheet" href="ManageBookedCars.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap">
  <style>
    .car-panel {
      margin-top: 50px;
      margin-left: 100px;
      width: 900px;
      display: flex;
      align-items: flex-start;
      background-color: white;
      border-radius: 20px;
      border: 2px solid #000000;
      margin-bottom: 20px;
      padding: 20px;
    }

    .car-image {
      width: 40%;
    }

    .car-image img {
      margin-top: -10px;
      margin-left: -10px;
      width: 100%;
      border-radius: 10px;
    }

    .car-details {
      flex: 1;
      margin-left: 20px;
    }

    .car-details h3 {
      margin-top: 0;
      color: #000;
      font-family: "Anek Bangla";
      font-size: 32px;
      font-style: normal;
      font-weight: 500;
      line-height: normal;
    }

    .car-specs {
      margin-bottom: 20px;
    }

    .car-spec {
      display: flex;
      align-items: center;
      margin-bottom: 5px;
    }

    .car-spec img {
      width: 20px;
      margin-right: 5px;
    }

    .price {
      width: 30%;
      text-align: center;
    }

    .price h4 {
      margin-top: 0;
      color: #000000a8;
    }

    .price p.number {
      color: #000;
      font-family: "Anek Bangla";
      font-size: 32px;
      font-style: normal;
      font-weight: 500;
      line-height: normal;
    }

    .free-cancel {
      color: #119F1F;
      font-family: "Anek Bangla";
      font-size: 14px;
      font-style: normal;
      font-weight: 600;
      line-height: normal;
    }
    .manage-btn {
      background-color: #ffffff;
      color: #7B2CF8;
      border: none;
      padding: 15px 25px;
      border-radius: 5px;
      cursor: pointer;
    }

    .finish-btn {
      width: 150px;
      height: 50px;
      background-color: #119F1F;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
      margin-left: 50px;
      text-decoration: none;
    }

    .finish-btn:hover {
      background-color: #0a7d15;
    }

    .finish-btn:active {
      background-color: #096511;
    }

    .finish-btn:focus {
      outline: none;
    }

    .cancel-btn {
      width: 150px;
      height: 50px;
      background-color: #ff0000;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
      margin-left: 10px;
    }

    .cancel-btn:hover {
      background-color: #cc0000;
    }

    .cancel-btn:active {
      background-color: #aa0000;
    }

    .cancel-btn:focus {
      outline: none;
    }

    .nav-links a.underline {
      text-decoration: underline;
    }

    .location {
      margin-bottom: 10px;
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
            <a href="customerdash.php?user_id=<?php echo $user_id; ?>">Car rentals</a>
            <a href="favorites.php?user_id=<?php echo $user_id; ?>">Favorites</a>
            <a href="book-history.php?user_id=<?php echo $user_id; ?>">Booking History</a>
            <a href="settings.php?user_id=<?php echo $user_id; ?>">Settings</a>
        </div>
    </nav>
    <div class="currency-selector">
        <button class="currency-btn">NPR</button>
        <div class="profile-picture"></div>
    </div>
    <a href="ManageBookedCars.php?user_id=<?php echo $user_id; ?>" class="manage-btn">Manage Booked Cars</a>
</header>


  <main>
  <h2>Booked Cars:</h2>
    <?php
      // Fetch booked cars for the user from car_rental database
      $booked_cars_query = "SELECT * FROM booking WHERE user_id = ?";
      $booked_cars_stmt = $car_rental_conn->prepare($booked_cars_query);
      $booked_cars_stmt->bind_param("i", $user_id);
      $booked_cars_stmt->execute();
      $booked_cars_result = $booked_cars_stmt->get_result();

      // Loop through booked cars
      if ($booked_cars_result->num_rows > 0) {
        while ($row = $booked_cars_result->fetch_assoc()) {
          // Fetch car details for the current booking
          $car_id = $row['car_id'];
          $car_details_query = "SELECT * FROM car_details WHERE id = ?";
          $car_details_stmt = $car_rental_conn->prepare($car_details_query);
          $car_details_stmt->bind_param("i", $car_id);
          $car_details_stmt->execute();
          $car_details_result = $car_details_stmt->get_result();

          // Check if car details are found
          if ($car_details_result->num_rows > 0) {
            $car_row = $car_details_result->fetch_assoc(); // Fetch car details
            // Now, you can display the car information
    ?>
    
    <div class="car-panel">
      
      <div class="car-image">
        <?php
          // Decode the base64 encoded image retrieved from the database
          $imageData = base64_decode($car_row['carImage']);
          // Output the image data
          echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$car_row['carName'].'">';
        ?>
      </div>
        
      <div class="car-details">
        <!-- Display car name -->
        <h3><?php echo $car_row['carName']; ?></h3>
        <!-- Display car brand -->
        <div class="car-spec">
          <img src="brand-image.png" alt="Brand Icon">
          <span><?php echo $car_row['carBrand']; ?></span>
        </div>
        <!-- Display car type -->
        <div class="car-spec">
          <img src="vehicles.png" alt="Type Icon">
          <span><?php echo $car_row['carType']; ?></span>
        </div>
        <!-- Display number of seats -->
        <div class="car-spec">
          <img src="car-chair.png" alt="Seats">
          <span><?php echo $car_row['carSeats']; ?> seats</span>
        </div>
        <!-- Display transmission type with color indicating automatic or manual -->
        <div class="car-spec">
          <img src="gear-shift.png" alt="Transmission">
          <span style="color: <?php echo ($car_row['carTransmission'] == 'Automatic') ? 'rgb(2, 255, 2)' : 'rgb(255, 0, 0)'; ?>"><?php echo $car_row['carTransmission']; ?></span>
        </div>
        <!-- Display car location with color indicating different locations -->
        <p class="location" style="color:<?php echo ($car_row['carLocation'] == 'Kathmandu') ? '#4285F4' : '#F4B400'; ?>"><?php echo $car_row['carLocation']; ?></p>
      </div>
        
      <!-- Price Section -->
      <div class="price">
        <!-- Price for a day -->
        <h4>Price for a day:</h4>
        <p class="number">Rs. <?php echo number_format($car_row['carPrice'], 2); ?></p>
        <!-- Free cancellation -->
        <p class="free-cancel">Free cancellation</p>


        <!-- Cancel Button -->
        <form action="cancel_booking.php" method="POST">
            <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <button type="submit" class="cancel-btn">Cancel</button>
        </form>


        <!-- Finish Booking Button -->
        <form id="finishBookingForm" action="finish_booking.php" method="post">
            <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <button class="finish-btn" type="submit">Finish Booking</button>
        </form>


      </div>
    </div>
    <?php
          } else {
            echo "<p>Car details not found.</p>";
          }
        }
      } else {
        echo "<p>No cars booked for this user.</p>";
      }

      // Close connection to car_rental database
      mysqli_close($car_rental_conn);
    ?>

    <script>
      // Function to cancel booking
      function cancelBooking(bookingId) {
        // Ask for confirmation before canceling the booking
        if(confirm("Are you sure you want to cancel this booking?")) {
          // Redirect to cancel booking page or perform appropriate action
          window.location.href = "cancel_booking.php?booking_id=" + bookingId;
        }
      }

      // Function to finish booking
      function finishBooking(bookingId) {
        // Ask for confirmation before finishing the booking
        if(confirm("Are you sure you want to finish this booking?")) {
          // Redirect to finish booking page or perform appropriate action
          window.location.href = "finish_booking.php?booking_id=" + bookingId;
        }
      }
    </script>
  </main><section id="contact" class="panel">
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
