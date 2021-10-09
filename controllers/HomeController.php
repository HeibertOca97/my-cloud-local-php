<?php namespace controllers;

use core\Controller;
use core\Logger;
use models\Image;

class HomeController extends Controller {

    public function index(){
        self::isGET();

        $img = new Image();
        $this->view('views.home', [
            "images" => $img->getAll(),
        ]);
    }

    public function store(){
        self::isPOST();

        try {
            $req = $this->inputFile("image");
            $new_name = date("is") . $req->name;
            $route_file = $this->setStorage("image", $new_name);
            $this->uploadFile($req->tmp_name, $route_file);

            $img = new Image();
            $img->_set('url', $route_file);
            $img->save();

            Logger::info("Imagen almacenada con exito - " . $new_name);
        } catch (\Throwable $th) {
            Logger::error("HomeController - " . $th);
        }

        $this->redirect();
    }

}