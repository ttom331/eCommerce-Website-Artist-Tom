<?php


include "classes/dbh.classes.php";
$userid = $_SESSION["userid"];



class GetOrders extends Dbh {


    

    public function fetchOrders($userid) {
        $getOrder = $this->connect()->prepare('SELECT * FROM orders WHERE user_id = ?');
        $getOrder->execute(array($userid)); // Execute the prepared statement
        $orders = $getOrder->fetchAll(PDO::FETCH_ASSOC);
        return $orders; // Return the fetched products



        
    }

    //gets the price of the basket automatically

    
}

$getOrder = new GetOrders();
$orders = $getOrder->fetchOrders($userid);
