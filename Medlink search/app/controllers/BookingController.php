<?php
class BookingController extends Controller {

    public function confirm() {
        $this->view("booking/confirm");
    }

    public function store() {
        header('Content-Type: application/json');
        
        // Check if AJAX request
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
        
        // Get JSON data if AJAX
        $data = $isAjax ? json_decode(file_get_contents('php://input'), true) : $_POST;

        if (!Security::verifyToken($data['token'] ?? '')) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }

        // Simple PHP validation
        if (
            empty($data['patient']) ||
            empty($data['blood']) ||
            empty($data['gender']) ||
            empty($data['phone']) ||
            empty($data['date']) ||
            empty($data['reason'])
        ) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            return;
        }

        $_SESSION['booking'] = [
            "doctor" => $_SESSION['doctor'],
            "patient" => Security::clean($data['patient']),
            "blood" => Security::clean($data['blood']),
            "gender" => Security::clean($data['gender']),
            "phone" => Security::clean($data['phone']),
            "date" => Security::clean($data['date']),
            "reason" => Security::clean($data['reason'])
        ];

        if ($isAjax) {
            echo json_encode(['success' => true, 'message' => 'Booking confirmed', 'redirect' => 'index.php?c=booking&a=summary']);
        } else {
            header("Location: index.php?c=booking&a=summary");
        }
    }

    public function summary() {
        $this->view("booking/summary");
    }
}
