const message = document.querySelector(".popup-message");
const confirmButton = document.querySelector(".popup-confirm");


message.style.display = "flex";

confirmButton.addEventListener("click", () => {
    location.href="dashboard.php";
});

