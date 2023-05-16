<?php

namespace Core\Classes;

class Validator
{
    public static function string($Value, $Min = 1, $Max = 255)
    {
        $Value = trim($Value);
        return strlen($Value) >= $Min && strlen($Value) <= $Max;
    }

    public static function email($Value)
    {
        return filter_var($Value, FILTER_VALIDATE_EMAIL);
    }
}