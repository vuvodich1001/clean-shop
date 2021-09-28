<?php

class BaseModel extends Database {
    protected $connect;

    public function __construct() {
        $this->connect = $this->connect();
    }

    public function all($table, $select, $orderBy, $limit) {
        $field = implode(',', $select);
        $orderField = 'order by ';
        $orderBy ? $orderField .= implode(' ', $orderBy) : $orderField = '';

        $sql = "select $field from $table $orderField limit $limit";

        $result = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function find($table, $id) {
        $sql = "select * from $table where ${table}_id = $id limit 1";
        $result = $this->query($sql);
        return mysqli_fetch_assoc($result);
    }


    public function create($table, $data) {
        $columns = implode(',', array_keys($data));
        $values = array_map(function ($value) {
            return is_numeric($value) ? $value : "'$value'";
        }, $data);
        $dataSets = implode(',', $values);
        $sql = "insert into $table($columns) values($dataSets)";
        $this->query($sql);
    }

    public function update($table, $id, $data) {
        $dataSets = [];
        foreach ($data as $key => $value) {
            is_numeric($value) ? $dataSets[] = "$key = $value" : $dataSets[] = "$key = '$value'";
        }

        $dataSets = implode(',', $dataSets);
        $sql = "update $table set $dataSets where ${table}_id = $id";
        $this->query($sql);
    }

    public function destroy($table, $id) {
        $sql = "delete from $table where ${table}_id = $id";
        $this->query($sql);
    }

    protected function query($sql) {
        return mysqli_query($this->connect, $sql);
    }
}