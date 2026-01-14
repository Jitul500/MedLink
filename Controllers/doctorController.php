<?php
require_once __DIR__ . '/../Models/doctorModel.php';

function getDoctorsController() {
    return getAllDoctors();
}


function getDoctorByEmailController($email) {
    return getDoctorByEmail($email); 
}

function getDoctorCountController() {
    return getDoctorCount();
}
?>
