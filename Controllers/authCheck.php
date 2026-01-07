<?php
session_start();
require_once '../Models/userModel.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {

    if (isset($_COOKIE['auth_user'])) {

        $username = $_COOKIE['auth_user'];

        $con = getConnection();
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; 
            $_SESSION['id'] = $user['id'];
            $_SESSION['profile_pic'] = $user['profile_pic'];
        } else {
            header("Location: ../Views/login.php");
            exit();
        }

    } else {
        header("Location: ../Views/login.php");
        exit();
    }
}
?>