<?php namespace core;

class Connection{
    private $driver, $host, $user, $pass, $database, $charset;
    
    public function __construct(){
        $db_cfg = include './config/database.php';
        
        $this->driver = $db_cfg['driver'];
        $this->host = $db_cfg['host'];
        $this->user = $db_cfg['user'];
        $this->pass = $db_cfg['pass'];
        $this->database = $db_cfg['database'];
        $this->charset = $db_cfg['charset'];
    }

    public function getConnection(){
        if($this->driver=='mysql' || $this->driver==null){
            $con = new \mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->set_charset($this->charset);

        }
        return $con;
    }
}