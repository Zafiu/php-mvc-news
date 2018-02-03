<?php

namespace Controller;


use Config\Core\Controller;
use Model\User;

class LoginController extends Controller
{
    /**
     * User bereis eingeloggt -> Weiterleitung sonst
     * Ausgabe der Form zum Einloggen
     */
    public function index()
    {
        if (empty($_SESSION)) {
            if (empty($_POST['username']) && empty($_POST['password'])) {
                return $this->render(__DIR__ . '/../views/login/index.php');
            }

            $login = $this->login($_POST['username'], $_POST['password']);
            if (!$login) {
                return $this->render(__DIR__ . '/../views/login/index.php', [
                    'error' => 'Der Benutzername oder das Passwort wurden falsch eingegeben.',
                ]);
            }
        }

        return $this->redirect('News');
    }


    /**
     * User Eingaben werden überprüft und
     * es wird eine Session initialisiert
     *
     * @return bool
     */
    protected function login(string $username, string $password): bool
    {
        $model = new User();
        $result = $model->verifyUser($_POST['username'], $_POST['password']);

        if (!empty($result)) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];

            return true;
        }

        return false;
    }

}