<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $review_id = $_POST['review_id'];
    $user_id = $_POST['user_id']; // Receive user_id from the form
    $car_id = $_POST['car_id']; // Receive car_id from the form
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "car_rental");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to update the review in the database
    $sql = "UPDATE reviews SET rating='$rating', review='$review' WHERE id='$review_id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page where the review was added
        header("Location: CarInformation.php?car_id=$car_id&user_id=$user_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
