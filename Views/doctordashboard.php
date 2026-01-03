<?php
require_once('../Controllers/authCheck.php');

if ($_SESSION['role'] !== 'doctor') {
  echo "Access Denied! You are not a Doctor.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard</title>
  <link rel="stylesheet" href="../Assets/patientdashboard-style.css">
</head>

<body>

  <div class="test-container">
    <h1 style="color: #00796b;">Welcome, <?php echo $_SESSION['username']; ?> 👨‍⚕️</h1>

    <p>This is the <strong>Doctor's Portal</strong>.</p>
    <p>Your Role: <span style="color: green; font-weight: bold;"><?php echo $_SESSION['role']; ?></span></p>

    <div style="margin: 20px 0;">
      <a href="Organ_Donation.php"
        style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
        Go to Organ Donation Panel
      </a>
    </div>

    <a href="../Controllers/logout.php" class="btn-logout">Logout</a>
  </div>

</body>

</html>