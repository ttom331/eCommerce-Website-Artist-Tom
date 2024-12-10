<?php

include 'dbh.classes.php'; // Make sure this path is correct



class GetCards extends Dbh {
    

    public function fetchCards() {
        $getProducts = $this->connect()->prepare('SELECT * FROM printcard');
        $getProducts->execute(); // Execute the prepared statement
        $products = $getProducts->fetchAll(PDO::FETCH_ASSOC);
        return $products; // Return the fetched products
    }
}

$getCard= new GetCards();
$cards = $getCard->fetchCards();
