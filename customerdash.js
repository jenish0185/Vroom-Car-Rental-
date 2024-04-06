// Initialize Leaflet map
var map = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Filtering functionality
document.getElementById('price').addEventListener('change', filterCars);
document.getElementById('ac').addEventListener('change', filterCars);
document.getElementById('seats').addEventListener('change', filterCars);

function filterCars() {
  var selectedPrice = document.getElementById('price').value;
  var acChecked = document.getElementById('ac').checked;
  var seatsChecked = document.getElementById('seats').checked;

  var carPanels = document.querySelectorAll('.car-panel');

  carPanels.forEach(function(panel) {
    var price = panel.querySelector('.price').textContent;
    var automatic = panel.querySelector('.icon-gear').textContent.trim() === 'Automatic';
    var seats = parseInt(panel.querySelector('.icon-seat').textContent);

    var showPanel = true;

    if (selectedPrice !== 'any' && !price.includes(selectedPrice)) {
      showPanel = false;
    }

    if (acChecked && !automatic) {
      showPanel = false;
    }

    if (seatsChecked && seats < 4) {
      showPanel = false;
    }

    if (showPanel) {
      panel.style.display = 'block';
    } else {
      panel.style.display = 'none';
    }
  });
}
