<?php
require_once __DIR__ . '/doctorController.php';

header("Content-Type: application/json");

$doctors = getDoctorsController();

echo json_encode($doctors);
?>
