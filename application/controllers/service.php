<?php

class Service extends Controller
{
    public function migrate()
    {
        var_dump($this->db->migrate());
    }
}