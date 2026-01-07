<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  if ($_SESSION['role'] == 'admin') {
    header("Location: admindashboard.php");
  } elseif ($_SESSION['role'] == 'doctor') {
    header("Location: doctordashboard.php");
  }elseif ($_SESSION['role'] == 'receptionist') {
    header("Location: receptionistdashboard.php");
  }else {
    header("Location: patientdashboard.php");
  }
  exit();
}

$msg = "";
$err = "";

if (isset($_SESSION['success_msg'])) {
  $msg = $_SESSION['success_msg'];
  unset($_SESSION['success_msg']);
}
if (isset($_SESSION['error_msg'])) {
  $err = $_SESSION['error_msg'];
  unset($_SESSION['error_msg']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login - MedLink</title>
  <link rel="stylesheet" href="../Assets/login-style.css">
</head>

<body>

  <div class="login-box">

    <a href="../index.php" class="back-btn">
      < Back</a>

        <div class="header">
          <h1>MEDLINK</h1>
          <p>Welcome Back</p>
        </div>

        <form action="../Controllers/loginCheck.php" method="post" onsubmit="return validateLogin()">

          <input type="hidden" id="php_success" value="<?php echo $msg; ?>">
          <input type="hidden" id="php_error" value="<?php echo $err; ?>">

          <label>Username</label>
          <input type="text" name="username" id="username" placeholder="Type your username">

          <label>Password</label>
          <input type="password" name="password" id="password" placeholder="Type your password">

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
          <p>No account? <a href="patient-register.php">Sign Up as Patient</a></p>
        </div>

  </div>

  <script src="../Assets/login.js"></script>

</body>

</html>