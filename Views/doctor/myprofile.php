
<?php
session_start();
if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header("Location: ../../Views/patientlogin.php");
    exit();
}

$name  = $_SESSION['name'];
$email = $_SESSION['email'];

require_once "../../Controllers/doctorController.php";

$doctor = getDoctorByEmailController($email); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile - MedLink</title>
  <link rel="stylesheet" href="../../Assets/doctorProfile.css">
</head>
<body>

<aside class="sidebar">
  <h1>MEDLINK PRO</h1>
  <nav class="menu">
    <a href="#" class="active">Dashboard</a>
    <a href="myprofile.php">My Profile</a>
    <a href="listOfPatients.php">Patients</a>
    <a href="appointments.php">Appointments</a>
    <a href="reports.php">Reports</a>
    <a href="../../Views/doctor-admin-login.php?logout=1">Logout</a>
  </nav>
</aside>

<main class="main-content">

  <header class="page-header">
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
          <span class="label">Designation</span>
          <p><?php echo $doctor['specialty'] ?></p>
        </div>

        <div class="info-row">
          <span class="label">Email</span>
          <span class="value"><?php echo $email ?></span>
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
