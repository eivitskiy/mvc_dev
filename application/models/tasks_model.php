<?php

class Tasks_model extends Model
{
    private $table = 'tasks';

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }
}