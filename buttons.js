const userImage = document.getElementById("user-image");
const logoutMenu = document.getElementById("logout-container");
const logoutButton = document.getElementById("logout-button");

const menuButton = document.getElementById("menu-button");
const sideNavbar = document.getElementById("side-navbar");

const sideNavbarButton = document.querySelectorAll("#side-navbar div");
const sideNavbarImg = document.querySelectorAll("#side-navbar img");
const sideNavbarText = document.querySelectorAll(".side-navbar-text");

userImage.addEventListener('click', showLogoutButton);
logoutButton.addEventListener('click', logout);

menuButton.addEventListener('click', showMenu);

function showLogoutButton() {
    const menuStyle = getComputedStyle(logoutMenu);
    if (menuStyle.display === "none") {
        logoutMenu.style.display = "flex";
    } else {
        logoutMenu.style.display = "none";
    }
}

function logout() {
    console.log("Logged out");
    window.location.href="logout.php";
}

function showMenu() {
    sideNavbar.classList.toggle("expand");

    for (let i = 0; i < sideNavbarButton.length; i++) {
        sideNavbarButton[i].classList.toggle("expand");
    }

    for (let i = 0; i < sideNavbarText.length; i++) {
        sideNavbarText[i].classList.toggle("show");
    }

    for (let i = 0; i < sideNavbarImg.length; i++) {
        sideNavbarImg[i].classList.toggle("addMargin");
    }
    console.log("Menu button clicked")
}