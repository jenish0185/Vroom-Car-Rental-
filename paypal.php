<?php
// payment.php

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

// Retrieve the car ID from the form submission
if(isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];
    
    // Retrieve car price from the database
    $query = "SELECT carprice FROM car_details WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the car price
        $row = $result->fetch_assoc();
        $car_price = $row['carprice'];

        // PayPal API endpoint
        $api_url = 'https://api.sandbox.paypal.com/v1/payments/payment';
        
        // PayPal API credentials
        $client_id = 'Aex6ZS8fYXkxMa1i6E_0LLy1D8V5YoOQmAtvIy-_BqFzOAmnyhTTFVWRZl1MUEHct-T715DRtTN6oHDZ';
        $secret_key = 'EPE7FJMvrgjrFhmO2Q_K8DI2-Vk4lpEs12EbjWog1K4yrodvkvdcXl4lzbD86Kyw9RlD-6I-2-ba1p9l';

        // Sample payment data including test credit card details
        $data = array(
            'intent' => 'sale',
            'payer' => array(
                'payment_method' => 'paypal'
            ),
            'transactions' => array(
                array(
                    'amount' => array(
                        'total' => $car_price, // Use retrieved car price
                        'currency' => 'USD'
                    )
                )
            ),
            'redirect_urls' => array(
                'return_url' => 'http://localhost/Login%20page/success.php', // Modify as needed
                'cancel_url' => 'http://localhost/Login%20page/CarInformation.php?car_id=17'   // Modify as needed
            ),
            'payment_method' => 'credit_card',
            'credit_card' => array(
                'number' => '4111111111111111', // Test credit card number
                    'type' => 'visa',
                    'expire_month' => 12,
                    'expire_year' => 2023,
                    'cvv2' => '123', // Test CVV number
                    'first_name' => 'Jenish',
                    'last_name' => 'Shrestha',
                    'billing_address' => array(
                        'line1' => '123 Naxal Kathmandu', // Address line 1
                        'city' => 'Kathmandu', // City
                        'state' => 'Bagmati', // State
                        'postal_code' => '44600', // Postal code
                        'country_code' => 'Nepal' // Country code
                    )
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
    echo "Car ID not provided.";
}
?>
