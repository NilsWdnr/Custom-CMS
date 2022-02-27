<?php

namespace App\Controllers;

use App\Interfaces\BaseController;
use App\Routeguards\LoggedInOnly;

class LogoutController extends BaseController {

  use LoggedInOnly;

  public function index(){

    session_unset();
    header("location: /");
  }
}