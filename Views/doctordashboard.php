<?php
require_once('../Controllers/authCheck.php');

if ($_SESSION['role'] !== 'doctor') {
  echo "Access Denied!";
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
  <title>Doctor Dashboard</title>
  <link rel="stylesheet" href="../Assets/patientdashboard-style.css">
  <style>
    .profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #007bff;
      margin-bottom: 15px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>

<body>

  <div class="test-container" style="text-align: center;">

    <img src="../uploads/<?php echo $profilePic; ?>" alt="Doctor Profile" class="profile-img">

    <h1 style="color: #00796b;">Welcome, Dr. <?php echo $_SESSION['username']; ?> 👨‍⚕️</h1>
    <p>This is the <strong>Doctor's Portal</strong>.</p>

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