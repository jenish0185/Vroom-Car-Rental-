// Simulated database
let users = {};
let cars = {};

function login() {
    let email = document.getElementById("email-login").value;
    let password = document.getElementById("password-login").value;
    if (users[email] && users[email].password === password) {
        if (users[email].type === "host") {
            showHostPage();
        } else {
            showCustomerPage();
        }
    } else {
        alert("Invalid credentials!");
    }
}

function signup() {
    let firstName = document.getElementById("firstname").value;
    let lastName = document.getElementById("lastname").value;
    let email = document.getElementById("email-signup").value;
    let password = document.getElementById("password-signup").value;
    let confirmPassword = document.getElementById("confirm-password").value;

    if (firstName && lastName && email && password && confirmPassword) {
        if (password === confirmPassword) {
            // Passwords match, proceed with sign up
            // Here you can add code to submit the form or perform further actions
            alert("Sign up successful! Please login.");
            // Optionally, you can redirect the user to the login page
            window.location.href = "login.html";
        } else {
            alert("Passwords do not match!");
        }
    } else {
        alert("Please fill in all fields.");
    }
}


function showLogin() {
    document.getElementById("signup-container").classList.add("hidden");
    document.getElementById("login-container").classList.remove("hidden");
}

function showSignup() {
    document.getElementById("login-container").classList.add("hidden");
    document.getElementById("signup-container").classList.remove("hidden");
}

// Other functions (showHostPage, showCustomerPage, logout, listCar) remain the same as previous example
