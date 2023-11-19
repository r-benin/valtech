showMessage();

function showMessage() {
    document.getElementById('login-message').style.display = 'flex';
    document.getElementById('login-message-text').innerHTML = 'Login failed! Incorrect e-mail or password.';
}