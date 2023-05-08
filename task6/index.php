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

$ServerName = "localhost";
$UserName = "root";
$Password = "password";
$DbName = "task6db";

// Create connection
$conn = mysqli_connect($ServerName, $UserName, $Password, $DbName);

$Log = new Logger(LOG_FILE);
$Log->startLog();

$Task6 = new Task6($conn);
$Task6->run();

$Log->endLog();
$Log->saveLog();

?>