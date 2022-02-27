<?php

namespace App\Interfaces;

use App\View;
use App\Models\Database;

abstract class BaseController {
  public function __construct(){
    $this->view = new View();
    $this->db = new Database();
  }
}