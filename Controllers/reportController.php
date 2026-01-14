<?php

require_once "../../Models/reportModel.php";

$patient_id = $_POST['patient_id'] ?? null;
$doctor_id = $_SESSION['id'] ?? null;

function getReportsController() {
    return getAllReports();
}

function addReport($patient_id, $doctor_id, $file, $date) {
    return addReportModel($patient_id, $doctor_id, $file, $date);
}

function getReportsByPatientController($patient_id) {
    return getReportsByPatient($patient_id);
}

function deleteReportController($report_id){
    return deleteReportModel($report_id);
}

function getReportCountController() {
    return getReportCount();
}
?>
