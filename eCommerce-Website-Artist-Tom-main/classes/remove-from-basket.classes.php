<?php


    $userid = $_SESSION["userid"];

    class RemoveFromBasket extends Dbh {
    

        public function removeBasket($userid) {
            $stmt = $this->connect()->prepare('DELETE FROM basket WHERE user_id = ?');
            $stmt->execute(array($userid)); // Execute the prepared statement
            $selectedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $selectedProducts; // Return the fetched products
        }
    }
    
    $selectedPrints = new RemoveFromBasket();
    $print = $selectedPrints->removeBasket($userid);
