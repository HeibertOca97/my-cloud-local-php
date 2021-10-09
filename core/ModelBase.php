<?php namespace core;

use core\Connection;

class ModelBase{
    private $con, $db, $table;

    public function __construct($table){
        $this->table = $table;
        $this->con = new Connection();
        $this->db = $this->con->getConnection();
    }

    public function connection(){
        return $this->con;
    }

    public function getAll(){
        $query = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        $resultSet = [];

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }
}