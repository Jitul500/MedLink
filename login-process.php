<?php
session_start();

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$remember = isset($_POST["remember"]);

// Simple demo authentication (replace with DB later)
$validEmail = "patient@medlink.com";
$validPassword = "123456";

if ($email != "" && $password != "") {

    if ($email === $validEmail && $password === $validPassword) {

        // -------- SESSION --------
        $_SESSION["isLoggedIn"] = true;
        $_SESSION["userEmail"] = $email;
        $_SESSION["role"] = "patient";

        // -------- COOKIE --------
        if ($remember) {
            setcookie("medlinkUser", $email, time() + (7 * 24 * 60 * 60), "/");
        } else {
            setcookie("medlinkUser", "", time() - 3600, "/");
        }

        header("Location: dashboard.php");
        exit();

    } else {
        echo "Invalid login credentials.";
    }

} else {
    echo "Please enter email and password.";
}
