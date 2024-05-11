// Function to navigate to a specified page and apply styling to the clicked navbar item
function navigateTo(page, element) {
    // Remove active class from all navbar items
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => link.classList.remove('active'));
  
    // Add active class to the clicked navbar item
    element.classList.add('active');
  
    // Navigate to the specified page
    window.location.href = 'admindash.php';
}

// Function to underline the clicked navigation link
function underlineLink(event) {
    // Remove underline from all navigation links
    var navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(function(link) {
        link.classList.remove('underline');
    });

    // Add underline to the clicked navigation link
    event.target.classList.add('underline');
}

// Add an event listener to the "Car hostings" link
document.querySelector('.nav-links a[href="#"]').addEventListener('click', function(event) {
    // Call navigateTo function to navigate and apply styling
    navigateTo('admindash.php', this);
    // Call underlineLink function to underline the clicked link
    underlineLink(event);
});
