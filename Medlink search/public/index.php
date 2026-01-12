<?php
session_start();

require_once __DIR__ . "/../app/core/Controller.php";
require_once __DIR__ . "/../app/core/Security.php";

$c = $_GET['c'] ?? 'doctor';
$a = $_GET['a'] ?? 'list';

$controllerName = ucfirst($c) . "Controller";
$controllerFile = __DIR__ . "/../app/controllers/$controllerName.php";

if (!file_exists($controllerFile)) {
    die("Controller not found");
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    die("Controller class missing");
}

$controller = new $controllerName();

if (!method_exists($controller, $a)) {
    die("Method not found");
}

$controller->$a();
