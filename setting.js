document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    var currentPage = window.location.href;
    
    // Find the "Settings" link in the navigation bar
    var settingLink = document.querySelector('.nav-links a[href="setting.html"]');
    
    // Check if the current page is the settings page
    if (currentPage.includes("setting.html")) {
      // Add the "underline" class to the "Settings" link if it's the current page
      settingLink.classList.add("underline");
    }
  });
  