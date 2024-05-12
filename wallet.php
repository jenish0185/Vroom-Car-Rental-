<?php
session_start();

// Database configurations
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'car_rental';

$user_id = 1;

// Output the user ID to the browser console
echo "<script>console.log('User ID:', $user_id);</script>";

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate today's total price
function calculateTodayPrice($conn, $selectedDate) {
    $query = "SELECT SUM(price) AS total_price FROM finance WHERE date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_price'];
}

// Function to calculate this week's total price
function calculateThisWeekPrice($conn, $selectedDate) {
    $query = "SELECT SUM(price) AS total_price FROM finance WHERE date BETWEEN ? - INTERVAL 6 DAY AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $selectedDate, $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_price'];
}

// Function to calculate this month's total price
function calculateThisMonthPrice($conn, $selectedDate) {
    $query = "SELECT SUM(price) AS total_price FROM finance WHERE YEAR(date) = YEAR(?) AND MONTH(date) = MONTH(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $selectedDate, $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total_price'];
}

// Get today's date
$selectedDate = date("Y-m-d");

// Calculate total prices
$today_price = calculateTodayPrice($conn, $selectedDate);
$this_week_price = calculateThisWeekPrice($conn, $selectedDate);
$this_month_price = calculateThisMonthPrice($conn, $selectedDate);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet - Vroom</title>
    <!-- Include necessary stylesheets -->
    <link rel="stylesheet" href="admindash.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Additional styles -->
    <style>
        /* Add any additional styles specific to the wallet page */
        .wallet-box {
            background-color: #f0f0f0;
            padding: 30px;
            margin-left: 20px; /* Moved to the left side */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(100% - 40px); /* Adjusted width */
            max-width: 600px; /* Max width */
        }

        .wallet-content {
            margin: 0 auto;
            font-size: 18px; /* Increased font size */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .earnings-info {
            flex-grow: 1;
        }

        .earnings-info div {
            margin-bottom: 20px;
        }

        .earnings-info h3 {
            color: #333;
            font-size: 20px;
        }

        .earnings-info p {
            color: #333;
            font-size: 20px;
            margin: 5px 0;
        }

        .earnings-info span {
            color: #f2b01e;
            font-size: 24px;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .withdraw-btn {
            background-color: #f2b01e;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .withdraw-btn:hover {
            background-color: #e09115;
        }

        .chart-container {
            width: 80%; /* Adjust width as needed */
            height: 400px; /* Set height for the chart */
            margin-left: 40px; /* Adjusted margin-left */
            margin-top: 20px; /* Added margin-top */
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
    </style>
</head>

<body>

<header>
    <!-- For header/logo  -->
    <div class="branding">
        <h1 href="Index.html" class="vroom-text" >Vroom</h1>
        <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
        <div class="nav-links">
            <a href="admindash.php" onclick="navigateTo('admindash.php', this)">Car hostings</a>
            <a href="wallet.php" class="underline">Wallet</a>
            <a href="inbox.php" onclick="navigateTo('inbox.php', this)">Inbox</a>
            <a href="setting.php" onclick="navigateTo('setting.php', this)">Settings</a>
        </div>
    </nav>

    <div class="currency-selector">
        <button class="currency-btn">NPR</button>
        <div class="profile-picture"></div>
    </div>
    <a href="ManageCarList.php" class="manage-btn">Manage Cars</a>
</header>

<main>
    <div class="wallet-box">
        <!-- Wallet panel content -->
        <h2>Wallet</h2>
        <div class="wallet-content">
            <div class="earnings-info">
                <div>
                    <h3>Today's Earnings:</h3>
                    <p>Rs. <span id="todayEarnings"><?php echo $today_price; ?></span></p>
                </div>
                <div>
                    <h3>This Week's Earnings:</h3>
                    <p>Rs. <span id="thisWeekEarnings"><?php echo $this_week_price; ?></span></p>
                </div>
                <div>
                    <h3>This Month's Earnings:</h3>
                    <p>Rs. <span id="thisMonthEarnings"><?php echo $this_month_price; ?></span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Input field for date selection -->
    <div class="select-menu">
        <label for="dateInput">Select Date:</label>
        <input type="date" id="dateInput" onchange="updateChart()">
    </div>
    <div class="chart-container">
        <canvas id="earningsChart"></canvas>
    </div>

    <div class="car-panel-wrapper">
        <!-- Your wallet content goes here -->
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



<!-- Include necessary scripts -->
<script>
    function updateChart() {
        // Get selected date
        var selectedDate = document.getElementById('dateInput').value;

        // Fetch data for the selected date using AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                // Update wallet box
                document.getElementById("todayEarnings").innerText = data.today;
                document.getElementById("thisWeekEarnings").innerText = data.thisWeek;
                document.getElementById("thisMonthEarnings").innerText = data.thisMonth;
                // Update chart
                earningsChart.data.datasets[0].data = [data.today, data.thisWeek, data.thisMonth];
                earningsChart.update();
            }
        };
        xhttp.open("GET", "fetch_data.php?date=" + selectedDate, true);
        xhttp.send();
    }

    var ctx = document.getElementById('earningsChart').getContext('2d');
    var earningsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Today', 'This Week', 'This Month'],
            datasets: [{
                label: 'Earnings',
                data: [<?php echo $today_price; ?>, <?php echo $this_week_price; ?>, <?php echo $this_month_price; ?>],
                backgroundColor: 'rgba(242, 176, 30, 0.2)',
                borderColor: 'rgba(242, 176, 30, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</body>

</html>
