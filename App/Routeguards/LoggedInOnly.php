<?php

namespace App\Routeguards;

trait LoggedInOnly {
    public function __construct(){
        parent::__construct();

        if(!isset($_SESSION["username"])){
          header("location: /login");
        }
    }
}