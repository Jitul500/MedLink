<?php
// ১. সিকিউরিটি চেক
require_once '../Controllers/authCheck.php';

// যদি রোল receptionist না হয়, লগইন পেজে পাঠাও
if ($_SESSION['role'] !== 'receptionist') {
  header("Location: ../Views/login.php");
  exit();
}

$name = $_SESSION['username'];
$profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Receptionist Dashboard</title>
  <link rel="stylesheet" href="../Assets/receptionist-style.css">
</head>

<body>

  <div class="sidebar">
    <div class="profile-section">
      <img src="../uploads/<?php echo $profile_pic; ?>" alt="Profile" class="profile-pic">
      <h3>
        <?php echo $name; ?>
      </h3>
      <p>Reception Desk</p>
    </div>

    <ul class="nav-links">
      <li><a href="#" class="active">Dashboard</a></li>
      <li><a href="#">Manage Appointments</a></li>
      <li><a href="#">Patient Queries</a></li>
      <li><a href="../Controllers/logout.php" class="logout-btn">Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <header>
      <h1>Receptionist Dashboard</h1>
    </header>

    <div class="dashboard-cards">
      <div class="card">
        <h3>New Appointments</h3>
        <p class="count">0</p>
      </div>
      <div class="card">
        <h3>Available Doctors</h3>
        <p class="count">Check List</p>
      </div>
      <div class="card">
        <h3>Pending Queries</h3>
        <p class="count">0</p>
      </div>
    </div>

    <div class="recent-section">
      <h2>Today's Tasks</h2>
      <p>No tasks pending...</p>
    </div>
  </div>

</body>

</html>