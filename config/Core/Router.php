<?php

namespace Config\Core;


class Router
{
    /**
     * 404 Action
     */
    const PAGE_NOT_FOUND = 'pageNotFound';

    /**
     * @var string Controller Klasse
     */
    private $_controller = '\Controller\NewsController';
    /**
     * @var string Action bzw. Methode des Controllers
     */
    private $_action = 'index';

    /**
     * URL wird eingelesen und überprüft, wenn sie
     * nicht gültig ist wird Page 404 ausgegeben
     */
    public function __construct()
    {

        if (!empty($_GET['r'])) {
            $route = explode('/', $_GET['r']);

            if (!$this->verifyClassAndAction($route)) {
                $this->_action = self::PAGE_NOT_FOUND;
            }
        }
    }

    /**
     * Controller mit der jeweiligen Action initialisieren
     */
    public function run()
    {
        $controller = new $this->_controller;
        $controller->{$this->_action}();
    }

    /**
     * @param array $route URL
     *
     * @return bool <true> Controller existiert
     *              Action kann übergeben werden, sonst default -> index()
     *              <false> Controller oder Action existieren nicht
     */
    protected function verifyClassAndAction(array $route): bool
    {
        $controller = '\Controller\\' . $route[0] . 'Controller';
        $action = !empty($route[1]) ? $route[1] : false;

        if (!class_exists($controller)) {
            return false;
        }
        $this->_controller = $controller;

        if (!$action) {
            return true;
        }

        if (!method_exists($controller, $action)) {
            return false;
        }

        $this->_action = $action;

        return true;
    }
}