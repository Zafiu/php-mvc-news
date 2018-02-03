<?php

namespace Controller;

use Config\Core\Controller;
use Model\News;
use Model\User;

class NewsController extends Controller
{

    public function index()
    {
        $model = new News();
        $result = $model->getNews();

        if (!empty($_SESSION)) {
            $modelUser = new User();
            $user = $modelUser->getUserById($_SESSION['id']);

            return $this->render(__DIR__ . '/../views/news/admin/index.php', [
                'result' => $result,
                'userName' => $user['name'],
                'userSurname' => $user['surname']
            ]);
        }

        return $this->render(__DIR__ . '/../views/news/index.php', ['result' => $result,]);
    }


    public function view()
    {
        if (!empty($_GET['id'])) {
            $model = new News();
            $news = $model->getOneNews($_GET['id']);

            if ($news) {
                return $this->render(__DIR__ . '/../views/news/view.php', ['news' => $news]);
            }
        }

        return $this->pageNotfound();
    }

    public function edit()
    {
        if (!empty($_SESSION)) {
            if (!empty($_POST)) {
                $model = new News();
                $model->id = $_POST['id'];
                $model->title = $_POST['title'];
                $model->text = $_POST['text'];

                if ($model->save()) {
                    $this->redirect('News');
                }

            } else {
                $model = new News();
                $news = $model->getOneNews($_GET['id']);
                return $this->render(__DIR__ . '/../views/news/admin/edit.php', ['news' => $news]);
            }
        }

        return $this->pageNotfound();
    }


    public function create()
    {
        if (!empty($_SESSION)) {
            if (!empty($_POST)) {
                $model = new News();
                $model->title = $_POST['title'];
                $model->text = $_POST['text'];

                if ($model->save()) {
                    $this->redirect('News');
                }

            }

            return $this->render(__DIR__ . '/../views/news/admin/create.php');
        }

        return $this->pageNotfound();
    }


    public function delete()
    {
        if (!empty($_SESSION)) {

            if (!empty($_GET['id'])) {
                $model = new News();

                if ($model->delete($_GET['id'])) {
                    $this->redirect('News');
                }
            }
        }

        return $this->pageNotfound();
    }
}
