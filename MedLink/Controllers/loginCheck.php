<?php
session_start();
if(isset(($_POST['submit']))) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $remember = isset($_POST['remember']);
    // Dummy credentials for demonstration
    $valid_username = "user";
    $valid_password = "pass";

    if($username == "null" || $password == "") {
        echo "Username or Password cannot be null.";
    } else {
        if($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        if($remember) {
                setcookie('status', 'true', time() + 3000, '/');
            }
        header("Location: ../Views/test.php");
        exit();
        }else {

            echo "Invalid username or password.";
        }
    } 

    }else{
        header("Location: ../Views/login.php");
        exit();
        
    }
 

?>