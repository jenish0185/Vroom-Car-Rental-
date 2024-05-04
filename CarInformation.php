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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Information</title>
  <!-- Add your CSS file link here -->
</head>
<body>

  <div class="car-details-container">


  <div class="car-details-container">
    <!-- Display car image -->
    <div class="car-image">
        <?php
        // Decode the base64 encoded image retrieved from the database
        $imageData = base64_decode($row['carImage']);
        // Output the image data
        echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'">';
        ?>
    </div>

 
    <!-- Display car details -->
    <h2><?php echo $row['carName']; ?></h2>
    <p><strong>Brand:</strong> <?php echo $row['carBrand']; ?></p>
    <p><strong>Type:</strong> <?php echo $row['carType']; ?></p>
    <p><strong>Seats:</strong> <?php echo $row['carSeats']; ?></p>
    <p><strong>Space:</strong> <?php echo $row['carSpace']; ?></p>
    <p><strong>Transmission:</strong> <?php echo $row['carTransmission']; ?></p>
    <p><strong>Engine:</strong> <?php echo $row['carEngine']; ?></p>
    <p><strong>Mileage:</strong> <?php echo $row['carMileage']; ?></p>
    <p><strong>Electric:</strong> <?php echo $row['electric']; ?></p>
    <p><strong>Price for a day:</strong> Rs. <?php echo number_format($row['carPrice'], 2); ?></p>
    <p><strong>Airbags:</strong> <?php echo ($row['airbags'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>ABS Brakes:</strong> <?php echo ($row['absBrakes'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Traction Control:</strong> <?php echo ($row['tractionControl'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Audio System:</strong> <?php echo ($row['audioSystem'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Bluetooth:</strong> <?php echo ($row['bluetooth'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Navigation:</strong> <?php echo ($row['navigation'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Parking Assistance:</strong> <?php echo ($row['parkingAssistance'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Air Conditioning:</strong> <?php echo ($row['airConditioning'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Heating:</strong> <?php echo ($row['heating'] == 1) ? 'Yes' : 'No'; ?></p>
    <!-- Add more car details as needed -->

    <!-- Rent button (optional) -->
    <form action="payment.php" method="post">
      <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
      <button type="submit">Continue to book</button>
    </form>

  </div>
</body>
</html>

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
