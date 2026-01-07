<?php

session_start();
session_unset();
session_destroy();


if(isset($_COOKIE['auth_user'])) {
    setcookie('auth_user', '', time() - 10, '/');
}

header("Location: ../Views/login.php");

exit();
?>