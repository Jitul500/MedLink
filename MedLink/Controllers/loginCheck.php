<?php
session_start();
if(isset(($_POST['login']))) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy credentials for demonstration
    $valid_username = "user";
    $valid_password = "pass";

    if($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../Views/login.php");
        exit();
    }
} else {
    header("Location: ../Views/login.php");
    exit();
}