document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    var currentPage = window.location.href;
    
    // Find the "Settings" link in the navigation bar
    var settingsLink = document.querySelector('.nav-links a[href="settings.html"]');
    
    // Check if the current page is the settings page
    if (currentPage.includes("settings.html")) {
        // Add the "underline" class to the "Settings" link if it's the current page
        settingsLink.classList.add("underline");
    }
});
