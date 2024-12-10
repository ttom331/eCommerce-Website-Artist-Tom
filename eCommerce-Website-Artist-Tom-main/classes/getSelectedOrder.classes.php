<?php


include "dbh.classes.php";
$orderid = $_SESSION['orderid'];



class GetSelectedOrder extends Dbh {


    

    public function fetchOrderItems($orderid) {
        $getItems = $this->connect()->prepare('SELECT * FROM order_items WHERE order_ID = ?');
        $getItems->execute(array($orderid)); // Execute the prepared statement
        $orderItems = $getItems->fetchAll(PDO::FETCH_ASSOC);
        return $orderItems; // Return the fetched products




        
    }

    //gets the price of the basket automatically

    
}

$getItems = new GetSelectedOrder();
$orderItems = $getItems->fetchOrderItems($orderid);

