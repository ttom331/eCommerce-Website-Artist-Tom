<?php




class Basket extends Dbh{
    protected function addPrint($customer_ID, $print_ID, $print_Name, $print_Img, $print_Price, $print_Quantity) {
        $stmt = $this->connect()->prepare('INSERT INTO basket (user_id, print_ID, print_Name, print_Price, print_Image, quantity) VALUES (?, ?, ?, ?, ?, ?);');


        if(!$stmt->execute(array($customer_ID, $print_ID, $print_Name, $print_Price, $print_Img, $print_Quantity))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed1");
            exit();

        }

        $this->discountCheck(null, $customer_ID);

        $this->calculateTotal($customer_ID); //calls the calculate total function to recalculste total with quantity changes
    }


    protected function removePrint($print_ID, $customer_ID) {
        $stmt = $this->connect()->prepare('DELETE FROM basket WHERE basket_ID = ?');


        if(!$stmt->execute(array($print_ID))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed1");
            exit();

        }
        $this->discountCheck(null, $customer_ID);
        $stmt = null;
        $this->calculateTotal($customer_ID); //calls the calculate total function to recalculste total with quantity changes

        

    }

    protected function editPrint($print_ID, $quantity, $customer_ID) {

        //if the quantity is set to 0 or less it will remove from the basket.
        if ($quantity <= 0)
            {
                $stmt = $this->connect()->prepare('DELETE FROM basket WHERE basket_ID = ?');
                if(!$stmt->execute(array($print_ID))){
                    $stmt = null;
                    header("location: ../index.php?error=delete");
                    exit();
        
                }
        
                $stmt = null;
            }
        
        $stmt = $this->connect()->prepare('UPDATE basket SET quantity = ? WHERE basket_ID = ?');
        
        


        if(!$stmt->execute(array($quantity, $print_ID))){
            $stmt = null;
            header("location: ../basket.php?error=stmtfailed1");
            $this->calculateTotal($customer_ID); //calls the calculate total function to recalculste total with quantity changes
            exit();

        }
        $stmt = null;
        $this->discountCheck(null, $customer_ID);
        $this->calculateTotal($customer_ID); //calls the calculate total function to recalculste total with quantity changes


    }

    protected function calculateTotal($customer_ID):float{
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
        $this->discountCheck($code, $customer_ID); //calls the calculate total function to recalculste total with quantity changes

        
        $stmt = null;
        return $totalCost;
    }

    protected function discountCheck($code, $customer_ID){
        session_start();
        $printDiscount2 = null;
        $stmt = $this->connect()->prepare('SELECT promo_amount FROM promo WHERE promo_Code = ?');
        if(!$stmt->execute(array($code))){
            $_SESSION['discount'] = 0;
            $stmt = null;
            header("location: ../basket.php?error=stmtfailed1");


        }

        $discount = $stmt->fetch(PDO::FETCH_ASSOC);



            
        

        if ($discount) {
            $_SESSION['discount'] = $discount['promo_amount'];
        } else {
            // Handle invalid discount code case
            $_SESSION['discount'] = 0;
        }
        // Check for discount

        $discount = $_SESSION['discount'];
        $originalCost = $_SESSION['totalCost'];


        if ($discount > 0) {
            $discountAmount = $originalCost / 100 * $_SESSION['discount'];
            $newtotalCost = $originalCost - $discountAmount;
            $_SESSION['totalCost2'] = number_format($newtotalCost);
        }
        else{
            $_SESSION['totalCost2'] = $originalCost;

        }
        return $newtotalCost;
        

    }



    

    
}