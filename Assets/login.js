function validateLogin() {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let msgBox = document.getElementById('message-box');

    if (username === "" || password === "") {
        msgBox.style.color = "red";
        msgBox.innerHTML = "Username and Password cannot be empty!";
        return false; 
    }
    return true; 
}

document.addEventListener("DOMContentLoaded", function () {
    let successVal = document.getElementById('php_success').value;
    let errorVal = document.getElementById('php_error').value;
    let msgBox = document.getElementById('message-box');

    if (successVal !== "") {
        msgBox.style.color = "green";
        msgBox.innerHTML = successVal;
    }
    else if (errorVal !== "") {
        msgBox.style.color = "red";
        msgBox.innerHTML = errorVal;
    }
});