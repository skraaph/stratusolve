<?php

class Person {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    private function randValue($DataName) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randValue = '';
        switch($DataName) {
            case 'FirstName':
            case 'Surname':
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

    public function createPerson($personNumber) {
        for ($i=0; $i < $personNumber; $i++) {
            $query = "INSERT INTO person (`FirstName`, `Surname`, `DateOfBirth`, `EmailAddress`) VALUES (:FirstName, :Surname, :DateOfBirth, :EmailAddress)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':FirstName', $this->randValue('FirstName'), PDO::PARAM_STR);
            $stmt->bindValue(':Surname', $this->randValue('Surname'), PDO::PARAM_STR);
            $stmt->bindValue(':DateOfBirth', $this->randValue('DateOfBirth'), PDO::PARAM_STR);
            $stmt->bindValue(':EmailAddress', $this->randValue('EmailAddress'), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    public function loadPerson($id) {

    }

    public function savePerson() {
        
    }

    public function deletePerson() {
        
    }

    public function loadAllPeople() {
        $query = "SELECT * FROM person";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteAllPeople() {
        $query = "DELETE FROM person";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
}

?>