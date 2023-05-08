<?php

class Connect {
    protected static $host = "localhost";
    protected static $db_name="task6db";
    protected static $username = "root";
    protected static $password = "password";
    protected static $pdo;
    public function __construct() { }

    public static function connect() {
        $host =self::$host;
        $db_name = self::$db_name;
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name", self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        return $conn;
    }
}


