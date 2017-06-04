<?php

require_once 'db.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAll()
    {
        return $this->db->select('*', $this->table, []);
    }

    public function update($id, $data)
    {
        return $this->db->update($id, $data, $this->table);
    }
}