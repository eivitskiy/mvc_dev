<?php

/**
 * Created by PhpStorm.
 * User: eivitskiy
 * Date: 03.06.17
 * Time: 11:20
 */
class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function load($type, $name)
    {
        switch($type) {
            case 'model':
                $this->load_model($name);
                break;
        }
    }

    private function load_model($name)
    {
        $modelName = $name . '_model';
        $modelFile = $_SERVER['DOCUMENT_ROOT'] . "/application/models/" . strtolower($modelName) . '.php';
        include $modelFile;
        $this->$modelName = new $modelName;
    }
}