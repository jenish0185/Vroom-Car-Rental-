document.addEventListener("DOMContentLoaded", function() {
  // Get the current page's URL
  var currentPage = window.location.href;
  
  // Find the "Reviews" link in the navigation bar
  var reviewsLink = document.querySelector('.nav-links a[href="inbox.php"]');
  
  // Check if the current page is the reviews page
  if (currentPage.includes("inbox.php")) {
    // Add the "underline" class to the "Reviews" link if it's the current page
    reviewsLink.classList.add("underline");
  }
});
