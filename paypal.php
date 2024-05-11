<?php
// paypal.php
// Retrieve the user ID from the POST data
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
  } else {
    // Handle the case where user ID is not provided
    // For example, redirect the user to an error page or ask them to log in again
    // This depends on your application's logic
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

// Function to retrieve car ID from either POST or GET parameters
function get_car_id() {
    if(isset($_POST['car_id'])) {
        return $_POST['car_id'];
    } elseif(isset($_GET['car_id'])) {
        return $_GET['car_id'];
    } else {
        return false;
    }
}

// Function to generate the cancel URL
function generate_cancel_url($car_id) {
    $base_url = 'http://localhost/Login%20page/payment.php';
    // Append the car_id parameter to the URL
    $cancel_url = $base_url . '?car_id=' . $car_id;
    return $cancel_url;
}

// Retrieve the car ID
$car_id = get_car_id();

if($car_id !== false) {
    // Retrieve car price from the database based on car ID
    $query = "SELECT carPrice FROM car_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the car price
        $row = $result->fetch_assoc();
        $car_price = $row['carPrice'];

        // PayPal API endpoint
        $api_url = 'https://api.sandbox.paypal.com/v1/payments/payment';
        
        // PayPal API credentials
        $client_id = 'AWLRTqhuVzuolpUAihvWuJjl7yGAmk41eT24_tHkiaD37HQwGORKTMxruF_Du00aa9XLT6t76Skt0kUT';
        $secret_key = 'ELN0C0CMJewLE_Z4vZwj-YZ0svBuUFE7OS68nkgh8FkavqOunUPlE73h8RgjjISo61hKfIu-zGqD0PHo';

        // Sample payment data
        $data = array(
            'intent' => 'sale',
            'payer' => array(
                'payment_method' => 'paypal'
            ),
            'transactions' => array(
                array(
                    'amount' => array(
                        'total' => $car_price, // Use retrieved car price
                        'currency' => 'USD' // Change currency code if needed
                    )
                )
            ),
            'redirect_urls' => array(
                'return_url' => 'http://localhost/Login%20page/ReserveCar.php?car_id=' . $car_id . '&user_id=' . $user_id,
                'cancel_url' => generate_cancel_url($car_id) // Generate the cancel URL with the car_id parameter

            )
        );

        // Convert data to JSON
        $json_data = json_encode($data);

        // Set up cURL
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($client_id . ':' . $secret_key)
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        // Execute cURL request
        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check for errors
        if ($response === false) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            // Decode JSON response
            $result = json_decode($response, true);

            // Check if "message" key exists in the response
            if (isset($result['message'])) {
                // Error handling
                echo 'Error: ' . $result['message'];
            } else {
                // If "message" key is not present, display a generic success message
                echo 'Payment initiated successfully. Redirecting to PayPal...';
                // Redirect user to PayPal payment page
                header('Location: ' . $result['links'][1]['href']); // Assuming the redirect URL is the second link
                exit;
            }
        }

        // Close cURL
        curl_close($ch);
    } else {
        echo "Car not found.";
    }
} else {
    // Handle error if car ID is not provided
    echo "Car ID not provided.";
}
?>
