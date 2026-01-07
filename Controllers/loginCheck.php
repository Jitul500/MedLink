<?php
session_start();
require_once '../Models/userModel.php';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($password)) {
        $_SESSION['error_msg'] = "Username and Password cannot be empty.";
        header("Location: ../Views/login.php");
        exit();
    }

    $user_input = [
        'username' => $username,
        'password' => $password
    ];

    $user_data = login($user_input);

    if ($user_data != false) {

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['id'] = $user_data['id'];
        $_SESSION['role'] = $user_data['role']; // রোল সেশনে রাখা হলো
        $_SESSION['profile_pic'] = isset($user_data['profile_pic']) ? $user_data['profile_pic'] : 'default.png';

        if ($remember) {
            setcookie('auth_user', $username, time() + 3600, '/');
        }

        if ($user_data['role'] == 'admin') {
            header("Location: ../Views/admindashboard.php");
        } elseif ($user_data['role'] == 'doctor') {
            header("Location: ../Views/doctordashboard.php");
        } elseif ($user_data['role'] == 'receptionist') { 
            header("Location: ../Views/receptionistdashboard.php");
        } else {
            
            header("Location: ../Views/patientdashboard.php");
        }
        exit();

    } else {
        
        $_SESSION['error_msg'] = "Invalid Username or Password!";
        header("Location: ../Views/login.php");
        exit();
    }

} else {
    header("Location: ../Views/login.php");
    exit();
}
?>