<?php
require_once('db.php');

function getAllPatients() {
    $con = getConnection();

    $sql = "SELECT id, name, email, phone, gender FROM users WHERE role = 'patient'";
    $result = mysqli_query($con, $sql);

    $patients = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $patients[] = $row;
        }
    }

    return $patients;
}



function getPatientCount() {
    $con = getConnection();

    $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 'patient'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);
    return $row['total']; 
}
?>
