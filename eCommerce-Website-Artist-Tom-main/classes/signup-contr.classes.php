<?php


class SignupContr extends SignUp{

    //varible is a properties
    //functions are methods

    private $username;
    private $pwd;
    private $pwdrepeat;
    private $email;  //chang ethis to watever

    public function __construct($username, $pwd, $pwdrepeat, $email){ //these are data grabbed from user
        $this->username = $username;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
    }

    //error handlers

    public function signupUser(){
        if($this->emptyInput()== false){
            header("location: ../register.php?error=One of the fields has been left empty!");
            exit();
        }
        if($this->invalidUsername()== false){
            header("location: ../register.php?error=Username contains invalid characters");
            exit();
        }
        if($this->invalidEmail()== false){
            header("location: ../register.php?error=Email address is invalid!");
            exit();
        }
        if($this->pwdMatch()== false){

            //password dont match
            header("location: ../register.php?error=The passwords entered do not match!");
            exit();
        }
        if($this->uidTakenCheck()== false){
            //username or email taken
            header("location: ../register.php?error=Username or email address has already been taken");
            exit();
        }
        if($this->isPwdLengthValid()== false){
            //username or email taken
            header("location: ../register.php?error=Password length is too short, it must be a minimum of 8 characters!");
            exit();
        }

        $this->setUser($this->username, $this->pwd, $this->email);
    }


    private function emptyInput(){
        $result = false;
        if(empty($this->username) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)) {

            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidUsername(){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function pwdMatch(){
        $result = false;
        if ($this->pwd !== $this->pwdrepeat){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        $result = false;
        if (!$this->checkUser($this->username, $this->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    private function isPwdLengthValid() {
        $minLength = 8;
        if (strlen($this->pwd) < $minLength) {
            return false; // Password is too short
        }
        return true; // Password is long enough
    }
    

}