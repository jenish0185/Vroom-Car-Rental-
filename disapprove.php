<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];

    // Delete the notification from the notifications table
    $delete_query = "DELETE FROM notifications WHERE notification_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $notification_id);
    $delete_stmt->execute();

    // Delete the corresponding booking entry from the bookings table
    $delete_booking_query = "DELETE FROM booking WHERE notification_id = ?";
    $delete_booking_stmt = $conn->prepare($delete_booking_query);
    $delete_booking_stmt->bind_param("i", $notification_id);
    $delete_booking_stmt->execute();

    header("Location: inbox.php");
    exit();
} else {
    header("Location: inbox.php"); // Redirect if notification_id is not set or request method is not POST
    exit();
}
?>
