<?php

class BasketContr extends Basket{
    private $customer_ID;
    private $print_ID;
    private $print_Name;
    private $print_Img;
    private $print_Price;
    private $print_Quantity;

    public function __construct($customer_ID, $print_ID, $print_Name, $print_Img, $print_Price, $print_Quantity){ //these are data grabbed from user
        $this->customer_ID = $customer_ID;
        $this->print_ID = $print_ID;
        $this->print_Name = $print_Name;
        $this->print_Img = $print_Img;
        $this->print_Price = $print_Price;
        $this->print_Quantity = $print_Quantity;
    }

    public function addPrintToBasket(){
        $this->addPrint($this->customer_ID, $this->print_ID, $this->print_Name, $this->print_Img, $this->print_Price, $this->print_Quantity);
    }


}

class PromoCodeContr extends Basket{
    private $code;
    private $customer_ID;
    

    public function __construct($code, $customer_ID){ //these are data grabbed from user
        $this->code = $code;
        $this->customer_ID = $customer_ID;

    }

    public function addDiscount(){
        $this->discountCheck($this->code, $this->customer_ID);
    }


}