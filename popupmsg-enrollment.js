const message = document.querySelector(".popup-message");
const messageHeading = document.querySelector(".popup-heading");
const messageText = document.getElementById("popup-message-text");
const messageImg = document.querySelector(".popup-img");
const confirmButton = document.querySelector(".popup-confirm");

messageHeading.innerHTML = "Success!"
messageText.innerHTML = "You have successfully enrolled!";
messageImg.setAttribute("src", "img/check.png");
message.style.display = "flex";

confirmButton.addEventListener("click", () => {
    message.style.display = "none";
});

