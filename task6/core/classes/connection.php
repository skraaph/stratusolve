<?php

class Connect {
    protected static $ServerName = "localhost";
    protected static $DbName="task6db";
    protected static $UserName = "root";
    protected static $Password = "password";
    protected static $pdo;
    
    public function __construct() { }

    public static function connect() {
        $conn = mysqli_connect(self::$ServerName, self::$UserName, self::$Password, self::$DbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}


