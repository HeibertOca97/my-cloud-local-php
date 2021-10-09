<?php namespace core;

use core\Request;

class Controller extends Request{
    private $data;

    public function __construct(){
        $this->data = [];
    }

    public function template($view){
        $view = $this->strReplace($view);
        foreach ($this->data as $id_data => $value) {
            ${$id_data} = $value;
        }

        include PATH.'resources/' . $view . '.php';
    }

    public function view($view, $data = []){
        $view = $this->strReplace($view);
        $this->data = $data;
        foreach ($data as $id_data => $value) {
            ${$id_data} = $value;
        }

        require_once './resources/' . $view . '.php';
    }

    public function redirect($url = null){
        header("Location: " . URL . $url);
    }
}