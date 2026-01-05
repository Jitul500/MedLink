<?php
session_start();


require_once __DIR__ . "/../app/core/Controller.php";
require_once __DIR__ . "/../app/core/Security.php";

$controller = $_GET['c'] ?? 'doctor';
$action     = $_GET['a'] ?? 'list';

$controller = strtolower($controller);
$controllerName = ucfirst($controller) . "Controller";

$controllerFile = __DIR__ . "/../app/controllers/" . $controllerName . ".php";

if (!file_exists($controllerFile)) {
    die("Controller file not found: " . $controllerFile);
}
require_once $controllerFile;

if (!class_exists($controllerName)) {
    die("Controller class not found: " . $controllerName);
}

$controllerObject = new $controllerName();

if (!method_exists($controllerObject, $action)) {
    die("Method not found: " . $action);
}
$controllerObject->$action();
