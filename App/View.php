<?php

namespace App;

use App\config;

class View {

    private $isBackend;

    public function __construct(){

        $this->isBackend = false;
        
    }

    public function isBackend(bool $value){
        $this->isBackend = $value;
    }

    public function renderView($page, $params = []){

        $root = config::get("root");

        extract($params);

        require_once("App/Views/Templates/headView.php");

        if($this->isBackend){
            require_once("App/Views/Templates/backendHeaderView.php");
        }

        require_once("App/Views/{$page}View.php");
        require_once("App/Views/Templates/footerView.php");
    }
}