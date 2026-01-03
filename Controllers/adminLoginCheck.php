<?php
session_start();
require_once '../Models/userModel.php';

if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $remember = isset($_POST['remember']);

  if (empty($username) || empty($password)) {
    $_SESSION['error_msg'] = "Username and Password cannot be empty.";
    header("Location: ../Views/doctor-admin-login.php");
    exit();
  }

  $user_input = [
    'username' => $username,
    'password' => $password
  ];

  $user_data = login($user_input);

  if ($user_data != false) {

    if ($remember) {
      setcookie('auth_user', $username, time() + 3600, '/');
    }

    if ($user_data['role'] === 'admin') {
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['role'] = 'admin';
      header("Location: ../Views/admindashboard.php");
      exit();
    } elseif ($user_data['role'] === 'doctor') {
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['role'] = 'doctor';
      header("Location: ../Views/doctordashboard.php");
      exit();
    } else {
      $_SESSION['error_msg'] = "Access Denied! Patients use Patient Login.";
      header("Location: ../Views/doctor-admin-login.php");
      exit();
    }

  } else {
    $_SESSION['error_msg'] = "Invalid Username or Password!";
    header("Location: ../Views/doctor-admin-login.php");
    exit();
  }

} else {
  header("Location: ../Views/doctor-admin-login.php");
  exit();
}
?>