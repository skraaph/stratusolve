<?php

use Core\Classes\Authenticator;
use Core\Classes\Database;
use Core\Classes\Validator;

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/validator.php';
require '../core/classes/authenticator.php';

session_start();
header('Content-Type: application/json; charset=utf-8');

$DatabaseConfigArr = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfigArr['database']);

$EmailStr = $_POST['email'];
$PasswordStr = $_POST['password'];

$ErrorsArr = array();

if (!Validator::email($EmailStr)) {
    $ErrorsArr['signin-email'] = '* Please provide a valid email address.';
}
if (!Validator::string($PasswordStr, 7, 32)) {
    $ErrorsArr['signin-password'] = '* Wrong password or email.';
}
if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {
    if (!Validator::emailExist($EmailStr)) {
        $ErrorsArr['signin-password'] = '* Wrong password or email.';
        echo json_encode($ErrorsArr);
        exit();
    }

    $signedInBool = (new Authenticator)->attemptConnect($EmailStr, $PasswordStr);

    if (!$signedInBool) {
        $ErrorsArr['signin-password'] = '* Wrong password or email.';
        echo json_encode($ErrorsArr);
    } else {
        echo true;
    }
}