<?php

class OrderContr extends Order{
    private $customer_ID;
    private $address1;
    private $address2;
    private $town;
    private $postcode;
    private $orderTotal;
    private $orderStatus;
    private $orderDate;



    public function __construct($customer_ID, $address1, $address2, $town, $postcode, $orderTotal, $orderStatus, $orderDate){ //these are data grabbed from user
        $this->customer_ID = $customer_ID;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->town = $town;
        $this->postcode = $postcode;
        $this->orderTotal = $orderTotal;
        $this->orderStatus = $orderStatus;
        $this->orderDate = $orderDate;
    }

    public function addToOrder(){
        $this->addOrder($this->customer_ID, $this->address1, $this->address2, $this->town, $this->postcode, $this->orderTotal, $this->orderStatus, $this->orderDate);
    }


}
