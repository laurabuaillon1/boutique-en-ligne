<?php

//CLASS USERS

class User{

//PROPRIETES
private int $id;
private string $email;
private string $password;
private string $role;


//CONSTRUCTEURS

//pour creer l'utilisateur
public function __construct($id,$email,$password,$role)
{
    $this->id = $id;
    $this->email =$email;
    $this->password =$password;
    $this->role=$role;
}


//UTILISATION DE GETTER ET SETTER CAR LES PROPRIETES SONT EN PRIVATE

//GETTER
public function getId():int{
    return $this->id;
}

public function getEmail():string{
    return $this->email;
}

public function getPassword():string{
    return $this->password;
}

public function getRole():string{
    return $this->role;
}


//SETTER

public function setEmail(string $email){
    $this->email=$email;
}

public function setPassword(string $password){
    $this->password=$password;
}

public function setRole(string $role){
    $this->role=$role;
}

}








?>