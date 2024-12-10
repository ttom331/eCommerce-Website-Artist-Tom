<?php


$userid = $_SESSION["userid"];



class GetBasketOrder extends Dbh {


    

    public function fetchBasket($userid) {
        $getBasket = $this->connect()->prepare('SELECT * FROM basket WHERE user_id = ?');
        $getBasket->execute(array($userid)); // Execute the prepared statement
        $basket1 = $getBasket->fetchAll(PDO::FETCH_ASSOC);
        $this->calculateTotal($userid); //calls the calculate total function to recalculste total with quantity changes
        return $basket1; // Return the fetched products



        
    }

    //gets the price of the basket automatically

    public function calculateTotal($customer_ID):float{
        $stmt = $this->connect()->prepare('SELECT print_Price, quantity FROM basket WHERE user_id = ?');
        if(!$stmt->execute(array($customer_ID))){
            $stmt = null;
            header("location: ../basket.php?error=stmtfailed1");


        }
        $totalCost = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $totalCost += $row['print_Price']*$row['quantity'];
        }

        $_SESSION['totalCost'] = $totalCost;
        $code = "null";
        
        $stmt = null;
        return $totalCost;
    }

    
    
    
}

$getBasket = new GetBasketOrder();
$basket1 = $getBasket->fetchBasket($userid);
