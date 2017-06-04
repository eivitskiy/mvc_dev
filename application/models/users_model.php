<?php

class Users_model extends Model
{
    protected $table = 'users';

    public function getByUsername($username)
    {
        $users = $this->db->select('*', $this->table, ["username = '$username'"]);
        if(count($users) == 1) {
            return $users[0];
        } else {
            return false;
        }
    }
}