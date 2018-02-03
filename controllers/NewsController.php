<?php

namespace Controller;

use Config\Core\Controller;
use Model\News;

class NewsController extends Controller
{

    public function index()
    {
        $model = new News();
        $result = $model->getNews();

        if (!empty($_SESSION)) {
            return $this->render(__DIR__ . '/../views/news/admin/index.php', ['result' => $result]);
        }

        return $this->render(__DIR__ . '/../views/news/index.php', ['result' => $result,]);
    }

    /**
     * Detailansicht der News
     */
    public function view()
    {
        if (!empty($_GET['id'])) {
            $model = new News();
            $news = $model->getOneNews($_GET['id']);

            if ($news) {
                return $this->render(__DIR__ . '/../views/news/view.php', ['news' => $news]);
            }
        }

        return $this->render(__DIR__ . '/../views/page-not-found.php');

    }

    /**
     * News Artikel wird angelegt
     *
     * News konnte angelegt werden <TRUE> sonst <FALSE>
     *
     * @return bool|\PDOStatement
     */
    public function create(): bool
    {
        if (!empty($_POST['title']) && !empty($_POST['text'])) {

            $sqlGetLatestPosition = 'SELECT position FROM news ORDER BY position DESC LIMIT 1';
            $executeSql = Db::connection()->query($sqlGetLatestPosition);
            $result = $executeSql->fetch();

            $position = $result['position'] + 1;
            $title = $_POST['title'];
            $text = $_POST['text'];
            $sqlNewPost = "INSERT INTO news (title,text,position) VALUES ('$title','$text','$position')";
            $executeSql = Db::connection()->prepare($sqlNewPost)->execute();

            return $executeSql;
        }

        return false;
    }

    /**
     * eine bestehende News übarbeiten
     *
     * ID der News
     *
     * @param int $id
     *
     * News konnte überarbeitet werden <TRUE> sonst <FALSE>
     *
     * @return bool
     */
    public function edit(int $id): bool
    {
        if (!empty($_POST['title']) && !empty($_POST['text'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $sql = "UPDATE news SET title = '$title', text = '$text' WHERE id = $id";

            $executeSql = Db::connection()->prepare($sql)->execute();

            return $executeSql;
        }

        return false;
    }

    /**
     * ID der News
     *
     * @param int $id
     *
     * News wurde gelöscht <TRUE> sonst <FALSE>
     *
     * @return bool
     */
    function delete(int $id): bool
    {
        $sql = "DELETE FROM news WHERE id = $id";
        $executeSql = Db::connection()->prepare($sql)->execute();
        if ($executeSql) {
            return true;
        }

        return false;
    }

    /**
     * gibt alle News-Artikel zurück
     *
     * @return array
     */
    public function getNews(): array
    {
        $sql = 'SELECT * FROM news ORDER BY position DESC';

        $executeSql = Db::connection()->query($sql);
        $result = $executeSql->fetchAll();

        return $result;
    }

    function move($id, $dir)
    {
        $con = mysqli_connect("localhost", "root", "zakhtar", "testdb");

        $sql = mysqli_query($con, "SELECT * FROM news WHERE id = $id");
        $cur = mysqli_fetch_assoc($sql);
        $cur = $cur['position'];


        $sql = mysqli_query($con, "SELECT * FROM news WHERE position > $cur ORDER BY position ASC LIMIT 1 ");
        $prev = mysqli_fetch_assoc($sql);
        $prev = $prev['position'];

        $sql = mysqli_query($con, "SELECT * FROM news WHERE position < $cur ORDER BY position DESC LIMIT 1 ");
        $next = mysqli_fetch_assoc($sql);
        $next = $next['position'];

        if ($dir == "up") {
            var_dump($cur);
            var_dump($prev);
            mysqli_query($con, "UPDATE news SET position = $prev WHERE id = $id");
            mysqli_query($con, "UPDATE news SET position = $cur WHERE position = $prev AND id != $id");
        }
        if ($dir == "down") {
            var_dump($cur);
            var_dump($next);
            mysqli_query($con, "UPDATE news SET position = $next WHERE id = $id");
            mysqli_query($con, "UPDATE news SET position = $cur WHERE position = $next AND id != $id");
        }

    }
}
