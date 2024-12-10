<?php

class Login extends Dbh{

    protected function getUser($username, $pwd) {
        $stmt = $this->connect()->prepare('SELECT pass FROM users WHERE username = ? OR email_address = ?;');

        if(!$stmt->execute(array($username, $username))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed1");
            exit();

        }

        if ($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../login.php?error=Username does not exist!");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["pass"]);

        if ($checkPwd == false){
            $stmt = null;
            header("location: ../login.php?error=Incorrect password entered!");
            exit();

        }elseif ($checkPwd == true){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ? OR email_address = ? AND pass = ?;');

            if(!$stmt->execute(array($username, $username, $pwdHashed['pass'],))){
                $stmt = null;
                header("location: ../login.php?error=stmtfailed1");
                exit();
    
            }

            if ($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../login.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['userid'] = $user[0]["user_id"];
            $_SESSION['user_username'] = $user[0]["username"];
            $_SESSION['user_email'] = $user[0]["email_address"];


        }

        $stmt = null;

    }

}



?>