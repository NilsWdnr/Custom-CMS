<?php

namespace App\Controllers;

use App\Interfaces\BaseController;

class HomeController extends BaseController {

  public function index(){
    $this->view->isBackend(false);
    $this->view->renderView("home");
  }
}