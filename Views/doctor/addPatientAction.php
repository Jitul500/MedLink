<?php
session_start();
require_once "../../Models/userModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $phone  = trim($_POST['phone']);
    $gender = $_POST['gender'];

    // Validation
    if ($name === '' || $email === '' || $phone === '' || $gender === '') {
        echo '<p class="message error">All fields are required!</p>';
        exit;
    }

    if (strpos($email, '@') === false || strpos($email, '.') === false) {
    echo '<p class="message error">Invalid email format!</p>';
    exit;
}

    if (!preg_match("/^[0-9]{10,11}$/", $phone)) {
        echo '<p class="message error">Invalid phone number!</p>';
        exit;
    }

    $username = strtolower(str_replace(" ", "", $name));
    $password = strtolower(str_replace(" ", "", $name))."202";

    $user = [
        'username' => $username,
        'password' => $password,
        'name'     => $name,
        'email'    => $email,
        'phone'    => $phone,
        'gender'   => $gender,
        'role'     => 'patient',
        'specialty'=> ''
    ];

    if (addUser($user)) {
        echo '<p class="message success">Patient added successfully! Username: <strong>'.$username.'</strong> & Password: <strong>'.$password.'</strong></p>';
    } else {
        echo '<p class="message error">Failed to add patient! Email or username may already exist.</p>';
    }
}
?>
