<?php

if(isset($_POST["edit_Quantity"]))
{
    //grabbing the data from submit
    $print_ID = $_POST["basket_ID"];
    $quantity = $_POST["quantity"];
    $customer_ID = $_POST["customer_ID"];
    



    //Instantiate Signup contr class
    include "../classes/dbh.classes.php";
    include "../classes/basket.classes.php";
    include "../classes/editBasket-contr.classes.php";

    //Running error handlers and user signup
    $basket = new EditBasketContr($print_ID, $quantity, $customer_ID);
    $basket->editPrintFromBasket();


    //going to back to front page
    header("location: ../basket.php?error=none");


}