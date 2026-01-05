<?php
class BookingController extends Controller {

    public function confirm() {
        if (!isset($_SESSION['doctor'])) {
            header("Location: index.php");
            exit;
        }
        $this->view("booking/confirm");
    }

    public function store() {

        if (!Security::verifyToken($_POST['token'])) {
            die("CSRF validation failed");
        }

        $booking = [
            "doctor" => $_SESSION['doctor'],
            "patient"   => Security::clean($_POST['patient']),
            "age"       => (int) $_POST['age'],
            "gender"    => Security::clean($_POST['gender']),
            "phone"     => Security::clean($_POST['phone']),
            "emergency" => Security::clean($_POST['emergency']),
            "reason"    => Security::clean($_POST['reason'])
        ];

        /* Basic validation (NO regex) */
        if (strlen($booking['patient']) < 3) {
            die("Invalid patient name");
        }

        if ($booking['age'] < 1 || $booking['age'] > 120) {
            die("Invalid age");
        }

        if (strlen($booking['phone']) !== 11 || !is_numeric($booking['phone'])) {
            die("Invalid phone number");
        }

        if (strlen($booking['emergency']) !== 11 || !is_numeric($booking['emergency'])) {
            die("Invalid emergency contact");
        }

        if (strlen($booking['reason']) < 5) {
            die("Please enter reason for visit");
        }

        /* Store booking in session */
        $_SESSION['booking'] = $booking;

        header("Location: index.php?c=booking&a=summary");
    }

    public function summary() {
        if (!isset($_SESSION['booking'])) {
            header("Location: index.php");
            exit;
        }
        $this->view("booking/summary");
    }
}
