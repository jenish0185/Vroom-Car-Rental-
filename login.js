document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting by default

        const email = form.email.value.trim(); // Get the email value and remove whitespace
        const password = form.password.value.trim(); // Get the password value and remove whitespace

        // Regular expression for email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Check if email is empty or not valid
        if (email === '' || !emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        // Check if password is empty or less than 6 characters
        if (password === '' || password.length < 6) {
            alert('Please enter a password with at least 6 characters.');
            return;
        }

        // If both email and password are valid, submit the form
        form.submit();
    });
});
