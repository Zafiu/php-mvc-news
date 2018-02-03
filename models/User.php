<?php

namespace Model;


use Config\Core\Model;

class User extends Model
{

    /**
     * Spaltennamen aus der Tabelle News
     */
    public $id;
    public $name;
    public $surname;
    public $username;
    public $password;

    public function verifyUser($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $sql = 'SELECT * FROM user WHERE username = :username AND password = :password';

        return self::findOneBySql($sql,
            [
                ':username' => $this->username,
                ':password' => $this->password,
            ]);

    }

}