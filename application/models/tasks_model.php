<?php

class Tasks_model extends Model
{
    protected $table = 'tasks';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get($order, $direction, $limit, $offset)
    {
        return $this->db->select('*', $this->table, [], $order, $direction, $limit, $offset);
    }
}