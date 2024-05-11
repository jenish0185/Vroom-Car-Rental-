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
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle the form submission
        // For demonstration, let's set a session message
        $_SESSION['message'] = "Your booking request has been submitted. Please wait for admin approval.";

        // Insert booking request into booking table
        $booking_query = "INSERT INTO booking (user_id, car_id, status) VALUES (?, ?, '0')";
        $booking_stmt = $conn->prepare($booking_query);
        $booking_stmt->bind_param("ii", $user_id, $car_id);
        $booking_stmt->execute();

        // Get the last inserted booking ID
        $booking_id = $booking_stmt->insert_id;

        // Insert notification into notifications table for admin
        $admin_id = 1; // Assuming admin's user ID is 1
        $notification_message = "New booking request from user $user_id for car $car_id.";
        $notification_status = 'unread'; // Set default status to 'unread'
        $notification_query = "INSERT INTO notifications (user_id, message, status, car_id, booking_id) VALUES (?, ?, ?, ?, ?)";
        $notification_stmt = $conn->prepare($notification_query);
        $notification_stmt->bind_param("isssi", $admin_id, $notification_message, $notification_status, $car_id, $booking_id);
        $notification_stmt->execute();

        // Set success message
        $_SESSION['success_message'] = "Booking request successfully submitted.";

        // Redirect to customer dashboard
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

    // Close connection
    mysqli_close($conn);
} else {
    // Redirect back to the customer dashboard if parameters are missing
    header("Location: customerdash.php");
    exit();
}
?>
