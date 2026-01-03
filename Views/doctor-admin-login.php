<?php
session_start();
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
  <title>Doctor & Admin Login</title>
  <link rel="stylesheet" href="../Assets/login-style.css">
</head>

<body>

  <div class="login-box">

  <a href="../index.php" class="back-btn">
    < Back</a>

      <div class="header">
        <h1>MEDLINK</h1>
        <p>Administrative Portal</p>
      </div>

    <form action="../Controllers/adminLoginCheck.php" method="post">

      <label>Username</label>
      <input type="text" name="username" placeholder="Enter Username" required>

      <label>Password</label>
      <input type="password" name="password" placeholder="Enter Password" required>

    <div class="options">
    <div>
    <input type="checkbox" name="remember" id="remember">
    <label for="remember">Remember Me</label>
    </div>
    </div>

  <p id="message-box" style="text-align: center; margin-bottom: 10px; font-size: 14px; min-height: 20px;"></p>

  <button type="submit" name="submit" class="login-btn">Access Portal</button>

 </form>

  <div class="footer-links">
  <p><a href="patientlogin.php" class="small-link">Go to Patient Login</a></p>
  </div>

  </div>

  <script>
  let errorMsg = "<?php echo $err; ?>";
  let msgBox = document.getElementById('message-box');

  if (errorMsg !== "") {
    msgBox.style.color = "red";
    msgBox.innerHTML = errorMsg;
  }
  </script>

</body>

</html>