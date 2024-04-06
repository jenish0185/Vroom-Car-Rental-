document.addEventListener("DOMContentLoaded", function() {
    fetchCars();
  });
  
  function fetchCars() {
    fetch('server.php?action=getCars')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        const carsPanel = document.getElementById('carsPanel');
        carsPanel.innerHTML = '';
        data.forEach(car => {
          const carElement = document.createElement('div');
          carElement.classList.add('car');
          carElement.innerHTML = `
            <h3>${car.name}</h3>
            <p>Brand: ${car.brand}</p>
            <p>Model: ${car.model}</p>
            <p>Mileage: ${car.mileage}</p>
            <p>Seats: ${car.seats}</p>
            <p>Luggage Space: ${car.luggage_space}</p>
            <img src="${car.image}" alt="${car.name}">
          `;
          carsPanel.appendChild(carElement);
        });
      })
      .catch(error => {
        if (error instanceof TypeError) {
          console.error('Network error occurred:', error.message);
        } else {
        //   console.error('Error fetching cars:', error);
        }
      });
      
  }
  