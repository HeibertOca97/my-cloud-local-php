<?php namespace core;

class Logger{
    public static function error($message){
        error_log("Error: ". $message, 0);
    }
    
    public static function info($message){
        error_log("Info: ". $message, 0);
    } 
}