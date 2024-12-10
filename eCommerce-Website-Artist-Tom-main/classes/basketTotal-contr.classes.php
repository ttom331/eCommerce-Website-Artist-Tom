<?php

class BasketTotalContr extends Basket{
    private $customer_ID;


    public function __construct($customer_ID,){ //these are data grabbed from user
        $this->customer_ID = $customer_ID;
    }

    public function calculateTotalAmount(){
        $this->calculateTotal($this->customer_ID);
        
    }


}