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

    public function getNews()
    {
        $sql = 'SELECT * FROM news';

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
        $sql = "INSERT INTO news (title,text) VALUES (:title,:text)";
        $param = [
            ':title' => $this->title,
            ':text' => $this->text,
        ];

        if ($this->id) {
            $sql = "UPDATE `news` SET `title`=:title,`text`=:text WHERE id=:id";
            $param = [
                ':id' => $this->id,
                ':title' => $this->title,
                ':text' => $this->text,
            ];
        }


        return self::createSqlCommand($sql, $param);

    }

    public function delete($id)
    {
        $sql = 'DELETE FROM news WHERE id = :id';

        return self::createSqlCommand($sql, [
            ':id' => $id,
        ]);

    }

}