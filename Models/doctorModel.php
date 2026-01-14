<?php
require_once('db.php');

function getAllDoctors() {
    $con = getConnection();

    $sql = "SELECT id, name, email, phone, specialty FROM users WHERE role = 'doctor'";
    $result = mysqli_query($con, $sql);

    $doctors = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctors[] = $row;
        }
    }

    return $doctors;
}

function getDoctorByEmail($email) {
    $con = getConnection();
    $sql = "SELECT * FROM users WHERE email='$email' AND role='doctor'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result); 
}

function getDoctorCount() {
    $con = getConnection();

    $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 'doctor'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);
    return $row['total']; 
}

?>
