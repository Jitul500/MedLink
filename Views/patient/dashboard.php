<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'patient'){
    echo "Unauthorized! <a href='../auth/login.php'>Login</a>";
    exit();
}
include '../partials/header.php';
?>

<h1>Patient Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['email']; ?></p>
<a href="../../controllers/patientController.php?logout=1">Logout</a>

<h2>My Appointments (Demo)</h2>
<table>
<tr><th>Doctor</th><th>Date</th><th>Status</th></tr>
<tr><td>Dr. Alice</td><td>2025-12-24</td><td>Pending</td></tr>
<tr><td>Dr. Bob</td><td>2025-12-25</td><td>Approved</td></tr>
</table>

<?php include '../partials/footer.php'; ?>
