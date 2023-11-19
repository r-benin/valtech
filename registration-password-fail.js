showFormMessage();

function showFormMessage() {
    document.getElementById("form-message-text").innerHTML = "Registration failed! Password confirmation does not match.";
    document.getElementById("form-message").style.color = "#c41b1b";
    document.getElementById("form-message").style.border = "solid 1px #c41b1b";
    document.getElementById("form-message").style.backgroundColor = "#fad9d9";
    document.getElementById("form-message").style.display = "flex";
    console.log("wew");
}
