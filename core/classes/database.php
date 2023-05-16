<?php

namespace Core\Classes;

class Database
{
    public $Connection;
    public $Statement;

    public function __construct($ConfigArr, $UsernameStr = 'root', $PasswordStr = 'secret')
    {
        $HostStr = $ConfigArr['host'];
        $UsernameStr = $ConfigArr['username'] ?? $UsernameStr;
        $PasswordStr = $ConfigArr['password'] ?? $PasswordStr;
        $DatabaseStr = $ConfigArr['database'];

        $this->Connection = new \mysqli($HostStr, $UsernameStr, $PasswordStr, $DatabaseStr);
        if ($this->Connection->connect_errno) {
            die("Failed to connect to MySQL: " . $this->Connection->connect_error);
        }
    }

    public function query($Query, $Params = [])
    {
        $this->Statement = $this->Connection->prepare($Query);
        if (!empty($Params)) {
            
            $TypesStr = '';
            $Values = array();

            foreach ($Params as $Param) {
                $TypesStr .= $this->getDataType($Param);
                $Values[] = $Param;
            }
            
            $bindParamsArr = array();
            $bindParamsArr[] = &$TypesStr;
            foreach ($Values as &$Value) {
                $bindParamsArr[] = &$Value;
            }

            array_unshift($Values, $TypesStr);
            
            call_user_func_array([$this->Statement, 'bind_param'], $bindParamsArr);
        }

        $this->Statement->execute();

        return $this;
    }

    public function get()
    {
        $Result = $this->Statement->get_result();
        return $Result->fetch_all(MYSQLI_ASSOC);
    }

    public function find()
    {
        $Result = $this->Statement->get_result();
        return $Result->fetch_assoc();
    }

    private function getDataType($Value)
    {
        if (is_int($Value)) {
            return 'i';
        } elseif (is_float($Value)) {
            return 'd';
        } elseif (is_string($Value)) {
            return 's';
        } else {
            return 'b';
        }
    }
    
    public function __destruct()
    {
        $this->Connection->close();
    }
}