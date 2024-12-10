<?php

class Signup extends Dbh{

    protected function setUser($username, $pwd, $email) {
        $stmt = $this->connect()->prepare('INSERT INTO users (username, pass, email_address) VALUES (?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($username, $hashedPwd, $email))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed1");
            exit();

        }

        $stmt = null;

    }


    protected function checkUser($username, $email) {
        $stmt = $this->connect()->prepare('SELECT username FROM users where username = ? OR email_address = ?;');

        if(!$stmt->execute(array($username, $email))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed2");
            exit();

        }

        $resultCheck = false;
        if($stmt->rowCount() >0) {
            $resultCheck = false;

        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;

    }

}


