<?php
class Security {

    public static function clean($data) {
        return htmlspecialchars(trim($data));
    }

    public static function csrfToken() {
        if (!isset($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['token'];
    }

    public static function verifyToken($token) {
        return isset($_SESSION['token']) && $_SESSION['token'] === $token;
    }
}
