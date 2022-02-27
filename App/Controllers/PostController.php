<?php

namespace App\Controllers;

use App\Interfaces\BaseController;
use App\Routeguards\LoggedInOnly;
use App\Models\Post;
use App\Models\FormValidation;

class PostController extends BaseController {

  use LoggedInOnly;

  public function index(){
    header("location: /");
  }

  public function create(){

    $this->view->isBackend(true);

    if(isset($_POST["submit"])){

      $validation = new FormValidation($this->db, $_POST);

      $validation->setRules([
          "title" => "required|max:150",
          "content" => "required|max:999",
      ]);

      $validation->validate();

      if($validation->fails()){
          $errors = $validation->getErrors();

          $this->view->renderView("createPost",["errors"=>$errors,"input"=>$_POST]);
      } else {

        $data = [];

        $data["title"] = $_POST["title"];
        $data["content"] = $_POST["content"];

        if(isset($_FILES["post_image"])&&$_FILES["post_image"]["name"]!==""){
          
          $data["post_image"] = $_FILES["post_image"]; 

        }
    
        $post = new Post($this->db);
        $post->create($data);

        $this->view->renderView("creationSuccess");
      }  

    } else {
      $this->view->renderView("createPost");
    }

  }

  public function edit(string $id){

    $this->view->isBackend(true);

    $id = (int)$id;

    $post = new Post($this->db);

    if(isset($_POST["submit"])){

      $validation = new FormValidation($this->db, $_POST);

      $validation->setRules([
          "title" => "required|max:150",
          "content" => "required|max:999",
      ]);

      $validation->validate();

      if($validation->fails()){
          $errors = $validation->getErrors();

          $this->view->renderView("editPost",["errors"=>$errors,"input"=>$_POST]);
      } else { 
        $data = [];

        $data["title"] = $_POST["title"];
        $data["content"] = $_POST["content"];

        if(isset($_FILES["post_image"])&&$_FILES["post_image"]["name"]!==""){
          
          $data["post_image"] = $_FILES["post_image"]; 

        }

        $post->edit($id,$data);

        $this->view->renderView("creationSuccess");
      }  

    } else {

      $foundPost = $post->get($id);

      if($foundPost===null){
        header("location: /");
      } else {
        $this->view->renderView("editPost",["input"=>$foundPost]);
      }

    }
  }

  public function delete(string $id){
    $id = (int)$id;
    $post = new Post($this->db);

    if(!$post->exists($id)){
      header("location: /dashboard");
    }

    if(isset($_POST["submit"])){
      $post->delete($id);
      header("location: /dashboard");
    } else {
      $this->view->isBackend(true);
      $this->view->renderView("deletePost");
    }
    


  }
}