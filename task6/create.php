<?php

include 'core/init.php';

$PersonDataArr = array();

function randValue($DataName) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randValue = '';
    switch($DataName) {
        case 'FirstName':
        case 'SurName':
            for ($i = 0; $i < 10; $i++) {
                $randValue .= $characters[rand(0, strlen($characters)-1)];
            }
            $randValue = ucfirst($randValue);
            break;
        case 'EmailAddress':
            for ($i = 0; $i < 10; $i++) {
                $randValue .= $characters[rand(0, strlen($characters)-1)];
            }
            $randValue .= '@mail.com';
            break;
        case 'DateOfBirth':
            $startDate = strtotime("1900-01-01");
            $endDate = strtotime("2022-12-31");
            $randomTimestamp = rand($startDate, $endDate);
            $randValue = date("Y-m-d", $randomTimestamp);
            break;
    }
    return $randValue;
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
    $PersonDataArr = [
        'FirstName' => $_POST['FirstName'],
        'SurName' => $_POST['SurName'],
        'DateOfBirth' => $_POST['DateOfBirth'],
        'EmailAddress' => $_POST['EmailAddress'],
    ];
}

Person::createPerson("person", $PersonDataArr);

?>