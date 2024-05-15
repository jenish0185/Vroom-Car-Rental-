

<?php
// auth.php

// Check if the authorization code is provided in the URL
if(isset($_GET['code'])) {
    // Exchange authorization code for access token
    $auth_code = $_GET['code'];
    
    // Your client ID and client secret obtained from the Google Developer Console
    $client_id = '1044023192075-bjdg7o3u278358k6j6r98kfr2v1g4ak6.apps.googleusercontent.com';
    $client_secret = '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';
    
    // Redirect URI should match the one registered in the Google Developer Console
    $redirect_uri = 'http://localhost/Login%20page/auth.php';
    
    // Request access token from Google's OAuth 2.0 token endpoint
    $token_url = 'https://oauth2.googleapis.com/token';
    $post_data = array(
        'code' => $auth_code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    );

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    // Check if access token is obtained
    if(isset($token_data['access_token'])) {
        // Access token obtained, now fetch user data using the access token
        $access_token = $token_data['access_token'];

        $userinfo_url = 'https://www.googleapis.com/oauth2/v2/userinfo?access_token=' . $access_token;
        $userinfo_response = file_get_contents($userinfo_url);
        $userinfo_data = json_decode($userinfo_response, true);

        // Fetch user data
        $username = $userinfo_data['name'];
        $email = $userinfo_data['email'];
        $phone = $userinfo_data['phone'];
        $profile_picture_url = $userinfo_data['picture']; // Profile picture URL
        
        // Download the profile picture
        $profile_picture_data = file_get_contents($profile_picture_url);
        // Encode the profile picture using base64 encoding
        $profile_picture_base64 = base64_encode($profile_picture_data);

        // Connect to your database (replace with your actual database connection code)
        $conn = mysqli_connect("localhost", "root", "", "user_login");
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Prepare and execute SQL statement to insert user data into the database
        $sql = "INSERT INTO users (username, email, phone, profile_picture) 
                VALUES ('$username', '$email', '$phone', '$profile_picture_base64')";
        
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        // Close database connection
        mysqli_close($conn);
        
        // Redirect the user to login.php upon successful registration
        header("Location: login.php");
        exit();
    } else {
        // Access token not obtained, handle error
        echo "Error: Access token not obtained";
    }
} else {
    // Authorization code not provided in the URL, handle error
    echo "Error: Authorization code not provided";
}
?>
