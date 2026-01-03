<?php
require_once('../Controllers/authCheck.php');

if($_SESSION['role'] !== 'patient'){
    echo "Access Denied! You are not a Patient.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="../Assets/patientdashboard-style.css">
</head>
<body>
  
  <div class="test-container">
    <h1>Welcome to MedLink, <?php echo $_SESSION['username']; ?></h1>
    
    <p>This is your <strong>Patient Dashboard</strong>.</p>
    
    <a href="../Controllers/logout.php" class="btn-logout">Logout</a>
  </div>

</body>
</html>