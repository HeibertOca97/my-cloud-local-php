<?php namespace controllers;

use core\Controller;

class ErrorController extends Controller{

    public function index(){
        $this->view("views.error.404");
    }
    
}