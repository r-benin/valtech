const message = document.querySelector(".popup-message");
const confirmButton = document.querySelector(".popup-confirm");


message.style.display = "flex";

confirmButton.addEventListener("click", () => {
    message.style.display = "none";
});

