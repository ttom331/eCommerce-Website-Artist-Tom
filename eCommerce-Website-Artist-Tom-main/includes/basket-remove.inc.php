<?php


if(isset($_POST["remove_Print"]))
{
    //grabbing the data from submit
    $print_ID = $_POST["print_ID"];
    $customer_ID = $_POST["customer_ID"];



    //Signup contr class
    include "../classes/dbh.classes.php";
    include "../classes/basket.classes.php";
    include "../classes/removeBasket-contr.classes.php";

    //Running error handlers and user signup
    $basket = new RemoveBasketContr($print_ID, $customer_ID);
    $basket->removePrintFromBasket();


    //going to back to front page
    header("location: ../basket.php?error=none");


}