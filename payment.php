<?php
if(isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];
  echo "<script>console.log('User ID:', $user_id);</script>";
} else {
  // Handle the case where user ID is not provided
  // For example, redirect the user to an error page or ask them to log in again
  // This depends on your application's logic
  header("Location: error.php");
  exit();
}

// Retrieve the car ID from the URL parameter
if(isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
    
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

    // Prepare and execute the SQL statement to fetch car price
    $sql = "SELECT carPrice FROM car_details WHERE id = $car_id";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Fetch car price
        $row = $result->fetch_assoc();
        $car_price = $row['carPrice'];
?>

<!DOCTYPE html>
<html lang="en">
<title>Payment</title>
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
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Payment Options</title>
  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
    }
    .payment-option {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }
    .panel {
      margin: 10px;
      cursor: pointer;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      transition: all 0.3s ease;
      width: 200px; /* Set a fixed width */
      height: 200px; /* Set a fixed height */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .panel:hover,
    .panel:active {
      background-color: #f0f0f0; /* Change background color on hover and click */
    }
    .panel img {
      max-width: 80px;
      max-height: 80px;
    }
    .total-price {
      font-size: 24px;
      font-weight: bold;
    }
    .payment-img {
      max-width: 200px;
      max-height: 200px;
      margin-top: 20px;
    }
    .ContinueToRent-btn {
        width: 150px;
        height: 50px;
        background-color: #4285F4;
        color: white; /* Set text color to white */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5px; /* Add margin to the left */
      }

      .ContinueToRent-btn a {
        font-weight: 500;

        font-size: 180px;
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
    <a href="index.php" class="vroom-text">
        <h1>Vroom</h1>
    </a>
    <p class="slogan-text"><a href="index.php">Drive, Explore, and Repeat</a></p>
    </div>
    <nav>
      <div class="nav-links">
      <a href="customerdash.php?user_id=<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>" class="underline" >Car rentals</a>
      <a href="favorites.php?user_id=<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>" onclick="navigateTo('favorites.php', this)">Favorites</a>
      <a href="book-history.php?user_id=<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>" onclick="navigateTo('book-history.php', this)">Booking History</a>
      <a href="settings.php?user_id=<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
      </div>
    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <button class="manage-btn">Manage Bookings</button>


  </header>


  <main>
    <div class="container">
        <!-- Payment options -->
        <h1 class="total-price">Total Price: Rs. <?php echo number_format($car_price, 2); ?></h1>
        <h2>Payment Options</h2>

        <div class="payment-option">
            <div class="panel" id="panel1" onclick="selectPayment('mobile_banking', 'Esewa', 'esewa-qr.jpg')">
                <img src="esewa-logo.png" alt="Esewa">
                <p>Esewa</p>
            </div>
            <div class="panel" id="panel2" onclick="selectPayment('mobile_banking', 'Khalti', 'khalti-qr.png')">
                <img src="khatli-logo.jpg" alt="Khalti">
                <p>Khalti</p>
            </div>
            <div class="panel" id="panel3" onclick="showPayPal()">
                <img src="PayPal-Logo.png" alt="PayPal">
                <p>PayPal</p>
            </div>
        </div>

        <!-- Image and button for PayPal -->
        <div id="paypalSection" style="display: none;">
            <img src="" alt="PayPal Logo" id="paypalImg" class="payment-img">
            
            <form id="paypalForm" action="paypal.php" method="post">
                <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> <!-- Add this line -->
                <button type="submit" class="ContinueToRent-btn">Continue to Pay</button>
            </form>
        </div>

        <!-- Image and button for PayPal -->
        <div id="paypalSection" style="display: none;">
            <img src="" alt="PayPal Logo" id="paypalImg" class="payment-img">
            
            <form id="paypalForm" action="paypal.php" method="post">
                <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <button type="submit" class="ContinueToRent-btn">Continue to Pay</button>
            </form>
        </div>

        <!-- Image and button for Esewa -->
        <div id="esewaSection" style="display: none;">
            <img src="esewa-qr.jpg" alt="Esewa QR Code" class="payment-img">
            <button class="ContinueToRent-btn" onclick="continueToEsewa('<?php echo $user_id; ?>', '<?php echo $car_id; ?>')">Continue to Esewa</button>
        </div>

        <!-- Image and button for Khalti -->
        <div id="khaltiSection" style="display: none;">
            <img src="khalti-qr.png" alt="Khalti QR Code" class="payment-img">
            <button class="ContinueToRent-btn" onclick="continueToKhalti('<?php echo $user_id; ?>', '<?php echo $car_id; ?>')">Continue to Khalti</button>
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

    <script>
      function selectPayment(paymentMethod, provider, image) {
        console.log("Selecting payment:", paymentMethod, provider);
        document.getElementById("paypalSection").style.display = "none";
        document.getElementById("esewaSection").style.display = "none";
        document.getElementById("khaltiSection").style.display = "none";

        if (provider === 'Esewa') {
            document.getElementById("esewaSection").style.display = "block";
        } else if (provider === 'Khalti') {
            document.getElementById("khaltiSection").style.display = "block";
        } else {
            document.getElementById("paypalSection").style.display = "block";
            document.getElementById("paypalImg").src = image;
        }
    }

    function showPayPal() {
        document.getElementById("paypalImg").src = "PayPal-Logo.png";
        document.getElementById("paypalSection").style.display = "block";
        document.getElementById("esewaSection").style.display = "none";
        document.getElementById("khaltiSection").style.display = "none";
    }

      function continueToPay() {
        document.getElementById("paypalForm").submit();
      }

      function continueToEsewa(user_id, car_id) {
          console.log("Continue to Esewa");
          // Redirect to reserve-car.php with user_id and car_id parameters
          window.location.href = "ReserveCar.php?user_id=" + user_id + "&car_id=" + car_id;
      }

      function continueToKhalti(user_id, car_id) {
          console.log("Continue to Khalti");
          // Redirect to reserve-car.php with user_id and car_id parameters
          window.location.href = "ReserveCar.php?user_id=" + user_id + "&car_id=" + car_id;
      }
</script>


  
  

</body>
</html>

<?php
    } else {
        echo "Car price not found.";
    }

    $conn->close();
} else {
    echo "Car ID not provided.";
}
?>
