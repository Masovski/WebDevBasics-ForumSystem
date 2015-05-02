<?php
session_start();
include_once('includes/config.php');
$requestParts = explode('/', $_SERVER['REQUEST_URI'], 4);

$controllerName = DEFAULT_CONTROLLER;
if(count($requestParts) >= 2 && $requestParts[1] != '') {
    $controllerName = strtolower($requestParts[1]);
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $controllerName)) {
        die('Invalid controller name. Use letters, digits and underscore only.');
    }
}

$action = DEFAULT_ACTION;
if(count($requestParts) >= 3 && $requestParts[2] != '') {
    $action = strtolower($requestParts[2]);
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $action)) {
        die('Invalid action name. Use letters, digits and underscore only.');
    }
}

$params = [];
if (count($requestParts) >= 4) {
    $params = explode('/', $requestParts[3]);
}

// Load the controller and execute the action
$controllerClassName = ucfirst($controllerName) . 'Controller';
$controllerFileName = 'controllers/' . $controllerClassName . '.php';

if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName($controllerName, $action);
} else {
    die("Cannot find controller class '$controllerClassName' in file '$controllerFileName' ");
}

if (method_exists($controller, $action)) {
    call_user_func_array(array($controller, $action), $params);
    $controller->renderView();
} else {
    die("Cannot find action '$action' in controller '$controllerClassName'");
}

function __autoload($className) {
    if (file_exists("controllers/{$className}.php")) {
        include "controllers/{$className}.php";
    }
    if (file_exists("models/{$className}.php")) {
        include "models/{$className}.php";
    }
}