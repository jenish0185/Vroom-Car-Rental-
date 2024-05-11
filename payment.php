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

    </div>

    <script>
      function selectPayment(paymentMethod, provider, image) {
        console.log("Selecting payment:", paymentMethod, provider);
        // Set the image source based on the selected payment option
        document.getElementById("paymentImg").src = image;
        // Make the image visible
        document.getElementById("paymentImg").style.display = "block";
      }

      function showPayPal() {
        document.getElementById("paypalImg").src = "PayPal-Logo.png";
        document.getElementById("paypalSection").style.display = "block";
      }

      function continueToPay() {
        document.getElementById("paypalForm").submit();
      }
    </script>
  </main>

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
