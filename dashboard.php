<?php
session_start();

if (!isset($_SESSION["isLoggedIn"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
</head>
<body>

<h2>Welcome to MedLink</h2>

<p>Email: <?php echo $_SESSION["userEmail"]; ?></p>
<p>Role: <?php echo $_SESSION["role"]; ?></p>

<a href="logout.php">Logout</a>

</body>
</html>
