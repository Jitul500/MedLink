<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MedLink Provider Login</title>
  <link rel="stylesheet" href="../Assets/doctor-admin-style.css">
  
</head>

<body>

  <div class="login-container">
    <div class="login-card">
      <div class="logo">
        <i class="fas fa-stethoscope"></i>
        <h1>MEDLINK PRO</h1>
        <p>Provider & Administration Access</p>
      </div>

      <h2>Sign In to the Professional Portal</h2>

      <form id="providerLoginForm">
        <div class="input-group">
          <label for="id">Employee ID or License Number</label>
          <div class="input-field">
            <i class="fas fa-id-card-alt"></i>
            <input type="text" id="id" placeholder="Enter ID or license number" required>
          </div>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <div class="input-field">
            <i class="fas fa-key"></i>
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
          <a href="#" class="forgot-password">Need Help Logging In?</a>
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i> Access Portal
        </button>
      </form>

      <div class="support-link">
        <a href="#">Contact IT Support</a>
      </div>

      <div class="patient-link">
        <a href="#">Looking for Patient Login?</a>
      </div>
    </div>
  </div>

  <script src="js/doctor-admin-script.js"></script>
</body>

</html>