<?php
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: ../views/auth/login.php");
}
?>
