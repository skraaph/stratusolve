<?php

namespace Core\Classes;

use Core\Classes\Database;
class Validator
{
    public static function string($Value, $Min = 1, $Max = 255)
    {
        $Value = trim($Value);
        return strlen($Value) >= $Min && strlen($Value) <= $Max;
    }

    public static function email($EmailStr)
    {
        return filter_var($EmailStr, FILTER_VALIDATE_EMAIL);
    }

    public static function emailExist($EmailStr)
    {
        $DatabaseConfigArr = require getBasePath(DB_CONF_FILE);
        $DatabaseConnection = new Database($DatabaseConfigArr['database']);

        $UserDataArr = $DatabaseConnection->query('SELECT COUNT(Id) FROM Users WHERE EmailAddress = ?',
        ['email' => $EmailStr])->find();
        
        if($UserDataArr['COUNT(Id)']) {
            return true;
        } else {
            return false;
        }
    }
}