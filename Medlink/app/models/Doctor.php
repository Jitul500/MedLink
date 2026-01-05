<?php
class Doctor {

    public static function getAll() {
        return [
            [
                "id" => 1,
                "name" => "Dr. Ayesha Rahman",
                "specialty" => "Cardiology",
                "fee" => 1500,
                "photo" => "doctor1.jpg",
                "qualification" => "MBBS, MD (Cardiology)",
                "experience" => "10 Years"
            ],
            [
                "id" => 2,
                "name" => "Dr. Mahmud Hasan",
                "specialty" => "Neurology",
                "fee" => 1800,
                "photo" => "doctor2.jpg",
                "qualification" => "MBBS, FCPS (Neurology)",
                "experience" => "12 Years"
            ],
            [
                "id" => 3,
                "name" => "Dr. Nusrat Jahan",
                "specialty" => "Orthopedics",
                "fee" => 1200,
                "photo" => "doctor3.jpg",
                "qualification" => "MBBS, MS (Orthopedics)",
                "experience" => "8 Years"
            ]
        ];
    }

    public static function findById($id) {
        foreach (self::getAll() as $doc) {
            if ($doc['id'] == $id) {
                return $doc;
            }
        }
        return null;
    }
}
