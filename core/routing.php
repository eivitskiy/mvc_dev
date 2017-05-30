<?php

/**
 * Created by PhpStorm.
 * User: eivitskiy
 * Date: 03.06.17
 * Time: 11:01
 */
class Routing
{
    static function execute()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($url[1])) {
            $controllerName = $url[1];
        } else {
            $controllerName = 'main';
        }
        if (!empty($url[2])) {
            $methodName = $url[2];
        } else {
            $methodName = 'index';
        }

        $controllerFile = APPPATH . "controllers" . strtolower($controllerName) . '.php';

        if(file_exists($controllerFile)) {
            include $controllerFile;
            $controller = new $controllerName;
        } else {
            return Routing::error(404);
        }

        if (method_exists($controller, $methodName)) {
            return $controller->$methodName();
        } else {
            return Routing::error(404);
        }
    }

    static function error($index)
    {
        include APPPATH . "controllers/error.php";
        $method = 'error_' . $index;
        return (new Error)->$method();
    }
}