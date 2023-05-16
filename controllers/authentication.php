<?php

use Core\Classes\Authenticator;
use Core\Classes\Database;
use Core\Classes\Validator;

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/Validator.php';
require '../core/classes/authenticator.php';

session_start();

$DatabaseConfigArr = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfigArr['database']);

$EmailStr = $_POST['email'];
$PasswordStr = $_POST['password'];

$ErrorsArr = array();

if (!Validator::email($EmailStr)) {
   $ErrorsArr['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($PasswordStr, 7, 32)) {
    $ErrorsArr['password'] = 'Please enter a password from 7 to 32 characters.';
}

if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {
    $signedInBool = (new Authenticator)->attemptConnect($EmailStr, $PasswordStr);

    if (!$signedInBool) {
        echo false;
    } else {
        echo true;
    }
}