// Function to navigate back to the previous panel
function goBack() {
    // Get the currently displayed panel and its previous sibling
    var currentPanel = document.querySelector('.panel[style*="display: block"]');
    var previousPanel = currentPanel.previousElementSibling;
    
    // Hide the current panel and display the previous one
    currentPanel.style.display = 'none';
    previousPanel.style.display = 'block';

    // Prevent the default form submission behavior
    event.preventDefault();
}

// Function to display the filename when an image is selected
function displayFileName() {
    // Get the selected file input and its filename
    const fileInput = document.getElementById('carImage');
    const fileName = fileInput.files[0].name;

    // Display the filename in a designated area
    const imageDisplay = document.getElementById('image-display');
    imageDisplay.innerHTML = fileName;
}

// Function to show the initial panel and overlay
function showPanels() {
    // Show the overlay
    document.querySelector('.overlay').style.display = 'block';

    // Show the first panel and hide the "Host" button
    document.getElementById("firstPanel").style.display = "block";
    document.getElementById("hostButton").style.display = "none";
}

// Function to navigate to the next panel
function nextPanel() {
    // Show the second panel and hide the first panel
    document.getElementById("secondPanel").style.display = "block";
    document.getElementById("firstPanel").style.display = "none";

    // Prevent the default form submission behavior
    event.preventDefault();
}

// Function to navigate to the third panel
function nextPanel2() {
    // Hide the second panel and show the third panel
    document.getElementById("secondPanel").style.display = "none";
    document.getElementById("thirdPanel").style.display = "block";

    // Display the review details before moving to the next panel
    displayReviewDetails();

    // Prevent the default form submission behavior
    event.preventDefault();
}

// Function to handle form submission
function submitForm() {
    // Disable the submit button to prevent multiple submissions
    document.getElementById("submitButton").disabled = true;

    // Validate the fields in the first panel
    if (!validateFirstPanel()) {
        // Alert the user if validation fails
        alert("Please fill out all required fields in the first panel.");

        // Re-enable the submit button
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

    // Send fetch request to process form data
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
        // Re-enable the submit button after request completion
        document.getElementById("submitButton").disabled = false;
    })
    .catch(error => {
        console.error("Fetch error:", error);
        // Re-enable the submit button if an error occurs
        document.getElementById("submitButton").disabled = false;
    });
}

// Function to display review details in the third panel
function displayReviewDetails() {
    // Get the element to display review details
    var reviewDetails = document.getElementById("reviewDetails");
    reviewDetails.innerHTML = "";

    // Retrieve values of various form fields
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

    // Construct HTML content to display review details
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

    // Display the review details
    reviewDetails.innerHTML = reviewText;
}
