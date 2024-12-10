<?php

if(isset($_POST["promo"]))
{
    //grabbing the data from submit
    $code = $_POST["code"];
    $customer_ID = $_POST["customer_ID"];
    


    include "../classes/dbh.classes.php";
    include "../classes/basket.classes.php";
    include "../classes/basket-contr.classes.php";

    //Running error handlers and user signup
    $promo = new PromoCodeContr($code, $customer_ID);
    $promo->addDiscount();


    //going to back to front page
    header("location: ../basket.php?error=none");


}