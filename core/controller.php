<?php

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
            case 'library':
                $this->load_library($name);
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

    private function load_library($name)
    {
        $libraryName = $name;
        $libraryFile = $_SERVER['DOCUMENT_ROOT'] . "/application/libraryes/" . strtolower($libraryName) . '.php';
        include $libraryFile;
        $this->$libraryName = new $libraryName;
    }

    protected function response($data, $code = 200, $json = true)
    {
        $data = $json ? json_encode($data) : $data;

        header('Content-type: application/json');
        http_response_code($code);

        return print($data);
    }

}