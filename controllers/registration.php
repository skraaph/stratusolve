<?php

use Core\Classes\Database;
use Core\Classes\Validator;

//require '../core/init.php';

//const BASE_PATH = __DIR__.'/';
//const DB_CONF_FILE = '../core/db.php';

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/Validator.php';

/*if (isset($_SESSION['user_id'])) {
    header("location: " . APP_DIR . "/");
}*/

$DatabaseConfig = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfig['database']);

$FirstName = $_POST['firstname'];
$LastName = $_POST['lastname'];
$Email = $_POST['email'];
$Username = $_POST['username'];
$Password = $_POST['password'];

//header('Content-Type: application/json');

$ErrorsArr = [];
if (!Validator::email($Email)) {
   $ErrorsArr['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($Password, 7, 32)) {
    $ErrorsArr['password'] = 'Please enter a password from 7 to 32 characters.';
}

if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {
    $EmailExist = $DatabaseConnection->query('SELECT * FROM Users WHERE EmailAddress = ?', [
        'EmailAddress' => $Email
    ])->find();

    $UserExist = $DatabaseConnection->query('SELECT * FROM Users WHERE Username = ?', [
        'Username' => $Username
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
        'firstname' => $FirstName,
        'lastname' => $LastName,
        'email' => $Email,
        'username' => $Username,
        'password' => password_hash($Password, PASSWORD_BCRYPT)
    ]);
    
    $UserId = $DatabaseConnection->query('SELECT Id FROM Users WHERE Username = ?', [
        'Username' => $Username
    ])->find();

    echo true;
}