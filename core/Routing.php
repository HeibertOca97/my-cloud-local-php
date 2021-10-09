<?php namespace core;

class Routing{

    private $url, $controller, $action, $params;

    public function __construct(){
        $this->run();
    }

    public function run(){
        if(isset($_GET['url'])){
            $this->url = $_GET['url'];
        }

        if(!empty($this->url)){
            $this->url = explode("/", $this->url);
            
            $this->controller = $this->url[0];
            array_shift($this->url);
            
            if(isset($this->url[0]) && !empty($this->url[0])){
                $this->action = $this->url[0];
                array_shift($this->url);
            }else{
                $this->action = ACTION_DEFAULT;
            }

            if(count($this->url) > 0){
                $this->params = $this->url;
            }

        }else{
            $this->controller = CONTROLLER_DEFAULT;
            $this->action = ACTION_DEFAULT;
        }

        $controllerObj = $this->launchController($this->controller); 
        $this->launchAction($controllerObj);

    }

    public function launchController($controller){
        $controller = ucwords($controller) . "Controller";
        $strFileController = "./controllers/" . $controller . ".php";
        
        if(!file_exists($strFileController)){
            $strFileController = "./controllers/" . CONTROLLER_DEFAULT . "Controller.php";
        }

        $controllerObj = null;
        try {
            require_once $strFileController;
            $controller = "controllers\\".$controller;
            $controllerObj = new $controller;

        } catch (\Throwable $th) {
            $controller = "ErrorController";
            $strFileController = "./controllers/" . $controller . ".php";
            require_once $strFileController;
            $controller = "controllers\\".$controller;
            $controllerObj = new $controller;

        }finally{
            return $controllerObj;
        }
        
    }

    public function loadView($controllerObj, $action){
        $accion = $action;
        $controllerObj->$accion();
    }

    public function launchAction($controllerObj){
        if(isset($this->action) && method_exists($controllerObj, $this->action)){
            $this->loadView($controllerObj, $this->action);
        }else{
            $this->loadView($controllerObj, ACTION_DEFAULT);
        }
    }

    public function validatedParams($controllerObj, $paramObj){
        if(isset($paramObj)){
            call_user_func_array(array($controllerObj, $this->action), $paramObj);
        }else{
           call_user_func(array($controllerObj, $this->action));
        }
    }
    
}