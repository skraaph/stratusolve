<?php

include 'core/init.php';

$id = $_POST['Id'];

$PersonDataArr = [
    'FirstName' => $_POST['FirstName'],
    'SurName' => $_POST['SurName'],
    'DateOfBirth' => $_POST['DateOfBirth'],
    'EmailAddress' => $_POST['EmailAddress'],
];

Person::savePerson("person", $id, $PersonDataArr);

?>