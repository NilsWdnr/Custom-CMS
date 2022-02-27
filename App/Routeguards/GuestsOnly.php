<?php

namespace App\Routeguards;

trait GuestsOnly {
    public function __construct(){
        parent::__construct();

        if(isset($_SESSION["username"])){
          header("location: /dashboard");
        }
    }
}