<?php

class Orders{

       private int $id;
       private string $user_id;
       private string $created_at;
       private string $total;


       //CONSTRUCTEUR

       public function __construct($id,$user_id,$created_at,$total)
       {
        $this->id=$id;
        $this->user_id=$user_id;
        $this->created_at=$created_at;
        $this->total=$total;
       }


       //GETTER

       public function getId(){
        return $this->id;
       }

       public function getUserid(){
        return $this->user_id;
       }

       public function getCreatedAt(){
        return $this->created_at;
       }

       public function getTotal(){
        return $this->total;
       }

       //SETTER

       public function setTotam(string $total){
        $this->total=$total;
       }
}









?>