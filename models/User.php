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

    /**
     * @param int $id
     * @return mixed <array> User wurde gefunden
     * <false> User konnte nicht gefunden werden
     */
    public function getUserById(int $id)
    {
        $this->id = $id;
        $sql = 'SELECT * FROM user WHERE id = :id';

        return self::findOneBySql($sql, [':id' => $this->id]);

    }

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