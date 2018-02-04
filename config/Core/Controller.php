<?php

namespace Config\Core;

/**
 * Controller Basis Klasse, welche alle wichtigen
 * Funktionalitäten beinhaltet
 *
 * Class Controller
 * @package Config\Core
 */
abstract class Controller
{

    public function actionPageNotFound()
    {
        return $this->render(PAGE_NOT_FOUND);
    }

    /**
     * @param string $view Datei einrendern
     * @param array $params Parameter für die View
     *
     * @return bool
     */
    protected function render(string $view, array $params = [])
    {
        if (file_exists($view)) {

            extract($params, EXTR_OVERWRITE);
            require_once($view);

            return;
        }

        return false;
    }

    /**
     * leitet zum gewünschtem Controller weiter
     *
     * @param string $location
     */
    protected function redirect(string $location)
    {
        return header('Location: /php-mvc-news/web/?r=' . $location);
    }

}