<?php

if(isset($_POST["submit"]))
{
    //grabbing the data from submit
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($username, $pwd, $pwdrepeat, $email); //create object from the signupcontr class

    //Running error handlers and user signup

    $signup->signupUser();


    //going to back to front page
    header("location: ../registerSuccess.php?error=none");


}