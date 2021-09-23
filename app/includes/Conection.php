<?php

class db {
    private $conn,
    $host = "localhost",
    $username = "root",
    $dbname = "newsportal",
    $password = "";
    
    public function __construct(){
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
    }

    public function __destruct(){
        $this->conn = null;
        unset($this->conn);
    }

    public function run($query, $data){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->conn = null;

        if(!empty($res)) return $res;
    }
}