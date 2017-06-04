<?php

class View
{
    public function generate($template, array $data = [])
    {
        foreach($data as $key=>$value) {
            $$key = $value;
        }
        $content = APPPATH . "views/$template.php";
        include APPPATH . "views/layout.php";
    }
}