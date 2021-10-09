<?php namespace models;

use core\ModelBase;

class Image extends ModelBase{
    private $table = "images";
    private $db, $url;

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
        $sql = "INSERT INTO images(url) VALUES('{$this->url}')";
        $this->db->query($sql);
    }
}