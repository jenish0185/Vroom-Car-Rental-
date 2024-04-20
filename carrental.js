document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    var currentPage = window.location.href;
    
    // Find the "Car rentals" link in the navigation bar
    var carrentalLink = document.querySelector('.nav-links a[href="carrental.html"]');
    
    // Check if the current page is the carrental page
    if (currentPage.includes("carrental.html")) {
      // Add the "underline" class to the "Car rentals" link if it's the current page
      carrentalLink.classList.add("underline");
    }
  });
  