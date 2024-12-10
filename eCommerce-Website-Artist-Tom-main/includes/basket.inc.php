<?php

if(isset($_POST["submit"]))
{
    //grabbing the data from submit
    $customer_ID = $_POST["customer_ID"];
    $print_ID = $_POST["print_ID"];
    $print_Name = $_POST["print_Name"];
    $print_Img = $_POST["print_Img"];
    $print_Price = $_POST["print_Price"];
    $print_Quantity = $_POST['print_Quantity'];


    //Instantiate Signup contr class
    include "../classes/dbh.classes.php";
    include "../classes/basket.classes.php";
    include "../classes/basket-contr.classes.php";
    $basket = new BasketContr($customer_ID, $print_ID, $print_Name, $print_Img, $print_Price, $print_Quantity); //create object from the signupcontr class

    //Running error handlers and user signup

    $basket->addPrintToBasket();
    


    //going to back to front page
    header("location: ../basket.php?error=none");


}