<?php

class Product
{
    private int $id;
    private string $name;
    private string $description;
    private string $prix;
    private string $date;
    
   


    //CONSTRUCTEURS

    public function __construct($id, $name, $description, $prix, $date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->prix = $prix;
        $this->date = $date;
        
    }

    //GETTER

    public function getId():int
    {
        return $this->id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function getPrix():string
    {
        return $this->prix . "€";
    }

    public function getDate():string
    {
        return $this->date;
    }

    public function getImage():string{
        $image=[
            'Bridon simple'=>'bridons.jpg',
            'Bombe samshield'=>'bombe_samshield.jpg',
            'Tapis'=>'tapis_de_selle.jpg',
        ];

        return $image[$this->name] ?? 'default.jpg';
    }



    //SETTER

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setPrix(float $prix)
    {
        $this->prix = $prix ;
    }



    }

    
