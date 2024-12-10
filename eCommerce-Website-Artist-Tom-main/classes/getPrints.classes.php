<?php

include 'dbh.classes.php'; // Make sure this path is correct



class GetPrints extends Dbh {
    

    public function fetchProducts() {
        $getProducts = $this->connect()->prepare('SELECT * FROM prints');
        $getProducts->execute(); // Execute the prepared statement
        $products = $getProducts->fetchAll(PDO::FETCH_ASSOC);
        return $products; // Return the fetched products
    }
}

$getPrints = new GetPrints();
$prints = $getPrints->fetchProducts();





