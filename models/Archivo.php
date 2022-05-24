<?php namespace models;

use core\ModelBase;

class Archivo extends ModelBase{
    private $table = "Archivos";
    private $db, $url, $id, $type_id;

    public function __construct(){
        parent::__construct($this->table);
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

    public function save(){
        $sql = "INSERT INTO {$this->table}(url, type_id) VALUES('{$this->url}', {$this->type_id})";
        $this->db->query($sql);
    }

    public function getAll(){
        $query = $this->db->query("SELECT * FROM {$this->table} WHERE type_id = {$this->type_id} ORDER BY id DESC");
        $resultSet = [];

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    
}