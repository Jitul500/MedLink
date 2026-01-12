<?php
require_once __DIR__ . "/../models/Doctor.php";

class DoctorController extends Controller {

   public function list() {

    $doctors = Doctor::getAll();

    if (isset($_GET['search']) && $_GET['search'] != "") {

        $keyword = strtolower(Security::clean($_GET['search']));
        $filtered = [];

        foreach ($doctors as $doc) {
            if (
                strpos(strtolower($doc['name']), $keyword) !== false ||
                strpos(strtolower($doc['specialty']), $keyword) !== false
            ) {
                $filtered[] = $doc;
            }
        }

        $doctors = $filtered;
    }

    $this->view("doctor/search", compact("doctors"));
}


    public function select() {
        header('Content-Type: application/json');
        
     
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
        
       
        $data = $isAjax ? json_decode(file_get_contents('php://input'), true) : $_POST;
        
        $_SESSION['doctor'] = [
            "name" => $data['name'] ?? '',
            "specialty" => $data['specialty'] ?? '',
            "fee" => $data['fee'] ?? '0'
        ];
        
        if ($isAjax) {
            echo json_encode(['success' => true, 'message' => 'Doctor selected', 'redirect' => 'index.php?c=booking&a=confirm']);
        } else {
            header("Location: index.php?c=booking&a=confirm");
        }
    }
}
