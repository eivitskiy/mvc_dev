<?php

require_once 'db.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }
}