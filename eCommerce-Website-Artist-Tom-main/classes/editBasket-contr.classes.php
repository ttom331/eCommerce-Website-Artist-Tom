<?php

class EditBasketContr extends Basket{
    private $print_ID;
    private $quantity;

    private $customer_ID;

    public function __construct($print_ID, $quantity, $customer_ID){ //these are data grabbed from user
        $this->print_ID = $print_ID;
        $this->quantity = $quantity;
        $this->customer_ID = $customer_ID;
    }

    public function editPrintFromBasket(){
        $this->editPrint($this->print_ID, $this->quantity, $this->customer_ID);
    }


}