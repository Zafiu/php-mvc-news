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
    public $fk_userId;


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
        $sql = "INSERT INTO news (title,text,fk_userId) VALUES (:title,:text,:fk_userId)";
        $param = [
            ':title' => $this->title,
            ':text' => $this->text,
            ':fk_userId' => $this->fk_userId
        ];

        if ($this->id) {
            $sql = "UPDATE `news` SET `title`=:title,`text`=:text WHERE id=:id AND fk_userId=:fk_userId";
            $param = [
                ':id' => $this->id,
                ':title' => $this->title,
                ':text' => $this->text,
                ':fk_userId' => $this->fk_userId
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