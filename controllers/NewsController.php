<?php

namespace Controller;

use Config\Core\Controller;
use Model\News;
use Model\User;

class NewsController extends Controller
{


    public function actionIndex()
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


    public function actionView($id)
    {
        $model = new News();
        $news = $model->getOneNews($id);

        if ($news) {
            return $this->render(__DIR__ . '/../views/news/view.php', ['news' => $news]);
        }

        return $this->actionPageNotFound();
    }


    public function actionEdit($id = null)
    {
        if (!empty($_SESSION)) {
            if (!empty($_POST)) {
                $model = new News();
                $model->id = $_POST['id'];
                $model->title = $_POST['title'];
                $model->text = $_POST['text'];
                $model->fk_userId = $_POST['userId'];


                if ($model->save()) {
                    $this->redirect('news');
                }

            } elseif ($id) {
                $model = new News();
                $news = $model->getOneNews($id);
                return $this->render(__DIR__ . '/../views/news/admin/edit.php', ['news' => $news]);
            }
        }

        return $this->actionPageNotFound();
    }


    public function actionCreate()
    {
        if (!empty($_SESSION)) {
            if (!empty($_POST)) {
                $model = new News();
                $model->title = $_POST['title'];
                $model->text = $_POST['text'];
                $model->fk_userId = $_POST['userId'];

                if ($model->save()) {
                    $this->redirect('news');
                }
            }

            return $this->render(__DIR__ . '/../views/news/admin/create.php', ['userId' => $_SESSION['id']]);
        }

        return $this->actionPageNotFound();
    }


    public function actionDelete($id)
    {
        if (!empty($_SESSION)) {
            $model = new News();

            if ($model->delete($id)) {
                $this->redirect('news');
            }
        }

        return $this->actionPageNotFound();
    }
}
