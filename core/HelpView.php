<?php namespace core;


class HelpView{
    private $path;
    public function assets($dir){
        $strPathUrl = URL . "resources/" . $dir; 
        print $strPathUrl;
    }

    public function route($dir){
        $strPathUrl = URL . $dir; 
        print $strPathUrl;
    }

    public function storage($dir){
        $strPathUrl = URL . $dir; 
        print $strPathUrl;
    }
    
    public function content($dir){
        $strPathUrl = PATH . "resources/" . $dir . ".php"; 
        require $strPathUrl;
    }
    
    public function strReplace($str){
        $strRoute =  str_replace('.', '/', $str);
        return $strRoute;
    }

    public function config($value){
        print $value;
    }

    public function json($array){
        return json_decode(json_encode($array));
    }

    // METHOD FILE
    public function setStorage($directory = null, $filename){
        $this->path = "resources/storage/" . $directory;
        return $this->path . "/" . $filename;
    }

    public function uploadFile($tmp_name, $route_file){
        if (!file_exists($this->path)) {
            mkdir($this->path, 0777, true);
        }

        move_uploaded_file($tmp_name, $route_file);
    }

    
}