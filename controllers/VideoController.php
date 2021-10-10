<?php namespace controllers;

use core\Controller;

class VideoController extends Controller {

    public function index(){
        self::isGET();

        $this->view('views.video');
    }

}