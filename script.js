// Get the login form overlay and the close button
var loginFormOverlay = document.getElementById("login-form-overlay");
var closeButton = document.getElementById("close-btn-login");

// Get the login button and add a click event listener to show the overlay
var loginButton = document.getElementById("login-btn");
loginButton.addEventListener("click", function() {
  loginFormOverlay.style.display = "block";
});

// Add a click event listener to the close button to hide the overlay
closeButton.addEventListener("click", function() {
  loginFormOverlay.style.display = "none";
});

// Add a click event listener to the overlay itself to hide it if clicked outside of the form
loginFormOverlay.addEventListener("click", function(event) {
  if (event.target === loginFormOverlay) {
    loginFormOverlay.style.display = "none";
  }
});

// Get the register form overlay and the close button
var registerFormOverlay = document.getElementById("register-form-overlay");
var closeButtonRegister = document.getElementById("close-btn-register");

// Get the register button and add a click event listener to show the overlay
var registerButton = document.getElementById("register-btn");
registerButton.addEventListener("click", function() {
  registerFormOverlay.style.display = "block";
});

// Add a click event listener to the close button to hide the overlay
closeButtonRegister.addEventListener("click", function() {
  registerFormOverlay.style.display = "none";
});

// Add a click event listener to the overlay itself to hide it if clicked outside of the form
registerFormOverlay.addEventListener("click", function(event) {
  if (event.target === registerFormOverlay) {
    registerFormOverlay.style.display = "none";
  }
});



