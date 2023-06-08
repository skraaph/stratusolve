<?php

use Core\Classes\Authenticator;
use Core\Classes\Database;

session_start();
header('Content-Type: application/json; charset=utf-8');

require '../core/functions.php';
require '../config.php';
require '../core/classes/database.php';
require '../core/classes/authenticator.php';


$targetDir = "../assets/uploads/";

$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);

$allowedTypes = array(IMAGETYPE_PNG);
$detectedType = exif_imagetype($_FILES["fileToUpload"]["tmp_name"]);

$ErrorsArr = [];
if (!in_array($detectedType, $allowedTypes)) {
    $ErrorsArr["img"] = "* Invalid file format. Only PNG images are allowed.";
    echo json_encode($ErrorsArr);
    exit();
}

$maxFileSize = 100 * 1024;
if ($_FILES["fileToUpload"]["size"] > $maxFileSize) {
    $ErrorsArr['img'] =  '* File size limit 100 KB.';
    echo json_encode($ErrorsArr);
    exit();
}

$uniqueFilename = uniqid() . "_" . time() . "." . "png";
$targetFile = $targetDir . $uniqueFilename;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    chmod($targetFile, 0644);
    $DatabaseConfig = require getBasePath(DB_CONF_FILE);
    $DatabaseConnection = new Database($DatabaseConfig['database']);

    $DatabaseConnection->query('UPDATE Users SET Img = ? WHERE Id = ?', [
        'Img' => $uniqueFilename,
        'id' => $_SESSION['user']['user_id']
    ]);
    
    $_SESSION['user']['img'] = $uniqueFilename;
}