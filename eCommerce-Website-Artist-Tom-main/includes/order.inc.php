<?php

   include "../classes/dbh.classes.php";
   include "../classes/order.classes.php";
   include "../classes/order-contr.classes.php";

    if ($_SESSION['payment_status'] == 'success'){;
        $customer_ID = "123";
        $address1 = "123";
        $address2 = "123";
        $town = "123";
        $postcode = "123";
        $orderTotal = "123";
        $orderStatus = "hello";
        $orderDate = date('Y-m-d H:i:s');


        $order = new OrderContr($customer_ID, $address1, $address2, $town, $postcode, $orderTotal, $orderStatus, $orderDate); //create object from the logincontr class

        //Running error handlers and user signup

        $order->addToOrder();

        header("Location:success.php"); // Redirect to a confirmation page
        exit;

    }