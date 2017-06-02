<?php

/**
 * Created by PhpStorm.
 * User: eivitskiy
 * Date: 30.05.17
 * Time: 11:37
 */
class Main extends Controller
{
    public function index()
    {
        echo '<a href="//auslogics.dev/file/file.exe">Ссылка на файл</a>';
        echo '<br />';
        exit('main/index');
    }


    public function test()
    {
        $this->load('model', 'test');
        $va = $this->test_model->index();
        $this->view->generate('test', ['va'=>$va]);
    }
}