<?php

use Core\Classes\Database;
use Core\Classes\Validator;

session_start();

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/Validator.php';

$DatabaseConfigArr = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfigArr['database']);

$PostNameStr = sanitizeInput($_POST['postname']);
$PostTextStr = sanitizeInput($_POST['posttext']);

$ErrorsArr = [];

if (!empty($ErrorsArr)) {
    //echo json_encode($ErrorsArr);
    exit();
} else {
    $DatabaseConnection->query('INSERT INTO Posts (UserId, PostName, PostText) VALUES(?, ?, ?)', [
        'UserId' => $_SESSION['user']['user_id'],
        'PostName' => $PostNameStr,
        'PostText' => $PostTextStr
    ]);

    $UserFullNameStr = $_SESSION['user']['user_full'];
    $UsernameStr = $_SESSION['user']['username'];
    $PostDate = date("m.d.Y H:i", time());
    
    ob_start();
    include '../views/partials/post.html.php';
    $NewPostHtmlElementStr = ob_get_clean();

    $NewPostHtmlElementStr = str_replace('{ Userfull }', $UserFullNameStr, $NewPostHtmlElementStr);
    $NewPostHtmlElementStr = str_replace('{ Username }', $UsernameStr, $NewPostHtmlElementStr);
    $NewPostHtmlElementStr = str_replace('{ Postdate }', $PostDate, $NewPostHtmlElementStr);
    $NewPostHtmlElementStr = str_replace('{ Postname }', $PostNameStr, $NewPostHtmlElementStr);
    $NewPostHtmlElementStr = str_replace('{ Posttext }', $PostTextStr, $NewPostHtmlElementStr);

    unset($_SESSION['post']['start_post_id']);
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([ 'Done' => true, 'NewPost' => $NewPostHtmlElementStr]);
}