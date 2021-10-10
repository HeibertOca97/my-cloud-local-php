<?php namespace controllers;

use core\Controller;

class DocumentController extends Controller {

    public function index(){
        self::isGET();

        $this->view('views.document');
    }

}