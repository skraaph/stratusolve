<?php

namespace Core\Classes;

use Core\Classes\Database;

class Authenticator
{
    public function attemptConnect($EmailStr, $PasswordStr) {
        $DatabaseConfigArr = require getBasePath(DB_CONF_FILE);
        $DatabaseConnection = new Database($DatabaseConfigArr['database']);
        
        $UserDataArr = $DatabaseConnection->query('SELECT * FROM Users WHERE EmailAddress = ?',
         ['email' => $EmailStr])->find();
        
        if ($UserDataArr) {
            if (password_verify($PasswordStr, $UserDataArr['Password'])) {
                $this->login(['email' => $EmailStr,
                    'user_id' => $UserDataArr['Id'],
                    'user_full' => $UserDataArr['FirstName'] . ' ' . $UserDataArr['LastName'][0] . '.',
                    'user_firstname' => $UserDataArr['FirstName'],
                    'user_lastname' => $UserDataArr['LastName'],
                    'username' => $UserDataArr['Username']
                ]);
                return true;
            }
        }
        
        return false;
    }

    public function login($UserDataArr) {
        $_SESSION['user'] = [
            'email' => $UserDataArr['email'],
            'user_id' => $UserDataArr['user_id'],
            'user_full' => $UserDataArr['user_full'],
            'user_firstname' => $UserDataArr['user_firstname'],
            'user_lastname' => $UserDataArr['user_lastname'],
            'username' => $UserDataArr['username']
        ];
        
        session_regenerate_id(true);
    }

    public function logout() {
        Session::destroy();
    }
}