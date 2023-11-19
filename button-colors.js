loginButton = document.getElementById("login-button");
signupButton = document.getElementById("signup-button");

if (document.getElementById("registration-container") == null) {
    loginButton.style.backgroundColor = "black";
    loginButton.style.color = "white";
    signupButton.style.backgroundColor = "white";
    signupButton.style.color = "black";
} 