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


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Information</title>
  <link rel="stylesheet" href="customerdash.css">
  <!-- Leaflet CSS -->
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

</head>
<body>
 
<header>
    <!-- For header/logo  -->
    <div class="branding">
    <a href="index.php" class="vroom-text">
        <h1>Vroom</h1>
    </a>
    <p class="slogan-text"><a href="index.php">Drive, Explore, and Repeat</a></p>
    </div>
    
      <nav>
        <div class="nav-links">
            <a href="<?php echo isset($_GET['user_id']) ? 'customerdash.php?user_id='.$_GET['user_id'] : 'customerdash.php'; ?>" class="underline">Car rentals</a>
            <a href="<?php echo isset($_GET['user_id']) ? 'favorites.php?user_id='.$_GET['user_id'] : 'favorites.php'; ?>" onclick="navigateTo('favorites.php', this)">Favorites</a>
            <a href="<?php echo isset($_GET['user_id']) ? 'book-history.php?user_id='.$_GET['user_id'] : 'book-history.php'; ?>" onclick="navigateTo('book-history.php', this)">Booking History</a>
            <a href="<?php echo isset($_GET['user_id']) ? 'settings.php?user_id='.$_GET['user_id'] : 'settings.php'; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
        </div>
    </nav>


  

    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>

    
    <a href="<?php echo isset($_GET['user_id']) ? 'ManageBookedCars.php?user_id='.htmlspecialchars($_GET['user_id']) : 'ManageBookedCars.php'; ?>" class="manage-btn">Manage Booked Cars</a>

  </header>

  <main>

  <div class="car-details-container">
    <!-- Display car image -->
    <div class="car-image">
        <?php
        // Decode the base64 encoded image retrieved from the database
        $imageData = base64_decode($row['carImage']);
        // Output the image data
        echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'">';
        ?>
    </div>

 
    <!-- Display car details -->
    <h2><?php echo $row['carName']; ?></h2>
    <p><strong>Brand:</strong> <?php echo $row['carBrand']; ?></p>
    <p><strong>Type:</strong> <?php echo $row['carType']; ?></p>
    <p><strong>Seats:</strong> <?php echo $row['carSeats']; ?></p>
    <p><strong>Space:</strong> <?php echo $row['carSpace']; ?></p>
    <p><strong>Transmission:</strong> <?php echo $row['carTransmission']; ?></p>
    <p><strong>Engine:</strong> <?php echo $row['carEngine']; ?></p>
    <p><strong>Mileage:</strong> <?php echo $row['carMileage']; ?></p>
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
    <!-- Form for Add to Favorites Button -->
    <form id="add-to-favorites-form" action="add_to_favorites.php" method="post">
        <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <button type="button" class="Favorites-btn" id="add-to-favorites-btn">Add to Favorites</button>
    </form>





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
    document.getElementById('add-to-favorites-btn').addEventListener('click', function() {
        var formData = new FormData(document.getElementById('add-to-favorites-form'));

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_favorites.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Check response text
                if (xhr.responseText.trim() === 'success') {
                    // Update button text or style
                    document.getElementById('add-to-favorites-btn').innerText = 'Added to Favorites';
                    // Optionally, refresh the page or update favorites section dynamically
                } else {
                    // Handle error response
                    alert('Error: ' + xhr.responseText);
                }
            } else {
                // Handle HTTP error
                alert('HTTP Error: ' + xhr.status);
            }
        };
        xhr.onerror = function() {
            // Handle network error
            alert('Network Error');
        };
        xhr.send(formData);
    });
</script>
</body>
</html>

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