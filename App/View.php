<?php

namespace App;

use App\config;

class View {

    private $isBackend;
    private $title;

    public function __construct(){

        $this->isBackend = false;
        $this->title = null;
        
    }

    public function isBackend(bool $value){
        $this->isBackend = $value;
    }

    public function setTitle(string $title){

        $this->title = $title;

    }

    public function renderView($page, $params = []){

        $root = config::get("root");
        $main_title = config::get("page_title");

        if(!is_null($this->title)){
            $title = $this->title . " - " . $main_title;
        } else {
            $title = $main_title;
        }

        extract($params);

        require_once("App/Views/Templates/headView.php");

        if($this->isBackend){
            require_once("App/Views/Templates/backendHeaderView.php");
        }

        require_once("App/Views/{$page}View.php");
        require_once("App/Views/Templates/footerView.php");
    }
}