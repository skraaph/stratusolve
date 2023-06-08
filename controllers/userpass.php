<?php

use Core\Classes\Authenticator;
use Core\Classes\Database;
use Core\Classes\Validator;
//$2y$10$M/6A4Ewt1TknQ4X/S8yK8O74zJ/Z5ARtxePdzm/Y1iD4LrlcLqgkS
session_start();
header('Content-Type: application/json; charset=utf-8');

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/validator.php';
require '../core/classes/authenticator.php';

$DatabaseConfig = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfig['database']);

$EmailStr = $_SESSION['user']['email'];
$OldPasswordStr = $_POST['oldpassword'];
$NewPasswordStr = $_POST['newpassword'];

$ErrorsArr = [];
if ($OldPasswordStr == '') {
    $ErrorsArr['oldpassword'] = '* Required field.';
 }

if ($NewPasswordStr == '') {
    $ErrorsArr['newpassword'] = '* Required field.';
 }

if (!Validator::string($OldPasswordStr, 7, 32)) {
    $ErrorsArr['oldpassword'] = '* Please enter a password from 7 to 32 characters.';
}

if (!Validator::string($NewPasswordStr, 7, 32)) {
    $ErrorsArr['newpassword'] = '* Please enter a password from 7 to 32 characters.';
}

if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {

    $signedInBool = (new Authenticator)->attemptConnect($EmailStr, $OldPasswordStr);
    //dd($OldPasswordStr + $NewPasswordStr + $signedInBool);
    if (!$signedInBool) {
        $ErrorsArr['oldpassword'] = '* Wrong password.';
        echo json_encode($ErrorsArr);
        exit();
    }

    $DatabaseConnection->query('UPDATE Users SET Password = ? WHERE Id = ?', [
        'password' => password_hash($NewPasswordStr, PASSWORD_BCRYPT),
        'id' => $_SESSION['user']['user_id']
    ]);
    
    $signedInBool = (new Authenticator)->attemptConnect($EmailStr, $NewPasswordStr);

    if (!$signedInBool) {
        $ErrorsArr['oldpassword'] = '* Wrong password.';
        echo json_encode($ErrorsArr);
        exit();
    } else {
        echo true;
    }
}