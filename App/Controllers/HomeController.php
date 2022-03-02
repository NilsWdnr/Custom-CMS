<?php

namespace App\Controllers;

use App\Interfaces\BaseController;
use App\Models\Post;

class HomeController extends BaseController {

  public function index(){

    $post = new Post($this->db);
    $foundPosts = $post->getAll();

    $this->view->isBackend(false);
    $this->view->renderView("home",["posts"=>$foundPosts]);
  }
}