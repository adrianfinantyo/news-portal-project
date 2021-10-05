<?php

class User_model {
    private $username, $password, $fname, $lname, $email, $level;

    public function setData($username, $password, $fname, $lname, $email, $level){
        $this->username = $username;
        $this->password = $password;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->level = $level;
    }
}