<?php

class Person {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    private function randValue($DataName) {
        $CharactersStr = 'abcdefghijklmnopqrstuvwxyz';
        $RandValueStr = '';
        switch($DataName) {
            case 'FirstName':
            case 'Surname':
                for ($i = 0; $i < 10; $i++) {
                    $RandValueStr .= $CharactersStr[rand(0, strlen($CharactersStr)-1)];
                }
                $RandValueStr = ucfirst($RandValueStr);
                break;
            case 'EmailAddress':
                for ($i = 0; $i < 10; $i++) {
                    $RandValueStr .= $CharactersStr[rand(0, strlen($CharactersStr)-1)];
                }
                $RandValueStr .= '@mail.com';
                break;
            case 'DateOfBirth':
                $StartDate = strtotime("1900-01-01");
                $EndDate = strtotime("2022-12-31");
                $RandomTimestamp = rand($StartDate, $EndDate);
                $RandValueStr = date("Y-m-d", $RandomTimestamp);
                break;
        }
        return $RandValueStr;
    }

    public function createPerson($personNumber) {
        for ($i=0; $i < $personNumber; $i++) {
            $query = "INSERT INTO person (`FirstName`, `Surname`, `DateOfBirth`, `EmailAddress`) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->conn, $query);

            $FirstName = $this->randValue('FirstName');
            $SurName = $this->randValue('Surname');
            $DateOfBirth = $this->randValue('DateOfBirth');
            $EmailAddress = $this->randValue('EmailAddress');
            mysqli_stmt_bind_param($stmt, "ssss", $FirstName, $SurName, $DateOfBirth, $EmailAddress);
            
            if (mysqli_stmt_execute($stmt)) {
            } else {
                echo "Error creating record: " . mysqli_error($this->conn);
            }
        }
        mysqli_stmt_close($stmt);
    }

    public function loadPerson($id) {

    }

    public function savePerson() {
        
    }

    public function deletePerson() {
        
    }

    public function loadAllPeople() {
        $query = "SELECT * FROM person";
        $stmt = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    }

    public function deleteAllPeople() {
        $query = "DELETE FROM person";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_execute($stmt);
    }
}

?>