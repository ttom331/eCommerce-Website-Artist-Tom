<?php

class RemoveBasketContr extends Basket{
    private $print_ID;

    private $customer_ID;

    public function __construct($print_ID, $customer_ID){ //these are data grabbed from user
        $this->print_ID = $print_ID;
        $this->customer_ID = $customer_ID;
    }

    public function removePrintFromBasket(){
        $this->removePrint($this->print_ID, $this->customer_ID);
    }


}