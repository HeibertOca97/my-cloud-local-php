<?php namespace config;

class Autoload{
    public static function run(){
        spl_autoload_register(function($class){
        $ruta = "./".str_replace("\\", "/", $class) . ".php";
            if(file_exists($ruta)){
                require_once $ruta;
            }
        });
    }
}