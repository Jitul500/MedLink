<?php
$emailCookie = "";
if (isset($_COOKIE["medlinkUser"])) {
    $emailCookie = $_COOKIE["medlinkUser"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MedLink Patient Login</title>
  <link rel="stylesheet" href="../Assets/login-style.css">
</head>

<body>

<div class="login-container">
  <div class="login-card">

    <h1>MEDLINK</h1>
    <p>Patient Access Portal</p>

    <h2>Sign In</h2>

    <form method="POST" action="login-process.php">
      <div class="input-group">
        <label>Email or Patient ID</label>
        <input type="text" name="email" value="<?php echo $emailCookie; ?>" required>
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>

      <div class="actions">
        <input type="checkbox" name="remember"
          <?php if ($emailCookie != "") echo "checked"; ?>>
        Remember Me
      </div>

      <button type="submit">Login</button>
    </form>

  </div>
</div>

</body>
</html>
