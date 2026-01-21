<?php

require_once __DIR__ . '/../controller/ProduitController.php';
require_once __DIR__ . '/../controller/UtilisateurController.php';

$page = $_GET['page'] ?? 'home';


switch ($page) {

    //PRODUITS

    //liste des produits
    case 'produits':
        $controler = new ProductController();
        $controler->index();
        break;

    //voir un produit
    case 'produit':
        $controler = new ProductController();
        $controler->show((int)($_GET['id'] ?? 0));
        break;

    //supprimer un produit
    case 'supprimer':
        $controler = new ProductController();
        $controler->delete((int)($_GET['id'] ?? 0));
        break;


    //UTILISATEURS

    //inscription
    case 'inscription':
        $controler = new ProductController();
        $controler->inscription();
        break;

    //connexion
    case 'connexion':
        $controler = new ProductController();
        $controler->connexion();
        break;

    //deconnexion

    case 'deconnexion':
        $controler = new ProductController();
        $controler->delete((int)($_GET['id'] ?? 0));
        break;
}
