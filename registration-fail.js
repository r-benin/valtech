showFormMessage();

function showFormMessage() {
    document.getElementById("form-message-text").innerHTML = "Registration failed! Please fill up all the required information.";
    document.getElementById("form-message").style.color = "#c41b1b";
    document.getElementById("form-message").style.border = "solid 1px #c41b1b";
    document.getElementById("form-message").style.backgroundColor = "#fad9d9";
    document.getElementById("form-message").style.visibility = "visible";
}
