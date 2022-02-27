<?php

namespace App\Models;

use App\Config;
use PDO;
use Exception;

class Database {
    public $pdo;
    private $table;
    private $statement;

    public function __construct(){
        try {
            $this->pdo = new PDO(
                "mysql:host=" . Config::get("database>host") . ";dbname=" . Config::get("database>name"), Config::get("database>username"), Config::get("database>password")
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exception){
            die($exception->getMessage());
        }
    }

    public function table(string $table){
        $this->table = $table;

        return $this;
    }

    public function query(string $sql, array $values = []){
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($values);

        return $this;
    }

    public function getAll(string $orderKey = null, string $orderDirection = null){

        if(is_null($orderKey)||is_null($orderDirection)){
            $this->query("SELECT * FROM {$this->table}");
        } else {
            $this->query("SELECT * FROM {$this->table} ORDER BY {$orderKey} {$orderDirection}");
        }    

        return $this->results();
    }

    public function where(string $field, string $operator, $value, string $orderKey = null, string $orderDirection = null){

        if(is_null($orderKey)||is_null($orderDirection)){
            $this->query("SELECT * FROM {$this->table} WHERE {$field} {$operator} ?", [$value]);
        } else {
            $this->query("SELECT * FROM {$this->table} WHERE {$field} {$operator} ? ORDER BY {$orderKey} ${$orderDirection}", [$value]);
        }


        return $this;
    }

    public function store(array $data){
        $columns = implode(",", array_keys($data));
        $placeholders = rtrim(str_repeat("?,", count($data)),",");
        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, $values); 
    }

    public function count()
    {
        return $this->statement->rowCount();
    } 
    
    public function results(){
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function first(){
        return $this->results()[0] ?? null;
    }

    public function update(string $targetField, string $value, string $identifierField, string $identifier){
        $values = [$value, $identifier];
        $sql = "UPDATE {$this->table} SET $targetField = ? WHERE $identifierField = ?";
        $this->query($sql,$values);
        
    }

    public function getLastPrimary(){
        return $this->pdo->lastInsertId();
    }

    public function delete_where(string $field, string $operator, $value){
        $this->query("DELETE FROM {$this->table} WHERE {$field} {$operator} ?", [$value]);

        return $this;
    }
}