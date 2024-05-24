// script.js

document.addEventListener('DOMContentLoaded', function() {
    // Add Review Button Functionality
    document.getElementById('add-review-btn').addEventListener('click', function() {
        document.getElementById('add-review-form').style.display = 'block';
    });

    // Add to Favorites Button Functionality
    document.getElementById('add-to-favorites-btn').addEventListener('click', function() {
        document.getElementById('add-to-favorites-form').submit();
    });

    // Show More Reviews Functionality
    const showMoreBtn = document.getElementById('show-more-btn');
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            const hiddenReviews = document.querySelectorAll('.review[style="display: none;"]');
            hiddenReviews.forEach(function(review) {
                review.style.display = 'block';
            });
            showMoreBtn.style.display = 'none';
        });
    }

    // Edit Review Button Functionality
    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const form = btn.nextElementSibling;
            form.style.display = 'block';
            btn.style.display = 'none';
        });
    });
});
