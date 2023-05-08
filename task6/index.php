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

// Task 7:
// This card builds on: Foundation Task 6

// Create an html file that allows for a user to create, read, update and delete a Person from the database
// This file should use jquery to post data to your backend php script to perform the required functions



include 'core/init.php';

Define("LOG_FILE", 'log/logfile.log');

//$pdo = new PDO('mysql:host=localhost;dbname=task6db;charset=utf8mb4', 'root', 'password');

$log = new Logger(LOG_FILE);
$log->startLog();

$PeopleArr = Person::loadAllPeople();

ob_start();
include 'templates/index.html';
$HtmlPage = ob_get_clean();

include 'tabledata.php';

echo $HtmlPage;

$log->endLog();
$log->saveLog();

?>