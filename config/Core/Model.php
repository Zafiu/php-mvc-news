<?php

namespace Config\Core;


use \Config\Core\Db;

abstract class Model extends Db
{

    /**
     * @param string $sql
     * @param array $params
     *
     * @return mixed Datensatz wird zurückgeben
     * <false> Query ist fehlgeschalgen
     */
    public static function findOneBySql(string $sql, array $params = [])
    {
        $query = self::connection()->prepare($sql);
        $query->execute($params);

        return $query->fetch();
    }

    /**
     * @param string $sql
     *
     * @return array Datensätze werden zurückgeben
     * <false> Query ist fehlgeschalgen
     */
    public static function findBySql(string $sql)
    {
        $query = self::connection()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @param string $sql
     * @param array $params
     *
     * @return bool <true> Query konnte ausgeführt werden
     *              <false> Query ist fehlgeschlagen
     */
    public static function createSqlCommand(string $sql, array $params = [])
    {
        return self::connection()->prepare($sql)->execute($params);
    }

}