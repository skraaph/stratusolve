<?php

session_start();

$ResultsArr = array();

$FistNameStr = $_SESSION['user']['user_firstname'];
$LastNameStr = $_SESSION['user']['user_lastname'];
$UserNameStr = $_SESSION['user']['username'];

$ResultsArr = [
    'firstname' => $FistNameStr,
    'lastname' => $LastNameStr,
    'username' => $UserNameStr
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($ResultsArr);