<?php

class Signup extends Controller {
    public function index(){
        $data["judul"] = "Signup";

        $this->view("template/header", $data);
        $this->view("signup/index");
        $this->view("template/footer");

        function isUserExist($username){
            $conn = new db;
            $query = "SELECT * FROM user WHERE username='?'";
            $res = $conn->run($query, [$username]);
            
            return empty($res);
        }

        if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && !isUserExist($_POST["username"])){
            $conn = new db;
            $query = "INSERT INTO user (username, password, firstName, lastName, email) VALUES (?,?,?,?,?)";
            $data = [$_POST["username"], $_POST["password"], $_POST["fname"], $_POST["lname"], $_POST["email"]];
                        
            $conn->run($query, $data);
            unset($conn);
        }
    }
}