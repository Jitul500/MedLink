<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header("Location: ../../Views/patientlogin.php");
    exit();
}

$name  = $_SESSION['name'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile - MedLink</title>
  <link rel="stylesheet" href="../../Assets/patientProfile.css">
</head>
<body>

<aside class="sidebar">
  <h1>MEDLINK</h1>
  <nav class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a class="active" href="myprofile.php">My Profile</a>
    <a href="listOfDoctors.php">Doctors</a>
    <a href="appointments.php">Appointments</a>
    <a href="medicalRecords.php">Medical Records</a>
    <a href="../../Views/patientlogin.php?logout=1">Logout</a>
  </nav>
</aside>

<main class="main-content">

  <header>
    <h1>👤 My Profile</h1>
  </header>

  <section class="profile-section">

    <div class="profile-card">

      <div class="profile-header">
        <div class="avatar">
          <?php echo strtoupper($name[0]); ?>
        </div>
        <h2><?php echo $name ?></h2>
        <p><?php echo $email ?></p>
      </div>

      <div class="profile-body">
        <div class="info-row">
          <span class="label">Full Name</span>
          <span class="value"><?php echo $name ?></span>
        </div>

        <div class="info-row">
          <span class="label">Email</span>
          <span class="value"> <?php echo $email ?></span>
        </div>
      </div>

      <div class="profile-footer">
        <a href="../../Views/patientlogin.php?logout=1" class="btn secondary">Logout</a>
      </div>

    </div>

  </section>

</main>

</body>
</html>
