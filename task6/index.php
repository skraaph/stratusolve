<?php 

// Task: Create a local mysql database and setup a php script to connect to it.

// Create one table in the database called "Person" with fields : FirstName, Surname, DateOfBirth, EmailAddress, Age

// Create a class in your php script called "Person" that will have 6 functions:
// - createPerson
// - loadPerson
// - savePerson
// - deletePerson
// - loadAllPeople
// - deleteAllPeople

// Add a for loop that creates 10 new People

// Implement the loadAllPeople function, this function should return all the people's information, 
// then loop over the returned information and print each Person's information to the screen

// Add a log that logs when your script starts and ends and shows how long it took to execute

Define("LOG_FILE", 'logfile.log');

include __DIR__ . '/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=task6db;charset=utf8mb4', 'root', 'password');

$log = new Logger(LOG_FILE);
$log->startLog();

$task6 = new Task6($pdo);
$task6->run();

$log->endLog();
$log->saveLog();

?>