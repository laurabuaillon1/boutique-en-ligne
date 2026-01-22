<?php
//CHARGER TOUT LES CONTROLEURS ET REPOSITORIES

//controleur
require_once  './controller/ProduitController.php';
require_once  './controller/UtilisateurController.php';


//repositories
require_once  './repository/ProduitRepository.php';
require_once  './repository/UtilisateurRepository.php';

$pdo = getPDO();
$utilisateurRepository = new UtilisateurRepository($pdo);

$page = $_GET['page'] ?? 'home';
switch ($page) {

    //PRODUITS

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
        $controler = new UtilisateurController($utilisateurRepository);
        $controler->inscription();
        break;

    //connexion
    case 'login':
        $controler = new UtilisateurController($utilisateurRepository);
        $controler->connexion();
        break;

    //deconnexion

    case 'deconnexion':
        $controler = new UtilisateurController($utilisateurRepository);
        $controler->deconnexion((int)($_GET['id'] ?? 0));
        break;

    case 'home':
    default:
        $controler = new ProductController();
        $controler->index();
        break;



    //PANIER

    case 'panier':
        $controller = new CommandeController($detailCommandeRepository);
        $controler->show();
        break;
}
