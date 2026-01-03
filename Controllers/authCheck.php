<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {

    if (isset($_COOKIE['auth_user'])) {

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $_COOKIE['auth_user'];
        $_SESSION['role'] = 'patient'; 

    } else {
        header("Location: ../Views/patientlogin.php");
        exit();
    }
}
?>