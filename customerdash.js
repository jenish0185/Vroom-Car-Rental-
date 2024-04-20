// Initialize Leaflet map
var map = L.map('map').setView([51.505, -0.09], 13); // Initializing the Leaflet map with a specific view

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map); // Adding a tile layer to the map from OpenStreetMap

// Filtering functionality
document.getElementById('price').addEventListener('change', filterCars); // Adding event listener for price filter
document.getElementById('ac').addEventListener('change', filterCars); // Adding event listener for air conditioning filter
document.getElementById('seats').addEventListener('change', filterCars); // Adding event listener for seats filter

function filterCars() {
  var selectedPrice = document.getElementById('price').value; // Getting selected price value from dropdown
  var acChecked = document.getElementById('ac').checked; // Getting whether air conditioning checkbox is checked
  var seatsChecked = document.getElementById('seats').checked; // Getting whether seats checkbox is checked

  var carPanels = document.querySelectorAll('.car-panel'); // Selecting all car panels

  carPanels.forEach(function(panel) {
    var price = panel.querySelector('.price').textContent; // Getting price of the car from panel
    var automatic = panel.querySelector('.icon-gear').textContent.trim() === 'Automatic'; // Checking if the car has automatic transmission
    var seats = parseInt(panel.querySelector('.icon-seat').textContent); // Getting number of seats of the car from panel

    var showPanel = true; // Variable to control whether to show the panel or not

    // Applying filters
    if (selectedPrice !== 'any' && !price.includes(selectedPrice)) { // Filter by price
      showPanel = false;
    }

    if (acChecked && !automatic) { // Filter by air conditioning
      showPanel = false;
    }

    if (seatsChecked && seats < 4) { // Filter by seats
      showPanel = false;
    }

    // Showing or hiding the panel based on filters
    if (showPanel) {
      panel.style.display = 'block';
    } else {
      panel.style.display = 'none';
    }
  });
}


document.addEventListener("DOMContentLoaded", function() {
  // Get the current page's URL
  var currentPage = window.location.href;
  
  // Find the "Car rentals" link in the navigation bar
  var carrentalLink = document.querySelector('.nav-links a[href="customerdash.php"]');
  
  // Check if the current page is the carrental page
  if (currentPage.includes("customerdash.php")) {
    // Add the "underline" class to the "Car rentals" link if it's the current page
    carrentalLink.classList.add("underline");
  }
});
