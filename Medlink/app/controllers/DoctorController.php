<?php
require_once __DIR__ . "/../models/Doctor.php";

class DoctorController extends Controller {

    public function list() {
        unset($_SESSION['booking']);
        $doctors = Doctor::getAll();
        $this->view("doctor/search", compact("doctors"));
    }

    public function search() {
        $keyword = strtolower(Security::clean($_GET['q'] ?? ""));
        $doctors = Doctor::getAll();

        if ($keyword !== "") {
            $doctors = array_filter($doctors, function ($doc) use ($keyword) {
                return
                    strpos(strtolower($doc['name']), $keyword) !== false ||
                    strpos(strtolower($doc['specialty']), $keyword) !== false;
            });
        }

        $this->view("doctor/search", compact("doctors", "keyword"));
    }

    public function profile() {

        if (!isset($_GET['id'])) {
            header("Location: index.php");
            exit;
        }

        $doctor = Doctor::findById((int) $_GET['id']);

        if (!$doctor) {
            die("Doctor not found");
        }

        $this->view("doctor/profile", compact("doctor"));
    }

    public function select() {
        $_SESSION['doctor'] = [
            "name" => Security::clean($_POST['name']),
            "specialty" => Security::clean($_POST['specialty']),
            "fee" => (int) $_POST['fee']
        ];

        header("Location: index.php?c=booking&a=confirm");
    }
}
