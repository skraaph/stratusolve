<?php

namespace Core\Classes;

class ValidationException extends \Exception
{
    public readonly array $ErrorsArr;

    public static function throw($ErrorsArr)
    {
       $Instance = new static('The form failed to validate.');

       $Instance->ErrorsArr = $ErrorsArr;

       throw $Instance;
    }
}