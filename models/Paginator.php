<?php namespace models;

use core\ModelBase;

class Paginator extends ModelBase{
    private $table, $db, $type_id, $limit = 10, $page = 1;

    public function __construct($table, $limit){
        $this->limit = $limit;
        parent::__construct($table);
        $this->table = $table;
        $this->db = $this->connection()->getConnection();
    }

    public function _set($property, $value){
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function _get($property){
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getPaginator(){
        $query = $this->db->query("SELECT * FROM {$this->table} WHERE type_id = {$this->type_id} ORDER BY id DESC LIMIT " . (($this->page - 1) * $this->limit) . ", {$this->limit}");
        $resultSet = [];

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    public function getLinks() {
        $pag = ceil($this->getTotal() / $this->limit);

        return $pag;
    }

    public function getTotal(){
        $query = $this->db->query("SELECT * FROM {$this->table} WHERE type_id = {$this->type_id}");
        return $query->num_rows;
    }
}