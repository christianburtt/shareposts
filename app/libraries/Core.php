<?php
/**
 * Main App Core Class
 * Creates URL and loads core controller
 * URL FORMAT /controller/method/params
 */
class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $currentParams = [];

    public function __construct(){
        // print_r($this->_getURL());
        $url = $this->_getURL();
        //look in controllers for first value
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        //require controller
        require_once('../app/controllers/'.$this->currentController.'.php');

        //launch it
        $this->currentController = new $this->currentController;

        //check for second part of url method
        if(isset($url[1])){
            //check to see if the method exists
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        // echo $this->currentMethod;
        //get params
        $this->currentParams = $url ? array_values($url):[];

        call_user_func_array([$this->currentController,$this->currentMethod], $this->currentParams);
    }

    public function _getURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }else{
            return null;
        }
    }
}