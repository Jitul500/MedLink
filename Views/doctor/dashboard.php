<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor'){
    echo "Unauthorized! <a href='../auth/login.php'>Login</a>";
    exit();
}
include '../partials/header.php';
?>

<h1>Doctor Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['email']; ?></p>
<a href="../../controllers/doctorController.php?logout=1">Logout</a>

<h2>Appointments (Demo)</h2>
<table>
<tr><th>Patient</th><th>Date</th><th>Status</th></tr>
<tr><td>John Doe</td><td>2025-12-24</td><td>Pending</td></tr>
<tr><td>Jane Smith</td><td>2025-12-25</td><td>Approved</td></tr>
</table>

<?php include '../partials/footer.php'; ?>
