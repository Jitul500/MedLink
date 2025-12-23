<?php
session_start();
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
      <div class="logo">
        <i class="fas fa-heartbeat"></i>
        <h1>MEDLINK</h1>
        <p>Patient Access Portal</p>
      </div>

      <h2>Sign In to Your Account</h2>

      <form id="patientLoginForm">
        <div class="input-group">
          <label for="email">Email or Patient ID</label>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" id="email" placeholder="Enter your email or ID" required>
          </div>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" placeholder="Enter your password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility()">
              <i class="fas fa-eye" id="toggleIcon"></i>
            </span>
          </div>
        </div>

        <div class="actions">
          <div class="remember-me">
            <input type="checkbox" id="remember">
            <label for="remember">Remember Me</label>
          </div>
          <a href="#" class="forgot-password">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
      </form>

      <div class="signup-link">
        Don't have an account? <a href="#">Sign Up Here</a>
      </div>

      <div class="admin-link">
        <a href="#">Are you a Doctor or Admin?</a>
      </div>
    </div>
  </div>

  <script src="../Assets/login-script.js"></script>
</body>

</html>