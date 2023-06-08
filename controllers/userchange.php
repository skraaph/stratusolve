<?php

use Core\Classes\Authenticator;
use Core\Classes\Database;
use Core\Classes\Validator;

session_start();
header('Content-Type: application/json; charset=utf-8');

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/validator.php';
require '../core/classes/authenticator.php';

$DatabaseConfig = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfig['database']);

$FirstNameStr = sanitizeInput($_POST['firstname']);
$LastNameStr = sanitizeInput($_POST['lastname']);
$EmailStr = $_SESSION['user']['email'];
$UsernameStr = sanitizeInput($_POST['username']);
$PasswordStr = $_POST['password'];

$ErrorsArr = [];
if ($FirstNameStr == '') {
    $ErrorsArr['firstname'] = '* Required field.';
 }

if ($LastNameStr == '') {
    $ErrorsArr['lastname'] = '* Required field.';
 }

if ($UsernameStr == '') {
    $ErrorsArr['username'] = '* Required field.';
 }

if (!Validator::string($PasswordStr, 7, 32)) {
    $ErrorsArr['password'] = '* Please enter a password from 7 to 32 characters.';
}

if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {
    if($UsernameStr != $_SESSION['user']['username']) {
        $UserExist = $DatabaseConnection->query('SELECT * FROM Users WHERE Username = ?', [
            'Username' => $UsernameStr
        ])->find();

        if ($UserExist) {
            $ErrorsArr['username'] = 'This username is already taken, try another one';
            echo json_encode($ErrorsArr);
            exit();
        }
    }

    $signedInBool = (new Authenticator)->attemptConnect($EmailStr, $PasswordStr);

    if (!$signedInBool) {
        $ErrorsArr['password'] = '* Wrong password.';
        echo json_encode($ErrorsArr);
    } else {
        // UPDATE Users SET FirstName = ?, LastName = ?, Username = ? WHERE Id = ?
        $DatabaseConnection->query('UPDATE Users SET FirstName = ?, LastName = ?, Username = ? WHERE Id = ?', [
            'firstname' => $FirstNameStr,
            'lastname' => $LastNameStr,
            'username' => $UsernameStr,
            'id' => $_SESSION['user']['user_id']
        ]);
        
        $signedInBool = (new Authenticator)->attemptConnect($EmailStr, $PasswordStr);

        if (!$signedInBool) {
            $ErrorsArr['password'] = '* Wrong password.';
            echo json_encode($ErrorsArr);
        }

        echo true;
    }
}