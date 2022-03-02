<?php

namespace App\Models;


class Post {

  public function __construct(Database $db){
    $this->db = new $db;
  }

  public function create($postData){

    $data = [];

    if(isset($postData["post_image"])){

      $tmp_name = $_FILES["post_image"]["tmp_name"];
      $image_name = $_FILES["post_image"]["name"];
    

      $targetDir = "app/include/uploaded_images/".$image_name;

      move_uploaded_file($tmp_name,$targetDir);

      $imageData = [
        "title" => $postData["title"],
        "image_directory" => $targetDir
      ];

      $this->db->table("images");
      $this->db->store($imageData);
      $imgID = $this->db->getLastPrimary();
    }

    $data = [
      "post_image" => $imgID ?? null,
      "title" => $postData["title"],
      "content" => $postData["content"]
    ];

    $this->db->table("posts");
    $this->db->store($data);
    
  }

  public function get(int $id){
    $this->db->table("posts");
    $getQuery =  $this->db->where("id","=",$id);
    $post = $getQuery->first();

    if(!is_null($post["post_image"])){
      $this->db->table("images");
      $getQuery =  $this->db->where("id","=",$post["post_image"]);
      $post["post_image"] = $getQuery->first();
    }

    return $post;
  
  }

  public function getAll(){
    $this->db->table("posts");
    $foundPosts = $this->db->getAll("created","DESC");

    $postsReturn = [];

    foreach($foundPosts as $post){
      if(!is_null($post["post_image"])){
        $this->db->table("images");
        $getQuery =  $this->db->where("id","=",$post["post_image"]);
        $post["post_image"] = $getQuery->first()["image_directory"];
      }

      array_push($postsReturn, $post);
    }

    return $postsReturn;
  
  }

  public function exists(int $id){
    if($this->get($id)===null){
      return false;
    } else {
      return true;
    }
  }

  public function edit(int $id,array $postData){

    $data = [];

    if(isset($postData["post_image"])){

      $tmp_name = $_FILES["post_image"]["tmp_name"];
      $image_name = $_FILES["post_image"]["name"];
    

      $targetDir = "app/include/uploaded_images/".$image_name;

      move_uploaded_file($tmp_name,$targetDir);

      $imageData = [
        "title" => $postData["title"],
        "image_directory" => $targetDir
      ];

      $this->db->table("images");
      $this->db->store($imageData);
      $imgID = $this->db->getLastPrimary();
    }

    $data = [
      "post_image" => $imgID ?? null,
      "title" => $postData["title"],
      "content" => $postData["content"]
    ];


    $this->db->table("posts");

    foreach($data as $column => $value){
      $this->db->update($column,$value,"id",$id);
    }

  }

  public function delete(int $id){

    $this->db->table("posts");

    $getQuery = $this->db->where("id","=",$id);
    $foundPost = $getQuery->first();
    $post_image = $foundPost["post_image"];

    $this->db->delete_where("id","=",$id);

    if(!is_null($post_image)){
      $this->db->table("images");
      
      $getQuery = $this->db->where("id","=",$post_image);
      $foundImage = $getQuery->first();
      $directory = $foundImage["image_directory"];
  
      unlink($directory);

      $this->db->delete_where("id","=",$post_image);

    }



    /*
    $this->db->table("images");
    $this->db->delete_where
    */
  }

}