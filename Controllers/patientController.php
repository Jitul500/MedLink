<?php
require_once __DIR__ . '/../Models/patientModel.php'; 
require_once __DIR__ . '/../Models/userModel.php'; 



function getPatientsController() {
    return getAllPatients();
}

function getPatientCountController() {
    return getPatientCount();
}
?>
