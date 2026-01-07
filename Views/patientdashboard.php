<?php
require_once('../Controllers/authCheck.php');

if ($_SESSION['role'] !== 'patient') {
  header("location: login.php");
  exit();
}


$profilePic = isset($_SESSION['profile_pic']) && !empty($_SESSION['profile_pic'])
  ? $_SESSION['profile_pic']
  : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="../Assets/patientdashboard-style.css">
  
</head>

<body>

  <div class="test-container" style="text-align: center;">

    <img src="../uploads/<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-img">

    <h1 style="color: #00796b;">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>This is the <strong>Patient Portal</strong>.</p>

    <a href="../Controllers/logout.php" class="btn-logout">Logout</a>
  </div>

</body>

</html>