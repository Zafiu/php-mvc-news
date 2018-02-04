<?php

namespace Config\Core;


class Router
{
    /**
     * @var string Default Controller
     */
    private $_controller;
    /**
     * @var string Default Action bzw. Methode des Controllers
     */
    private $_action;

    /**
     * URL wird eingelesen und überprüft, wenn sie
     * nicht gültig ist wird Page 404 ausgegeben
     * @param $config array
     */
    public function __construct(array $config)
    {
        $this->_controller = $config['defaultController'];
        $this->_action = $config['defaultAction'];
        define('PAGE_NOT_FOUND', $config['pageNotFound']);

        if (!empty($_GET['r'])) {
            $route = explode('/', $_GET['r']);

            if (!$this->verifyClassAndAction($route)) {
                $this->_action = 'actionPageNotFound';
            }
        }
    }

    /**
     * Controller mit der jeweiligen Action initialisieren
     */
    public function run()
    {
        $controller = new $this->_controller;
        call_user_func_array([$controller, $this->_action], $this->getRequiredParams());
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
        $controller = '\Controller\\' . ucfirst($route[0]) . 'Controller';
        $action = !empty($route[1]) ? 'action' . ucfirst($route[1]) : false;

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

    /**
     * gibt alle _GET Werte außer 'r' zurück,
     * welche als Parameter für functions eingesetzt
     * werden können
     *
     * @return array params für die Action
     */
    protected function getRequiredParams()
    {
        $params = [];

        foreach ($_GET as $key => $value) {
            if ($key === 'r') {
                continue;
            }

            $params[$key] = $value;
        }

        return $params;
    }
}