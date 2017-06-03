<?php

class DB
{
    public $connect;

    public function __construct()
    {
        $this->connect = mysqli_connect(
            "127.0.0.1",
            "eivitskiy",
            "eivitskiy",
            "eivitskiy_dev"
        );
    }

    public function get_users()
    {
        $query = "
            SELECT
              *
            FROM
              users;
        ";
        return $this->result(mysqli_query($this->connect, $query));
    }

    public function migrate()
    {
        $query = "
            CREATE TABLE users (
              id SERIAL,
              name VARCHAR(255) NOT NULL,
              phone VARCHAR(255) NOT NULL,
              email VARCHAR(255) NOT NULL,
              PRIMARY KEY (id)
            );
        ";
        return mysqli_query($this->connect, $query);
    }

    private function result($result)
    {
        if ( !$result ) {
            return mysqli_error();
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}