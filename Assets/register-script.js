function validateForm() {
  let phone = document.getElementById('phone').value;
  let pass = document.getElementById('pass').value;
  let cpass = document.getElementById('cpass').value;
  let errorBox = document.getElementById('error-msg');

  errorBox.innerHTML = "";

  if (isNaN(phone) || phone.trim() === "") {
    errorBox.innerHTML = "Invalid Phone Number! Only numbers allowed.";
    return false;
  }

  if (pass !== cpass) {
    errorBox.innerHTML = "Password and Confirm Password do not match!";
    return false;
  }

  return true;
}

document.addEventListener("DOMContentLoaded", function () {
  let serverMsg = document.getElementById('php_error');
  let errorBox = document.getElementById('error-msg');

  if (serverMsg && serverMsg.value !== "") {
    errorBox.innerHTML = serverMsg.value;
  }
});