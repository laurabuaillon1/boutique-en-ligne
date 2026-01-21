<?php

require_once __DIR__ . '/../controller/ProduitController.php';

$page = $_GET['page'] ?? 'home';


switch ($page){

   //liste des produits
   case 'produits':
    $controler = new ProductController();
    $controler->index();
    break;

    //voir un produit
    case 'produit':
    $controler = new ProductManager();
    $controler->show();
    break;

    //supprimer un produit
    case 'supprimer':
    $controler = new ProductManager();
    $controler->delete();
    break;







}