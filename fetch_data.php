<?php
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

// Get selected date
$date = $_GET['date'];

// Function to calculate today's total price
function calculateTodayPrice($conn, $date) {
    $query = "SELECT SUM(price) AS total_price FROM finance WHERE date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_price'];
}

// Function to calculate this week's total price
function calculateThisWeekPrice($conn, $date) {
    $query = "SELECT SUM(price) AS total_price FROM finance WHERE date BETWEEN ? - INTERVAL 6 DAY AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $date, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_price'];
}

// Function to calculate this month's total price
function calculateThisMonthPrice($conn, $date) {
    $query = "SELECT SUM(price) AS total_price FROM finance WHERE YEAR(date) = YEAR(?) AND MONTH(date) = MONTH(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $date, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_price'];
}

// Calculate total prices for the selected date
$today_price = calculateTodayPrice($conn, $date);
$this_week_price = calculateThisWeekPrice($conn, $date);
$this_month_price = calculateThisMonthPrice($conn, $date);

// Close connection
$conn->close();

// Prepare data to send back as JSON
$data = array(
    "today" => $today_price,
    "thisWeek" => $this_week_price,
    "thisMonth" => $this_month_price
);

// Send data back as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
