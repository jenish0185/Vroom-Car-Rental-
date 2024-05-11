<<<<<<< HEAD
<?php
// Start the session
session_start();

// Check if user ID is provided in the URL
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

// Check if car ID is provided in the URL
if(isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming there's no password
    $dbname = "car_rental";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to fetch car details
    $sql = "SELECT * FROM car_details WHERE id = $car_id";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Fetch car details
        $row = $result->fetch_assoc();
?>


=======
>>>>>>> 4b3df973a3ee405d5bf32e3d2f3aa2f10e0fd67d
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
  <title>Car Information</title>
=======
  <title>Vroom - Favorites</title>
>>>>>>> 4b3df973a3ee405d5bf32e3d2f3aa2f10e0fd67d
  <link rel="stylesheet" href="customerdash.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap"
    />
<<<<<<< HEAD
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"
    />
    <style>
      /* Styles for user profile picture */
      .user-profile-picture {
          width: 50px; /* Adjust as needed */
          height: 50px; /* Adjust as needed */
          border-radius: 50%; /* Make it circular */
          overflow: hidden; /* Hide overflow content */
          margin-right: 10px; /* Add margin between profile picture and username */
      }

      .user-profile-picture img {
          width: 100%; /* Make sure the image fills the container */
          height: auto; /* Maintain aspect ratio */
          border: 2px solid #ddd; /* Add border */
      }

      /* Styles for username */
      .username {
          margin: 0;
          font-weight: bold;
      }

      /* Styles for stars */
      .rating {
          margin-bottom: 10px;
      }

      .star {
          width: 20px; /* Adjust as needed */
          height: auto; /* Maintain aspect ratio */
          margin-right: 5px; /* Add space between stars */
      }


      .ContinueToBook-btn {
        width: 150px;
        height: 50px;
        background-color: #119F1F;
        color: white; /* Set text color to white */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5px; /* Add margin to the left */
      }

      .ContinueToBook-btn a {
        font-weight: 500;

        font-size: 180px;
        text-decoration: none; /* Remove underline */
        color: white; /* Set text color to white */
      }

      .favorites-btn {
        width: 150px;
        height: 50px;
        background-color: blue;
        color: white; /* Set text color to white */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5px; /* Add margin to the left */
      }

      .favorites-btn a {
        font-weight: 500;

        font-size: 180px;
        text-decoration: none; /* Remove underline */
        color: white; /* Set text color to white */
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

=======
  <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Mate:wght@400&display=swap"
    />
  <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap"
    />
  <style>
    /* Reset CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    header {
      height: 200px;
      background-color: #7B2CF8;
      color: white;
      padding: 20px;
      display: flex;
      flex-wrap: wrap; /* Allow items to wrap to the next line */
      justify-content: space-between;
      align-items: center;
      max-width: 1550px; /* Added max-width */
      margin: 0 auto; /* Center the header */
    }

    .branding {
      display: flex;
      align-items: center;
    }

    .branding img {
      width: 100px; /* Adjusted width of the logo */
      height: auto; /* Maintain aspect ratio */
      margin-right: 10px; /* Add some spacing between logo and text */
    }

    .vroom-text {
      font-family: 'meddon';
      font-size: 32px;
      margin-bottom: 5px;
    }

    .slogan-text {
      font-family: 'anek bangla';
      font-size: 15px;
    }

    .nav-links {
      flex-basis: 100%; /* Take up full width initially */
    }

    .nav-links a {
      font-size: 20px;
      font-weight: 500;
      font-family: "Anek Bangla";
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      margin-right: 50px; /* Add margin between each link */
    }

    .currency-selector,
    .manage-btn {
      margin-top: 20px; /* Add space between currency selector and manage button */
    }

    .currency-btn {
      background-color: white;
      color: #7B2CF8;
      border: none;
      padding: 15px 25px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 20px;
    }

    .profile-picture {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background-image: url('image.png'); /* Replace 'images.png' with your image path */
      background-size: cover;
      border: none; /* Remove the border */
    }

    .manage-btn {
      background-color: #ffffff;
      color: #7B2CF8;
      border: none;
      padding: 15px 25px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 20px;
    }

    main {
      display: flex;
      justify-content: space-between;
      padding: 20px;
      margin-top: 30px; /* Add a gap of 50px */
      max-width: 1550px; /* Added max-width */
      margin: 0 auto; /* Center the content */
    }

    .favorites-panel-wrapper {
      /* Add styles for favorites panel */
    }

    .car-panel {
      width: 700px; /* Adjusted width */
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .car-image {
      margin-bottom: 20px;
    }

    .car-details {
      font-size: 18px;
    }

    .booking-panel {
      width: 45%; /* Adjusted width */
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .price-panel {
      width: 45%; /* Adjusted width */
      background-color: #f2f2f2;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
    }

    .continue-booking {
      position: fixed;
      bottom: 20px;
      left: 20px;
    }

    .continue-booking button {
      background-color: #119F1F; /* Green color */
      color: white;
      border: none;
      padding: 20px 40px; /* Bigger padding */
      border-radius: 10px;
      font-size: 20px; /* Bigger font size */
      cursor: pointer;
    }

    @media screen and (max-width: 768px) {
      .car-panel,
      .booking-panel,
      .price-panel {
        width: 100%; /* Full width on smaller screens */
      }
    }
  </style>
>>>>>>> 4b3df973a3ee405d5bf32e3d2f3aa2f10e0fd67d
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
        <a href="customerdash.php?user_id=<?php echo $_GET['user_id']; ?>" class="underline" >Car rentals</a>
        <a href="favorites.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('favorites.php', this)">Favorites</a>
        <a href="book-history.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('book-history.php', this)">Booking History</a>
        <a href="settings.php?user_id=<?php echo $_GET['user_id']; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
    </div>

<<<<<<< HEAD
    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <a href="ManageBookedCars.php?user_id=<?php echo htmlspecialchars($_GET['user_id']); ?>" class="manage-btn">Manage Booked Cars</a>
  </header>

  <main>
=======
  <header>
    <!-- For header/logo  -->
    <div class="branding">
      <h1 class="vroom-text">Vroom</h1>
      <p class="slogan-text">Drive, Explore, and Repeat</p>
    </div>
    <nav>
      <div class="nav-links">
        <a href="customerdash.php" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
        <a href="favorites.html" onclick="navigateTo('favorites.html', this)">Favorites</a>

        <a href="book-history.html" onclick="navigateTo('book-history.html', this)">Booking History</a>
        <a href="settings.html" onclick="navigateTo('settings.html', this)">Settings</a>
      </div>
    </nav>
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <button class="manage-btn">Manage Bookings</button>
  </header>
>>>>>>> 4b3df973a3ee405d5bf32e3d2f3aa2f10e0fd67d

  <main>

    <div class="favorites-panel-wrapper">
      <!-- Your Favorites content goes here -->
    </div>

<<<<<<< HEAD
 
    <!-- Display car details -->
    <h2><?php echo $row['carName']; ?></h2>
    <p><strong>Brand:</strong> <?php echo $row['carBrand']; ?></p>
    <p><strong>Type:</strong> <?php echo $row['carType']; ?></p>
    <p><strong>Seats:</strong> <?php echo $row['carSeats']; ?></p>
    <p><strong>Space:</strong> <?php echo $row['carSpace']; ?></p>
    <p><strong>Transmission:</strong> <?php echo $row['carTransmission']; ?></p>
    <p><strong>Engine:</strong> <?php echo $row['carEngine']; ?></p>
    <p><strong>Mileage:</strong> <?php echo $row['carMileage']; ?></p>
    <p><strong>Electric:</strong> <?php echo $row['electric']; ?></p>
    <p><strong>Price for a day:</strong> Rs. <?php echo number_format($row['carPrice'], 2); ?></p>
    <p><strong>Airbags:</strong> <?php echo ($row['airbags'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>ABS Brakes:</strong> <?php echo ($row['absBrakes'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Traction Control:</strong> <?php echo ($row['tractionControl'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Audio System:</strong> <?php echo ($row['audioSystem'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Bluetooth:</strong> <?php echo ($row['bluetooth'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Navigation:</strong> <?php echo ($row['navigation'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Parking Assistance:</strong> <?php echo ($row['parkingAssistance'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Air Conditioning:</strong> <?php echo ($row['airConditioning'] == 1) ? 'Yes' : 'No'; ?></p>
    <p><strong>Heating:</strong> <?php echo ($row['heating'] == 1) ? 'Yes' : 'No'; ?></p><br>
    <!-- Add more car details as needed -->



    <!-- Reviews Panel -->
    <section id="reviews" class="panel">
        <h2>Reviews</h2>

        <!-- Add Review Button -->
        <button id="add-review-btn">Add Review</button><br>

        <!-- Add Review Form (Initially Hidden) -->
        <form id="add-review-form" action="add_review.php" method="post" style="display: none;">
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
            <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" required>
            <textarea name="review" placeholder="Your Review" rows="5" required></textarea>
            <button type="submit" name="add_review">Add Review</button>
        </form>



        <!-- Reviews Output -->
<?php
// Check if the user_id has a value
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    // Fetch reviews for the current car along with user information
    $sql_reviews = "SELECT reviews.*, users.username, users.profile_picture 
                    FROM reviews 
                    INNER JOIN user_login.users ON reviews.user_id = users.id 
                    WHERE car_id = ?";
    $stmt_reviews = $conn->prepare($sql_reviews);
    $stmt_reviews->bind_param("i", $car_id);
    $stmt_reviews->execute();
    $result_reviews = $stmt_reviews->get_result();

    // Check if there are reviews
    if ($result_reviews->num_rows > 0) {
        // Output each review
        while ($row_review = $result_reviews->fetch_assoc()) {
            // Check if the current review belongs to the logged-in user
            $is_user_review = ($_GET['user_id'] == $row_review['user_id']);
            ?>
            <div class="review">
                <div class="user-profile">
                    <?php
                    // Display user profile picture
                    if (!empty($row_review['profile_picture'])) {
                       // Decode the base64 encoded image retrieved from the database
                      $imageData = base64_decode($row_review['profile_picture']);
                      // Output the image
                      echo '<div class="user-profile-picture"><img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="' . $row_review['username'] . '"></div>';

                    } else {
                        // If profile picture is not available, show default picture
                        echo '<div class="user-profile-picture"><img src="default_profile_picture.jpg" alt="Profile Picture"></div>';
                    }
                    ?>
                    <p class="username"><?php echo $row_review['username']; ?></p>
                    <?php
                    // Display edit and delete buttons if it's the user's review
                    if ($is_user_review) {
                        // Edit form
                        echo '<button class="edit-btn">Edit</button>';
                        echo '<form class="edit-review-form" action="edit_review.php" method="post" style="display: none;">';
                        echo '<input type="hidden" name="review_id" value="' . $row_review['id'] . '">';
                        echo '<input type="hidden" name="user_id" value="' . $_GET['user_id'] . '">'; // Include user_id
                        echo '<input type="hidden" name="car_id" value="' . $car_id . '">'; // Include car_id
                        echo '<input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" value="' . $row_review['rating'] . '" required>';
                        echo '<textarea name="review" placeholder="Your Review" rows="5" required>' . $row_review['review'] . '</textarea>';
                        echo '<button type="submit" name="edit_review">Update Review</button>';
                        echo '</form>';

                        // Delete form
                        echo '<form class="delete-review-form" action="delete_review.php" method="post">';
                        echo '<input type="hidden" name="review_id" value="' . $row_review['id'] . '">';
                        echo '<input type="hidden" name="user_id" value="' . $_GET['user_id'] . '">'; // Include user_id
                        echo '<input type="hidden" name="car_id" value="' . $car_id . '">'; // Include car_id
                        echo '<button type="submit" name="delete_review">Delete</button>';
                        echo '</form>';
                    }
                    ?>
                </div>
                <div class="rating">
                    <?php
                    // Display stars based on rating
                    $stars = $row_review['rating'];
                    for ($i = 0; $i < 5; $i++) {
                        if ($i < $stars) {
                            echo '<img src="star_filled.png" alt="Filled Star" class="star">';
                        } else {
                            echo '<img src="star_empty.png" alt="Empty Star" class="star">';
                        }
                    }
                    ?>
                </div>
                <div class="review-content">
                    <p><?php echo $row_review['review']; ?></p>
                </div>
            </div>
        <?php
        }
    } else {
        echo "<p>No reviews available.</p>";
    }
} else {
    echo "<p>Please log in to view and add reviews.</p>";
}
?>








    <form action="payment.php" method="post">
      <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> <!-- Add this line -->
      <button type="submit" class="ContinueToBook-btn">Continue to book</button>
    </form>
    <form action="add_to_favorites.php" method="post">
      <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
      <button type="submit" class="Favorites-btn">Add to Favorites</button>
    </form>





  </main>
  

  </div>
  <!-- JavaScript for adding/editing/deleting review functionality -->
  <script>
     // Add Review Button Functionality
    document.getElementById('add-review-btn').addEventListener('click', function() {
        document.getElementById('add-review-form').style.display = 'block';
    });

    // Edit Button Functionality
    var editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var reviewForm = this.nextElementSibling;
            reviewForm.style.display = 'block';
        });
    });

    // Delete Form Confirmation
    var deleteForms = document.querySelectorAll('.delete-review-form');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            var confirmDelete = confirm("Are you sure you want to delete this review?");
            if (!confirmDelete) {
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
=======
    <?php
    // Retrieve the car ID from the URL parameter
    if(isset($_GET['car_id'])) {
        $car_id = $_GET['car_id'];
        
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there's no password
        $dbname = "car_rental";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL statement to fetch car details
        $sql = "SELECT * FROM car_details WHERE id = $car_id";
        $result = $conn->query($sql);

        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Fetch car details
            $row = $result->fetch_assoc();
    ?>

    <div class="car-panel">
        <div class="car-image">
            <?php
            // Decode the base64 encoded image retrieved from the database
            $imageData = base64_decode($row['carImage']);
            // Output the image data
            echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'">';
            ?>
        </div>
        
        <div class="car-details">
            <!-- Display car name -->
            <h3><?php echo $row['carName']; ?></h3>
            <!-- Display car brand -->
            <div class="car-spec">
                <img src="brand-image.png" alt="Brand Icon">
                <span><?php echo $row['carBrand']; ?></span>
            </div>
            <!-- Display car type -->
            <div class="car-spec">
                <img src="vehicles.png" alt="Type Icon">
                <span><?php echo $row['carType']; ?></span>
            </div>
            <!-- Display number of seats -->
            <div class="car-spec">
                <img src="car-chair.png" alt="Seats">
                <span><?php echo $row['carSeats']; ?> seats</span>
            </div>
            <!-- Display transmission type with color indicating automatic or manual -->
            <div class="car-spec">
                <img src="gear-shift.png" alt="Transmission">
                <span style="color: <?php echo ($row['carTransmission'] == 'Automatic') ? 'rgb(2, 255, 2)' : 'rgb(255, 0, 0)'; ?>"><?php echo $row['carTransmission']; ?></span>
            </div>
            <!-- Display car location with color indicating different locations -->
            <p class="location" style="color:<?php echo ($row['carLocation'] == 'Kathmandu') ? '#4285F4' : '#F4B400'; ?>"><?php echo $row['carLocation']; ?></p>
        </div>
    </div>

    <?php
        } else {
            echo "Car not found.";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Car ID not provided.";
    }
    ?>

    <!-- Booking Panel -->
    <div class="booking-panel">
        <h3>Booking Details</h3>
        <!-- Pickup and Drop Locations -->
        <div class="pickup-drop-locations">
            <h3>Pickup and Drop Locations</h3>
            <p>Mon, May 13, 10 AM, Kathmandu</p>
            <hr> <!-- Horizontal line -->
            <p>Tue, May 14, 10 AM, Kathmandu</p>
        </div>
    </div>

    <!-- Price Panel -->
    <div class="price-panel">
        <h3>Car Price and Booking Duration</h3>
        <p>Price: $<?php echo $row['carPrice']; ?></p>
        <?php
            // Calculate the number of days between pickup and drop dates
            $pickup_date = strtotime('2024-05-13');
            $drop_date = strtotime('2024-05-14');
            $days_diff = ceil(abs($drop_date - $pickup_date) / (60 * 60 * 24));
        ?>
        <p>Booking Duration: <?php echo $days_diff; ?> days</p>
    </div>

  </main>

  <!-- Continue Booking Button -->
  <div class="continue-booking">
    <button>Continue Booking</button>
  </div>

  <script src="favorites.js"></script>

>>>>>>> 4b3df973a3ee405d5bf32e3d2f3aa2f10e0fd67d
</body>
</html>