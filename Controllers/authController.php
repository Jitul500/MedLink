<?php
session_start();

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if(empty($name) || empty($email) || empty($password) || empty($role)){
        echo "All fields are required!";
        exit();
    }

    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
    $_SESSION['name'] = $name;

    setcookie("last_user", $email, time() + 3600); 

    if($role == 'doctor'){
        header("Location: ../views/doctor/dashboard.php");
    } else {
        header("Location: ../views/patient/dashboard.php");
    }
}

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $role = $_POST['role'];

    if(empty($email) || empty($role)){
        echo "Email and Role required!";
        exit();
    }

    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;

    // Cookie example
    setcookie("last_user", $email, time() + 3600);

    if($role == 'doctor'){
        header("Location: ../views/doctor/dashboard.php");
    } else {
        header("Location: ../views/patient/dashboard.php");
    }
}

// Logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: ../views/auth/login.php");
}
?>
