<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
} else {
    // Redirect back to the login page if user_id parameter is missing
    header("Location: error.php");
    exit();
}
?>
<?php

// Database configurations
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'car_rental';

// Create connection to car_rental database
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch notifications for the admin (user_id = 1)
$notification_query = "SELECT notifications.*, car_details.carName, user_login.users.username 
                        FROM notifications
                        LEFT JOIN user_login.users ON notifications.user_id = user_login.users.id
                        LEFT JOIN car_details ON notifications.car_id = car_details.id
                        WHERE notifications.user_id = 1 AND (notifications.status IS NULL OR notifications.status = '' OR notifications.status = 'unread')
                        ORDER BY notifications.notification_id DESC";

$notification_stmt = $conn->prepare($notification_query);
$notification_stmt->execute();
$result = $notification_stmt->get_result();

// Process notifications
$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
} else {
    // Debug statement: Print message if no notifications are found
    echo "<p>No notifications found.</p>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];
    $status = $_POST['status'];

    // Update notification status to 'read'
    $update_query = "UPDATE notifications SET status = 'read' WHERE notification_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $notification_id);
    $update_stmt->execute();

    if ($status == 'approved') {
        // Update booking status to 'booked' directly in the booking table
        $update_booking_query = "UPDATE booking SET status = '1' WHERE id = ?";
        $update_booking_stmt = $conn->prepare($update_booking_query);
        $update_booking_stmt->bind_param("i", $notification['booking_id']); // Use booking_id instead of notification_id
        $update_booking_stmt->execute();

        // Debug statement: Check if the query was executed
        if ($update_booking_stmt->affected_rows > 0) {
            echo "<p>Booking status updated successfully.</p>";
        } else {
            echo "<p>Failed to update booking status.</p>";
        }
    } elseif ($status == 'disapproved') {
        // Get booking_id from notifications table
        $get_booking_id_query = "SELECT booking_id FROM notifications WHERE notification_id = ?";
        $get_booking_id_stmt = $conn->prepare($get_booking_id_query);
        $get_booking_id_stmt->bind_param("i", $notification_id);
        $get_booking_id_stmt->execute();
        $result = $get_booking_id_stmt->get_result();
        $row = $result->fetch_assoc();
        $booking_id = $row['booking_id'];

        // Delete from booking table using booking_id
        $delete_query = "DELETE FROM booking WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $booking_id);
        $delete_stmt->execute();
    }

    // Redirect to inbox.php to refresh notifications
    header("Location: inbox.php");
    exit();
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - Vroom</title>
    <!-- Include necessary stylesheets -->
    <link rel="stylesheet" href="admindash.css">
    <!-- Additional styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"
    />
    <style>

    .center-buttons {
            text-align: center;
            display: flex;
            gap: 10px;
          }
          .approve{
            background-color: #4CAF50; /* Green */
                color: white;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                margin-right: 5px;
                border-radius: 5px;
                
          }
          .approve:hover {
                background-color: #45a049;
            }
          .disapprove{
            background-color: #f44336; /* Red */
                color: white;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                border:black;
                border-radius: 5px;
          }
          .disapprove:hover {
                background-color: #45a049;
            }
          li {
                display: flex;
                align-items: center;
                gap: 20px;
            }
          /* New styles for the contact panel */
          #contact {
        margin-top: 250px;
        margin-bottom: 0;
        height: 60vh; /* Adjust height as needed */
        background-color: #12042a; /* Set background color to black */
        color: #fff; /* Set text color to white */
        padding: 50px; /* Add padding */
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }

      /* Style for the headers */
      .contact-header {
        font-size: 24px;
        margin-bottom: 10px;
      }

      /* Adjust margins for the headers */
      .vroom-header {
        margin-right: 20px;
      }

      .about-vroom-header {
        margin-right: 20px;
      }

      .top-brands-header {
        margin-right: 20px;
      }

      /* Style for the list items */
      .contact-list {
        list-style: none;
        padding: 0;
        margin-top: 10px;
      }

      .contact-list-item {
        margin-bottom: 8px;
      }

      .contact-list-item:last-child {
        margin-bottom: 0;
      }

      /* Style for socials header */
      .socials-header {
        margin-bottom: 10px; /* Add margin to create space between the header and icons */
      }

      /* Style for social icons */
      .socials {
        display: flex;
        flex-direction: column;
      }

      .social {
        display: flex;
        align-items: center; /* Align items vertically */
        margin-bottom: 10px; /* Add margin to create space between each social icon and name */
      }

      .social a {
        text-decoration: none;
        color: inherit; /* Inherit color from parent */
      }

      .social a:hover,
      .social a:focus {
        color: #800080; /* Change color to purple/blue on hover or focus */
      }

      .social img {
        width: 48px; /* Double the width of the image */
        height: 48px; /* Double the height of the image */
        margin-right: 10px;
      }

      .social span {
        color: #fff;
        font-size: 18px; /* Adjust font size for the name */
        font-weight: bold; /* Make the name bold */
      }
   
      /* Add any additional styles specific to the Reviews page */
      .review {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
      }

      .review img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-right: 15px;
        float: left;
      }

      .review .stars {
        color: #f2b01e;
      }

      .review .comment {
        clear: both;
      }

      /* Center align the buttons */
      .center-buttons {
        text-align: center;
      }
      </style>
</head>

<body>

<header>
    <!-- For header/logo  -->
    <div class="branding">
            <a href="index.php?user_id=<?php echo $user['id']; ?>" class="vroom-text">
                <h1>Vroom</h1>
            </a>
            <p class="slogan-text"><a href="index.php?user_id=<?php echo $user['id']; ?>">Drive, Explore, and Repeat</a></p>
    </div>
    <nav>
      <div class="nav-links">
        <a href="admindash.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('admindash.php', this)">Car hostings</a>
        <a href="wallet.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('wallet.php', this)">Wallet</a>
        <a href="inbox.php?user_id=<?php echo $user_id; ?>" class="underline">Inbox</a>
        <a href="setting.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('setting.php', this)">Settings</a>

      </div>
    </nav>
    
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageCarList.php" class="manage-btn">Manage Cars</a>

  </header>
  

    <h1>Inbox</h1>

    <?php if (count($notifications) > 0): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <?php if ($notification['status'] == 'unread'): ?>
                    <li>
                        <?php echo "New booking request from user " . $notification['username'] . " for car " . $notification['carName']; ?>
                        <div class="center-buttons">
                            <form action="inbox.php" method="post">
                                <input type="hidden" name="notification_id" value="<?php echo htmlspecialchars($notification['notification_id']); ?>">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="approve">Approve</button>
                            </form>
                            <form action="inbox.php" method="post">
                                <input type="hidden" name="notification_id" value="<?php echo htmlspecialchars($notification['notification_id']); ?>">
                                <input type="hidden" name="status" value="disapproved">
                                <button type="submit" class="disapprove">Disapprove</button>
                        </div>
                    </li><br>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No unread notifications found.</p>
    <?php endif; ?>

    <footer>
        <!-- Footer content -->
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
    </footer>

    <!-- Include necessary scripts -->
    <script src="inbox.js"></script>
    <script>
        // JavaScript code specific to the Reviews page
    </script>

</body>

</html>