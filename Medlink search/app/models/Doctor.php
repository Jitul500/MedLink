<?php
require_once "../app/core/Database.php";

class Doctor {

    public static function getAll() {

        $db = Database::connect();
        $result = $db->query("SELECT * FROM users WHERE role = 'doctor'");

        if (!$result) {
            die("Query failed: " . $db->error);
        }

        $doctors = [];

        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }

        return $doctors;
    }

    public static function findById($id) {

        $db = Database::connect();
        $id = (int)$id;

        $result = $db->query("SELECT * FROM users WHERE id = $id AND role = 'doctor'");
        
        if (!$result) {
            die("Query failed: " . $db->error);
        }
        
        return $result->fetch_assoc();
    }
}
