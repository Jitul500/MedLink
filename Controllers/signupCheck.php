<?php
session_start();
require_once '../Models/userModel.php';

if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = 'patient';

    if (!is_numeric($phone)) {
        $_SESSION['error_msg'] = "Invalid Phone Number!";
        header("Location: ../Views/patient-register.php");
        exit();
    }

    if ($password !== $cpassword) {
        $_SESSION['error_msg'] = "Passwords do not match!";
        header("Location: ../Views/patient-register.php");
        exit();
    }

    $user = [
        'username' => $username,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'gender' => $gender,
        'password' => $password,
        'role' => $role
    ];

    $status = addUser($user);

    if ($status) {
        
        $_SESSION['success_msg'] = "Registration Successful! Please Login.";
        header("Location: ../Views/patientlogin.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Registration Failed! Username or Email already exists.";
        header("Location: ../Views/patient-register.php");
        exit();
    }

} else {
    header("Location: ../Views/patient-register.php");
    exit();
}
?>