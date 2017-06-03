<?php

/**
 * Created by PhpStorm.
 * User: eivitskiy
 * Date: 03.06.17
 * Time: 11:20
 */
class View
{
    public function generate($template, $data = null)
    {
        foreach($data as $key=>$value) {
            $$key = $value;
        }
        include $_SERVER['DOCUMENT_ROOT'] . "/application/views/" . $template . '.php';
    }
}