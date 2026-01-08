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

    $src = $_FILES['profile_pic']['tmp_name'];
    $originalName = $_FILES['profile_pic']['name'];

    $ext = explode('.', $originalName);
    $count = count($ext);
    $fileExt = strtolower($ext[$count - 1]); 

    $allowed_extensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExt, $allowed_extensions)) {

        $newFileName = time() . "." . $fileExt;

        $des = "../uploads/" . $newFileName;

        if (move_uploaded_file($src, $des)) {

            $user = [
                'username' => $username,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'password' => $password,
                'role' => $role,
                'profile_pic' => $newFileName 
            ];

            
            $status = addUser($user);

            if ($status) {
                $_SESSION['success_msg'] = "Registration Successful! Please Login.";
                header("Location: ../Views/login.php");
                exit();
            } else {
                $_SESSION['error_msg'] = "Registration Failed! Username or Email already exists.";
                header("Location: ../Views/patient-register.php");
                exit();
            }

        } else {
            $_SESSION['error_msg'] = "Failed to upload image to folder.";
            header("Location: ../Views/patient-register.php");
            exit();
        }

    } else {
        $_SESSION['error_msg'] = "Only JPG, JPEG, and PNG files are allowed!";
        header("Location: ../Views/patient-register.php");
        exit();
    }

} else {
    header("Location: ../Views/patient-register.php");
    exit();
}
?>