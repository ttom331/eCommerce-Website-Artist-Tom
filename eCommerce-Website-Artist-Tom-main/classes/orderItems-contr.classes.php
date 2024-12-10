<?php 
class ViewOrderContr extends GetSelectedOrder{
    private $orderid;




    public function __construct($orderid){ //these are data grabbed from user
        $this->orderid = $orderid;
    }


    public function viewOrderItems(){
        $this->fetchOrderItems($this->orderid);
    }


}