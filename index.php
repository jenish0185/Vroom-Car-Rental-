<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom</title>
    <style>
        .alert {
        color: rgb(255, 0, 0);
        font-size: 12px;
        margin-top: 5px;
    }
    
        .search-box {
            margin-top: 500px;
            bottom: 50px;
            margin-top: 50px;
            display: flex;
            justify-content: space-between; /* Space items evenly */
            align-items: top; /* Align items vertically */
            width: 1000px;
            padding: 20px;
            border: 2px solid #080606;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }

        .input-container {
        display: flex;
        flex-direction: column;
        margin-right: 10px; /* Add some space between inputs */
        
        }

        .input-container input {
        width: 300px; /* Adjust width as needed */
        padding: 12px;
        border: 2px solid #0e0e0e;
        border-radius: 8px;
        box-sizing: border-box;
        margin-bottom: 10px;
        }

        .input-container input[type="datetime-local"] {
        width: 90px; /* Adjust the width as needed */
        padding: 10px; /* Adjust the padding as needed */
        }

        .search-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
        }
        #pickUpDateInput{
        width: 130px;

        }
        #pickUpTimeInput{
        width:100px;
        }
        #dropOffDateInput{
        width:130px;
        }
        #dropOffTimeInput{
        width:100px;
        }

        #search-btn {
            width: 150px;
            height: 50px;
            background-color:#7B2CF8;
            color: white; /* Set text color to white */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px; /* Add margin to the left */
            
        }
        
        /* Apply styles to anchor tag within .update-btn */
        #search-btn a {
            text-decoration: none; /* Remove underline */
            color: white; /* Set text color to white */
        }

        @import url('https://fonts.googleapis.com/css2?family=Meddon&display=swap');
    </style>
    <!-- styles link -->
    <link rel="stylesheet" href="styles.css">

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
</head>

<body>
    <header>
        <!-- For header/logo  -->
        <div class="branding">
            <h1 class="vroom-text">Vroom</h1>
            <p class="slogan-text">Drive, Explore, and Repeat</p>
        </div>
        <!-- nav bar items -->
        <div class="nav-items">
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#featured-cars">Featured Cars</a></li>
                    <li><a href="#brands">Brands</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <!-- login button -->
            <div class="login-btn">
                <a href="login.php">Login</a>
            </div>
        </div>
    </header>

    <!-- home panel -->
    <section id="home" class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Get your desired car at a reasonable price</h1>
            <p>"Unlock the Drive to Adventure: Your Perfect Ride Awaits! Explore, Experience, and Embrace the Journey!"
            </p>
            <a href="https://mail.google.com/mail" class="contact-btn">Contact Us</a>

            <div class="redirect">
                <div class="search-box">
                    <!-- Location input with label -->
                    <div class="input-container">
                        <label for="locationInput">Pick-up Location:</label>
                        <input type="text" id="locationInput" placeholder="&#128269; Kathmandu">
                        <div id="locationAlert" class="alert"></div>
                    </div>
                    
                    <!-- Pick-up date input with label -->
                    <div class="input-container">
                        <label for="pickUpDateInput">Pick-up Date:</label>
                        <input type="date" id="pickUpDateInput" placeholder="Pick-up date">
                        <div id="pickUpDateAlert" class="alert"></div>
                    </div>
                    
                    <!-- Pick-up time input with label -->
                    <div class="input-container">
                        <label for="pickUpTimeInput">Pick-up Time:</label>
                        <input type="time" id="pickUpTimeInput" placeholder="Pick-up time">
                        <div id="pickUpTimeAlert" class="alert"></div>
                    </div>
                    
                    <!-- Drop-off date input with label -->
                    <div class="input-container">
                        <label for="dropOffDateInput">Drop-off Date:</label>
                        <input type="date" id="dropOffDateInput" placeholder="Drop-off date (at least 24 hours from pickup)">
                        <div id="dropOffDateAlert" class="alert"></div>
                    </div>
                    
                    <!-- Drop-off time input with label -->
                    <div class="input-container">
                        <label for="dropOffTimeInput">Drop-off Time:</label>
                        <input type="time" id="dropOffTimeInput" placeholder="Drop-off time">
                        <div id="dropOffTimeAlert" class="alert"></div>
                    </div>
                    
                    <!-- Search button -->
                    <button id="search-btn" onclick="storeSearchParameters()">Search</button>
                </div>
            </div>
        </div>
        <div class="overlay"></div> <!-- Add overlay div for the hero section -->
    </section>
    
    
    <section id="services" class="panel">
        <h3>Provided Features:</h3>
        <div class="top-service-panels">
            <div class="service-panel">
                <h2>Hosting and Renting Cars</h2>
                <ul>
                    <li>Host can earn money by hosting</li>
                    <li>Customers can rent for cheap and reasonable price</li>
                </ul>
            </div>
            <div class="service-panel">
                <h2>Premium Subscription</h2>
                <ul>
                    <li>Buying subscription grants features like discounts</li>
                    <li>Insurance, priority booking, and more</li>
                </ul>
            </div>
            <div class="service-panel">
                <h2>Free Cancellation</h2>
                <ul>
                    <li>Cancel your booking for free within a certain period</li>
                    <li>No cancellation fees</li>
                </ul>
            </div>
        </div>
    
        <div class="bottom-service-panels">
            <div class="service-panel">
                <h2>Wide Selection of Cars</h2>
                <ul>
                    <li>Choose from a diverse range of vehicles</li>
                    <li>Options available for every budget and preference</li>
                </ul>
            </div>
            <div class="service-panel">
                <h2>Easy Booking Process</h2>
                <ul>
                    <li>Simple and user-friendly booking system</li>
                    <li>Secure payment options</li>
                </ul>
            </div>
            <div class="service-panel">
                <h2>Reviews and Ratings</h2>
                <ul>
                    <li>Read reviews from previous customers</li>
                    <li>Make informed decisions based on ratings</li>
                </ul>
            </div>
        </div>
    </section>
    
    

    <?php
    // Establish database connection
    $servername = "localhost"; // Assuming your database is hosted locally
    $username = "root";
    $password = "";
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch car details
    $sql = "SELECT carName, carSeats, carPrice, carTransmission, carImage FROM car_details LIMIT 10";
    $result = $conn->query($sql);
    ?>

    <div class="featured-cars">
        <h2>Checkout the Featured Cars</h2>
        <div class="car-list">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="customerdash.php" class="car-link">';
                    echo '<div class="car">';
                    // Decode the base64 encoded image retrieved from the database
                    $imageData = base64_decode($row['carImage']);
                    // Output the image data
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'">';
                    echo '<h3 class="car-name">' . $row["carName"] . '</h3>';
                    echo '<p>Seats: ' . $row["carSeats"] . '</p>';
                    echo '<p>Price: ' . $row["carPrice"] . '</p>';
                    echo '<p>' . $row["carTransmission"] . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>



    
    <section id="brands" class="panel">
        <!-- Content for brands section -->
    </section>
    
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
    

    

    <script src="script.js"></script>

    <script> 
    function storeSearchParameters() {
        var location = document.getElementById('locationInput').value.trim().toLowerCase();
        var pickUpDate = document.getElementById('pickUpDateInput').value;
        var pickUpTime = document.getElementById('pickUpTimeInput').value;
        var dropOffDate = document.getElementById('dropOffDateInput').value;
        var dropOffTime = document.getElementById('dropOffTimeInput').value;

        var locationAlert = document.getElementById('locationAlert');
        var pickUpDateAlert = document.getElementById('pickUpDateAlert');
        var pickUpTimeAlert = document.getElementById('pickUpTimeAlert');
        var dropOffDateAlert = document.getElementById('dropOffDateAlert');
        var dropOffTimeAlert = document.getElementById('dropOffTimeAlert');

        locationAlert.innerHTML = '';
        pickUpDateAlert.innerHTML = '';
        pickUpTimeAlert.innerHTML = '';
        dropOffDateAlert.innerHTML = '';
        dropOffTimeAlert.innerHTML = '';

        if (location !== 'kathmandu') {
            locationAlert.innerHTML = 'Location must be Kathmandu';
            return;
        }

        if (!pickUpDate || !dropOffDate) {
            if (!pickUpDate) {
                pickUpDateAlert.innerHTML = 'Please select pick-up date';
            }
            if (!dropOffDate) {
                dropOffDateAlert.innerHTML = 'Please select drop-off date';
            }
            return;
        }

        if (!pickUpTime) {
            pickUpTimeAlert.innerHTML = 'Please select pick-up time';
            return;
        }

        if (!dropOffTime) {
            dropOffTimeAlert.innerHTML = 'Please select drop-off time';
            return;
        }

        var currentDate = new Date();
        var pickUpDateTime = new Date(pickUpDate + 'T' + pickUpTime);
        var dropOffDateTime = new Date(dropOffDate + 'T' + dropOffTime);

        if (pickUpDateTime < currentDate) {
            pickUpDateAlert.innerHTML = 'Pick-up date must be after the current date';
            return;
        }

        if (dropOffDateTime < pickUpDateTime || dropOffDateTime - pickUpDateTime < 86400000) {
            dropOffDateAlert.innerHTML = 'Drop-off date must be at least 24 hours after the pick-up date';
            return;
        }

        // Store search parameters in session storage
        sessionStorage.setItem('location', location);
        sessionStorage.setItem('pickUpDate', pickUpDate);
        sessionStorage.setItem('pickUpTime', pickUpTime);
        sessionStorage.setItem('dropOffDate', dropOffDate);
        sessionStorage.setItem('dropOffTime', dropOffTime);

        // Redirect to search results page
        window.location.href = 'customerdash.php';
    }
</script>
</body>

</html>