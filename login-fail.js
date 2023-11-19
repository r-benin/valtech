showMessage();

function showMessage() {
    document.getElementById('login-message').style.display = 'flex';
    document.getElementById('login-message-text').innerHTML = 'Login failed! Please input your e-mail and password.';
}