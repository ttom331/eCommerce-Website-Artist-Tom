<?php

if(isset($_POST["submit"]))
{
    //grabbing the data from submit
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($username, $pwd); //create object from the logincontr class

    //Running error handlers and user signup

    $login->loginUser();


    //going to back to front page
    header("location: ../index.php?error=none");


}