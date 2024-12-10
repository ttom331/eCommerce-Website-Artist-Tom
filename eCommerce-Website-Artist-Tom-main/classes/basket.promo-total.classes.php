<?php

class DiscountTotal extends Dbh{

    protected function calculateTotal($customer_ID):float{
        $newtotalCost = 0;
        $stmt = $this->connect()->prepare('SELECT print_Price, quantity FROM basket WHERE user_id = ?');
        if(!$stmt->execute(array($customer_ID))){
            $stmt = null;
            header("location: ../basket.php?error=stmtfailed1");


        }
        $totalCost = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $totalCost += $row['print_Price']*$row['quantity'];
        }

        // Check for discount
        if (isset($_SESSION['discount']) && is_numeric($_SESSION['discount']) &&($_SESSION['discount'] > 0)) {
            $discountAmount = $totalCost / 100 * $_SESSION['discount'];
            $newtotalCost = $totalCost - $discountAmount;
            $_SESSION['totalCost2'] = number_format($newtotalCost);

        }
        else{
            $_SESSION['totalCost2'] = $totalCost;

        }
        $_SESSION['totalCost'] = $totalCost;
        $_SESSION['totalCost2'] = $totalCost;
        
        $stmt = null;
        return $newtotalCost;
    }

    protected function discountCheck($code, $customer_ID){
        session_start();
        $discount = 0;
        $stmt = $this->connect()->prepare('SELECT promo_amount FROM promo WHERE promo_Code = ?');
        if(!$stmt->execute(array($code))){
            $stmt = null;
            header("location: ../basket.php?error=stmtfailed1");
            exit();


        }

        $discount = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($discount) {
            $_SESSION['discount'] = $discount['promo_amount'];
        } else {
            // Handle invalid discount code case
            $_SESSION['discount'] = 0;
        }
        
        $this->calculateTotal($customer_ID); //calls the calculate total function to recalculste total with quantity changes

    }
}