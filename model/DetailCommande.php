<?php

class Orderitem {
       private int $id;
       private string $order_id;
       private string $product_id;
       private int $quantity;
       private float $unit_price;
       


       //CONSTRUCTEUR

       public function __construct($id,$order_id,$product_id,$quantity,$unit_price)
       {
        $this->id=$id;
        $this->order_id=$order_id;
        $this->product_id=$product_id;
        $this->quantity=$quantity;
        $this->unit_price=$unit_price;
       
       }

       //GETTER 

       public function getId(){
        return $this->id;
       }

       public function getOrderItem(){
        return $this->order_id;
       }

       public function getProductId(){
        return $this->product_id;
       }

       public function getQuantity(){
        return $this->quantity;
       }

       public function getUnitPrice(){
        return $this->unit_price;
       }

       

       //SETTER

       public function setQuantity(float $quantity){
        $this->quantity=$quantity;
       }

       public function setUnitPrice(float $unit_price){
         $this->unit_price=$unit_price;
       }
}














?>