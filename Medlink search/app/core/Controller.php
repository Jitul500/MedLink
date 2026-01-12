<?php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require __DIR__ . "/../views/layout/header.php";
        require __DIR__ . "/../views/$view.php";
        require __DIR__ . "/../views/layout/footer.php";
    }
}

