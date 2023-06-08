<?php

use Core\Classes\Database;
use Core\Classes\Validator;

header('Content-Type: application/json; charset=utf-8');

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/Validator.php';

$DatabaseConfig = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfig['database']);

$FirstNameStr = sanitizeInput($_POST['firstname']);
$LastNameStr = sanitizeInput($_POST['lastname']);
$EmailStr = $_POST['email'];
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

if (!Validator::email($EmailStr)) {
   $ErrorsArr['email'] = '* Please provide a valid email address.';
}

if (!Validator::string($PasswordStr, 7, 32)) {
    $ErrorsArr['password'] = '* Please enter a password from 7 to 32 characters.';
}

if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {
    $EmailExist = $DatabaseConnection->query('SELECT * FROM Users WHERE EmailAddress = ?', [
        'EmailAddress' => $EmailStr
    ])->find();

    $UserExist = $DatabaseConnection->query('SELECT * FROM Users WHERE Username = ?', [
        'Username' => $UsernameStr
    ])->find();
    
    if ($EmailExist) {
        $ErrorsArr['email'] = 'This email is already in use';
        echo json_encode($ErrorsArr);
        exit();
    }

    if ($UserExist) {
        $ErrorsArr['username'] = 'This username is already taken, try another one';
        echo json_encode($ErrorsArr);
        exit();
    }

    $DatabaseConnection->query('INSERT INTO Users (FirstName, LastName, EmailAddress, Username, Password) VALUES(?, ?, ?, ?, ?)', [
        'firstname' => $FirstNameStr,
        'lastname' => $LastNameStr,
        'email' => $EmailStr,
        'username' => $UsernameStr,
        'password' => password_hash($PasswordStr, PASSWORD_BCRYPT)
    ]);
    
    $UserId = $DatabaseConnection->query('SELECT Id FROM Users WHERE Username = ?', [
        'Username' => $UsernameStr
    ])->find();

    echo true;
}