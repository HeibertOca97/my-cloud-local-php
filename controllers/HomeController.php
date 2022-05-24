<?php namespace controllers;

use core\Controller;

class HomeController extends Controller {

    public function index(){
        self::isGET();

        $this->view('views.home');
    }

}