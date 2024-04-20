<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vroom - Car Rentals</title>
  <link rel="stylesheet" href="admindash.css">
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
        <a href="admindash.php"class="underline">Car hostings</a>
        <a href="wallet.html" onclick="navigateTo('wallet.html', this)">Wallet</a>
        <a href="reviews.html" onclick="navigateTo('reviews.html', this)">Reviews</a>
        <a href="setting.html" onclick="navigateTo('setting.html', this)">Settings</a>

      </div>
    </nav>
    
    <div class="currency-selector">
      <button class="currency-btn">NPR</button>
      <div class="profile-picture"></div>
    </div>
    <button class="manage-btn">Manage Cars</button>
  </header>

  
  
  
  <main>

    
    <div class="car-panel-wrapper">
        <h1> Your Hosted Car:</h1>
        <?php
        // Establish database connection (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_rental";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch car data from the database (replace with your actual database query)
        $sql = "SELECT * FROM car_details";
        $result = $conn->query($sql);

        // Output car panels
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                include 'car_panel.php'; // Include the car panel template
            }
        } else {
            echo "No cars available";
        }

        $conn->close();
        ?>
        

      <div class="right-panel">
        <!-- Wallet panel content -->
        <h2>Wallet</h2>
        <div class="wallet-content">
          <h3>Today's Earnings:</h3>
          <p>Rs. 0</p>
          <h3>This Week's Earnings:</h3>
          <p>Rs. 999</p>
          <h3>This Month's Earnings:</h3>
          <p>Rs. 994,923</p>
        </div>
      </div>
      


      

      <div class="right-panel">
        <!-- Wallet panel content -->
        <h2>Wallet</h2>
        <div class="wallet-content">
          <h3>Today's Earnings:</h3>
          <p>Rs. 0</p>
          <h3>This Week's Earnings:</h3>
          <p>Rs. 999</p>
          <h3>This Month's Earnings:</h3>
          <p>Rs. 994,923</p>
        </div>
      </div>

      <button id="hostButton" onclick="showPanels()">Host</button>

        <!-- Overlay -->
      <div class="overlay"></div>

      <form id="carForm" method="post" enctype="multipart/form-data" action="process_form.php">
          <!-- First Panel -->
          <div id="firstPanel" class="panel" style="display: none;">
              <h2>Enter Car Details</h2>
              <input type="text" id="carName" name="carName" placeholder="Car Name"><br>
              <select id="carBrand" name="carBrand" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Car Brand-------</option>
                  <option value="Toyota">Toyota</option>
                  <option value="Honda">Honda</option>
                  <option value="Ford">Ford</option>
                  <!-- Add more options here -->
              </select><br>
              
              <!-- Car Type Selector -->
              <select id="carType" name="carType" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Car Type-------</option>
                  <option value="SUV">SUV</option>
                  <option value="Offroad">Offroad</option>
                  <option value="Sports">Sports</option>
                  <!-- Add more options here -->
              </select><br>
              
              <!-- Car Seats Selector -->
              <select id="carSeats" name="carSeats" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Number of Seats-------</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5+</option>
                  <!-- Add more options here -->
              </select><br>
              
              <!-- Car Space Selector -->
              <select id="carSpace" name="carSpace" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Space (e.g. for luggage)-------</option>
                  <option value="Automatic">1 Small bag</option>
                  <option value="Automatic">1 Large bag</option>
                  <option value="Automatic">2 Large bag</option>
                  <!-- Add more options here -->
              </select><br>
      
              <!-- Car Transmission Selector -->
              <select id="carTransmission" name="carTransmission" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Transmission Type-------</option>
                  <option value="Automatic">Automatic</option>
                  <option value="Manual">Manual</option>
                  <!-- Add more options here -->
              </select><br>
      
              <!-- Car Engine Selector -->
              <select id="carEngine" name="carEngine" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Engine Type-------</option>
                  <option value="Petrol">Petrol</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Hybrid">Hybrid</option>
                  <!-- Add more options here -->
              </select><br>
      
              <!-- Car Mileage Selector -->
              <select id="carMileage" name="carMileage" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Mileage-------</option>
                  <option value="Unlimited">Unlimited</option>
                  <!-- Add more options here -->
              </select><br>
      
              <!-- Electric Selector -->
              <select id="electric" name="electric" style="color: rgba(0, 0, 0, 0.5);">
                  <option value="" disabled selected>-----Power Source-------</option>
                  <option value="Electric">Electric</option>
                  <option value="Fuel">Fuel</option>
                  <!-- Add more options here -->
              </select><br>
      
              <input type="number" id="carPrice" name="carPrice" placeholder="Price"><br>
      
              <!-- New image field -->
              <div class="file-upload">
                  <label for="carImage" class="upload-btn">Upload Image</label>
                  <input type="file" id="carImage" name="carImage" accept="image/*" class="upload-input" onchange="displayFileName()">
                  <div id="image-display" class="file-display">Drag an image here or <a href="#">upload a file</a></div>
              </div>
      
              <div style="margin-bottom: 150px;"></div>
              <button onclick="goBack()" class="button" style="position: absolute; bottom: 10px; left: 10px;">Back</button>
              <button onclick="nextPanel()" class="button" style="position: absolute; bottom: 10px; right: 10px;">Next</button>
          </div>
      
          <!-- Second Panel -->
          <div id="secondPanel" class="panel" style="display: none;">
              <h2>Select Additional Features</h2>
              <div class="feature">
                  <h3 style="color: blue;">Safety Features:</h3>
                  <input type="checkbox" id="airbags" name="airbags" value="Airbags">
                  <label for="airbags">Airbags</label><br>
                  <input type="checkbox" id="absBrakes" name="absBrakes" value="ABS Brakes">
                  <label for="absBrakes">ABS Brakes</label><br>
                  <input type="checkbox" id="tractionControl" name="tractionControl" value="Traction Control">
                  <label for="tractionControl">Traction Control</label><br>
                  <!-- Add more safety features here -->
              </div><br>
              <div class="feature">
                  <h3 style="color: blue;">Entertainment System:</h3>
                  <input type="checkbox" id="audioSystem" name="audioSystem" value="Audio System">
                  <label for="audioSystem">Audio System</label><br>
                  <input type="checkbox" id="bluetooth" name="bluetooth" value="Bluetooth Connectivity">
                  <label for="bluetooth">Bluetooth Connectivity</label><br>
                  <!-- Add more entertainment features here -->
              </div><br>
              <div class="feature">
                  <h3 style="color: blue;">Technology:</h3>
                  <input type="checkbox" id="navigation" name="navigation" value="Navigation System">
                  <label for="navigation">Navigation System</label><br>
                  <input type="checkbox" id="parkingAssistance" name="parkingAssistance" value="Parking Assistance">
                  <label for="parkingAssistance">Parking Assistance</label><br>
                  <!-- Add more technology features here -->
              </div><br>
              <div class="feature">
                  <h3 style="color: blue;">Comfort Features:</h3>
                  <input type="checkbox" id="airConditioning" name="airConditioning" value="Air Conditioning">
                  <label for="airConditioning">Air Conditioning</label><br>
                  <input type="checkbox" id="heating" name="heating" value="Heating">
                  <label for="heating">Heating</label><br>
                  <!-- Add more comfort features here -->
              </div><br>
      
              
      
              <div style="margin-bottom: 150px;"></div>
              <button onclick="goBack()" class="button" style="position: absolute; bottom: 10px; left: 10px;">Back</button>
              <button onclick="nextPanel2()" class="button" style="position: absolute; bottom: 10px; right: 10px;">Next</button>
          </div>
      
      
          <!-- Third Panel -->
          <div id="thirdPanel" class="panel" style="display: none;">
              <h2>Review Car Details</h2>
              <div id="reviewDetails"></div>
      
              <div style="margin-bottom: 150px;"></div>
              <button onclick="goBack()" class="button" style="position: absolute; bottom: 10px; left: 10px;">Back</button>
              <button id="submitButton" class="button" style="position: absolute; bottom: 10px; right: 10px;" type="button" onclick="document.getElementById('carForm').submit()">Submit</button>


          </div>

      </form>
      <script>

        function goBack() {
            var currentPanel = document.querySelector('.panel[style*="display: block"]');
            var previousPanel = currentPanel.previousElementSibling;
            currentPanel.style.display = 'none';
            previousPanel.style.display = 'block';

            // Hide overlay
            document.querySelector('.overlay').style.display = 'none';

            // Prevent form submission
            event.preventDefault();
          }


        



        // Function to display the filename when an image is selected
        function displayFileName() {
            const fileInput = document.getElementById('carImage');
            const fileName = fileInput.files[0].name;
            const imageDisplay = document.getElementById('image-display');
            imageDisplay.innerHTML = fileName;
        }

        

        function showPanels() {
            // Show overlay
            document.querySelector('.overlay').style.display = 'block';

            // Show first panel
            document.getElementById("firstPanel").style.display = "block";
            document.getElementById("hostButton").style.display = "none";
            
        }

        function nextPanel() {
            document.getElementById("secondPanel").style.display = "block";
            document.getElementById("firstPanel").style.display = "none";
            // Prevent form submission
            event.preventDefault();
        }

        function nextPanel2() {
            document.getElementById("secondPanel").style.display = "none";
            document.getElementById("thirdPanel").style.display = "block";
            displayReviewDetails();
            // Prevent form submission
            event.preventDefault();
        }

        // Function to submit the form
        function submitForm() {
            // Disable the submit button to prevent multiple submissions
            document.getElementById("submitButton").disabled = true;

            // Validate first panel fields
            if (!validateFirstPanel()) {
                alert("Please fill out all required fields in the first panel.");
                // Re-enable the submit button if validation fails
                document.getElementById("submitButton").disabled = false;
                return;
            }

            // Serialize form data
            var formData = new FormData(document.getElementById("carForm"));

            // Manually handle checkbox values in the second panel
            var checkboxes = document.querySelectorAll('#secondPanel input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                formData.append(checkbox.name, checkbox.checked ? "1" : "0");
            });

            // Send fetch request
            fetch("process_form.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
                console.log(data);
                // Re-enable the submit button after the request is completed
                document.getElementById("submitButton").disabled = false;
            })
            .catch(error => {
                console.error("Fetch error:", error);
                // Re-enable the submit button if an error occurs
                document.getElementById("submitButton").disabled = false;
            });
        }


        function displayReviewDetails() {
            var reviewDetails = document.getElementById("reviewDetails");
            reviewDetails.innerHTML = "";
            var carName = document.getElementById("carName").value;
            var carBrand = document.getElementById("carBrand").value;
            var carType = document.getElementById("carType").value;
            var carSeats = document.getElementById("carSeats").value;
            var carSpace = document.getElementById("carSpace").value;
            var carTransmission = document.getElementById("carTransmission").value;
            var carEngine = document.getElementById("carEngine").value;
            var carMileage = document.getElementById("carMileage").value;
            var electric = document.getElementById("electric").value;
            var carPrice = document.getElementById("carPrice").value;
            var reviewText = `
                <p><strong>Car Name:</strong> ${carName}</p>
                <p><strong>Car Brand:</strong> ${carBrand}</p>
                <p><strong>Car Type:</strong> ${carType}</p>
                <p><strong>Number of Seats:</strong> ${carSeats}</p>
                <p><strong>Space (e.g. for luggage):</strong> ${carSpace}</p>
                <p><strong>Transmission Type:</strong> ${carTransmission}</p>
                <p><strong>Engine Type:</strong> ${carEngine}</p>
                <p><strong>Mileage:</strong> ${carMileage}</p>
                <p><strong>Electric:</strong> ${electric}</p>
                <p><strong>Price:</strong> ${carPrice}</p>
            `;
            reviewDetails.innerHTML = reviewText;
        }

     

    </script>
    

      
    
    </main>



  
</body>
</html>
