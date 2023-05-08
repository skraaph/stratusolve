<?php

class Person extends Connect{
    public static function createPerson($Table, $DataArr = array()) {
        $KeyArr = implode(', ' , array_keys($DataArr));
        $ValueArr = implode(', ', array_fill(0, count($DataArr), '?'));
        $query = "INSERT INTO {$Table} ({$KeyArr}) VALUES ({$ValueArr})";
        //echo $query;
        $conn = self::connect();
        
        $conn->begin_transaction();
        if($stmt = $conn->prepare($query)) {
            $Values = array_values($DataArr);
            $Types = str_repeat('s', count($Values)); //ssss - mean all string
            $stmt->bind_param($Types, ...$Values);
            if ($stmt->execute() === false) {
                $conn->rollback();
            } else {
                $conn->commit();
            }
        }
    }

    public static function savePerson($Table, $id, $DataArr = array()) {
        $KeyArr = '';
        
        // TODO: for?
        $Count = 1;
        foreach ($DataArr as $key => $Data) {
            $KeyArr .= "`{$key}` = ?";
            if($Count < count($DataArr)) {
                $KeyArr .= ', ';
            }
            $Count++;
        }
        $query = "UPDATE {$Table} SET {$KeyArr} WHERE id = {$id}";
        //echo $query;
        $conn = self::connect();
        $conn->begin_transaction();
        if($stmt = $conn->prepare($query)) {
            $values = array_values($DataArr);
            $types = str_repeat('s', count($values));
            $stmt->bind_param($types, ...$values);
            if ($stmt->execute() === false) {
                $conn->rollback();
            } else {
                $conn->commit();
            }
        }
    }

    public static function deletePerson($Table, $DataArr = array()) {
        $query   = "DELETE FROM " . $Table;
        $where = " WHERE ";
        foreach($DataArr as $key => $value){
            $query .= $where . $key . " = " . $value . "";
            $where = " AND ";
        }
        $query .= ";";
        mysqli_query(self::connect(), $query);
    }

    public static function loadPeoplePage() {
        if (!isset ($_GET['page']) ) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $ResultFirst = ($page-1) * RESULT_PER_PAGE;

        $query = 'SELECT * FROM person LIMIT ' . $ResultFirst . ',' . RESULT_PER_PAGE . ';';
        $stmt = mysqli_query(self::connect(), $query);
        return mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    }

    public static function loadAllPeople() {
        $query = "SELECT * FROM person";
        $stmt = mysqli_query(self::connect(), $query);
        return mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    }

    public static function pageCount() {
        $query = "SELECT * FROM person";
        $stmt = mysqli_query(self::connect(), $query);
        $PageCount = ceil(mysqli_num_rows($stmt)/RESULT_PER_PAGE);
        return $PageCount;
    }

    public static function deleteAllPeople() {
        $query = "DELETE FROM person";
        mysqli_query(self::connect(), $query);
    }
}

?>