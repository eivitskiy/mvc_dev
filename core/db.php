<?php

class DB {

    private $connect;

    public function __construct()
    {
        $this->connect = mysqli_connect(
            "127.0.0.1",
            "eivitskiy",
            "eivitskiy",
            "eivitskiy_dev"
        );
    }

    private function result($result)
    {
        if ( !$result ) {
            return mysqli_error($this->connect);
        } else {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = (object)$row;
            }
            return $data;
        }
    }

    public function select($fields, $table, array $where, $order = "'id'", $direction = "ASC", $limit = null, $offset = 0)
    {
        if($fields == '*') {
            $select = '*';
        } else {
            $select = implode(', ', $fields);
        }

        if(count($where) > 0) {
            $where_string = 'WHERE ' . implode(' AND ', $where);
        } else {
            $where_string = '';
        }

        if(is_numeric($limit)) {
            $limit_string = "LIMIT $limit OFFSET $offset";
        } else {
            $limit_string = '';
        }

        $query = "
          SELECT
            $select
          FROM $table
          $where_string
          ORDER BY $order $direction
          $limit_string
        ";

        return $this->result(mysqli_query($this->connect, $query));
    }

    public function insert($table, $data)
    {
        foreach($data as $k => $v) {
            $data[$k] = "'$v'";
        }
        $fields = implode(', ', array_keys($data));
        $values = implode( ', ', $data);
        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        return mysqli_query($this->connect, $query);
    }

    public function update($id, $data, $table)
    {
        $data_arr = '';
        foreach($data as $k => $v) {
            $data_arr[] = "$k = '$v'";
        }
        $data_string = implode(', ', $data_arr);
        $query = "UPDATE $table SET $data_string WHERE id = $id";
        return mysqli_query($this->connect, $query);
    }

    public function migrate()
    {
        $result = true;
        $users_query = "
            CREATE TABLE users (
              id SERIAL,
              username VARCHAR(255) NOT NULL,
              password VARCHAR(255) NOT NULL,
              PRIMARY KEY (id)
            );
        ";
        $tasks_query = "
            CREATE TABLE tasks (
              id SERIAL,
              username VARCHAR(255) NOT NULL,
              email VARCHAR(255) NOT NULL,
              text TEXT NOT NULL,
              images TEXT NOT NULL,
              status boolean NOT NULL DEFAULT FALSE,
              PRIMARY KEY (id)
            );
        ";
        if (!mysqli_query($this->connect, $users_query)) {
            $result = false;
        }
        if (!mysqli_query($this->connect, $tasks_query)) {
            $result = false;
        }
        return $result;
    }

}