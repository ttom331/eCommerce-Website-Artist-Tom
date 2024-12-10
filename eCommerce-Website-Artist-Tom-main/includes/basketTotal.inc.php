<?php


include_once("classes/dbh.classes.php");
$customer_ID = $_SESSION["userid"];


class GetTotal extends Dbh {

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
    
        $stmt = null;
        return $totalCost;
    }
    
}

$stmt = new GetTotal();
$totalCost = $stmt->calculateTotal($customer_ID);




