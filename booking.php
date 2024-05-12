<?php
session_start();

// Check if user_id and car_id parameters exist
if(isset($_GET['user_id']) && isset($_GET['car_id'])) {
    // Retrieve user_id and car_id from the URL
    $user_id = $_GET['user_id'];
    $car_id = $_GET['car_id'];

    // Database configurations
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'car_rental';

    // Create connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle the form submission
        // Insert booking request into booking table
        $booking_query = "INSERT INTO booking (user_id, car_id, status) VALUES (?, ?, '0')";
        $booking_stmt = $conn->prepare($booking_query);
        $booking_stmt->bind_param("ii", $user_id, $car_id);
        
        if ($booking_stmt->execute()) {
            $booking_id = $booking_stmt->insert_id;

            // Retrieve car ID from the booking table
            $car_id_query = "SELECT car_id FROM booking WHERE id = ?";
            $car_id_stmt = $conn->prepare($car_id_query);
            $car_id_stmt->bind_param("i", $booking_id);
            if ($car_id_stmt->execute()) {
                $car_id_result = $car_id_stmt->get_result();
                $car_id_row = $car_id_result->fetch_assoc();
                $car_id = $car_id_row['car_id'];

                // Retrieve car price from the car_details table based on car ID
                $car_price_query = "SELECT carPrice FROM car_details WHERE id = ?";
                $car_price_stmt = $conn->prepare($car_price_query);
                $car_price_stmt->bind_param("i", $car_id);
                if ($car_price_stmt->execute()) {
                    $car_price_result = $car_price_stmt->get_result();
                    $car_price_row = $car_price_result->fetch_assoc();
                    $car_price = $car_price_row['carPrice'];

                    // Insert finance record for admin
                    $date = date("Y-m-d");
                    $finance_query = "INSERT INTO finance (booking_id, price, date) VALUES (?, ?, ?)";
                    $finance_stmt = $conn->prepare($finance_query);
                    $finance_stmt->bind_param("ids", $booking_id, $car_price, $date);
                    
                    if ($finance_stmt->execute()) {
                        $_SESSION['success_message'] = "Booking request successfully submitted.";
                        header("Location: customerdash.php?user_id={$user_id}");
                        exit();
                    } else {
                        $_SESSION['error_message'] = "Failed to insert into finance table: " . $conn->error;
                    }
                } else {
                    $_SESSION['error_message'] = "Failed to execute car price query: " . $conn->error;
                }
            } else {
                $_SESSION['error_message'] = "Failed to execute car ID query: " . $conn->error;
            }
        } else {
            $_SESSION['error_message'] = "Failed to insert into booking table: " . $conn->error;
        }
    }

    // Retrieve car details from the database based on car ID
    $query = "SELECT * FROM car_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $car_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the car details
            $row = $result->fetch_assoc();
            // Output the car details
            echo "<h2>Confirm Booking</h2>";
            echo "<p>User ID: $user_id</p>";
            echo "<p>Car ID: $car_id</p>"; // Added car ID display
            echo "<p>Car Name: {$row['carName']}</p>";
            echo "<p>Brand: {$row['carBrand']}</p>";
            echo "<p>Type: {$row['carType']}</p>";
            echo "<p>Seats: {$row['carSeats']}</p>";
            echo "<p>Space: {$row['carSpace']}</p>";
            // Add more details as needed

            // Booking confirmation form
            echo '<form method="post">';
            echo '<input type="submit" value="Confirm Booking" class="reserve-btn">';
            echo '</form>';
        } else {
            echo "Car details not found.";
        }
    } else {
        $_SESSION['error_message'] = "Failed to execute car details query: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Redirect back to the customer dashboard if parameters are missing
    header("Location: customerdash.php");
    exit();
}
?>
