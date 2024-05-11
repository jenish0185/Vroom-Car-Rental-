<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
} else {
    // Handle the case where user ID is not provided
    // For example, redirect the user to an error page or ask them to log in again
    // This depends on your application's logic
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom - Settings</title>
    <link rel="stylesheet" href="customerdash.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"/>

    <style>
    
        main {
            margin-top: 50px; /* Adjust as needed */
            display: flex;
            justify-content: center;
        }
        .settings-container {
            width: 400px; /* Adjust width as needed */
        }
        .settings-container form {
            display: flex;
            flex-direction: column;
        }
        .settings-container form label {
            margin-bottom: 10px;
        }
        .settings-container form input {
            padding: 8px;
            margin-bottom: 15px;
        }
        .settings-container form button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .settings-container form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

  <header>
    <!-- For header/logo  -->
    <div class="branding">
      <h1 class="vroom-text">Vroom</h1>
      <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
    <div class="nav-links">
        <a href="customerdash.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
        <a href="favorites.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('favorites.html', this)">Favorites</a>
        <a href="book-history.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('book-history.html', this)">Booking History</a>
        <a href="settings.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
    </div>


    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <button class="manage-btn">Manage Bookings</button>
  </header>
  <main>
    <div class="settings-container">
        <!-- Display user information and form to update -->
        <h2>User Account Settings</h2>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root"; // Replace with your actual database username
        $password = ""; // Replace with your actual database password
        $dbname = "user_login"; // Replace with your actual database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user ID from URL parameter
        $user_id = $_GET['user_id'];

        // Retrieve user information from the database
        $query = "SELECT * FROM users WHERE id = $user_id";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        // Handle form submission to update user information
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Process form data and update the database
            $new_username = $_POST['new_username'];
            $new_email = $_POST['new_email'];
            $new_password = ($_POST['new_password'] != '') ? $_POST['new_password'] : $user['password'];
            $new_phone = $_POST['new_phone'];

            // Update user information in the database
            $update_query = "UPDATE users SET username='$new_username', email='$new_email', password='$new_password', phone='$new_phone' WHERE id=$user_id";
            mysqli_query($conn, $update_query);

            // Redirect to the same page to refresh user data
            header("Location: account.php?user_id=$user_id");
            exit();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?user_id=$user_id"; ?>">
            <label for="new_username">Username:</label>
            <input type="text" id="new_username" name="new_username" value="<?php echo $user['username']; ?>">
            
            <label for="new_email">Email:</label>
            <input type="email" id="new_email" name="new_email" value="<?php echo $user['email']; ?>">
            
            <label for="new_password">Password:</label>
            <input type="password" id="new_password" name="new_password" value="">
            
            <label for="new_phone">Phone:</label>
            <input type="text" id="new_phone" name="new_phone" value="<?php echo $user['phone']; ?>">
            
            <button type="submit">Save Changes</button>
        </form>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" name="profile_picture" id="profile_picture">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_GET['user_id']); ?>">
            <button type="submit">Upload</button>
        </form>

        <div id="message"></div>
        <button id="viewImageButton" style="display: none;">View Image</button>
    </div>
</main>


<section id="contact" class="panel">
    <div class="vroom-info">
        <h2 class="contact-header vroom-header">Vroom</h2>
        <p>Email: vroom@gmail.com</p>
        <p>Phone: +977 1234567890</p>
    </div>
    <div class="about-vroom">
        <h3 class="contact-header about-vroom-header">About Vroom</h3>
        <ul class="contact-list">
            <li class="contact-list-item">About Us</li>
            <li class="contact-list-item">Career</li>
            <li class="contact-list-item">Terms of Service</li>
            <li class="contact-list-item">Privacy Policy</li>
        </ul>
    </div>
    <div class="top-affiliated-brands">
        <h3 class="contact-header top-brands-header">Top Affiliated Brands</h3>
        <ul class="contact-list">
            <li class="contact-list-item">BMW</li>
            <li class="contact-list-item">Lamborghini</li>
            <li class="contact-list-item">Ferrari</li>
            <li class="contact-list-item">Audi</li>
            <li class="contact-list-item">Honda</li>
            <li class="contact-list-item">Ford</li>
            <li class="contact-list-item">Mercedes</li>
            <li class="contact-list-item">Nissan</li>
            <li class="contact-list-item">Bentley</li>
            <li class="contact-list-item">Porsche</li>
            <!-- Add more brands as needed -->
        </ul>
    </div>
    <div class="socials">
        <h3 class="contact-header socials-header">Socials</h3>
        <div class="social">
            <a href="https://www.facebook.com">
                <img src="facebook.webp" alt="Facebook">
                <span>Facebook</span>
            </a>
        </div>
        <div class="social">
            <a href="https://www.instagram.com/">
                <img src="instagram-logo.png" alt="Instagram">
                <span>Instagram</span>
            </a>
        </div>
        <div class="social">
            <a href="https://twitter.com/">
                <img src="x-logo.png" alt="Twitter">
                <span>Twitter</span>
            </a>
        </div>
    </div>
</section>

<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData();
        var fileInput = document.querySelector('input[type="file"]');
        formData.append('profile_picture', fileInput.files[0]);
        formData.append('user_id', <?php echo htmlspecialchars($_GET['user_id']); ?>);

        fetch('handle_upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('message').innerText = 'Profile picture uploaded successfully.';
                document.getElementById('message').classList.add('success-message');

                // Clear the image input field after successful upload
                document.getElementById('profile_picture').value = '';

                // Remove success message after 2 seconds
                setTimeout(function() {
                    document.getElementById('message').innerText = '';
                    document.getElementById('message').classList.remove('success-message');
                }, 2000);
            } else {
                console.error('Error uploading image:', data.message);
                alert('Error uploading image: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error uploading image:', error);
            alert('Error uploading image. Please try again.');
        });
    });
</script>


</body>
</html>