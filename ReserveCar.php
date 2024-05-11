<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom - Car Details</title>
    <link rel="stylesheet" href="customerdash.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap">
    <style>
        .car-image {
            width: 100%;
            height: auto;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .reserve-btn {
        width: 150px;
        height: 50px;
        background-color: #119F1F;
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

      .reserve-btn a {
        font-weight: 500;

        font-size: 180px;
        text-decoration: none; /* Remove underline */
        color: white; /* Set text color to white */
      }
      .refund-btn {
        width: 150px;
        height: 50px;
        background-color: #EE0000;
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

      .refund-btn a {
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
            <a href="customerdash.php?user_id=<?php echo $_GET['user_id']; ?>" class="underline" >Car rentals</a>
            <a href="favorites.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('favorites.php', this)">Favorites</a>
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
    <div class="car-details">
    <?php
session_start();

// Check if the user_id parameter exists in the URL
if(isset($_GET['user_id'])) {
    // Retrieve the user_id from the URL
    $user_id = $_GET['user_id'];
    // Proceed with your logic here
} else {
    // Handle the case where user ID is not provided
    header("Location: error.php");
    exit();
}

// Database configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'car_rental';

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the car_id parameter exists in the URL
if(isset($_GET['car_id'])) {
    // Retrieve the car_id from the URL
    $car_id = $_GET['car_id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle the form submission
        // Here, you would typically handle the booking logic
        
        // For demonstration, let's set a session message
        $_SESSION['message'] = "Your booking request has been submitted. Please wait for admin approval.";
        header("Location: customerdash.php?user_id={$user_id}");
        exit();
    }

    // Retrieve car details from the database based on car ID
    $query = "SELECT * FROM car_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if car details are found
    if ($result->num_rows > 0) {
        // Fetch the car details
        $row = $result->fetch_assoc();
        // Decode the base64 encoded image retrieved from the database
        $imageData = base64_decode($row['carImage']);
        // Output the image data
        echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'" class="car-image">';
        // Output other car details
        echo "<h2>{$row['carName']}</h2>";
        echo "<p>Brand: {$row['carBrand']}</p>";
        echo "<p>Type: {$row['carType']}</p>";
        echo "<p>Seats: {$row['carSeats']}</p>";
        echo "<p>Space: {$row['carSpace']}</p>";
        echo "<p>Transmission: {$row['carTransmission']}</p>";
        echo "<p>Engine: {$row['carEngine']}</p>";
        echo "<p>Mileage: {$row['carMileage']}</p>";
        echo "<p>Electric: {$row['electric']}</p>";
        echo "<p>Price: {$row['carPrice']}</p>";
        echo "<p>Airbags: {$row['airbags']}</p>";
        echo "<p>ABS Brakes: {$row['absBrakes']}</p>";
        echo "<p>Traction Control: {$row['tractionControl']}</p>";
        echo "<p>Audio System: {$row['audioSystem']}</p>";
        echo "<p>Bluetooth: {$row['bluetooth']}</p>";
        echo "<p>Navigation: {$row['navigation']}</p>";
        echo "<p>Parking Assistance: {$row['parkingAssistance']}</p>";
        echo "<p>Air Conditioning: {$row['airConditioning']}</p>";
        echo "<p>Heating: {$row['heating']}</p>";
        // Add more details as needed
    } else {
        echo "Car details not found.";
    }
} else {
    echo "Car ID not provided.";
}

?>
        <div class="button-container">
            <!-- Reserve Car Form -->
            <form id="reserveForm" method="post" action="booking.php?user_id=<?php echo $user_id; ?>&car_id=<?php echo $car_id; ?>">
                <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                <input type="submit" class="reserve-btn" value="Reserve Car">
            </form>

            <!-- Refund Button -->
            <button onclick="confirmRefund()" class="refund-btn">Refund</button>
        </div>
    </div>
</main>

<!-- JavaScript code -->
<script>
    function showConfirmation(event) {
        event.preventDefault(); // Prevent form submission
        // Display popup message
        var confirmation = confirm("Wait for admin approval.");
        if (confirmation) {
            // Submit the form
            document.getElementById("reserveForm").submit();
        }
    }

    function confirmRefund() {
        if (confirm("Are you sure you want to refund?")) {
            window.location.href = "customerdash.php?user_id=<?php echo $user_id; ?>";
        }
    }
</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="customerdash.js"></script>
</body>
</html>
