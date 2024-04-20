document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    var currentPage = window.location.href;
    
    // Find the "Booking History" link in the navigation bar
    var bookingHistoryLink = document.querySelector('.nav-links a[href="book-history.html"]');
    
    // Check if the current page is the booking history page
    if (currentPage.includes("book-history.html")) {
        // Add the "underline" class to the "Booking History" link if it's the current page
        bookingHistoryLink.classList.add("underline");
    }
});
