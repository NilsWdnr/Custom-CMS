<?php

namespace App\Models;

use Exception;

class User {

  public function __construct(Database $db){
    $this->db = $db;
  }

  public function find($username){

    $userQuery = $this->db->table("users")->where("username","=",$username);

    if($userQuery->count()){
        $userData = $userQuery->first();

        foreach($userData as $field => $value){
            $this->{$field} = $value;
        }

        return true;
    } else {
        return false;
    }
}

  public function login(string $username, string $password){
    if(!$this->find($username)){
        throw new Exception("Benutzername oder Passwort waren nicht korrekt");
    } 
    
    if (!password_verify($password,$this->password)){
        throw new Exception("Benutzername oder Passwort waren nicht korrekt");
    }

    $_SESSION["username"] = $username;

}
}