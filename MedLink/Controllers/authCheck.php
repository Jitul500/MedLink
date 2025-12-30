<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
   
} 

elseif (isset($_COOKIE['status']) && $_COOKIE['status'] === 'true') {
    
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = "user"; 
    
} 

else {
    header("Location: ../Views/login.php");
    exit();
}
?>
