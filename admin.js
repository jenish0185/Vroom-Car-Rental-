function goBack() {
    var currentPanel = document.querySelector('.panel[style*="display: block"]');
    var previousPanel = currentPanel.previousElementSibling;
    currentPanel.style.display = 'none';
    previousPanel.style.display = 'block';

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