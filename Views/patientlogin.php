<?php
session_start();
$msg = "";
if (isset($_SESSION['success_msg'])) {
  $msg = $_SESSION['success_msg'];
  unset($_SESSION['success_msg']); 
}

$err = "";
if (isset($_SESSION['error_msg'])) {
  $err = $_SESSION['error_msg'];
  unset($_SESSION['error_msg']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Login - MedLink</title>
  <link rel="stylesheet" href="../Assets/login-style.css">
</head>

<body>

<div class="login-box">

  <a href="../index.php" class="back-btn">
  < Back</a>

  <div class="header">
    <h1>MEDLINK</h1>
    <p>Patient Portal</p>
  </div>

  <form action="../Controllers/loginCheck.php" method="post">

  <label>Username</label>
  <input type="text" name="username" placeholder="Type your username" required>

  <label>Password</label>
  <input type="password" name="password" placeholder="Type your password" required>

  <div class="options">
  <div>
  <input type="checkbox" name="remember" id="remember">
 <label for="remember">Remember Me</label>
  </div>
  </div>

  <p id="message-box" style="text-align: center; margin-bottom: 10px; font-size: 14px; min-height: 20px;"></p>

  <button type="submit" name="submit" class="login-btn">Login</button>

  </form>

  <div class="footer-links">
   <p>No account? <a href="patient-register.php">Sign Up</a></p>
    <br>
    <p><a href="doctor-admin-login.php" class="small-link">Doctor or Admin Login</a></p>
  </div>
  </div>

  <script>
    let successMsg = "<?php echo $msg; ?>";
    let errorMsg = "<?php echo $err; ?>";
    let msgBox = document.getElementById('message-box');

    if (successMsg !== "") {
      msgBox.style.color = "green";
      msgBox.innerHTML = successMsg;
    }
    else if (errorMsg !== "") {
      msgBox.style.color = "red";
      msgBox.innerHTML = errorMsg;
    }
  </script>

</body>

</html>