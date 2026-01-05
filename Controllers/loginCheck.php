<?php
session_start();
require_once '../Models/userModel.php';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($password)) {
        $_SESSION['error_msg'] = "Username and Password cannot be empty.";
        header("Location: ../Views/patientlogin.php");
        exit();
    }

    $user_input = [
        'username' => $username,
        'password' => $password
    ];

    $user_data = login($user_input);

    if ($user_data != false && $user_data['role'] === 'patient') {

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'patient';
        $_SESSION['profile_pic'] = isset($user_data['profile_pic']) ? $user_data['profile_pic'] : 'default.png';

        if ($remember) {
            setcookie('auth_user', $username, time() + 3600, '/');
        }

        header("Location: ../Views/patientdashboard.php");
        exit();

    } else {
        $_SESSION['error_msg'] = "Invalid Username or Password!";
        header("Location: ../Views/patientlogin.php");
        exit();
    }

} else {
    header("Location: ../Views/patientlogin.php");
    exit();
}
?>