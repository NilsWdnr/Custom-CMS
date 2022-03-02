<?php

namespace App\Controllers;

use Exception;
use App\Interfaces\BaseController;
use App\Routeguards\GuestsOnly;
use App\Models\User;


class LoginController extends BaseController {

  use GuestsOnly;

  public function index(){

  $this->view->isBackend(true);
  $this->view->setTitle("Login");

    if(isset($_POST["submit"])){
      $user = new User($this->db);
      try {
        $user->login($_POST["username"], $_POST["password"]);
        header("location: /dashboard");
      } catch (Exception $exception){
        $loginError = $exception->getMessage();
        $this->view->renderView("login",["loginError"=>$loginError]);
      }

    }
    $this->view->renderView("login");
  }

}