const uiSelector = document.getElementById('ui-selector');
const registerButton = document.getElementById('register-button');
const loginButton = document.getElementById('login-button');
const selectedButton = document.getElementById('selected-button');

const formTitle = document.getElementById('form-title');
const formText = document.getElementById('form-text');

const registrationForm = document.getElementById('registration-container');
const loginForm = document.getElementById('login-container');

var selected = 'register';

loginButton.addEventListener('click', showLogin);

registerButton.addEventListener('click', showRegister);

function showLogin() {
    if (selected == 'register') {
        selected = 'login';
        selectedButton.style.left = '50%';
        registerButton.style.color = 'black';
        loginButton.style.color = 'white';
        registrationForm.classList.toggle('hide');
        loginForm.classList.toggle('hide');
        formTitle.innerHTML = 'Log in into your VALTECH account';
        formText.innerHTML = 'Access the myVALTECH portal by logging into your VALTECH account';
        console.log(selected);
    }
}

function showRegister() {
    if (selected == 'login') {
        selected = 'register';
        selectedButton.style.left = '0%';
        registerButton.style.color = 'white';
        loginButton.style.color = 'black';
        registrationForm.classList.toggle('hide');
        loginForm.classList.toggle('hide');
        formTitle.innerHTML = 'Create a VALTECH account';
        formText.innerHTML = 'Access the myVALTECH portal by creating a VALTECH account';
        console.log(selected);
    }
}
    