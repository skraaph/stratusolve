<?php

include 'core/init.php';

$PersonDataArr = array();

function randValue($DataName) {
    $CharStr = 'abcdefghijklmnopqrstuvwxyz';
    $RandValue = '';
    switch($DataName) {
        case 'FirstName':
        case 'SurName':
            for ($i = 0; $i < 10; $i++) {
                $RandValue .= $CharStr[rand(0, strlen($CharStr)-1)];
            }
            $RandValue = ucfirst($RandValue);
            break;
        case 'EmailAddress':
            for ($i = 0; $i < 10; $i++) {
                $RandValue .= $CharStr[rand(0, strlen($CharStr)-1)];
            }
            $RandValue .= '@mail.com';
            break;
        case 'DateOfBirth':
            $StartDate = strtotime("1900-01-01");
            $EndDate = strtotime("2022-12-31");
            $RandomTimestamp = rand($StartDate, $EndDate);
            $RandValue = date("Y-m-d", $RandomTimestamp);
            break;
    }
    return $RandValue;
}

function sanitizeInput($Input) {
    $Input = htmlspecialchars($Input);
    $Input = trim($Input);
    $Input = stripslashes($Input);
    return $Input;
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'random') {
        $PersonDataArr = [
            'FirstName' => randValue('FirstName'),
            'SurName' => randValue('SurName'),
            'DateOfBirth' => randValue('DateOfBirth'),
            'EmailAddress' => randValue('EmailAddress'),
        ];
    }
} else {
    $MaxInt = filter_input(INPUT_POST, 'max', FILTER_SANITIZE_NUMBER_INT);
    $PersonDataArr = [
        'FirstName' => ucfirst(strtolower(sanitizeInput($_POST['FirstName']))),
        'SurName' => ucfirst(strtolower(sanitizeInput($_POST['SurName']))),
        'DateOfBirth' => sanitizeInput($_POST['DateOfBirth']),
        'EmailAddress' => filter_input(INPUT_POST, 'EmailAddress', FILTER_SANITIZE_EMAIL),
    ];
}

Person::createPerson("person", $PersonDataArr);

echo Person::pageCount();

?>