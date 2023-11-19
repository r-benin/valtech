showFormMessage();

function showFormMessage() {
    document.getElementById("form-message-text").innerHTML = "Registration sucessful! You may now login with your account.";
    document.getElementById("form-message").style.color = "#0e8f28";
    document.getElementById("form-message").style.border = "solid 1px #0e8f28";
    document.getElementById("form-message").style.backgroundColor = "#d9ffe1";
    document.getElementById("form-message").style.display = "flex";
}
