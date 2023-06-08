<?php

use Core\Classes\Database;
use Core\Classes\Validator;

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/Validator.php';

session_start();
ob_start();

$DatabaseConfig = require getBasePath(DB_CONF_FILE);
$DatabaseConnection = new Database($DatabaseConfig['database']);

$limit = ($_POST['limit'] < 20 ? $_POST['limit'] : 10);
//$StartPostId = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT) ?? false;

$ErrorsArr = array();
$ResultsArr = array();
$ResultsStr = '';

if (!empty($ErrorsArr)) {
    echo json_encode($ErrorsArr);
    exit();
} else {
    //SELECT * FROM Posts WHERE id < (select max(id) from Posts) ORDER BY Id DESC LIMIT 0, 10
    //SELECT `Id`, `UserId`, `PostName`, `PostText`, `PostTimeStamp` FROM `posts` LIMIT 0, 10
    
    if(!$_SESSION['post'] ?? false) {
        //dd($_SESSION['post']['start_post_id']);
        $PostId = $DatabaseConnection->query('SELECT MAX(Id) FROM Posts')->find();
        $_SESSION['post'] = ['start_post_id' => $PostId['MAX(Id)']];
        session_regenerate_id(true);
    }

    $PostData = $DatabaseConnection->query('SELECT * FROM Posts WHERE id <= ? ORDER BY Id DESC LIMIT ?', [
        'start_id' => $_SESSION['post']['start_post_id'], 'limit' => $limit
    ]);
    
    $PostDataResultArr = $PostData->Statement->get_result();
    while ($PostObjArr = $PostDataResultArr->fetch_assoc()) {
        //SELECT `FirstName`, `LastName`, `Username`FROM `users` WHERE Id=?;
        $UserObjArr = $DatabaseConnection->query('SELECT `Id`, `FirstName`, `LastName`, `Username`, `Img` FROM Users WHERE Id=?', [
            'Id' => $PostObjArr['UserId']
        ])->find();

        if (!$UserObjArr) {
        } else {
            $UserFullNameStr = $UserObjArr['FirstName'] . ' ' . $UserObjArr['LastName'][0] . '.';
            $UsernameStr = '@' . $UserObjArr['Username'];
            $UserImgStr = $UserObjArr['Img'];
            $PostDate = $PostObjArr['PostTimeStamp'];
            $PostNameStr = $PostObjArr['PostName'];
            if($_SESSION['user']['user_id'] == $UserObjArr['Id']) {
                $PostIdStr = $PostObjArr['Id'];
            } else {
                $PostIdStr = "d";
            }
            $PostTextStr = $PostObjArr['PostText'];

            ob_start();

            view("partials/post.html.php", [
                'ViewUserIdStr' => $_SESSION['user']['user_id'],
                'ViewPostUserIdStr' => $PostObjArr['UserId']
            ]);

            //include '../views/partials/post.html.php';
            $PostHtmlElement = ob_get_clean();

            $PostHtmlElement = str_replace('{ Userfull }', $UserFullNameStr, $PostHtmlElement);
            $PostHtmlElement = str_replace('{ Username }', $UsernameStr, $PostHtmlElement);
            $PostHtmlElement = str_replace('{ Postdate }', $PostDate, $PostHtmlElement);
            $PostHtmlElement = str_replace('{ Postname }', $PostNameStr, $PostHtmlElement);
            $PostHtmlElement = str_replace('{ Postid }', $PostIdStr, $PostHtmlElement);
            $PostHtmlElement = str_replace('{ Posttext }', $PostTextStr, $PostHtmlElement);
            $PostHtmlElement = str_replace('{ UserImg }', $UserImgStr, $PostHtmlElement);
            
            $ResultsStr .= $PostHtmlElement;
            //$StartPostId = $PostObjArr['Id'];
            $_SESSION['post'] = ['start_post_id' => $PostObjArr['Id']-1];
        }
    }

    //array_unshift($ResultsArr, ['StartPostId' => $StartPostId]);
    array_unshift($ResultsArr, ['Posts' => $ResultsStr]);
    array_unshift($ResultsArr, ['Done' => true]);
    //dd($_SESSION['post']['start_post_id']);
    ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($ResultsArr);

    /*if (!$signedIn) {
        echo false;
    } else {
        echo true;
    }*/
}