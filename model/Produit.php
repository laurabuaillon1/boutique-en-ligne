<?php

class Products{
    private int $id;
    private string $name;
    private string $description;
    private float $prix;
    private string $date;
    

    //CONSTRUCTEURS

    public function __construct($id,$name,$description,$prix,$date)
    {
        $this->id = $id;
        $this->name=$name;
        $this->description=$description;
        $this->prix=$prix;
        $this->date=$date;

    }

    //GETTER

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPrix(){
        return $this->prix;
    }

    public function getDate(){
        return $this->date;
    }


    //SETTER

    public function setName(string $name){
        $this->name=$name;
    }

    public function setDescription(string $description){
        $this->description=$description;
    }

    public function setPrix(float $prix){
        $this->prix=$prix;
    }
}

?>