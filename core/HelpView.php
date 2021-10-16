<?php namespace core;

use core\HelpRoute;
class HelpView extends HelpRoute{
    private $path;

    public function assets($dir){
        $strPathUrl = URL . "public/" . $dir; 
        print $strPathUrl;
    }

    public function route($dir){
        $strPathUrl = URL . $dir; 
        print $strPathUrl;
    }

    public function url($dir){
        $strPathUrl = URL . $dir; 
        return $strPathUrl;
    }

    public function storage($dir){
        $strPathUrl = URL . $dir; 
        print $strPathUrl;
    }
    
    protected function content($dir){
        $strPathUrl = PATH . "resources/" . $dir . ".php"; 
        return $strPathUrl;
    }
    
    protected function strReplace($str){
        $strRoute =  str_replace('.', '/', $str);
        return $strRoute;
    }

    public function config($value){
        print $value;
    }

    protected function json($array){
        return json_decode(json_encode($array));
    }

    // METHOD FILE
    protected function setStorage($directory = null, $filename){
        $this->path = "public/storage/" . $directory;
        return $this->path . "/" . $filename;
    }

    protected function uploadFile($tmp_name, $route_file){
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }

        move_uploaded_file($tmp_name, $route_file);
    }

    protected function deleteFile($path){
        unlink($path);
    }
    
}