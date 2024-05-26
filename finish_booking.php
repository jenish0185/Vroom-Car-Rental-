<?php
session_start();

if(isset($_POST['booking_id'], $_POST['user_id'], $_POST['car_id'])) {
    // Get booking ID, user ID, and car ID from the form
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $car_id = $_POST['car_id'];

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

    // Delete the booking from the database
    $delete_booking_query = "DELETE FROM booking WHERE id = ?";
    $delete_booking_stmt = $car_rental_conn->prepare($delete_booking_query);
    $delete_booking_stmt->bind_param("i", $booking_id);
    $delete_booking_stmt->execute();

    // Insert into bookingHistory table
    $insert_booking_history_query = "INSERT INTO bookingHistory (user_id, car_id, booking_date) VALUES (?, ?, NOW())";
    $insert_booking_history_stmt = $car_rental_conn->prepare($insert_booking_history_query);
    $insert_booking_history_stmt->bind_param("ii", $user_id, $car_id);
    $insert_booking_history_stmt->execute();

    // Close connection to car_rental database
    mysqli_close($car_rental_conn);

    // Redirect back to the manage booked cars page
    header("Location: ManageBookedCars.php?user_id=$user_id");
    exit();
} else {
    // If any of the parameters are missing, redirect to an error page or handle it accordingly
    header("Location: error.php");
    exit();
}
?>
