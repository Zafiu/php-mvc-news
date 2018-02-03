<?php

namespace Model;

use Config\Core\Model;

class News extends Model
{
    /**
     * Spaltennamen aus der Tabelle News
     */
    public $id;
    public $title;
    public $text;
    public $position;

    public function getNews()
    {
        $sql = 'SELECT * FROM news ORDER BY position DESC';

        return self::findBySql($sql);
    }

    public function getOneNews($id)
    {
        $this->id = $id;

        $sql = 'SELECT * FROM news WHERE id =:id';

        return self::findOneBySql($sql, [':id' => $this->id]);

    }

    public function save()
    {
        $sql = "INSERT INTO news ('title','text','position') VALUES (?,?,?)";

        return self::createSqlCommand($sql, [
                $this->title,
                $this->text,
                $this->position,
            ]
        );

    }

    public function delete($id)
    {
        $sql = 'DELETE FROM news WHERE id = :id';

        return self::createSqlCommand($sql, [
            ':id' => $id,
        ]);

    }

}