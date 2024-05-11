<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];

    // Update notification status to "approved"
    // You may need to adjust your SQL query based on your table structure
    $update_query = "UPDATE notifications SET status = 'approved' WHERE notification_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $notification_id);
    $update_stmt->execute();

    // Update the status of the corresponding booking to "booked"
    // Assuming you have a bookings table with a status column
    $update_booking_query = "UPDATE booking SET status = 'booked' WHERE notification_id = ?";
    $update_booking_stmt = $conn->prepare($update_booking_query);
    $update_booking_stmt->bind_param("i", $notification_id);
    $update_booking_stmt->execute();

    // Optionally, delete the notification from the notifications table
    // Uncomment the following lines if you want to delete the notification
    /*
    $delete_query = "DELETE FROM notifications WHERE notification_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $notification_id);
    $delete_stmt->execute();
    */

    header("Location: inbox.php");
    exit();
} else {
    header("Location: inbox.php"); // Redirect if notification_id is not set or request method is not POST
    exit();
}
?>
