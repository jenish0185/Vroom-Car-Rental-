<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $car_id = $_POST['car_id'];
    $user_id = $_POST['user_id']; // Receive user_id from the form
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "car_rental");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to insert the review into the database
    $sql = "INSERT INTO reviews (car_id, user_id, rating, review) VALUES ('$car_id', '$user_id', '$rating', '$review')";
    if ($conn->query($sql) === TRUE) {
        // Redirect the user back to the car information page
        header("Location: CarInformation.php?car_id=$car_id&user_id=$user_id");
        exit();

        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
