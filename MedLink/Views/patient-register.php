<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MedLink Patient Registration</title>
  <link rel="stylesheet" href="../Assets/register-style.css">
  
</head>

<body>

  <div class="register-container">
    <div class="register-card">
      <div class="logo">
        <i class="fas fa-user-plus"></i>
        <h1>MEDLINK</h1>
        <p>New Patient Registration</p>
      </div>

      <h2>Create Your Secure Health Account</h2>

      <form id="patientRegistrationForm">

        <div class="section-title">Personal Information</div>

        <div class="input-group">
          <label for="fullName">Full Name</label>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" id="fullName" placeholder="Enter full name" required>
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label for="dob">Date of Birth</label>
            <div class="input-field">
              <i class="fas fa-calendar-alt"></i>
              <input type="date" id="dob" required>
            </div>
          </div>

          <div class="input-group">
            <label for="gender">Gender</label>
            <div class="input-field">
              <i class="fas fa-venus-mars"></i>
              <select id="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
        </div>

        <div class="section-title">Contact & Security</div>

        <div class="input-group">
          <label for="email">Email Address</label>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" placeholder="Enter valid email address" required>
          </div>
        </div>

        <div class="input-group">
          <label for="phone">Phone Number</label>
          <div class="input-field">
            <i class="fas fa-phone"></i>
            <input type="tel" id="phone" placeholder="e.g., +880XXXXXXXXXX" required>
          </div>
        </div>

        <div class="input-group">
          <label for="password">Create Password</label>
          <div class="input-field password-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" placeholder="Minimum 8 characters" required minlength="8">
            <span class="toggle-password" onclick="togglePasswordVisibility('password')">
              <i class="fas fa-eye" id="toggleIconPassword"></i>
            </span>
          </div>
        </div>

        <div class="input-group">
          <label for="confirmPassword">Confirm Password</label>
          <div class="input-field password-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="confirmPassword" placeholder="Re-enter password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword')">
              <i class="fas fa-eye" id="toggleIconConfirm"></i>
            </span>
          </div>
        </div>

        <div class="actions">
          <div class="terms">
            <input type="checkbox" id="agreeTerms" required>
            <label for="agreeTerms">I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Policy</a>.</label>
          </div>
        </div>

        <button type="submit" class="btn-register">
          <i class="fas fa-arrow-alt-circle-right"></i> Register Account
        </button>
      </form>

      <div class="login-link">
        Already have an account? <a href="login.php">Login Here</a>
      </div>
    </div>
  </div>

  <script src="../Assets/register-script.js"></script>
</body>

</html>