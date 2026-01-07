<?php
session_start();
$serverError = "";
if (isset($_SESSION['error_msg'])) {
  $serverError = $_SESSION['error_msg'];
  unset($_SESSION['error_msg']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Patient Registration</title>
  <link rel="stylesheet" href="../Assets/login-style.css">
</head>

<body>

  <div class="login-box" style="width: 400px; margin-top: 50px; margin-bottom: 50px;">

    <a href="login.php" class="back-btn">
      < Back</a>

        <div class="header">
          <h1>Create Account</h1>
        </div>

        <form action="../Controllers/signupCheck.php" method="post" onsubmit="return validateForm()"
          enctype="multipart/form-data">

          <input type="hidden" id="php_error" value="<?php echo $serverError; ?>">

          <label>Username</label>
          <input type="text" name="username" required>

          <label>Full Name</label>
          <input type="text" name="name" required>

          <label>Email</label>
          <input type="email" name="email" required>

          <label>Phone Number</label>
          <input type="text" id="phone" name="phone" required>

          <label>Gender</label>
          <select name="gender" required>
            <option value="" disabled selected>Select Your Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>

          <label>Profile Picture (JPG/PNG)</label>
          <input type="file" name="profile_pic" required style="margin-bottom: 15px;">

          <label>Password</label>
          <input type="password" id="pass" name="password" required>

          <label>Confirm Password</label>
          <input type="password" id="cpass" name="cpassword" required>

          <p id="error-msg" style="color: red; font-size: 14px; text-align: center; margin: 10px 0;"></p>

          <button type="submit" name="signup" class="login-btn">Register</button>

        </form>

        <div class="footer-links" style="text-align: center; margin-top: 15px;">
          <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>

  </div>

  <script src="../Assets/register-script.js"></script>

</body>

</html>