<?php

session_start();

//const BASE_PATH = __DIR__.'/';
//require 'config.php';

use Core\Classes\Session;
use Core\Classes\ValidationException;

require 'core/init.php';

$Router = new Core\Classes\Router();
require BASE_PATH . 'core/routes.php';

$UriStr = parse_url($_SERVER['REQUEST_URI'])['path'];
$MethodStr = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
try {
    $Router->route($UriStr, $MethodStr);
} catch (ValidationException $Exception) {
    return redirect($Router->previousUrl());
}