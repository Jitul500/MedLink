<?php
session_start();

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'doctor'){
        header("Location: views/doctor/dashboard.php");
        exit();
    } elseif($_SESSION['role'] == 'patient'){
        header("Location: views/patient/dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Healthcare System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Welcome to Healthcare System</h1>
    <p>Please choose an option:</p>
    
    <a href="views/auth/register.php"><button>Register</button></a>
    <a href="views/auth/login.php"><button>Login</button></a>
</body>
</html>
