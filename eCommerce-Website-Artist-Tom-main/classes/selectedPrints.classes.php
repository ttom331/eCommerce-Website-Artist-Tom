<?php

include "dbh.classes.php";

if (isset($_GET['print_ID'])){

    $printID = $_GET['print_ID'];

    class SelectedPrints extends Dbh {
    

        public function selectedPrint($printID) {
            $stmt = $this->connect()->prepare('SELECT * FROM prints WHERE print_ID = ?');
            $stmt->execute(array($printID)); // Execute the prepared statement
            $selectedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $selectedProducts; // Return the fetched products
        }
    }
    
    $selectedPrints = new SelectedPrints();
    $print = $selectedPrints->selectedPrint($printID);
}


