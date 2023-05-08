<?php

class Person extends Connect{
    protected static $pdo;

    public $PeopleArr;

    public static function createPerson($table, $dataArr = array()) {
        $keyArr = implode(',' , array_keys($dataArr));
        $valueArr = ':' . implode(', :' , array_keys($dataArr));
        $query = "INSERT INTO {$table} ({$keyArr}) VALUES ({$valueArr})";
        $pdo = self::connect();
        $pdo->beginTransaction(); 
        if($stmt = $pdo->prepare($query)) {
            foreach($dataArr as $key => $data) {
                $stmt->bindValue(':'. $key , $data );
            }
            if ($stmt->execute() === FALSE) {
                $pdo->rollback();
            } else {
                $pdo->commit();
            }
        }
    }

    public static function loadPerson($id) {

    }

    public static function savePerson($table, $id, $dataArr = array()) {
        $keyArr = '';
        

        // TODO: for?
        $Count = 1;
        foreach ($dataArr as $key => $data) {
            $keyArr .= "`{$key}` = :{$key}";
            if($Count < count($dataArr)) {
                $keyArr .= ', ';
            }
            $Count++;
        }
        $query = "UPDATE {$table} SET {$keyArr} WHERE id = {$id}";
        $pdo = self::connect();
        $pdo->beginTransaction(); 
        if($stmt = $pdo->prepare($query)) {
            foreach($dataArr as $key => $data) {
                $stmt->bindValue(':'. $key , $data );
            }
            if ($stmt->execute() === FALSE) {
                $pdo->rollback();
            } else {
                $pdo->commit();
            }
        }
    }

    public static function deletePerson($table, $dataArr = array()) {
        $query   = "DELETE FROM " . $table;
        $where = " WHERE ";
        foreach($dataArr as $key => $value){
            $query .= $where . $key . " = " . $value . "";
            $where = " AND ";
        }
        $query .= ";";
        $stmt = self::connect()->prepare($query);
        $stmt->execute();
    }

    public static function loadAllPeople() {
        $query = "SELECT * FROM person";
        $stmt = self::connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function deleteAllPeople() {
        $query = "DELETE FROM person";
        $stmt = self::connect()->prepare($query);
        $stmt->execute();
        return;
    }
}

?>