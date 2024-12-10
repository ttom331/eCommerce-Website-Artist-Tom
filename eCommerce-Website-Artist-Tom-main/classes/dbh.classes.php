<?php

class Dbh {
    protected function connect(){ //any class that extends to this class can use it.
        try{
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=lisaart2', $username, $password);
            return $dbh;

        }
        catch (PDOException $e){
            print "Error!: ". $e->getMessage() . "<br/>";

        }
    }
}