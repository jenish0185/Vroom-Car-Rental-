document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    var currentPage = window.location.href;
    
    // Find the "Favorites" link in the navigation bar
    var favoritesLink = document.querySelector('.nav-links a[href="favorites.html"]');
    
    // Check if the current page is the favorites page
    if (currentPage.includes("favorites.html")) {
      // Add the "underline" class to the "Favorites" link if it's the current page
      favoritesLink.classList.add("underline");
    }
});
