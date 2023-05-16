<?php

use Core\Classes\Database;

session_start();

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';

$DatabaseConfigArr = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfigArr['database']);

$UserIdStr = $_SESSION['user']['user_id'];
$PostIdStr = sanitizeInput($_POST['id']);

$ErrorsArr = [];

if (!empty($ErrorsArr)) {
    //echo json_encode($ErrorsArr);
    exit();
} else {
    $DatabaseConnection->query('DELETE FROM Posts WHERE Id = ? AND UserId = ?', [
        'PostId' => $PostIdStr,
        'UserId' => $UserIdStr
    ]);

    echo true;
}