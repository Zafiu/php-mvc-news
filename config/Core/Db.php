<?php

namespace Config\Core;

use PDO;

class Db
{
    /**
     * @var PDO
     */
    private static $mysql;

    /**
     * erstellt eine Datenbank Verbindung als Singleton
     *
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $pass
     *
     * @return PDO
     */
    protected static function connection(): PDO
    {

        if (self::$mysql === null) {
            /**
             * @var $credentials array
             */
            $credentials = require(__DIR__ . '/../db.php');
            $host = $credentials['host'];
            $db = $credentials['db'];
            $user = $credentials['user'];
            $pass = $credentials['password'];

            $dsn = "mysql:host=$host;dbname=$db";

            self::$mysql = new PDO($dsn, $user, $pass);

        }

        return self::$mysql;

    }

}