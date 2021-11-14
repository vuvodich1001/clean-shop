<?php

class BaseModel extends Database {
    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function all($table, $select, $orderBy, $limit) {
        $field = implode(',', $select);
        $orderField = 'order by ';
        $orderBy ? $orderField .= implode(', ', $orderBy) : $orderField = '';

        $sql = "select $field from $table $orderField limit $limit";
        $result = $this->db->query($sql);
        $data = [];
        while ($row = $result->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    public function find($table, $id) {
        $sql = "select * from $table where ${table}_id = :id limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    public function create($table, $data) {
        $columns = implode(',', array_keys($data));
        $placeHolders = implode(',', array_map(function ($value) {
            return ':' . $value;
        }, array_keys($data)));
        $sql = "insert into $table($columns) values($placeHolders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function update($table, $id, $data) {
        $placeHolders = implode(',', array_map(function ($value) {
            return $value . '=:' . $value;
        }, array_keys($data)));
        $data["${table}_id"] = $id;
        $sql = "update $table set $placeHolders where ${table}_id = :${table}_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function destroy($table, $id) {
        $sql = "delete from $table where ${table}_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
