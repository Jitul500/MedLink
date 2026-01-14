<?php
require_once __DIR__ . '/patientController.php';

header("Content-Type: application/json");

$patients = getPatientsController();

echo json_encode($patients);
?>
