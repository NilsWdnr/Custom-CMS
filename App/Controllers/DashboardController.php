<?php

namespace App\Controllers;

use App\Interfaces\BaseController;
use App\Routeguards\LoggedInOnly;
use App\Models\Post;

class DashboardController extends BaseController {

  use LoggedInOnly;

  public function index(){

    $post = new Post($this->db);
    $foundPosts = $post->getAll();

    $this->view->isBackend(true);
    $this->view->renderView("dashboard",["posts"=>$foundPosts]);
  }
}