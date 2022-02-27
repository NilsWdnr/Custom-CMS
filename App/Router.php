<?php

namespace App;

class Router {

    private $requestedController;
    private $requestedMethod;
    private $requestedParams;

    public function __construct()
    {
        $this->parseURL($_SERVER['REQUEST_URI']);
    }
    
    private function parseURL(string $url){
        $url = rtrim($url,"/");
        $urlParts = explode("/", $url);
        
        if($url===""){
            $this->requestedController = "App\\Controllers\\HomeController";
        } else {
            $this->requestedController = "App\\Controllers\\".ucfirst($urlParts[1])."Controller";
        }

        //$this->requestedMethod = $urlParts[2] ?? "index";


        if(!isset($urlParts[2]) || !method_exists($this->requestedController,$urlParts[2])){
            $this->requestedMethod = "index";
        } else {
            $this->requestedMethod = $urlParts[2];
        }

        $this->requestedParams = $urlParts[3] ?? null;
    }

    public function getRequestedController(){
        return $this->requestedController;
    }

    public function getRequestedMethod(){
        return $this->requestedMethod;
    }

    public function getRequestedParams(){
        return $this->requestedParams;
    }

}