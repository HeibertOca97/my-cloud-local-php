<?php namespace core;

class HelpRoute{
    private $controller;

    public function __construct(){
        if(isset($_GET["url"])){
            $url = $_GET["url"];
            $url = explode("/", $url);
            $this->controller = $url[0];
            array_shift($url);
        }
    }

    public function requestRoute($controller = null){
        if($this->controller == $controller){
            return true;
        }

        return false;
    }
    public function getRequestRoute(){
        print $this->controller;
    }
}