<?php


class LoginContr extends Login{

    //varible is a properties
    //functions are methods

    private $username;
    private $pwd;

    public function __construct($username, $pwd,){ //these are data grabbed from user
        $this->username = $username;
        $this->pwd = $pwd;
    }

    //error handlers

    public function loginUser(){
        if($this->emptyInput()== false){
            header("location: ../login.php?error=One of the fields is empty!");
            exit();
        }

        $this->getUser($this->username, $this->pwd);
    }


    private function emptyInput(){
        $result = false;
        if(empty($this->username) || empty($this->pwd)) {

            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

 

}