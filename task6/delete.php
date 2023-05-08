<?php

include 'core/init.php';

$PersonDataArr = array();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'deleteId') {
        $PersonDataArr = [
            'id' => $_POST['Id'],
        ];
        Person::deletePerson("person", $PersonDataArr);
    } elseif ($_POST['action'] == 'delete') {
    Person::deleteAllPeople();
    }
}

?>